<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\BannerRepositoryInterface;
 

class BannerController extends Controller
{
    protected $bannerRepository;
    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }
    public function list()
    {
        $this->bannerRepository->getAllBanners();
    }
    public function index()
    {
        if (!auth()->user()->hasPermission('Banner Listing')) {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to view Banner Listing!');
        }
        $banners = $this->bannerRepository->getAllBanners();
        return view('backend.banners.banner', compact('banners'));
    }
    public function create()
    {
        if (!auth()->user()->hasPermission('Banner Add')) {
            return redirect()->route('banners.index')->with('error', 'You do not have permission to Add New Banner!');
        }
        return view('backend.banners.create');
    }
    public function store(Request $request)
    {
        if (!auth()->user()->hasPermission('Banner Add')) {
            return redirect()->route('banners.index')->with('error', 'You do not have permission to Add New Banner!');
        }
        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required|string|max:255',
            'btn_text' => 'required|string|max:255',
            'btn_link' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/banner'), $filename);
                $data['image'] = $filename;
            } else {
                return back()->withErrors(['image' => 'Uploaded file is not valid'])->withInput();
            }
        }  
        $this->bannerRepository->createBanner($data);

        return redirect()->route('banners.index')->with('success', 'Banner Added Successfully.');
    }
    public function edit($id)
    {
        if (!auth()->user()->hasPermission('Banner Edit')) {
            return redirect()->route('banners.index')->with('error', 'You do not have permission to Edit Banner!');
        }
        $banner = $this->bannerRepository->getBannerById($id);
        return view('backend.banners.edit', compact('banner'));
    }
    public function update(Request $request, $id)
    {
        if (!auth()->user()->hasPermission('Banner Edit')) {
            return redirect()->route('banners.index')->with('error', 'You do not have permission to Edit Banner!');
        }
        $validatedData = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
            'description' => 'required|string|max:255',
            'btn_text' => 'required|string|max:255',
            'btn_link' => 'required|string|max:255',
        ]);
        $banner = $this->bannerRepository->getBannerById($id);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            if ($file->isValid()) {
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads/banner'), $filename);
                $data['image'] = $filename;
                if ($banner->image && file_exists(public_path('uploads/banner/' . $banner->image))) {
                    unlink(public_path('uploads/banner/' . $banner->image));
                }
            } else {
                return back()->withErrors(['image' => 'Uploaded file is not valid'])->withInput();
            }
        } else {
            $data['image'] = $banner->image;
        }

        $this->bannerRepository->updateBanner($id, $data);

        return redirect()->route('banners.index')->with('success', 'Banner Updated Successfully.');
    }
    public function show($id)
    {
        if (!auth()->user()->hasPermission('Banner Detail')) {
            return redirect()->route('banners.index')->with('error', 'You do not have permission to view Banner Details!');
        }
        $banner = $this->bannerRepository->getBannerById($id);
        return view('backend.banners.show',compact('banner'));
    }
    public function destroy($id)
    {
        if (!auth()->user()->hasPermission('Banner Delete')) {
            return redirect()->route('banners.index')->with('error', 'You do not have permission to Delete Banner!');
        }
        $banner = $this->bannerRepository->deleteBanner($id);
        if(!$banner)
        {
            return redirect()->route('banners.index')->with('error','Banner not found.');
        }
        return redirect()->route('banners.index')->with('success','Banner deleted successfully');
    }
    public function updateStatus($id, $status)
    {
        if (!auth()->user()->hasPermission('Banner Change Status')) {
            return redirect()->route('banners.index')->with('error', 'You do not have permission to Change Banner Status!');
        }
        $banner = $this->bannerRepository->updateBannerStatus($id, $status);
        return redirect()->route('banners.index')->with('success', $status==1 ? 'Banner activated successfully':'Banner deactivated successfully');
    }
}
