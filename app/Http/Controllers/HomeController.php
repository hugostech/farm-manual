<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home()
    {
        if(Auth::user()->hasRole('admin')) {
            return redirect('admin');
        }
        return redirect('dashboard');
    }

    public function search(Request $request)
    {
        $cleanData = $request->validate([
            'query' => 'required|string'
        ]);
        $query = $cleanData['query'];
        $pages = collect();
        $availableBooksForUser = Auth::user()->getAvailableBooks()?->pluck('id')->toArray();
        if (!empty($availableBooksForUser)) {
            $pages = Page::with('book')->available()
                ->whereIn('book_id', $availableBooksForUser)
                ->where('title', 'LIKE', "%{$query}%")
//            ->orWhere('context', 'LIKE', "%{$query}%")
                ->get()
                ->groupBy('book.title');
        }

        return view('user.search', compact('pages', 'query'));
    }


}
