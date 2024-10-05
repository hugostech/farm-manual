<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $user = $request->user();
        $books = $user->availableBooks;
        if ($user->isAdmin()) {

            return view('admin.books.index', compact('books'));
        }
        return view('user.books.index', compact('books'));
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
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'author' => 'required|string|max:255',
            'status' => 'nullable|string|in:draft,published',
            'published_at' => 'nullable|date',
        ]);

        $book = new Book();
        $book->fill($cleanData);
        $book->save();
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $book->storeCoverImage($image);
        }

        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        if(!Auth::user()->can('view', $book)){
            return redirect('/')->with('error', 'You are not allowed to view this book');
        }
        $breadcrumbs = $book->buildBreadcrumb();
        if (Auth::user()->isAdmin()) {
            return view('admin.books.show', compact('book', 'breadcrumbs'));
        }else{
            $lastReadPageUrl = null;
            $lastReadPage = $book->getLastReadPage(Auth::user());
            if ($lastReadPage){
                $lastReadPageUrl = $lastReadPage->getUrl();
            }
            return view('user.books.show', compact('book', 'lastReadPageUrl', 'breadcrumbs'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $this->authorize('update', $book);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $this->authorize('update', $book);
        $cleanData = $request->validate([
            'cover_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'author' => 'required|string|max:255',
            'status' => 'nullable|string|in:draft,published',
            'published_at' => 'nullable|date',
        ]);


        // Update other fields
        $book->fill($cleanData);
        $book->save();
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $book->storeCoverImage($image);
        }

        return redirect()->route('books.index')->with('success', 'Book updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $this->authorize('delete', $book);
    }
}
