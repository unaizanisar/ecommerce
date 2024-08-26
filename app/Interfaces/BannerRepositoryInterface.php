<?php

namespace App\Interfaces;

interface BannerRepositoryInterface
{
    public function getAllBanners();
    public function getBannerById($id);
    public function createBanner(array $data);
    public function updateBanner($id, array $data);
    public function deleteBanner($id);
    public function updateBannerStatus($id, $status);
}