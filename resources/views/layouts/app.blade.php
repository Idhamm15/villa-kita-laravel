<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>Villa Kita - Liburan tanpa batas</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="" name="keywords">
        <meta content="" name="description">

        {{-- Title --}}
        <title>@yield('title')</title>
        
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @vite('resources/css/app.css')
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        />

        <!-- Style -->
        {{-- @stack('prepend-style')
        @include('component.landing_pages.css.index')
        @stack('addon-style')  --}}

    </head>

    <body>

        <!-- Spinner Start -->
        <div id="spinner" class="show w-100 vh-100 bg-white position-fixed translate-middle top-50 start-50  d-flex align-items-center justify-content-center">
            <div class="spinner-grow text-primary" role="status"></div>
        </div>
        <!-- Spinner End -->

        {{-- Header --}}
        @include('components.navbar')


        {{-- content --}}
        <div class="content">
            @yield('content')
        </div>

        
        <!-- Footer -->
        @include('components.footer')


        <!-- Back to Top -->
        {{-- <a href="#" class="btn btn-primary btn-primary-outline-0 btn-md-square rounded-circle back-to-top"><i class="fa fa-arrow-up"></i></a>    --}}
        
        <!-- Script -->
        {{-- @stack('prepend-script')
        @include('component.landing_pages.js.index')
        @stack('addon-script') --}}

    </body>

</html>