@extends('layouts.app')

@section('auth')
    @if (\Request::is('profile'))
        @include('layouts.navbars.user.sidebar')
        <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
            @include('layouts.navbars.user.nav')
            @yield('content')
        </div>

    @else
        @include('layouts.navbars.user.sidebar')
        <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
            @include('layouts.navbars.user.nav')
            <div class="container-fluid py-4">
                @yield('content')
                @include('layouts.footers.auth.footer')
            </div>
        </main>
    @endif

    @include('components.fixed-plugin')

@endsection
