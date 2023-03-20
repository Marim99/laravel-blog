@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<div class="container mt-5">
    

    <div class="card mt-6">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
        </div>
    </div>

    <div class="card mt-6">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Created By : {{$post->user->name}}</h5>
            <p class="card-text">email : {{$post->user->email}}</p>
        </div>

  
        </div>

        </div>
        <div class="comments-section mt-5">
            <div class="container">
                <h1>comments</h1>
              @if(isset($post->comments))
                <table class="table mt-4">
                @foreach($post->comments as $comment)
                
                <tr>              
                        <div class="d-flex justify-content-end mb-2">
                        <div class="card card-body me-2">{{$comment['body']}}</div>
                        <form method="POST" action="{{ route('comments.delete',[$post['id'],$comment['id']]) }}" > 
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger ">Delete</button>
                        </form>
                        </div>
                </tr>
                @endforeach
                </table>
                @else
                <div class="text-center p-5">No comments</div> 
                @endif
            </div>
            <button class="btn btn-success mb-5" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
             Add Comment
            </button>
            <div class="collapse mt-2" id="collapseExample">
            <div class="card card-body">
            <form action="{{ route('comments.create',[$post['id']]) }}" method="post">
                @csrf
                 <div class="mb-3">
                    <label for="comment" class="form-label fs-2">comment</label>
                    <input class="form-control" type="text" name="body" id="comment">
                </div>
                <button type="submit" class="btn btn-dark">Post Comment</button>
                </form>

            </div>
            </div>
    </div>

@endsection
