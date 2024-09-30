@extends('layouts.user_type.admin')

@section('content')

    <div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Groups</h5>
                            </div>
                            <a href="#" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Group</a>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        ID
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Total Users
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($groups as $group)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$group->id}}</p>
                                        </td>

                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0 text-capitalize">{{$group->name}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$group->users()->count()}}</p>
                                        </td>
                                        <td class="text-center">
                                            <a href="#" class="mx-3" data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>
                                            <span>
                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                        </span>
                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5">

                                    </td>
                                    <td colspan="2">
                                        {{ $groups->links() }}
                                    </td>
                                </tr>

                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">--}}
{{--        <div class="container-fluid py-4">--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="card mb-4">--}}
{{--                        <div class="card-header pb-0">--}}
{{--                            <h6>Groups</h6>--}}
{{--                            <button class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal"--}}
{{--                                    data-bs-target="#createBookModal" type="button">+&nbsp; New User</button>--}}
{{--                        </div>--}}
{{--                        <div class="card-body px-0 pt-0 pb-2">--}}
{{--                            <div class="table-responsive p-0">--}}
{{--                                <table class="table align-items-center mb-0">--}}
{{--                                    <thead>--}}
{{--                                    <tr>--}}
{{--                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>--}}
{{--                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Author</th>--}}
{{--                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>--}}
{{--                                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Published At</th>--}}
{{--                                        <th class="text-secondary opacity-7"></th>--}}
{{--                                    </tr>--}}
{{--                                    </thead>--}}
{{--                                    <tbody>--}}
{{--                                    @foreach($books as $book)--}}
{{--                                        <tr>--}}
{{--                                            <td>--}}
{{--                                                <div class="d-flex px-2 py-1">--}}
{{--                                                    <div>--}}
{{--                                                        <img src="{{$book->cover_image}}" class="avatar avatar-sm me-3" alt="user2">--}}
{{--                                                    </div>--}}
{{--                                                    <div class="d-flex flex-column justify-content-center">--}}
{{--                                                        <h6 class="mb-0 text-sm"><a href="{{route('books.show', ['book'=>$book])}}">{{$book->title}}</a></h6>--}}
{{--                                                        <p class="text-xs text-secondary mb-0">{{ \Illuminate\Support\Str::limit($book->subtitle, 60) }}</p>--}}
{{--                                                    </div>--}}
{{--                                                </div>--}}
{{--                                            </td>--}}
{{--                                            <td>--}}
{{--                                                <p class="text-xs font-weight-bold mb-0">{{$book->author}}</p>--}}
{{--                                                <p class="text-xs text-secondary mb-0">Developer</p>--}}
{{--                                            </td>--}}
{{--                                            <td class="align-middle text-center text-sm">--}}
{{--                                                @if($book->status == \App\Models\Book::STATUS_DRAFT)--}}
{{--                                                <span class="badge badge-sm bg-gradient-secondary">{{$book->status}}</span>--}}
{{--                                                @else--}}
{{--                                                <span class="badge badge-sm bg-gradient-success">{{$book->status}}</span>--}}
{{--                                                @endif--}}
{{--                                            </td>--}}
{{--                                            <td class="align-middle text-center">--}}
{{--                                                <span class="text-secondary text-xs font-weight-bold">{{$book->published_at}}</span>--}}
{{--                                            </td>--}}
{{--                                            <td class="align-middle">--}}
{{--                                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editBookModal"--}}
{{--                                                        data-id="{{ $book->id }}" data-title="{{ $book->title }}" data-subtitle="{{ $book->subtitle }}"--}}
{{--                                                        data-action="{{ route('books.update', $book->id) }}" data-author="{{ $book->author }}" data-book-status="{{ $book->status }}"--}}
{{--                                                        data-published_at="{{ $book->published_at }}" data-cover_image="{{ $book->cover_image }}">--}}
{{--                                                    Edit--}}
{{--                                                </button>--}}
{{--                                            </td>--}}
{{--                                        </tr>--}}
{{--                                    @endforeach--}}


{{--                                    </tbody>--}}
{{--                                </table>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </main>--}}
{{--    <! -- New Book Modal -->--}}
{{--    <div class="modal fade" id="createBookModal" tabindex="-1" aria-labelledby="createBookModal" aria-hidden="true">--}}
{{--        <div class="modal-dialog">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="createBookModal">Create Book</h5>--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form id="editBookForm" action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">--}}
{{--                        @csrf--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="bookTitle" class="form-label">Title</label>--}}
{{--                            <input type="text" class="form-control" id="bookTitle" name="title" required>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="bookSubtitle" class="form-label">Subtitle</label>--}}
{{--                            <input type="text" class="form-control" id="bookSubtitle" name="subtitle" required>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="bookAuthor" class="form-label">Author</label>--}}
{{--                            <input type="text" class="form-control" id="bookAuthor" name="author" required>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="bookStatus" class="form-label">Status</label>--}}
{{--                            <select class="form-select" id="bookStatus" name="status" required>--}}
{{--                                <option value="{{ \App\Models\Book::STATUS_DRAFT }}">Draft</option>--}}
{{--                                <option value="{{ \App\Models\Book::STATUS_PUBLISHED }}">Published</option>--}}
{{--                            </select>--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="bookPublishedAt" class="form-label">Published At</label>--}}
{{--                            <input type="date" class="form-control" id="bookPublishedAt" name="published_at">--}}
{{--                        </div>--}}
{{--                        <div class="mb-3">--}}
{{--                            <label for="cover_image" class="form-label">Cover Image</label>--}}
{{--                            <input type="file" class="form-control" id="cover_image" name="cover_image">--}}
{{--                            <img id="coverImagePreview" src="" alt="Cover Image" class="img-thumbnail mt-2" width="150" style="display: none;">--}}
{{--                        </div>--}}
{{--                        <button type="submit" class="btn btn-primary">Save changes</button>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- Edit Book Modal -->
    <div class="modal fade" id="editBookModal" tabindex="-1" aria-labelledby="editBookModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editBookForm" action="{{ url('books/id') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" id="bookId" name="bookId">
                        <div class="mb-3">
                            <label for="bookTitle" class="form-label">Title</label>
                            <input type="text" class="form-control" id="bookTitle" name="title" required>
                        </div>
                        <div class="mb-3">
                            <label for="bookSubtitle" class="form-label">Subtitle</label>
                            <input type="text" class="form-control" id="bookSubtitle" name="subtitle" required>
                        </div>
                        <div class="mb-3">
                            <label for="bookAuthor" class="form-label">Author</label>
                            <input type="text" class="form-control" id="bookAuthor" name="author" required>
                        </div>
                        <div class="mb-3">
                            <label for="bookStatus" class="form-label">Status</label>
                            <select class="form-select" id="bookStatus" name="status" required>
                                <option value="{{ \App\Models\Book::STATUS_DRAFT }}">Draft</option>
                                <option value="{{ \App\Models\Book::STATUS_PUBLISHED }}">Published</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bookPublishedAt" class="form-label">Published At</label>
                            <input type="date" class="form-control" id="bookPublishedAt" name="published_at">
                        </div>
                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Cover Image</label>
                            <input type="file" class="form-control" id="cover_image" name="cover_image">
                            <img id="coverImagePreview" src="" alt="Cover Image" class="img-thumbnail mt-2" width="150" style="display: none;">
                        </div>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var editBookModal = document.getElementById('editBookModal');
        editBookModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var id = button.getAttribute('data-id');
            var title = button.getAttribute('data-title');
            var subtitle = button.getAttribute('data-subtitle');
            var published_at = button.getAttribute('data-published_at');
            var cover_image = button.getAttribute('data-cover_image');
            var author = button.getAttribute('data-author');
            var action = button.getAttribute('data-action');
            var bookStatus = button.getAttribute('data-book-status');

            var modalTitle = editBookModal.querySelector('.modal-title');
            var bookIdInput = editBookModal.querySelector('#bookId');
            var bookTitleInput = editBookModal.querySelector('#bookTitle');
            var bookSubtitleInput = editBookModal.querySelector('#bookSubtitle');
            var bookPublishedAtInput = editBookModal.querySelector('#bookPublishedAt');
            var coverImagePreview = editBookModal.querySelector('#coverImagePreview');
            var bookAuthorInput = editBookModal.querySelector('#bookAuthor');
            var bookStatusInput = editBookModal.querySelector('#bookStatus');

            modalTitle.textContent = 'Edit Book: ' + title;
            bookIdInput.value = id;
            bookTitleInput.value = title;
            bookSubtitleInput.value = subtitle;
            bookPublishedAtInput.value = published_at;
            bookAuthorInput.value = author;
            bookStatusInput.value = bookStatus;

            if (cover_image) {
                coverImagePreview.src = cover_image;
                coverImagePreview.style.display = 'block';
            } else {
                coverImagePreview.style.display = 'none';
            }

            var form = editBookModal.querySelector('#editBookForm');
            form.action = action;
        });
    </script>
@endsection
