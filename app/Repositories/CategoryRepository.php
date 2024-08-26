<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::orderBy('id','desc')->get();
    }
    public function getCategoryById($id)
    {
        return Category::findOrFail($id);
    }
    public function createCategory(array $data)
    {
        $category = new Category();
        $category->name = $data['name'];
        $category->description = $data['description'];
        if (isset($data['image'])) {
            $category->image = $data['image'];
        }
        $category->save();
        return $category;
    } 
    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        if($category)
        {
            $category->delete();
        }
        return $category;
    }
    public function updateCategoryStatus($id, $status)
    {
        $category = Category::findOrFail($id);
        $category->status = $status;
        $category->save();
        return $category;
    }
    public function updateCategory($id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->name = $data['name'];
        $category->description = $data['description'];
        if (isset($data['image'])) {
            $category->image = $data['image'];
        }
        $category->save();
        return $category;
    }
    public function updateCategoryHome($id, $is_home)
    {
        $category = Category::findOrFail($id);
        $category->is_home = $is_home;
        $category->save();
        return $category;
    }
}