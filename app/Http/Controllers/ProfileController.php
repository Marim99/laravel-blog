<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    //

    public function index()
    {
        return view('post.profile');
    }

    public function edit(UpdateProfileRequest $request)
    {
        
        $user=User::findOrFail(Auth::user()->id);
        if ($request->hasFile('photo')) {
            $destination_path='public/images/usersAvatars';
            $avatar= $request->file('photo');
            $image_name = $avatar->getClientOriginalName();
            $path=$request->file('photo')->storeAs($destination_path,$image_name);
        
            $user->profile()->updateOrCreate(
                [
                    'user_id'=>$user->id,
                ],[
                    'address' => $request->Address,
                    'photo' => $image_name,
                ]
            );

       
        }
        $user->name = $request['Username'];
        $user->email = $request['email'];
        $user->save();
        return redirect()->back()->with('message','User Profile Updated Success');
    }
}
