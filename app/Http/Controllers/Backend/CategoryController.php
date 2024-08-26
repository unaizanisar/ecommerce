<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\CategoryRepositoryInterface;
 
class CategoryController extends Controller
{
    protected $categoryRepository;
    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function list()
    {
        $this->categoryRepository->getAllCategories();
    }
    public function index()
    {
        if (!auth()->user()->hasPermission('Category Listing')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view Category Listing!');
        }
        $categories = $this->categoryRepository->getAllCategories();
        return view('backend.categories.category', compact('categories'));
    }
    public function create()
    {
        if (!auth()->user()->hasPermission('Category Add')) {
            return redirect()->route('categories.index')->with('error', 'You do not have permission to Add Category!');
        }
        return view('backend.categories.create');
    }
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission('Category Add')) {
            return redirect()->route('categories.index')->with('error', 'You do not have permission to Add Category!');
        }
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);
        if($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/category'), $filename);
                $data['image'] = 'category/' . $filename;
            } else {
                return back()->withErrors(['image' => 'Uploaded file is not valid'])->withInput();
            }
        }
        $this->categoryRepository->createCategory($data);
        return redirect()->route('categories.index')->with('success','Category created successfully');
    }
    public function show($id)
    {
        if (!auth()->user()->hasPermission('Category Detail')) {
            return redirect()->route('categories.index')->with('error', 'You do not have permission to view Category Details!');
        }
        $category = $this->categoryRepository->getCategoryById($id);
        return view('backend.categories.show',compact('category'));
    }
    public function destroy($id)
    {
        if (!auth()->user()->hasPermission('Category Delete')) {
            return redirect()->route('categories.index')->with('error', 'You do not have permission to Delete Category!');
        }
        $category = $this->categoryRepository->deleteCategory($id);
        if(!$category)
        {
            return redirect()->route('categories.index')->with('error','Category not found.');
        }
        return redirect()->route('categories.index')->with('success','Category deleted successfully');
    }
    public function updateStatus($id, $status)
    {
        if (!auth()->user()->hasPermission('Category Change Status')) {
            return redirect()->route('categories.index')->with('error', 'You do not have permission to Change Category Status!');
        }
        $category = $this->categoryRepository->updateCategoryStatus($id, $status);
        return redirect()->route('categories.index')->with('success', $status==1 ? 'Category activated successfully':'Category deactivated successfully');
    }
    public function edit($id)
    {
        if (!auth()->user()->hasPermission('Category Edit')) {
            return redirect()->route('categories.index')->with('error', 'You do not have permission to Edit Category!');
        }
        $category = $this->categoryRepository->getCategoryById($id);
        return view('backend.categories.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasPermission('Category Edit')) {
            return redirect()->route('categories.index')->with('error', 'You do not have permission to Edit Category!');
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $category = $this->categoryRepository->getCategoryById($id);

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
                return back()->withErrors(['image' => 'Uploaded file is not valid'])->withInput();
            }
        } else {
            $data['image'] = $category->image;
        }

        $this->categoryRepository->updateCategory($id, $data);

        return redirect()->route('categories.index')->with('success', 'Category Updated Successfully.');
    }
    public function updateHome($id, $is_home)
    {
        if (!auth()->user()->hasPermission('Category Home')) {
            return redirect()->route('categories.index')->with('error', 'You do not have permission to display Category on Home Screen!');
        }
        $product = $this->categoryRepository->getCategoryById($id);
        $this->categoryRepository->updateCategoryHome($id, $is_home);

        return redirect()->route('categories.index')->with('success', $is_home == 1 ? 'Category Displayed Successfully!' : 'Category Removed from Home Successfully');
    }
}