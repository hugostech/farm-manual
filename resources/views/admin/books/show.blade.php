@extends('layouts.user_type.admin')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h4>{{$book->title}}</h4>
                        </div>
                        <hr>
                        <div class="card-body px-0 pt-0 pb-2">
                            <ul>
                                @foreach($book->pages()->orderBy('sort')->get() as $page)
                                    <li><a href="{{route('pages.show', ['page'=>$page])}}">{{$page->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
