<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Category;

class CategoryController extends Controller
{
    public function category(){
        return view('categories.category');
    }

    public function addCategory(Request $request){
        $this->validate($request, [
            'category' => 'required'
        ]);
        $category = new Category;
        $category->category = $request->category;
        $category->save();
        return redirect('/category')->with('response', 'Added Successfully');
    }
}
