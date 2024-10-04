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
                                    <input class="form-control" type="text" name="title" id="page_title" value="{{ $page->title }}">
                                </div>
                                <div class="form-group mt-3">
                                    <label for="pageeditor" class="form-label lead">Page Content</label>
                                    <textarea id="pageeditor" name="context" class="form-control" style="height: 300px;">
                                        {!! $page->context  !!}
                                    </textarea>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="status" class="form-label lead">Status</label>
                                    <select class="form-control" name="status" id="status">
                                        <option value="draft" {{ $page->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ $page->status == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
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

    <!-- Include TinyMCE -->
    <script src="https://cdn.tiny.cloud/1/snjfxvgpd3jss980lw449vmn7weclaka3h2cn0l0w5aiqjrw/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
    <!-- Initialize TinyMCE and handle form submission -->
    <script>
        tinymce.init({
            selector: '#pageeditor',
            plugins: [
                // Core editing features
                'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
                // Your account includes a free trial of TinyMCE premium features
                // Try the most popular premium features until Oct 18, 2024:
                'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
            ],
            toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
                { value: 'First.Name', title: 'First Name' },
                { value: 'Email', title: 'Email' },
            ],
            ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
            height: 500,
            setup: function (editor) {
                document.getElementById('confirmSubmit').addEventListener('click', function() {
                    document.getElementById('pageForm').submit();
                });
            }
        });
    </script>
@endsection
