@extends('layouts.user_type.admin')

@section('content')
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h4>History for Page: {{ $page->title }}</h4>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <table class="table table-hover text-center">
                                <thead>
                                <tr>
                                    <th>Snapshot At</th>
                                    <th>Editor</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody class="text-center">
                                @foreach($histories as $history)
                                    <tr>
                                        <td>{{ $history->created_at->format('Y-m-d H:i:s') }}</td>
                                        <td>{{ $history->editor->name }}</td>
                                        <td>
                                            <a class="btn btn-sm btn-info" href="{{ route('pages.history.preview', $history) }}" target="_blank">Preview</a>
                                            <button class="btn btn-sm btn-warning rollback-page" data-action-url="{{ route('pages.history.restore', $history) }}" data-bs-toggle="modal" data-bs-target="#rollbackModal">Rollback</button>
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

    <!-- Rollback Modal -->
    <div class="modal fade" id="rollbackModal" tabindex="-1" aria-labelledby="rollbackModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="rollbackForm" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-header">
                        <h5 class="modal-title" id="rollbackModalLabel">Confirm Rollback</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to rollback to this version?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-warning">Rollback</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var rollbackModal = document.getElementById('rollbackModal');
            rollbackModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget;
                var action = button.getAttribute('data-action-url');
                console.log(action);
                document.getElementById('rollbackForm').setAttribute('action', action);
            });
        });
    </script>
@endsection
