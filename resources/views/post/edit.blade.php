@extends('layouts.app')

@section('title')Edit @endsection

@section('content')
<div class="container mt-5">
<form method="post" action="{{ route('posts.update',[$post['id']]) }}">
    @csrf
    @method('put')
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label fs-2">Title</label>
        <input type="text" name="title" value={{ $post['title'] }} class="form-control" id="exampleFormControlInput1">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label fs-3">Description</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" value={{ $post['description'] }} rows="3">{{ $post['description'] }}</textarea>
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label fs-4">Post Creator</label>
        <select name="user_id" class="form-control" value="{{ $post['user_id'] }}">
        <option value="{{ $post['user_id'] }}">{{$post->user->name}}</option>
        </select>
    </div>
    <button type="submit" class="btn btn-success self-end">Edit</button>
</form>
</div>
@endsection