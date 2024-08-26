<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function viewCategory($id)
    {
        // Get the current category
        $category = Category::findOrFail($id);

        // Get products in the category
        $products = Product::where('category_id', $id)->paginate(12);

        // Get all categories for the sidebar
        $categories = Category::where('status', 1)->get();

        // Pass the current category, products, and all categories to the view
        return view('frontend.frontend.category', compact('category', 'products', 'categories'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Search for products matching the query
        $products = Product::where('name', 'LIKE', "%$query%")
            ->orWhere('description', 'LIKE', "%$query%")
            ->paginate(12);

        // Return a view with the search results
        return view('frontend.frontend.search-results', compact('products', 'query'));
    }
}
