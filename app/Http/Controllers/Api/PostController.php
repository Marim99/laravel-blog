<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\Tags\Tag;

class PostController extends Controller
{
    //

    public function index()
    {
        $posts = Post::all();
        return PostResource::collection($posts);
    }
    public function show($Id)
    {
        $post = Post::find($Id);
        return new PostResource($post);
    
    }

    public function store(StorePostRequest  $request)
    {
            $title = $request->title;
            $description = $request->description;
            $postCreator = $request->user_id;
            $post = new Post();
            $post->title = $title;
            $post->description = $description;
            $post->user_id = $postCreator;
            // $tagsNames=explode(',', $request->tags);
            // if ($request->hasFile('image')) {
            //     $post->image = $request->file('image');
            // }
            $post->save();
            // $tags=Tag::findOrCreate($tagsNames);
            // $post->attachTags($tags);

            return $post;
    }
}
