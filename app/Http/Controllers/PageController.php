<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Join;
use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function MainPage(){
               $posts = Post::all();
               return view("blog",['posts' => $posts]);
    }

    public function readPage($id){
        $post = Post::find($id);
        $join = Join::find($id);
        $user_id = $join->user_id;
        $user = User::find($user_id);
        return view("read",['id'=>$id,'post' => $post,'user_name'=>$user->name]);
    }
}
