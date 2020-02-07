<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use\Auth;
use App\User;


class PostController extends Controller
{

    // To view all the posts
    public function index(){
        $posts = Post::all();
        return response()->json([
            'status'=>200,
            'data'=>$posts
        ]);
    }
    // To view a single post
    public function getPost($id){
        if (Post::where('id', $id)->exists()) {
            $posts = Post::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($posts, 200);
          } else {
            return response()->json([
              "message" => "post not found"
            ], 404);
          }
    }

    // To add a new post
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
        $posts->user_id = Auth::user()->id;
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
        $posts->save();
        return response()->json([
            'status'=>200,
            'message'=>'Post Added Successfully!'
        ]);
    }

    // To edit a single post
    public function editPost(Request $request, $id){
        $this->validate($request, [
            'post_title' => 'required',
            'post_body' => 'required',
            'category_id' => 'required',
            'post_image' => 'required',
        ]);
        if (Post::where('id', $id)->exists()) {
            $posts = Post::find($id);
            $posts->post_title = is_null($request->post_title) ? $posts->post_title : $request->post_title;
            $posts->post_body = is_null($request->post_body) ? $posts->post_body : $request->post_body;
            $posts->category_id = is_null($request->category_id) ? $posts->category_id : $request->category_id;
            $posts->post_image = is_null($request->post_image) ? $posts->post_image : $request->post_image;
            if($request->hasFile('post_image')){
                $file = $request->file('post_image');
    $file->move(public_path(). '/posts/',
    $file->getClientOriginalName());
    $url = URL::to("/") . '/posts/' .
                $file->getClientOriginalName();
    
            }
            $posts->post_image = $url;
            $data = array(
                'post_title' => $posts->post_title,
                'user_id' => $posts->user_id,
                'post_body'=> $posts->post_body,
                'category_id' => $posts->category_id,
                'post_image' => $posts->post_image,
            );
            Post::where('id', $post_id)->update($data);
            $posts->update();
            return response()->json([
                'status'=>200,
                'message'=>'Post Updated Successfully!'
            ]);
        }else {
            return response()->json([
                "message" => "Post not found"
            ], 404);
        }
    }

            

    // To delete a single post
    public function delete($post_id){
        Post::where('id', $post_id)->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Post Deleted Successfully!'
        ]);
    }

    
    
}
