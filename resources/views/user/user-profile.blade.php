@extends('layouts.user_type.user')

@section('content')

    <div>
        <div class="container-fluid">
            <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
                <span class="mask bg-gradient-primary opacity-6"></span>
            </div>
            <div class="card card-body blur shadow-blur mx-4 mt-n6">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            <img src="{{$user->avatar}}" alt="avatar" class="w-100 border-radius-lg shadow-sm">
                            <a href="javascript:;"
                               class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2" id="editImageButton">
                                <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Image"></i>
                            </a>
                            <form id="editImageForm" method="POST" action="{{ route('user.update.image', $user->id) }}" enctype="multipart/form-data" style="display: none;">
                                @csrf
                                @method('PUT')
                                <input type="file" id="profileImageInput" name="profile_image" accept="image/*" style="display: none;">
                            </form>
                        </div>
                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                {{ $user->name }}
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm text-capitalize">
                                {{ $user->group_name }}
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                        <div class="nav-wrapper position-relative end-0">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="card">
                <div class="card-header pb-0 px-3">
                    <h6 class="mb-0">{{ __('Profile Information') }}</h6>
                    <p class="text-sm">{{$user->email}}</p>
                </div>
                <div class="card-body pt-4 p-3">
                    <form action="{{route('update-user-profile')}}" method="POST" role="form text-left">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-name" class="form-control-label">{{ __('Full Name') }}</label>
                                    <div class="@error('user.name')border border-danger rounded-3 @enderror">
                                        <input class="form-control" value="{{ auth()->user()->name }}" type="text" placeholder="Name" id="user-name" name="name">
                                        @error('name')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user-email" class="form-control-label">{{ __('Password') }}</label>
                                    <div class="@error('email')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="password" placeholder="password" name="password">
                                        @error('password')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.phone" class="form-control-label">{{ __('Phone') }}</label>
                                    <div class="@error('user.phone')border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="tel"
                                               id="number"
                                               name="phone" value="{{ auth()->user()->phone }}">
                                        @error('phone')
                                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="user.location" class="form-control-label">{{ __('Location') }}</label>
                                    <div class="@error('user.location') border border-danger rounded-3 @enderror">
                                        <input class="form-control" type="text" placeholder="Location" id="name" name="location" value="{{ auth()->user()->location }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="about">{{ 'About Me' }}</label>
                            <div class="@error('user.about')border border-danger rounded-3 @enderror">
                                <textarea class="form-control" id="about" rows="3" placeholder="Say something about yourself" name="about_me">{{ auth()->user()->about_me }}</textarea>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary btn-md mt-4 mb-4">{{ 'Save Changes' }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editImageButton = document.getElementById('editImageButton');
            const profileImageInput = document.getElementById('profileImageInput');
            const editImageForm = document.getElementById('editImageForm');

            editImageButton.addEventListener('click', function() {
                profileImageInput.click();
            });

            profileImageInput.addEventListener('change', function() {
                if (profileImageInput.files.length > 0) {
                    editImageForm.submit();
                }
            });
        });
    </script>
@endsection
