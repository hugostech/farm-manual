@extends('layouts.app')

@section('auth')
    @if (\Request::is('profile'))
        @include('layouts.navbars.admin.sidebar')
        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            @include('layouts.navbars.admin.nav')
            @yield('content')
        </div>

    @else
        @include('layouts.navbars.admin.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
            @include('layouts.navbars.admin.nav')
            <div class="container-fluid py-4">
                <!-- Error Display -->
                @if($errors->any())
                    <div class="mx-4  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif
                @if(session('success'))
                    <div class="mx-4  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                            <i class="fa fa-close" aria-hidden="true"></i>
                        </button>
                    </div>
                @endif

                @yield('content')
                @include('layouts.footers.auth.footer')
            </div>
        </main>
    @endif



    @include('components.fixed-plugin')

@endsection
