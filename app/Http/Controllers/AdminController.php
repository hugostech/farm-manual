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
}
