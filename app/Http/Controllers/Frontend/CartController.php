<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class CartController extends Controller 
{
    public function index()
    {
        return view('frontend.frontend.cart'); 
    }
    public function add(Request $request)
    {
        $product = Product::find($request->product_id);
    
        if (!$product) {
            return redirect()->back()->with('error', 'Product not found!');
        }
        $cart = session()->get('cart', []);
        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['quantity']++;
        } else {
            $cart[$request->product_id] = [
                'name' => $product->name,
                'quantity' => $request->quantity,
                'price' => $product->price,
                'image' => $product->images
            ];
        }
        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Product added to cart!');
    }
    public function decrease($id)
    {
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            if ($cart[$id]['quantity'] > 1) {
                $cart[$id]['quantity']--;
            } else {
                unset($cart[$id]);
            }
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product quantity decreased!');
        }
        return redirect()->back()->with('error', 'Product not found in cart!');
    }
    public function remove($id)
    { 
        $cart = session()->get('cart');
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product removed from cart!');
        }
        return redirect()->back()->with('error', 'Product not found in cart!');
    }
    public function checkout()
    {
        $cart = session()->get('cart');
        if (!$cart) {
            return view('frontend.frontend.empty');
        }
        $total = array_reduce($cart, function($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);
        return view('frontend.frontend.checkout', compact('cart', 'total'));
    }
    
    public function placeOrder(Request $request)
{
    $request->validate([
        'firstname' => 'required|string',
        'lastname' => 'required|string',
        'email'  => 'required|string',
        'phone' => 'required|string',
        'address' => 'required|string',
        'city' => 'required|string',
        'postal_code' => 'required|string',
        'total' => 'required|numeric',
        'payment_method' => 'required|string',
    ]);

    if ($request->payment_method === 'stripe') {
        $request->validate([
            'stripeToken' => 'required|string',
        ]);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = \Stripe\Charge::create([
                'amount' => $request->total * 100,
                'currency' => 'usd',
                'description' => 'Order Payment',
                'source' => $request->stripeToken,
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    $trackingID = 'PKJ' . strtoupper(uniqid());
    $order = new Order();

    if (auth()->check()) {
        $order->user_id = auth()->user()->id;
    }

    $order->firstname = $request->firstname;
    $order->lastname = $request->lastname;
    $order->email = $request->email;
    $order->city = $request->city;
    $order->postal_code = $request->postal_code;
    $order->total = $request->total;
    $order->address = $request->address;
    $order->phone = $request->phone;
    $order->tracking_id = $trackingID;
    $order->payment_method = $request->payment_method;

    $order->save();

    foreach (session('cart') as $id => $details) {
        $order->orderItems()->create([
            'product_id' => $id,
            'quantity' => $details['quantity'],
            'price' => $details['price'],
        ]);
    }

    session()->forget('cart');

    return redirect()->route('order.done')->with('trackingID', $trackingID)->with('success', 'Your order has been placed successfully!');
}


    public function showTrackForm()
    {
        return view('frontend.frontend.track');
    }
    public function trackOrder(Request $request)
    {
        $request->validate([
            'trackingID' => 'required|string',
        ]);

        $order = Order::where('tracking_id', $request->trackingID)->first();

        if (!$order) {
            return redirect()->back()->with('error', 'Invalid Tracking ID');
        }
        return view('frontend.frontend.trackResult', compact('order'));
    }
}
