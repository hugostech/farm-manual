@extends('layouts.user_type.admin')

@section('content')

    <div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 mx-4">
                    <div class="card-header pb-0">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h5 class="mb-0">All Users</h5>
                            </div>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#createUserModal" class="btn bg-gradient-primary btn-sm mb-0" type="button">+&nbsp; New User</a>
                            <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('user.create')}}" method="POST" enctype="multipart/form-data">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editBookModalLabel">Create User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                                @csrf
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email <sup class="text-danger">*</sup></label>
                                                    <input type="email" class="form-control"  name="email" required>
                                                </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password <sup class="text-danger">*</sup></label>
                                                <input type="text" class="form-control"  name="password" value="{{\Illuminate\Support\Str::random(8)}}" required>
                                            </div>

                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Name <sup class="text-danger">*</sup></label>
                                                    <input type="text" class="form-control"  name="name" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phone" class="form-label">Phone</label>
                                                    <input type="text" class="form-control"  name="phone">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="location" class="form-label">Location</label>
                                                    <input type="text" class="form-control"  name="location">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="status" class="form-label">Status <sup class="text-danger">*</sup></label>
                                                    <select class="form-select" name="status" required>
                                                        <option value="1">Active</option>
                                                        <option value="0">Disable</option>
                                                    </select>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="group" class="form-label">Group <sup class="text-danger">*</sup></label>
                                                    <select class="form-select"  name="group" required>
                                                        @foreach(\App\Models\Group::all() as $group)
                                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="profile_image" class="form-label">Profile Image</label>
                                                    <input type="file" class="form-control" name="profile_image">
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                        </form>
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
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Photo
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Name
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Email
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Phone
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Location
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Group
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Creation Date
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Action
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td class="ps-4">
                                            <p class="text-xs font-weight-bold mb-0">{{$user->id}}</p>
                                        </td>
                                        <td>
                                            <div>
                                                <img src="{{$user->avatar}}" class="avatar avatar-sm me-3">
                                            </div>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0 text-capitalize">{{$user->name}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$user->email}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$user->phone}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0">{{$user->location}}</p>
                                        </td>
                                        <td class="text-center">
                                            <p class="text-xs font-weight-bold mb-0 text-capitalize">{{$user->group_name}}</p>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold">{{$user->created_at->format('d-M-Y')}}</span>
                                        </td>
                                        <td class="text-center">
                                            <span class="text-secondary text-xs font-weight-bold {{$user->status?'':'text-danger'}}">{{$user->status?'Active':'Disable'}}</span>
                                        </td>
                                        <td class="text-center">

                                            <a href="#" class="mx-3 edit-user-btn"
                                               data-action="{{ route('user.update', ['user' => $user]) }}" data-user-id="{{ $user->id }}"
                                               data-user-name="{{ $user->name }}" data-user-email="{{ $user->email }}"
                                               data-user-group="{{ $user->group?->id }}" data-user-phone="{{ $user->phone }}"
                                               data-user-location="{{ $user->location }}" data-user-status="{{ $user->status }}"
                                               data-bs-toggle="tooltip" data-bs-original-title="Edit user">
                                                <i class="fas fa-user-edit text-secondary"></i>
                                            </a>

                                        </td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td colspan="5">

                                    </td>
                                    <td colspan="2">
                                        {{ $users->links() }}
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
    <!-- Edit User Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="editUserForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email <span class="text-sm text-danger">(Display only)</span></label>
                            <input type="email" class="form-control" id="email" name="email" disabled required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="text" class="form-control" id="password" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Name <sup class="text-danger">*</sup></label>
                            <input type="text" class="form-control" id="username" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status <sup class="text-danger">*</sup></label>
                            <select class="form-select" id="status" name="status" required>
                                <option value="1">Active</option>
                                <option value="0">Disable</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="group" class="form-label">Group <sup class="text-danger">*</sup></label>
                            <select class="form-select" id="group" name="group" required>
                                @foreach(\App\Models\Group::all() as $group)
                                <option value="{{$group->id}}">{{$group->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="profile_image" class="form-label">Profile Image</label>
                            <input type="file" class="form-control" id="profile_image" name="profile_image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editButtons = document.querySelectorAll('.edit-user-btn');
            editButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const userId = this.getAttribute('data-user-id');
                    const userName = this.getAttribute('data-user-name');
                    const userEmail = this.getAttribute('data-user-email');
                    const userGroup = this.getAttribute('data-user-group');
                    const userAction = this.getAttribute('data-action');
                    const userPhone = this.getAttribute('data-user-phone');
                    const userLocation = this.getAttribute('data-user-location');
                    const userStatus = this.getAttribute('data-user-status');

                    const form = document.getElementById('editUserForm');
                    form.action = userAction;
                    document.getElementById('username').value = userName;
                    document.getElementById('email').value = userEmail;
                    document.getElementById('group').value = userGroup;
                    document.getElementById('phone').value = userPhone;
                    document.getElementById('location').value = userLocation;
                    document.getElementById('status').value = userStatus;

                    const editUserModal = new bootstrap.Modal(document.getElementById('editUserModal'));
                    editUserModal.show();
                });
            });
        });
    </script>
@endsection
