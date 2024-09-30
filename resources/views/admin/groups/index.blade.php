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
                            <a href="#" data-bs-toggle="modal" data-bs-target="#createGroupModal" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New Group</a>
                            <div class="modal fade" id="createGroupModal" tabindex="-1" aria-labelledby="createGroupModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBookModalLabel">Create Group</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('groups.store')  }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="bookTitle" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="groupname" name="name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="bookCheckbox" class="form-label">Books</label>
                                                    <ul class="list-group" id="bookCheckbox" >
                                                        @foreach(\App\Models\Book::all() as $book)
                                                            <li class="list-group-item">
                                                                <input type="checkbox" name="books[]"
                                                                       value="{{$book->id}}"> {{$book->title}}</li>
                                                        @endforeach
                                                    </ul>

                                                </div>


                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                            <button class="btn btn" data-bs-toggle="modal" data-bs-target="#editGroupModal_{{$group->id}}">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </button>


                                            {{--                                            <span>--}}
{{--                                            <i class="cursor-pointer fas fa-trash text-secondary"></i>--}}
{{--                                        </span>--}}
                                        </td>
                                        <div class="modal fade" id="editGroupModal_{{$group->id}}" tabindex="-1" aria-labelledby="editGroupModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Group</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="editBookForm" action="{{ route('groups.update', ['group'=>$group])  }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="mb-3">
                                                                <label for="bookTitle" class="form-label">Name</label>
                                                                <input type="text" class="form-control" id="groupname" name="name" value="{{$group->name}}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="bookCheckbox" class="form-label">Books</label>
                                                                <ul class="list-group" id="bookCheckbox" >
                                                                    @foreach($group->assignedBooks() as $book)
                                                                        <li class="list-group-item"><input type="checkbox" name="books[]" value="{{$book['id']}}" {{$book['assigned']?'checked':''}}> {{$book['title']}}</li>
                                                                    @endforeach
                                                                </ul>

                                                            </div>


                                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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

@endsection
