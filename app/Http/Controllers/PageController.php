<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Page::class, 'page');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.show', compact('page'));
        }
        $page->recordReader(Auth::user());
        return view('user.pages.show', compact('page'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page)
    {
        $cleanData = $request->validate([
            'title' => 'required',
            'context' => 'required',
            'status' => 'required',
            'sort' => 'nullable|integer',
        ]);
        $page->fill($cleanData);
        $page->save();
        return redirect()->route('books.show', $page->book)->with('success', 'Page updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page)
    {
        //
    }

    public function reorder(Request $request)
    {
        $cleanData = $request->validate([
            'pages' => 'required|array',
        ]);

        dd($cleanData);
        foreach ($cleanData['pages'] as $index => $pageId) {
            Page::where('id', $pageId)->update(['sort' => $index]);
        }
        return response()->json(['message' => 'Pages reordered successfully']);
    }
}
