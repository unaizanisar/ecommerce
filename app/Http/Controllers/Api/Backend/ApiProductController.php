<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;

class ApiProductController extends Controller
{
    protected $productRepository;
    protected $categoryRepository;
    public function __construct(ProductRepositoryInterface $productRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }
    public function index()
    {
        $products = $this->productRepository->getAllProducts();
        return response()->json($products, 200);
    }
    public function show($id)
    {
        try {
            $product = $this->productRepository->getProductById($id);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json($product, 200);
    }
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0',
                'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required|exists:categories,id',
            ]);
            if($validator->fails())
            {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $data = $request->all();
            if ($request->hasFile('images')) {
                $file = $request->file('images');
                if ($file->isValid()) {
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/products'), $filename); 
                    $data['images'] = $filename;
                } else {
                    return response()->json(['errors' => 'Upload file is not valid'], 422);
                }
            }
            $product = $this->productRepository->createProduct($data);
            return response()->json(['product'=> $product, 'message' => 'Product created successfully'], 201);
        }
        catch(\Exception $e){
            return response()->json(['error' => 'An error occurred while creating the product', 'message' => $e->getMessage()], 500);
        }
    }
    public function update($id, Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'stock' => 'required|numeric|min:0',
                'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'category_id' => 'required|exists:categories,id',
            ]);

            $product = $this->productRepository->getProductById($id);
            if (!$product) {
                return response()->json(['error' => 'Product not found'], 404);
            }

            $data = $validatedData;

            if ($request->hasFile('images')) {
                $file = $request->file('images');
                if ($file->isValid()) {
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/products'), $filename);
                    $data['images'] = $filename;

                    // Delete the old image if it exists
                    if ($product->images && file_exists(public_path('uploads/products/' . $product->images))) {
                        unlink(public_path('uploads/products/' . $product->images));
                    }
                } else {
                    return response()->json(['error' => 'Uploaded file is not valid'], 422);
                }
            }

            $this->productRepository->updateProduct($id, $data);
            return response()->json(['message' => 'Product updated successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred while updating the product', 'message' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try{
            $product = $this->productRepository->deleteProduct($id);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e){
            return response()->json(['error' => 'Product not found'], 404);
        }
        return response()->json(['message' => 'Product deleted successfully'], 200);
    }
    public function updateStatus($id, $status)
    {
        try{
            $product = $this->productRepository->updateProductStatus($id, $status);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'Product not found'], 404);
        }
        $message = $status == 1 ? 'Product activated successfully' : 'Product deactivated successfully';
        return response()->json(['message' => $message], 200);
    }
}   
