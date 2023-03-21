@extends('layouts.app')

@section('title')Create @endsection

@section('content')
<div class='container'>
<h1 class="text-center">User Profile</h1>
@if (session('message'))
    <div class="alert alert-danger">
     {{ session('message') }}
    </div>
@endif
<form method="post" action="{{ route('profile.edit')}}" enctype="multipart/form-data">
@csrf
<div class="card mb-3 mt-5 rounded-5">

  <div class="row g-0">
    <div class="col-md-4 d-flex flex-column justify-content-center align-items-center " style="background-color: #111; border-right:3px solid #198754">

        @if(isset(Auth::user()->profile->photo ))
      <img src="{{asset('/storage/images/UsersAvatars/'. Auth::user()->profile->photo ?? '')}}" style="width: 200px; height:200px;" class="img-fluid rounded-circle mt-5" alt="..." >
      
      @else

     <div class="rounded-circle">
     {{Auth::user()->name}}
     </div>
      @endif
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <div class="mb-3">
            <label for="Username" class="form-label fs-3">User Name</label>
            <input class="form-control" name="Username" id="Username" value="{{Auth::user()->name}}" rows="3"></input>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label fs-3">User Email</label>
            <input class="form-control" name="email" id="email" value="{{Auth::user()->email}}" rows="3"></input>
        </div>
        <div class="mb-3">
            <label for="Address" class="form-label fs-3">Address</label>
            <input class="form-control" name="Address" id="Address" value="{{Auth::user()->profile->address ?? ''}}" rows="3"></input>
        </div>
        <div class="mb-3 ">
            <label for="image" class="form-label text-center text-white">upload profile picture</label>
            <input class="form-control form-control-sm" id="image" name="photo" type="file" value="{{Auth::user()->profile->photo ?? ''}}">
        </div>
        <button type="submit" class="btn btn-success self-end">Edit</button>
    </div>
</div>
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