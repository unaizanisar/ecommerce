<?php
 
namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAllProducts()
    {
        return Product::with('category')->orderBy('id', 'desc')->get();
    }

    public function getProductById($id)
    {
        return Product::with('category')->findOrFail($id);
    }

    public function createProduct(array $data)
    {
        return Product::create($data);
    }
    public function updateProduct($id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);
        return $product;
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        if($product)
        {
            $product->delete();
        }
        return $product;
    }
    public function updateProductStatus($id, $status)
    {
        $product = Product::findOrFail($id);
        $product->status = $status;
        $product->save();
        return $product;
    }
    public function updateProductFeatured($id, $is_featured)
    {
        $product = Product::findOrFail($id);
        $product->is_featured = $is_featured;
        $product->save();
        return $product;
    }
    public function updateProductHome($id, $is_home)
    {
        $product = Product::findOrFail($id);
        $product->is_home = $is_home;
        $product->save();
        return $product;
    }
    public function getAllCategories()
    {
        return Category::all();
    }
}