<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use\App\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use\Auth;


class PostController extends Controller
{
    
    public function index(){
        $posts = Post::all();
        return response()->json([
            'status'=>200,
            'data'=>$posts
        ]);
    }

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
        // $posts->user_id = Auth::user()->id;
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


    public function delete($post_id){
        Post::where('id', $post_id)->delete();
        return response()->json([
            'status'=>200,
            'message'=>'Post Deleted Successfully!'
        ]);
    }

    public $successStatus = 200;
    // /** 
    //      * login api 
    //      * 
    //      * @return \Illuminate\Http\Response 
    //      */ 
        public function login(){ 
            if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
                $user = Auth::user(); 
                $success['token'] =  $user->createToken('MyApp')-> accessToken; 
                return response()->json(['success' => $success], $this-> successStatus); 
            } 
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            } 
        }

        // * Register api 
        // * 
        // * @return \Illuminate\Http\Response 
        // */ 
       public function register(Request $request) 
       { 
           $validator = Validator::make($request->all(), [ 
               'name' => 'required', 
               'email' => 'required|email', 
               'password' => 'required', 
               'c_password' => 'required|same:password', 
           ]);
   if ($validator->fails()) { 
               return response()->json(['error'=>$validator->errors()], 401);            
           }
   $input = $request->all(); 
           $input['password'] = bcrypt($input['password']); 
           $user = User::create($input); 
           $success['token'] =  $user->createToken('MyApp')-> accessToken; 
           $success['name'] =  $user->name;
   return response()->json(['success'=>$success], $this-> successStatus); 
       }

    // * details api 
    //  * 
    //  * @return \Illuminate\Http\Response 
    //  */ 
    public function details() 
    { 
        $user = Auth::user(); 
        return response()->json(['success' => $user], $this-> successStatus); 
    } 
    
}
