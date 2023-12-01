<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function MainPage(){
               $posts = Post::all();
               return view("blog",['posts' => $posts]);
    }

    public function readPage($id){
        $post = Post::find($id);
        return view("read",['id'=>$id,'post' => $post]);
    }
}
