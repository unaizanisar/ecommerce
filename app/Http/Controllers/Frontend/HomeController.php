<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subscription;


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

    // Apply sorting
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



}
