@extends('layouts.user_type.user')

@section('content')
    <div class="container mt-4">
        <h2>Search Results for "{{ $query }}"</h2>
        @foreach($pages as $bookTitle => $bookPages)
            <div class="card mb-4">
                <div class="card-header">
                    <h4>{{ $bookTitle }}</h4>
                </div>
                <div class="card-body">
                    <ul class="list-group">
                        @foreach($bookPages as $page)
                            <li class="list-group-item">
                                <a href="{{ route('pages.show', $page) }}">
                                    {!! preg_replace("/($query)/i", "<mark>$1</mark>", $page->title) !!}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
@endsection
