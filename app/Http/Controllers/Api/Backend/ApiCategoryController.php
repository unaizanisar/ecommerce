<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\CategoryRepositoryInterface;

class ApiCategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->getAllCategories();
        return response()->json(['categories' => $categories], 200);
    }

    public function show($id)
    {
        $category = $this->categoryRepository->getCategoryById($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json(['category' => $category], 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/category'), $filename);
                $data['image'] = 'category/' . $filename;
            } else {
                return response()->json(['error' => 'Uploaded file is not valid'], 422);
            }
        }

        $category = $this->categoryRepository->createCategory($data);
        return response()->json(['category' => $category, 'message' => 'Category created successfully'], 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $category = $this->categoryRepository->getCategoryById($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/category'), $filename);
                $data['image'] = $filename;
                if ($category->image && file_exists(public_path('uploads/category/' . $category->image))) {
                    unlink(public_path('uploads/category/' . $category->image));
                }
            } else {
                return response()->json(['error' => 'Uploaded file is not valid'], 422);
            }
        } else {
            $data['image'] = $category->image;
        }

        $this->categoryRepository->updateCategory($id, $data);
        return response()->json(['message' => 'Category updated successfully'], 200);
    }

    public function destroy($id)
    {
        $category = $this->categoryRepository->deleteCategory($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        return response()->json(['message' => 'Category deleted successfully'], 200);
    }

    public function updateStatus($id, $status)
    {
        $category = $this->categoryRepository->updateCategoryStatus($id, $status);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $message = $status == 1 ? 'Category activated successfully' : 'Category deactivated successfully';
        return response()->json(['message' => $message], 200);
    }

    public function updateHome($id, $is_home)
    {
        $category = $this->categoryRepository->getCategoryById($id);

        if (!$category) {
            return response()->json(['error' => 'Category not found'], 404);
        }

        $this->categoryRepository->updateCategoryHome($id, $is_home);

        $message = $is_home == 1 ? 'Category displayed on home page' : 'Category removed from home page';
        return response()->json(['message' => $message], 200);
    }
}
