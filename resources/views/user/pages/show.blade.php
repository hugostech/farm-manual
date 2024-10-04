@extends('layouts.user_type.user')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4>{{$page->title}}</h4>
                            <a href="{{ route('books.show', ['book' => $page->book_id]) }}" class="btn btn-secondary">Back to Book</a>
                        </div>
                        <hr>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="container">
                                {!! $page->context !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="fixed-bottom d-flex justify-content-between p-3 bg-light">
        @if($page->lastPage())
            <a href="{{ $page->lastPage()->getUrl() }}" class="btn btn-primary">Previous Page</a>
        @else
            <span class="text-muted">This is the first page</span>
        @endif
        @if($page->nextPage())
            <a href="{{ $page->nextPage()->getUrl() }}" class="btn btn-primary">Next Page</a>
        @else
            <span class="text-muted">This is the last page</span>
        @endif
    </div>
@endsection
