<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use App\Category;
use\Auth;
use App\User;

class CategoryController extends Controller
{
    // To get the categories
    public function index(){
        $categories = Category::all();
        return response()->json([
            'status'=>200,
            'data'=>$categories
        ]);
    }

    // public function addCategory(Request $request){
    //    $this->validate($request[
    //        'category' => 'required'
    //    ]) ;
    //     $category = new Category;
    //     $category->category = $request->category;
    //     $category->save();
    //     return response()->json([
    //         'status'=>200,
    //         'message'=>'Category Added Successfully!'
    //     ]);
    // }
}
