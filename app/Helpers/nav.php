<?php

use Illuminate\Support\Facades\DB;
function getNavCategories()
{
    $categories = DB::table('categories')->where('status', 1)->get();
    
    $html = '<ul class="nav navbar-nav">';
    foreach ($categories as $category) {
        $html .= '<li><a href="' . route('category.view', $category->id) . '">' . $category->name . '</a></li>';
    }
    $html .= '</ul>';
    
    return $html;
}

