@extends('layouts.user_type.user')

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
                           @foreach($book->availablePages()->orderBy('sort')->get() as $page)
                                <div class="accordion" id="accordionExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingOne">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#page_{{$page->id}}" aria-expanded="true" aria-controls="collapseOne">
                                                {{$page->title}}
                                            </button>
                                        </h2>
                                        <div id="page_{{$page->id}}" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                {!! $page->context !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
