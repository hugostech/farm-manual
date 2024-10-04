<?php

namespace App\Http\Controllers;

use App\Models\History;
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
        $cleanData = $request->validate([
            'title' => 'required',
            'book_id' => 'required|exists:books,id',
        ]);
        $sort = Page::where('book_id', $cleanData['book_id'])->max('sort');
        $cleanData['sort'] = $sort + 1;
        $page = Page::create($cleanData);
        return redirect()->route('books.show', $page->book)->with('success', 'Page created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page)
    {
        $breadcrumbs = $page->buildBreadcrumb();
        if (Auth::user()->isAdmin()) {
            return view('admin.pages.show', compact('page', 'breadcrumbs'));
        }
        $page->recordReader(Auth::user());
        return view('user.pages.show', compact('page', 'breadcrumbs'));
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
        $page->delete();
        return redirect()->route('books.show', $page->book)->with('success', 'Page deleted successfully');
    }

    public function reorder(Request $request)
    {
        $cleanData = $request->validate([
            'sortedIDs' => 'required|array',
        ]);

        foreach ($cleanData['sortedIDs'] as $index => $pageId) {
            Page::where('id', $pageId)->update(['sort' => $index]);
        }
        return response()->json(['message' => 'Pages reordered successfully']);
    }

    public function toggleStatus(Request $request, Page $page)
    {
        Page::withoutRecordHistory(function () use ($page) {
            $page->status = $page->status === Page::STATUS_PUBLISHED ? Page::STATUS_DRAFT : Page::STATUS_PUBLISHED;
            $page->save();
        });

        return redirect()->route('books.show', $page->book);
    }

    public function showPageHistories(Page $page)
    {
        $histories = $page->histories()->orderBy('created_at', 'desc')->get();
        return view('admin.pages.history', compact('histories', 'page'));
    }

    public function previewPageHistory(History $history)
    {
        $page = $history->convertToModel();
        return view('admin.pages.preview_history', compact('page'));
    }

    public function restorePageHistory(Request $request, History $history)
    {
        $history->historable->restoreHistory($history);
        return redirect()->back()->with('success', 'Page restored successfully');
    }
}
