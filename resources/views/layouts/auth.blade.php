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


    </head>

    <body>

    
        {{-- content --}}
        <div class="content">
            @yield('content')
        </div>

        

    </body>

</html>