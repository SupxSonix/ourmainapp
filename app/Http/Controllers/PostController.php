<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function viewSinglePost(Post $post){
        //return $post->title;
        return view('single-post', ['post'=> $post]);
    }

    public function showCreateForm(){
        return view('create-post');
    }

    public function storeNewPost(Request $request){
        $incomingFields = $request->validate([
            'title'=>'required',
            'body'=>'required'
        ]);

        $incomingFields ['title'] = strip_tags($incomingFields['title']);
        $incomingFields ['body'] = strip_tags($incomingFields['body']);
        $incomingFields ['user_id'] = Auth::id();

        if (Post::create($incomingFields)) {
            if(Auth::check()){
                return redirect('/create-post')->with('status', 'successfuly saved');
            }
        } else {
            return redirect('/create-post')->with('status', 'failed');
        }
    }
}
