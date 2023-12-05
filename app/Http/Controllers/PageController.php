<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Join;
use App\Models\User;
use App\Models\Draft;
use Illuminate\Http\Request;
use App\Mail\conformNotification;
use Illuminate\Support\Facades\Mail;
class PageController extends Controller
{
    public function MainPage(){
               $posts = Post::all();
               return view("blog",['posts' => $posts]);
    }

    public function readPage($id){
        $post = Post::find($id);
        $join = Join::where('post_id', $id)->first();
        $user_id = $join->user_id;
        $user = User::find($user_id);
        return view("read",['id'=>$id,'post' => $post,'user_name'=>$user->name]);
    }

   public function editPage($id){
       $post = Post::find($id);
 
        return view("edit",['post'=>$post]);
 
    }

    public function approve($id){
        $post = Post::find($id);
        $post->approved = true;
        $post->save();
        
        $userEmail = "harikrishnan.radhakrishnan@qburst.com"; 
        Mail::to($userEmail)->send(new conformNotification());

        return redirect()->route('pending.page')->with('approve','success fully approved');
    }


public function draftPage($id){
    $draft = Draft::where('user_id', $id)->first();
    if($draft){
    $postId = $draft->post_id;
    $draft->delete();
    $post = Post::find($postId);
    $post->delete();
     return view('draft',['post'=>$post]);
    }
    $posts = Post::all();
    return view("blog",['posts' => $posts]);
}  

    public function addPost(){
            return view("add");
    }

    public function pendingPage(){
               $posts = Post::all();
               return view("pending",['posts' => $posts]);
    }

}
