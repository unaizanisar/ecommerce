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
        $banners = $this->bannerRepository->getAllBanners();
        return view('backend.banners.banner', compact('banners'));
    }
    public function create()
    {
        return view('backend.banners.create');
    }
    public function store(Request $request)
    {
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
        $banner = $this->bannerRepository->getBannerById($id);
        return view('backend.banners.edit', compact('banner'));
    }
    public function update(Request $request, $id)
    {
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
        $banner = $this->bannerRepository->getBannerById($id);
        return view('backend.banners.show',compact('banner'));
    }
    public function destroy($id)
    {
        $banner = $this->bannerRepository->deleteBanner($id);
        if(!$banner)
        {
            return redirect()->route('banners.index')->with('error','Banner not found.');
        }
        return redirect()->route('banners.index')->with('success','Banner deleted successfully');
    }
    public function updateStatus($id, $status)
    {
        $banner = $this->bannerRepository->updateBannerStatus($id, $status);
        return redirect()->route('banners.index')->with('success', $status==1 ? 'Banner activated successfully':'Banner deactivated successfully');
    }
}
