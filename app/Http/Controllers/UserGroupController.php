<?php

namespace App\Http\Controllers;

use App\Models\Group;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('admin.groups.index', [
            'groups' => Group::paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cleanData = $request->validate([
            'name' => 'required|unique:groups',
            'books' => 'required|array',
        ]);

        $group = Group::create($cleanData);

        $group->books()->sync($cleanData['books']);

        return redirect()->route('groups.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        $cleanData = $request->validate([
            'name' => 'required',
            'books' => 'nullable|array',
        ]);

        if (!$group->is_editable) {
            return redirect()->route('groups.index')->withErrors('This group is not editable');
        }

        $group->update($cleanData);

        $group->books()->sync($cleanData['books'] ?? []);

        return redirect()->route('groups.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        //
    }
}
