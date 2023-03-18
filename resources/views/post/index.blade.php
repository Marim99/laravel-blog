@extends('layouts.app')


@section('title') Index @endsection

@section('content')

   <div class="container mt-5">
    <table class="table mt-4">
        <thead>
        <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Title</th>
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
                <td class="text-center">{{$post['posted_by']}}</td>
                <td class="text-center">{{$post['created_at']}}</td>
                <td class="text-center">
                    <a href="{{route('posts.show', $post['id'])}}" class="btn btn-secondary">View</a>
                    <a href="{{ route('posts.edit', $post['id']) }}" class="btn btn-dark">Edit</a>
                    <a href="#" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="">
      <a href="{{ route('posts.create') }}" ><button type="button" class="mt-4 btn btn-success">Create Post</button></a>  
    </div>
    </div>
@endsection