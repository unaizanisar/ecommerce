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
        ]);
        if (!session()->has('cart') || count(session('cart')) == 0) {
            return redirect()->route('product.viewProducts')->with('error', 'Your cart is empty!');
        }
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
        $order->save();
        foreach (session('cart') as $id => $details) {
            $order->orderItems()->create([
                'product_id' => $id,
                'quantity' => $details['quantity'],
                'price' => $details['price'],
            ]);
        }
        session()->forget('cart');
        return redirect()->route('order.done')->with('success', 'Your order has been placed successfully!');
    }
}
