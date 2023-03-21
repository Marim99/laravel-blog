@extends('layouts.app')


@section('title') Index @endsection

@section('content')

   <div class="container mt-5">
    <table class="table mt-4">
        <thead>
        <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Title</th>
            <th class="text-center" scope="col">Slug</th>
            <th class="text-center" scope="col">Posted By</th>
            <th class="text-center" scope="col">Created At</th>
            <th class="text-center" scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($posts as $post)
            <tr>
                <td class="text-center">{{$post['id']}}</td>
                <td class="text-center">{{$post['title']}}</td>
                <td class="text-center">{{$post['slug']}}</td>
                <td class="text-center">{{$post->user->name}}</td>
                
                <td class="text-center">{{date('d-m-Y', strtotime($post->created_at))}}</td>
                <td class="text-center">
                    <a href="{{route('posts.show', $post['id'])}}" class="btn btn-secondary">View</a>
                    <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-dark">Edit</a>
                    <button type="button" href="#" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#model{{$post->id}}">
                    Delete
                    </button>
                    </td>
            </tr>
            <!-- Modal -->
                <div class="modal fade" id="model{{$post->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Delete Post ID: {{$post['id'] }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete post ID: {{$post['id']}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('posts.delete',[$post['id']]) }}"> 
                        @csrf
                        @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>
          
        @endforeach
        </tbody>
    </table>
    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
  <div class="btn-group me-2" role="group" aria-label="First group">
<div class="d-flex">
{!! $posts->links()!!}
</div>
     </div>
    </div>
    <div class="">
      <a href="{{ route('posts.create') }}" ><button type="button" class="mt-4 btn btn-success">Create Post</button></a>  
    </div>
    </div>
@endsection