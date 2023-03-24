<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //

    public function create(Request $request,$post_id){
        dd('hi');
        $post = Post::where('id', $post_id)->first();
        $post->comments()->create([
            'body' => $request->input('body')
        ]);
        return redirect()->route('posts.show',$post_id);

    }

    public function delete($post_id,$Id)
    {

        $post = Post::where('id', $post_id)->first();
        $post->comments()->where('id', $Id)->delete();
        return redirect()->route('posts.show',$post_id);
    }
}
