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
        return Category::create($data);
    } 
    public function updateCategory($id, array $data)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
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

    public function updateCategoryHome($id, $is_home)
    {
        $category = Category::findOrFail($id);
        $category->is_home = $is_home;
        $category->save();
        return $category;
    }
}