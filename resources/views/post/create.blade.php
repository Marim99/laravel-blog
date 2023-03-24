@extends('layouts.app')

@section('title')Create @endsection

@section('content')
<div class="container mt-5">
@if (session('message'))
    <div class="alert alert-danger">
     {{ session('message') }}
    </div>
@endif
<form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label fs-2">Title</label>
        <input type="text" name="title" class="form-control" id="exampleFormControlInput1" placeholder="">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label fs-3">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="mb-3">
        <label for="tag" class="form-label fs-3">Add Tags</label>
        <input class="form-control" name="tags" id="tag" rows="3"></input>
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label fs-3">Post Creator</label>
        <select name="user_id" class="form-control">


            <option value=""></option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach

        </select>
    </div>

    <div class="mb-3 ">
            <label for="image" class="form-label text-center">upload profile picture</label>
            <input class="form-control form-control-sm" id="image" name="image" type="file">
        </div>
    <button type="submit" class="btn btn-success">Create</button>
</form>
</div>

@if ($errors->any())

    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
               
            @endforeach
        </ul>
    </div>
@endif
@endsection