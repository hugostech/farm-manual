@extends('layouts.user_type.admin')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <form id="pageForm" action="{{ route('pages.update', ['page' => $page]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="page_id" value="{{ $page->id }}">

                            <div class="card-header pb-0">
                                <h5 class="mb-0">Edit Page</h5>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="page_title" class="form-label lead">Page Title</label>
                                    <input class="form-control" type="text" name="page_title" id="page_title" value="{{ $page->title }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="pageeditor" class="form-label lead">Page Content</label>
                                    <div id="pageeditor" class="form-control" style="height: 300px;">{!! $page->context !!}</div>
                                    <input type="hidden" name="page_content" id="page_content">
                                </div>
                                <div class="form-group mt-3">
                                    <label class="form-label lead">Last Edited: {{ $page->updated_at->format('Y-m-d H:i:s') }}</label>
                                </div>
                                <div class="form-group mt-3">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#confirmModal">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirm Submission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to submit the changes?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmSubmit">Yes, Submit</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Include the Quill library and Quill Table Module -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

    <!-- Initialize Quill editor and handle form submission -->
    <script>
        const toolbarOptions = [
            ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
            ['blockquote', 'code-block'],
            ['link', 'image', 'video', 'formula'],

            [{ 'header': 1 }, { 'header': 2 }],               // custom button values
            [{ 'list': 'ordered'}, { 'list': 'bullet' }, { 'list': 'check' }],
            [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
            [{ 'direction': 'rtl' }],                         // text direction

            [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],

            ['clean']                                         // remove formatting button
        ];

        const quill = new Quill('#pageeditor', {
            theme: 'snow',
            modules: {
                toolbar: toolbarOptions,
                history: {
                    delay: 2000,
                    maxStack: 500,
                    userOnly: true
                },
            }
        });

        document.getElementById('confirmSubmit').addEventListener('click', function() {
            document.querySelector('#page_content').value = quill.root.innerHTML;
            document.getElementById('pageForm').submit();
        });
    </script>
@endsection
