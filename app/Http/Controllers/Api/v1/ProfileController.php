<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use App\Profile;
use App\Auth;

class ProfileController extends Controller
{
    // To view all the profiles
    public function index(){
        $profiles = Profile::all();
        return response()->json([
            'status'=>200,
            'data'=>$profiles
        ]);
    }

    // To add a profile
    public function addProfile(Request $request){
        $this->validate($request, [
            "name" => "required",
            "designation" => "required",
            "profile_pic" => "required"
        ]);

        $profiles = new Profile;
        $profiles->name = $request->name;
        $profiles->user_id = Auth::user()->id;
        $profiles->designation = $request->designaton;
        if($request->hasFile('profile_pic')){
            $file = $request->file('profile_pic');
    $file->move(public_path(). '/uploads/',
    $file->getClientOriginalName());
    $url = URL::to("/"). '/uploads/'.
            $file->getClientOriginalName();

        }
        $profiles->profile_pic->$url;
        $profiles->save();
        return response()->json([
            'status'=>200,
            'message'=>'Profile Created Successfully!'
        ]);
    }
}
