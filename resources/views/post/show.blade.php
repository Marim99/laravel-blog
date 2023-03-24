@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<div class="container mt-5">
    
<div class="card mb-3">
  <div class="row g-0">
        <div class="col-md-4">
        <img
        src="{{asset($post['image'])}}"
            alt="{{$post->title}}"
            class="img-fluid rounded-start"
        />
        </div>
            <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">Title: {{$post['title']}}</h5>
                <p class="card-text">
                Description: {{$post['description']}}
                </p>

                   
                 <div class="post-tags d-flex">
                 Tags:
                    @foreach ($post->tags as $tag)
                        <span class="badge bg-dark rounded-pill m-1">{{$tag->name}}</span>
                    @endforeach
                   
                </div>
                
                <p class="card-text">
                <small class="text-muted">Created By : {{$post->user->name}}</small>
                </p>
            </div>
      
            </div>
            <div class="card-footer">
            <small class="text-muted">{{ $post->created_at->format('F j, Y') }}</small>
        </div>
  </div>
</div>
        <livewire:comments :post="$post">
</div>
@endsection
