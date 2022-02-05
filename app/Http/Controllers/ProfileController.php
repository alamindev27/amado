<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function setting()
    {
        return view('backend.profile.setting');
    }
    public function UpdateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'profile' => 'image'
        ]);

        if($request->hasFile('profile'))
        {
            if(auth()->user()->profile != 'default-image.png')
            {
                unlink(base_path('public/image/profile/'.auth()->user()->profile));
            }
            $imageName = time().Str::random(5).'.'.$request->file('profile')->getClientOriginalExtension();
            Image::make($request->file('profile'))->resize(150, 150)->save(base_path('public/image/profile/'.$imageName));

            User::where('id', auth()->id())->update([
                'profile' => $imageName,
            ]);
        }
        User::where('id', auth()->id())->update([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Profile update successfull');
    }
    public function UpdateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required | email',
        ]);
        User::where('id', auth()->id())->update([
            'email' => $request->email
        ]);
        return response()->json('email changed');
    }

    public function UpdatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required',
            'newPassword' => 'required | min:8',
            'conPassword' => 'required',
        ],[
            'password.required' => 'Current Password is required',
            'conPassword.required' => 'Confirm Password is required',
        ]);

        if(Hash::check($request->password, auth()->user()->password))
        {
            if($request->newPassword == $request->conPassword)
            {
                User::where('id', auth()->id())->update([
                    'password' => Hash::make($request->newPassword)
                ]);
                return response()->json('done');
            }
            else
            {
                return response()->json('cpassnot');
            }
        }
        else
        {
            return response()->json('current');
        }
    }

    public function addAdmin(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required | email | unique:users',
        ]);
        $password = Str::random(10);
        $email = $request->email;
        $login = $request->login;
        Mail::to($email)->send(new AdminMail($password, $email, $login));
        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($password),
            'role' => 1,
            'created_at' => Carbon::now()
        ]);
        return response()->json('done');
    }
}
