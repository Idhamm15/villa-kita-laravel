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
        <div id="spinner" class="bg-white show w-100 vh-100 position-fixed translate-middle top-50 start-50 d-flex align-items-center justify-content-center">
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


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        @if (session('success') || session('success-login'))

            Swal.fire({
                toast: true,
                icon: 'success',
                title: @json(session('success') ?? session('success-login')),
                position: 'top-end',
                showConfirmButton: false,
                timer: 1800,
                timerProgressBar: true,

                showClass: {
                    popup: 'swal2-toast-show'
                },

                hideClass: {
                    popup: 'swal2-toast-hide'
                },

                customClass: {
                    popup: 'custom-toast',
                    title: 'custom-toast-title',
                    timerProgressBar: 'custom-toast-progress'
                }
            });

        @endif
    </script>

    <style>
        /* Toast */
        .custom-toast {
            border-radius: 14px !important;
            padding: 14px 18px !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.10) !important;
        }

        /* Text */
        .custom-toast-title {
            font-size: 14px !important;
            font-weight: 500 !important;
            margin: 0 !important;
        }

        /* Progress bar */
        .custom-toast-progress {
            height: 3px !important;
            border-radius: 0 0 14px 14px !important;
        }

        /* Animasi muncul */
        .swal2-toast-show {
            animation: toastFadeIn 0.25s ease-out !important;
        }

        /* Animasi hilang */
        .swal2-toast-hide {
            animation: toastFadeOut 0.2s ease-in forwards !important;
        }

        @keyframes toastFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        @keyframes toastFadeOut {
            from {
                opacity: 1;
            }

            to {
                opacity: 0;
            }
        }
    </style>

    </body>

</html>