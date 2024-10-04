<?php

namespace App\Http\Controllers;

use App\Mail\UserCreated;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $users = User::where('email', 'LIKE', "%{$query}%")
            ->orWhere('phone', 'LIKE', "%{$query}%")
            ->orWhere('name', 'LIKE', "%{$query}%")
            ->paginate(10);

        return view('admin.user-management', compact('users'));
    }

    public function userManagerIndex(Request $request)
    {
        $query = User::query();
        $search = $request->get('query', '');
        if ($search) {
            $query->where('email', 'LIKE', "%{$search}%")
                ->orWhere('phone', 'LIKE', "%{$search}%")
                ->orWhere('name', 'LIKE', "%{$search}%");
        }
        $group_id = $request->get('group', null);
        if($group_id) {
            $query->whereHas('groups', function ($query) use ($group_id) {
                $query->where('groups.id', $group_id);
            });
        }
        $users = $query->paginate(15);
        return view('admin.user-management', compact('users', 'search', 'group_id'));
    }

    public function userManagementUpdate(Request $request, User $user)
    {
        $cleanData = $request->validate([
            'name' => 'required|string',
            'profile_image' => 'nullable|image',
            'group' => 'required',
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
            'status' => 'required',
            'password' => 'nullable|string',
        ]);
        $cleanData['password'] = bcrypt($cleanData['password']);
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

    public function createUser(Request $request)
    {
        $cleanData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'profile_image' => 'nullable|image',
            'group' => 'required',
            'phone' => 'nullable|string',
            'location' => 'nullable|string',
            'status' => 'required',
        ]);
        $cleanData['password'] = bcrypt($cleanData['password']);
        $user = User::create($cleanData);
        if ($request->has('profile_image')) {
            $user->storeProfileImage($request->file('profile_image'));
        }
        $user->groups()->sync([$cleanData['group']]);
        // Send email to the user
        Mail::to($user)->send(new UserCreated($user, $request->password));
        return redirect()->back();
    }
}
