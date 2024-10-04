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
                                        <td class="text-center">{{ $page->sort }}</td>
                                        <td>{{ $page->title }}</td>
                                        <td>{{ $page->updated_at->format('Y-m-d H:i:s') }}</td>

                                        <td>
                                            <button class="btn btn-sm toggle-status {{ $page->status == \App\Models\Page::STATUS_PUBLISHED ? 'btn-success' : 'btn-secondary' }}"
                                                    data-toggle-url="{{ route("pages.toggleStatus", $page) }}">
                                                {{ $page->status == \App\Models\Page::STATUS_PUBLISHED ? 'Unpublish' : 'Publish' }}
                                            </button>
                                        </td>
                                        <td>
                                            <button class="btn btn-sm btn-info view-history" data-id="{{ $page->id }}">History</button>
                                            <a href="{{ route('pages.edit', ['page' => $page]) }}" class="btn btn-sm btn-warning">Edit</a>
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

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmSortModal" tabindex="-1" aria-labelledby="confirmSortModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmSortModalLabel">Confirm Sort Update</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to update the page order?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="cancelSortUpdate">Cancel</button>
                    <button type="button" class="btn btn-primary" id="confirmSortUpdate">Yes, Update</button>
                </div>
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
                        pageId: pageId
                    },
                    success: function(response) {
                        location.reload();
                    }
                });
            });

            $('.view-history').on('click', function() {
                var pageId = $(this).data('id');
                window.location.href = '{{ url("pages/history") }}/' + pageId;
            });
        });
    </script>
@endsection
