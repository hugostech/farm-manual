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
                @yield('content')
                @include('layouts.footers.auth.footer')
            </div>
        </main>
    @endif

    @include('components.fixed-plugin')

@endsection
