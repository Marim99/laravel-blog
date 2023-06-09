<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Jobs\PruneOldPostsJob;
use App\Models\Comment;
use App\Models\Post;
use App\Models\USer;
use App\Rules\MaxPostsPerUser;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Spatie\Tags\Tag;
use function GuzzleHttp\Promise\all;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->searchTitle;
        $posts = $query ? Post::with('comments')->limit(5)->where('title', 'LIKE', '%'.$query.'%')->paginate(10): Post::with('comments')->limit(5)->orderBy('id','desc')->paginate(10);
        return view('post.index', compact('posts','query'));
    }
    public function create()
    {
        $users = User::all();

        return view('post.create', ['users' => $users]);
    }
    public function show($Id)
    {
        
        $post = Post::with('comments')->where('id', $Id)->first();
        return view('post.show', ["post" =>$post]);
  
    }
    public function edit($Id)
    {
        $users = User::all();
        $post = Post::where('id', $Id)->first();
        return view('post.edit', ["post" =>$post,'users' => $users]);
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
            $post = new Post();
            $post->title = $title;
            $post->description = $description;
            $post->user_id = $postCreator;
            $tagsNames=explode(',', $request->tags);
            if ($request->hasFile('image')) {
                $post->image = $request->file('image');
            }
            $post->save();
            $post->syncTags($tagsNames);
            return to_route('posts.index');
    }
    public function update(StorePostRequest $request,$Id)
    {
        $post = Post::find($Id);
 
        $post->title = $request->title;
        $post->description = $request->description;
        $post->user_id = $request->user_id;
        $tagsNames=explode(',',$request->tags);
        if ($request->hasFile('image')) {
            // dd($post->image);
            // Storage::delete( $post->image);
            Storage::disk('public')->delete($post->image);
            $post->image = $request->file('image');
        }
      

        $post->save();
        $tags=Tag::findOrCreate($tagsNames);
        $post->attachTags($tags);
        return redirect()->back()->with('message', 'Post has been updated successfully.');
    }
    public function deleteTag(Post $post, Tag $tag)
    {
        $post->detachTag($tag);
        return redirect()->back()->with('message', 'Tag has been deleted successfully.');
    }
    public function deleteOldPosts()
    {
        dispatch(new PruneOldPostsJob());
        return redirect()->back()->with('message', 'Old posts has been deleted.');
    }
    public function showDeletedPosts(){
        $deletedPosts = Post::onlyTrashed()->get();
        return view('post.deletedPosts', ['deletedPosts' => $deletedPosts]);
    }

    public function restorePost($Id){


        $post = Post::withTrashed()->find($Id)->restore();

        return to_route('posts.index');
    }

    public function forceDeleteAllPosts(){
        $posts = Post::onlyTrashed()->get();
        $posts->each(function ($post) {
            $post->forceDelete();
        });

        return to_route('posts.index');
    }
    public function restoreAllPosts(){
        $posts = Post::withTrashed()->get();
        $posts->each(function ($post) {
            $post->restore();
        });

        return to_route('posts.index');
    }
}