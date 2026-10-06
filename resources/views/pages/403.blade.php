@extends('layouts.app')

@section('content')

<div class="min-h-[70vh] flex items-center justify-center px-6">
    <div class="text-center">

        <div class="mb-6">
            <h1 class="font-extrabold text-gray-800 text-8xl">
                403
            </h1>
        </div>

        <h2 class="mb-3 text-2xl font-bold text-gray-800">
            Akses Ditolak
        </h2>

        <p class="max-w-md mx-auto mb-8 text-gray-500">
            Maaf, Anda tidak memiliki izin untuk mengakses halaman ini.
        </p>

        <a
            href="{{ url('/') }}"
            class="inline-flex items-center px-6 py-3 font-semibold text-white transition bg-blue-600 rounded-xl hover:bg-blue-700"
        >
            Kembali ke Halaman Utama
        </a>

    </div>
</div>

@endsection