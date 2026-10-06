@extends('layouts.app')

@section('content')

    <div class="flex items-center justify-center min-h-[70vh] px-6">
        <div class="text-center">

            <h1 class="font-bold text-blue-600 text-8xl">
                404
            </h1>

            <h2 class="mt-4 text-2xl font-bold text-gray-900">
                Halaman Tidak Ditemukan
            </h2>

            <p class="mt-3 text-gray-500">
                Maaf, halaman yang kamu cari tidak tersedia atau sudah dipindahkan.
            </p>

            <a
                href="{{ url('/') }}"
                class="inline-block px-6 py-3 mt-6 font-semibold text-white transition bg-blue-600 rounded-xl hover:bg-blue-700"
            >
                Kembali ke Beranda
            </a>

        </div>
    </div>
    
   

@endsection