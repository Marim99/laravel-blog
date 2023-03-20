<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Models\Comment;
use App\Models\Post;
use App\Models\USer;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class PostController extends Controller
{
    public function index()
    {

        $allPosts = Post::paginate(10);
        // dd(request()->all());
        return view('post.index', ['posts' =>$allPosts]);
    }
    public function create()
    {
        $users = User::all();

        return view('post.create', ['users' => $users]);
    }
    public function show($Id)
    {

        // $comments = Comment::where('post_id',$Id)->get();
        $post = Post::where('id', $Id)->first();
        return view('post.show', ["post" =>$post]);
  
    }
    public function edit($Id)
    {
        $post = Post::where('id', $Id)->first();
        return view('post.edit', ["post" =>$post]);
    }
    public function delete($Id){

        $post = Post::where('id', $Id)->first();
        $post->delete();
        return to_route('posts.index');
    }
    public function store(StorePostRequest  $request)
    {
        
        $title = $request->title;
        $description = $request->description;
        $postCreator = $request->user_id;
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        return to_route('posts.index');
    
    }
    public function update(StorePostRequest $request,$Id)
    {

        $post = Post::where('id', $Id)->first();
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $post->save();
        return to_route('posts.index');
    }

    public function showDeletedPosts(){

  
        $deletedPosts = Post::onlyTrashed()->get();
        return view('post.deletedPosts', ['deletedPosts' => $deletedPosts]);
    }

    public function restorePost($Id){


        $post = Post::withTrashed()->find($Id)->restore();

        return to_route('posts.index');
    }
}