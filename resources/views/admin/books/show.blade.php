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
                           @foreach($book->availableCatalogs() as $catalog)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#catalog_{{$catalog->id}}" aria-expanded="false" aria-controls="collapseTwo">
                                        {{$catalog->title}}
                                    </button>
                                </h2>
                                <div id="catalog_{{$catalog->id}}" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach($catalog->pages as $page)
                                                <li><a href="{{route('pages.show', ['page'=>$page])}}">{{$page->title}}</a></li>
                                            @endforeach
                                        </ul>
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
