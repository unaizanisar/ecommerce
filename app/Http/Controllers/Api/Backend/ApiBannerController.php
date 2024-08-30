<?php

namespace App\Http\Controllers\Api\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Interfaces\BannerRepositoryInterface;

class ApiBannerController extends Controller
{
    protected $bannerRepository;
    public function __construct(BannerRepositoryInterface $bannerRepository)
    {
        $this->bannerRepository = $bannerRepository;
    }
    public function index()
    {
        $banner = $this->bannerRepository->getAllBanners();
        return response()->json($banner, 200);
    }
    public function show($id)
    {
        try{
            $banner = $this->bannerRepository->getBannerById($id);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Banner not found'
            ], 404);
        }
        return response()->json($banner, 200);
    }
    public function store(Request $request)
    {
        try{
            $validator = Validator::make($request->all(),[
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  
                'description' => 'required|string|max:255',
                'btn_text' => 'required|string|max:255',
                'btn_link' => 'required|string|max:255',
            ]);
            if($validator->fails())
            {
                return response()->json($validator->errors(), 422);
            }
            $data = $request->all();
            if($request->hasFile('image'))
            {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/banner'), $filename);
                    $data['image'] = $filename;
                } else {
                    return response()->json(['image' => 'Uploaded file is not valid'], 422);
                }
            }
            $banner = $this->bannerRepository->createBanner($data);
            return response()->json(['message' => 'Banner created successfully', 'banner' => $banner], 201);
        } catch (\Exception $e){
            return response()->json(['error'=>'An error occured while creating banner', 'message'=>$e->getMessage()], 500);
        }
    }
    public function update($id, Request $request)
    {
        try{
            $validatedData = $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',  
                'description' => 'required|string|max:255',
                'btn_text' => 'required|string|max:255',
                'btn_link' => 'required|string|max:255',
            ]);

            $data = $request->all();
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                if ($file->isValid()) {
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads/banner'), $filename);
                    $data['image'] = $filename;
                } else {
                    return response()->json(['image' => 'Uploaded file is not valid'], 422);
                }
            }

            $banner = $this->bannerRepository->updateBanner($id, $data);
            return response()->json(['message' => 'Banner updated successfully', 'banner' => $banner], 200);
        } catch (\Exception $e){
            return response()->json(['error'=>'An error occured while updating banner', 'message'=>$e->getMessage()], 500);
        }
    }
    public function destroy($id)
    {
        try{
            $order = $this->bannerRepository->deleteBanner($id);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'Banner not found'], 404);
        }
        return response()->json(['message'=>'Banner deleted successfully'], 200);
    }
    public function updateStatus($id, $status)
    {
        try{
            $banner = $this->bannerRepository->updateBannerStatus($id, $status);
        } catch(\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json(['error'=>'Banner not found'], 404);
        }
        $message = $status == 1 ? 'Banner activated successfully':'Banner deactivated successfully';
        return response()->json(['message'=>$message], 200);
    }
}

