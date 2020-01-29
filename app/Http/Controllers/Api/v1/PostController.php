<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Post;
use Illuminate\Support\Facades\Validator;
use\Auth;


class PostController extends Controller
{
    //
    public function index(){
        $posts = Post::all();
        return response()->json([
            'status'=>200,
            'data'=>$posts
        ]);
    }

    // protected function validator(array $data){
    //     return  validator::make($data, [
    //         'post_title'=>['required', 'string'],
    //         'post_body'=>['required', 'string'],
    //         'category_id'=>['required', 'integer'],
    //         'post_image'=>['required', 'file']
    //     ]);
    // }

    public function addPost(Request $request){
        $this->validate($request, [
            'post_title' => 'required',
            'post_body' => 'required',
            'category_id' => 'required',
            'post_image' => 'required',
        ]);
        
        $posts = new Post;
        $posts->user_id = $request->user_id;
        $posts->post_title = $request->post_title;
        $posts->post_body = $request->post_body;
        $posts->category_id = $request->category_id;
        
        if($request->hasFile('post_image')){
            $file = $request->file('post_image');
        $file->move(public_path(). '/posts/',
        $file->getClientOriginalName());
        $url = URL::to("/") . '/posts/' .
            $file->getClientOriginalName();


        }
        $posts->post_image = $url;
        return $posts;
    }  

   
}
