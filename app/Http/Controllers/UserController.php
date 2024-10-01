<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('user.dashboard', [
            'user' => Auth::user()
        ]);
    }

    public function showBilling()
    {
        return view('user.billing');
    }

    public function updateImage(Request $request, User $user)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            // Delete old profile image if exists
            if ($user->avatar) {
                Storage::delete($user->avatar);
            }
            // Store new profile image
            $user->storeProfileImage($request->file('profile_image'));
        }

        return redirect()->back()->with('success', 'Profile image updated successfully.');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
//            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:50'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
        ]);


        User::where('id',Auth::user()->id)
            ->update([
                'name'    => $attributes['name'],
                'phone'     => $attributes['phone'],
                'location' => $attributes['location'],
                'about_me'    => $attributes["about_me"],
            ]);


        return redirect('/user-profile')->with('success','Profile updated successfully');
    }


    public function create()
    {
        $template = 'user.user-profile';
        if (Auth::user()->isAdmin()) {
            $template = 'admin.user-profile';
        }
        return view($template, [
            'user' => Auth::user()
        ]);
    }
}
