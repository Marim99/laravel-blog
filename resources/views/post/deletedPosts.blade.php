@extends('layouts.app')


@section('title') Index @endsection

@section('content')

   <div class="container mt-5">
   <div class="d-flex justify-content-end">
      <a href="{{ route('posts.restoreAllPosts') }}" ><button type="button" class="mt-4 btn btn-success me-2">restore All</button></a>  
      <a><button type="button" class="mt-4 btn btn-success" data-bs-toggle="modal" data-bs-target="#forceDelete">Force Delete All</button></a>
      <div class="modal fade" id="forceDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered ">
                    <div class="modal-content text-bg-danger">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 text-center" id="staticBackdropLabel">Force Delete</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        Are you sure you want to Force Delete All posts
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
                        <form method="get" action="{{ route('posts.forceDeleteAllPosts') }}"> 
                        @csrf
                            <button type="submit" class="btn btn-dark">Delete</button>
                        </form>
                    </div>
                    </div>
                </div>
                </div>  
    </div>
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
        @foreach($deletedPosts as $deletedPost)
            <tr>
                <td class="text-center">{{$deletedPost['id']}}</td>
                <td class="text-center">{{$deletedPost['title']}}</td>
                <td class="text-center">{{$deletedPost->user->name}}</td>
                <td class="text-center">{{$deletedPost['created_at']}}</td>
                <td class="text-center">

                    <a href="{{ route('posts.restorePost', $deletedPost['id']) }}" class="btn btn-dark">Restore</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    </div>
@endsection