@extends('layouts.app')

@section('title')Edit @endsection

@section('content')
<div class="container mt-5">
@if (session('message'))
    <div class="alert alert-success">
     {{ session('message') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="card">
<div class="row g-0">
<div class="col-md-8">
  <div class="card-body">
  <div class="post-tags d-flex mb-3">
                 Tags:
                    @foreach ($post->tags as $tag)
                        <span class="badge bg-dark rounded-pill me-2 ms-1 d-flex">{{$tag->name}}
                            <form method="post" action="{{ route('posts.tags.detach',[$post->id,$tag->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button ms-2" style="background: none; padding: 0px; border: none; ">
                                    <i class="fa fa-times me-2" style="color: #fff;"></i>
                            </button>
                            </form>
                   
                        </span>
                        
                    @endforeach
                   
                </div>
            <form method="post" action="{{ route('posts.update',[$post['id']]) }}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label fs-2">Title</label>
                    <input type="text" name="title" value="{{ $post['title'] }}" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fs-3">Description</label>
                    <textarea class="form-control" name="description" id="exampleFormControlTextarea1" value="{{ $post['description'] }} "rows="3">{{ $post['description'] }}</textarea>
                </div>
                
                <div class="mb-3">
                    <label for="tag" class="form-label fs-3">Add Tags</label>
                    <input class="form-control" name="tags" id="tag" rows="3"></input>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label fs-4">Post Creator</label>
                    <select name="user_id" class="form-control" value="{{ $post['user_id'] }}">
                    <option value="{{ $post['user_id'] }}">{{$post->user->name}}</option>
                    @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3 ">
                        <label for="image" class="form-label text-center">upload profile picture</label>
                        <input class="form-control form-control-sm" id="image" name="image" type="file" value="">
                    </div>
                <button type="submit" class="btn btn-success self-end">Edit</button>
            </form>
        </div>
    </div>
                <div class="col-md-4">
                        <img
                        src="{{asset($post['image'])}}"
                            alt="{{$post->title}}"
                            class="img-fluid rounded-start"
                        />
                </div>
</div>
</div>
  <div class="card-footer">
    <small class="text-muted">{{ $post->created_at->format('F j, Y') }}</small>
  </div>
</div>



@endsection