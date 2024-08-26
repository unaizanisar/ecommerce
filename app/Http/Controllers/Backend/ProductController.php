<?php
namespace App\Http\Controllers\Backend;
 
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;

class ProductController extends Controller
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
        if (!auth()->user()->hasPermission('Product Listing')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view Product Listing!');
        }
        $products = $this->productRepository->getAllProducts();
        return view('backend.product.product', compact('products'));
    }

    public function create()
    {
        if (!auth()->user()->hasPermission('Product Add')) {
            return redirect()->route('products.index')->with('error', 'You do not have permission to Add Product!');
        }
        $categories = $this->categoryRepository->getAllCategories();
        return view('backend.product.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission('Product Add')) {
            return redirect()->route('products.index')->with('error', 'You do not have permission to Add Product!');
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename);
                $data['images'] = $filename;
            } else {
                return back()->withErrors(['images' => 'Uploaded file is not valid'])->withInput();
            }
        }  
        $this->productRepository->createProduct($data);

        return redirect()->route('products.index')->with('success', 'Product Added Successfully.');
    }

    public function show($id)
    {
        if (!auth()->user()->hasPermission('Product Detail')) {
            return redirect()->route('products.index')->with('error', 'You do not have permission to view Product Details!');
        }
        $product = $this->productRepository->getProductById($id);
        return view('backend.product.show', compact('product'));
    }


    public function edit($id)
    {
        if (!auth()->user()->hasPermission('Product Edit')) {
            return redirect()->route('products.index')->with('error', 'You do not have permission to Edit Product!');
        }
        $product = $this->productRepository->getProductById($id);
        $categories = $this->categoryRepository->getAllCategories();
        return view('backend.product.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasPermission('Product Edit')) {
            return redirect()->route('products.index')->with('error', 'You do not have permission to Edit Product!');
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);
        $product = $this->productRepository->getProductById($id);

        $data = $request->all();
        if ($request->hasFile('images')) {
            $file = $request->file('images');
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/products'), $filename);
                $data['images'] = $filename;
                if ($product->images && file_exists(public_path('uploads/' . $product->images))) {
                    unlink(public_path('uploads/products/' . $product->images));
                }
            } else {
                return back()->withErrors(['images' => 'Uploaded file is not valid'])->withInput();
            }
        } else {
            $data['images'] = $product->images;
        }

        $this->productRepository->updateProduct($id, $data);

        return redirect()->route('products.index')->with('success', 'Product Updated Successfully.');
    }

    public function destroy($id)
    {
        if (!auth()->user()->hasPermission('Product Delete')) {
            return redirect()->route('products.index')->with('error', 'You do not have permission to Delete Product!');
        }
        $product = $this->productRepository->getProductById($id);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        $this->productRepository->deleteProduct($id);

        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully.');
    }

    public function updateStatus($id, $status)
    {
        if (!auth()->user()->hasPermission('Product Change Status')) {
            return redirect()->route('products.index')->with('error', 'You do not have permission to Change Product Status!');
        }
        $product = $this->productRepository->getProductById($id);
        $this->productRepository->updateProductStatus($id, $status);

        return redirect()->route('products.index')->with('success', $status == 1 ? 'Product Activated Successfully!' : 'Product Deactivated Successfully');
    }
    public function updateFeatured($id, $is_featured)
    {
        if (!auth()->user()->hasPermission('Feature Product')) {
            return redirect()->route('products.index')->with('error', 'You do not have permission to Feature this Product!');
        }
        $product = $this->productRepository->getProductById($id);
        $this->productRepository->updateProductFeatured($id, $is_featured);

        return redirect()->route('products.index')->with('success', $is_featured == 1 ? 'Product Featured Successfully!' : 'Product Removed from Featured Successfully');
    }
    public function updateHome($id, $is_home)
    {
        if (!auth()->user()->hasPermission('Home Product')) {
            return redirect()->route('products.index')->with('error', 'You do not have permission to display this Product at Home screen!');
        }
        $product = $this->productRepository->getProductById($id);
        $this->productRepository->updateProductHome($id, $is_home);

        return redirect()->route('products.index')->with('success', $is_home == 1 ? 'Product Displayed Successfully!' : 'Product Removed from Home Successfully');
    }
}
