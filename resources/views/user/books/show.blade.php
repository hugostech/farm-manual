@extends('layouts.user_type.user')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4>{{$book->title}}</h4>
                            @if($lastReadPageUrl)
                            <a class="btn btn-primary" href="{{$lastReadPageUrl}}">Jump to Last Viewed Page</a>
                            @endif
                        </div>
                        <hr>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="row">
                                @foreach($book->availablePages()->orderBy('sort')->get() as $index => $page)
                                    @if($index % 3 == 0 && $index != 0)
                            </div><div class="row">
                                @endif
                                <div class="col-md-4 mb-3">
                                    <div class="card h-100">
                                        <div class="card-body d-flex flex-column justify-content-between">
                                            <h5 class="card-title">{{$index+1}}. {{ $page->title }}</h5>
                                            <a href="{{ $page->getUrl() }}" class="btn btn-primary mt-auto">Read</a>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
