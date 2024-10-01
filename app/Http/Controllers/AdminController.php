<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function userManagerIndex(Request $request)
    {
        if($request->has('role')) {
            $users = User::whereHas('groups', function ($query) use ($request) {
                $query->where('name', $request->role);
            })->paginate(10);
        } else {
            $users = User::paginate(10);
        }
        return view('admin.user-management', compact('users'));
    }

    public function disableUser(User $user)
    {
        $user->disable();
        return redirect()->back();
    }

    public function userManagementUpdate(Request $request, User $user)
    {
        $cleanData = $request->validate([
            'name' => 'required|string',
            'profile_image' => 'nullable|image',
            'group' => 'required',
        ]);
        $user->fill($cleanData);
        $user->save();
        if ($request->has('profile_image')) {
            $user->storeProfileImage($request->file('profile_image'));
        }
        if ($cleanData['group'] != $user->group->id) {
            $user->groups()->sync([$cleanData['group']]);
        }

        return redirect()->back();
    }
}
