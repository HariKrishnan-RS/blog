<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Join;
use App\Models\Draft;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Mail\NewPostNotification;
use Illuminate\Support\Facades\Mail;
class PostController extends Controller
{
public function storePost(Request $request){
    
      $request->validate([
        'title' => 'required',
        'small_description' => 'required',
        'full_description' => 'required',
        'image' => 'required',
    ]);
 
        if ($request->hasFile('image')) {

        $imageName = 'post-img1.' . $request->image->extension();
        $request->image->storeAs('images', $imageName, 'public');
        $post = new Post();
        $post->title = $request->title;
        $post->small_description = $request->small_description;
        $post->full_description = $request->full_description;
        if ($request->has('asDraft')) {
        $post->draft = true;
        } else {
        $post->draft = false;
        $userEmail = "harikrishnan.radhakrishnan@qburst.com"; 
        Mail::to($userEmail)->send(new NewPostNotification());
        }
        $post->save();



        $userId = Auth::id();
        $join = new Join();
        $join->user_id = $userId;
        $join->post_id = $post->id; // Use the newly created post's ID
        $join->save();
        if ($request->has('asDraft')) {
        $draft = new Draft();
        $postId = DB::table('posts') ->where('title', $request->title)->first()->id;
        $draft->post_id = $postId;
        $draft->user_id = Auth::user()->id;
        $draft->save();
      // dd('sss');
      }
        return redirect()->route('blog.page')->with('success', 'Post created successfully');
    
    
      }
}
public function editPost(Request $request,$id){
    
      $request->validate([
        'title' => 'required',
        'small_description' => 'required',
        'full_description' => 'required',
    ]);

    if ($request->has('edit')) {
      $post = Post::find($id);
      $post->title = $request->title;
      $post->small_description = $request->small_description;
      $post->full_description = $request->full_description;
      $post->save();
      return redirect()->route('blog.page')->with('edited', 'Post Edited successfully');
    }
    else{
      return redirect()->route('blog.page')->with('edited', 'Editing Cancled');
    }
  
  }




}