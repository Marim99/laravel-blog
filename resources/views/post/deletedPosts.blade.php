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