<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoriesController extends Controller
{
    public function allCategories()
    {
    	$categories = Category::select(['id', 'category_name'])->get();

    	$arr = [];
    	foreach($categories as $category){

    		$arr[] = [

    			'value' => $category->id,
    			'text' => $category->category_name
    		];
    	}

    	return response()->json(['options' => $arr]);
    }
}
