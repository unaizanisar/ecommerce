<?php

namespace App\Repositories;

use App\Models\Banner; 
use App\Interfaces\BannerRepositoryInterface;

class BannerRepository implements BannerRepositoryInterface
{
    public function getAllBanners()
    {
        return Banner::orderBy('id', 'desc')->get();
    }
    public function getBannerById($id)
    {
        return Banner::findOrFail($id);
    }
    public function createBanner(array $data)
    {
        $banner = new Banner();
        if (isset($data['image'])) {
            $banner->image = $data['image'];
        }
        $banner->description = $data['description'];
        $banner->btn_text = $data['btn_text'];
        $banner->btn_link = $data['btn_link'];
        $banner->save();
        return $banner;
    } 
    public function updateBanner($id, array $data)
    {
        $banner = Banner::findOrFail($id);
        if (isset($data['image'])) {
            $banner->image = $data['image'];
        }
        $banner->description = $data['description'];
        $banner->btn_text = $data['btn_text'];
        $banner->btn_link = $data['btn_link'];
        $banner->save();
        return $banner;
    }
    public function deleteBanner($id)
    {
        $banner = Banner::findOrFail($id);
        if($banner)
        {
            $banner->delete();
        }
        return $banner;
    }
    public function updateBannerStatus($id, $status)
    {
        $banner = Banner::findOrFail($id);
        $banner->status = $status;
        $banner->save();
        return $banner;
    }
}