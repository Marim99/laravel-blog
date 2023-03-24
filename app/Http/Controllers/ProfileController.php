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
        return view('profile.profile');
    }

    public function edit(UpdateProfileRequest $request)
    {
        
        $user=User::findOrFail(Auth::user()->id);
        // $profile=$user->profile()->firstOrCreate([]);
        $user->profile()->updateOrCreate(
            [
                'user_id' => $user ->id
            ],
            [
                
                'address' => $request-> Address

            ]
            );
        if ($request->hasFile('profile_image')) {
        $mediaItems = $user -> profile->getMedia('profile_image');
        foreach ($mediaItems as $media) {
            $media->delete();
            }
            $user -> profile
            ->addMediaFromRequest('profile_image')
            ->toMediaCollection('profile_image');   
        }
        $user->name = $request->Username;
        $user->email = $request->email;
        // $profile->address= $request->Address;
        $user->save();
       
        return redirect()->back()->with('message','User Profile Updated Success');
    }
}
