@extends('layouts.app')

@section('auth')
    <!-- Include jQuery and jQuery UI for drag-and-drop functionality -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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



    @include('components.fixed-plugin')

@endsection
