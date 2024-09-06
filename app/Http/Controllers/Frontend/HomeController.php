<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subscription;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    public function index(Request $request)
{
    $result['home_categories'] = DB::table('categories')
        ->where(['status' => 1])
        ->where(['is_home' => 1])
        ->get();
    
    foreach ($result['home_categories'] as $list) {
        $result['home_categories_product'][$list->id] = DB::table('products')
            ->where(['status' => 1])
            ->where(['is_home' => 1])
            ->where(['category_id' => $list->id])
            ->get();
    }
    
    $result['featured_products'] = DB::table('products')
        ->where(['status' => 1])
        ->where(['is_featured' => 1])
        ->get();

    $result['banners'] = DB::table('banners')
        ->where(['status' => 1])
        ->get();
    return view('frontend.frontend.index', $result);
}

public function show($id)
{
    $product = DB::table('products')->where('id', $id)->first();
    $reviews = DB::table('reviews')
        ->where('product_id', $id)
        ->orderBy('id', 'desc')
        ->paginate(3);
    $featured_products = DB::table('products')->where('is_featured', true)->get();
    return view('frontend.frontend.product_details', compact('product', 'reviews', 'featured_products'));
}
    public function storeReview(Request $request, $productId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string',
        ]);

        Review::create([
            'product_id' => $productId,
            'name' => $request->name,
            'email' => $request->email,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Review added successfully.');
    }
    public function viewProducts(Request $request)
{
    $query = DB::table('products')
        ->where('status', 1);
    $sortBy = $request->input('sort', 'id'); // Default to sorting by 'id'
    $sortOrder = $request->input('order', 'desc'); // Default to 'desc'

    switch ($sortBy) {
        case 'name':
            $query->orderBy('name', $sortOrder);
            break;
        case 'date':
            $query->orderBy('created_at', $sortOrder);
            break;
        case 'price':
            $query->orderBy('price', $sortOrder);
            break;
        default:
            $query->orderBy('id', $sortOrder);
            break;
    }

    $products = $query->paginate(9);

    $categories = DB::table('categories')
        ->where('status', 1)
        ->get();

    return view('frontend.frontend.products', compact('products', 'categories'));
}

    public function contact()
    {
        return view('frontend.frontend.contact');
    }

    public function account()
    {
        return view('frontend.frontend.account');
    }

    public function orderDetails()
    {
        $customer = auth()->guard('customer')->user();
        $orders = Order::where('customer_id', $customer->id)->get();
        return view('frontend.frontend.order_details', compact('orders'));
    }

    public function profile()
    {
        $customer = Auth::user();
        return view('frontend.frontend.profile',compact('customer'));
    }
    public function updateProfile(Request $request)
    {
        $customer = auth()->user();
        $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'password' => 'nullable|min:8',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'country' => 'nullable|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);
        $customer->firstname = $request->firstname;
        $customer->lastname = $request->lastname;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->city = $request->city;
        $customer->state = $request->state;
        $customer->country = $request->country;
        $customer->postal_code = $request->postal_code;
        if ($request->filled('password')) {
            $customer->password = bcrypt($request->password); 
        }
        $customer->save();
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}

