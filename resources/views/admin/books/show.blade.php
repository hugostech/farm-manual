@extends('layouts.user_type.admin')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0 d-flex justify-content-between align-items-center">
                            <h4>{{$book->title}}</h4>
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPageModal">+ New Page</button>
                        </div>
                        <hr>
                        <div class="card-body px-0 pt-0 pb-2">
                            <table class="table table-hover" id="pagesTable">
                                <thead>
                                <tr>
                                    <th>Page Order</th>
                                    <th>Title</th>
                                    <th>Last Edit</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($book->pages()->orderBy('sort')->get() as $page)
                                    <tr data-id="{{ $page->id }}">
                                        <td>{{ $page->sort }}</td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->updated_at->format('Y-m-d H:i:s') }}</td>
                                        <td>
                                            <div class="form-check form-switch">
                                                <input class="form-check-input toggle-status" type="checkbox"
                                                       {{ $page->status == \App\Models\Page::STATUS_PUBLISHED ? 'checked' : '' }}
                                                       data-toggle-url="{{ route("pages.toggleStatus", $page) }}"
                                                />
                                            </div>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info view-history" data-history-url="{{ route('pages.histories', $page) }}">History</button>
                                            <a href="{{ route('pages.edit', ['page' => $page]) }}" class="btn btn-sm btn-warning">Edit</a>
                                            <button class="btn btn-sm btn-danger delete-page" data-id="{{ $page->id }}" data-bs-toggle="modal" data-bs-target="#deletePageModal">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Create Page Modal -->
    <div class="modal fade" id="createPageModal" tabindex="-1" aria-labelledby="createPageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('pages.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPageModalLabel">Create New Page</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="pageTitle" class="form-label lead">Page Title</label>
                            <input type="text" class="form-control" id="pageTitle" name="title" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Create Page</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Confirm Sort Modal -->
    <div class="modal fade" id="confirmSortModal" tabindex="-1" aria-labelledby="confirmSortModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmSortModalLabel">Confirm Sort Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to update the sort order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmSortUpdate">Confirm</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Page Modal -->
    <div class="modal fade" id="deletePageModal" tabindex="-1" aria-labelledby="deletePageModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="deletePageForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deletePageModalLabel">Delete Page</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this page?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            var initialOrder = $("#pagesTable tbody").html();

            $("#pagesTable tbody").sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                    $('#confirmSortModal').modal('show');
                }
            }).disableSelection();

            $('#confirmSortUpdate').on('click', function() {
                var sortedIDs = $("#pagesTable tbody").sortable("toArray", { attribute: "data-id" });
                $.ajax({
                    url: '{{ route("pages.updateSort") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        sortedIDs: sortedIDs
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $('#cancelSortUpdate').on('click', function() {
                $("#pagesTable tbody").html(initialOrder);
            });

            $('.toggle-status').on('click', function() {
                var url = $(this).data('toggle-url');
                $.ajax({
                    url: url,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $('.view-history').on('click', function() {
                var url = $(this).data('history-url');
                window.location.href = url;
            });

            $('.delete-page').on('click', function() {
                var pageId = $(this).data('id');
                var action = '{{ url("pages") }}/' + pageId;
                $('#deletePageForm').attr('action', action);
            });
        });
    </script>
@endsection
