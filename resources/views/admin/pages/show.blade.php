@extends('layouts.user_type.admin')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <form action="{{route('pages.update', ['page'=>$page])}}">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="page_id" value="{{$page->id}}">

                        <div class="card-header pb-0">
                            <input class="form-control" type="text" name="page_title" id="page_title" value="{{$page->title}}">
                        </div>
                        <hr>
                        <div class="card-body px-2 pt-0 pb-2">

                                <!-- Create the editor container -->
                                <div id="pageeditor">
                                {!! $page->context !!}
                                </div>

                            <input type="submit" class="btn btn-primary" value="Update"/>



                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- Include the Quill library -->
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>

    <!-- Initialize Quill editor -->
    <script>
        const quill = new Quill('#pageeditor', {
            theme: 'snow'
        });
    </script>
@endsection
