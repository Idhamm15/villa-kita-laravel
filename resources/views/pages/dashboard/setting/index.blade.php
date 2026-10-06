@extends('layouts.admin')

@section('title', 'Pengaturan - Villa Kita')

@section('content')

@php
    $user = $data;

    $fullname = data_get($user, 'fullname', '');
    $username = data_get($user, 'username', '');
    $email = data_get($user, 'email', '');
    $phone = data_get($user, 'phone', '');
    $avatar = data_get($user, 'avatar');
@endphp

<div class="p-10 bg-gray-100 rounded-3xl">

{{-- Header --}}
<div class="mb-8">

    <a
        href="{{ url()->previous() }}"
        class="flex items-center gap-2 mb-5 text-gray-500 hover:text-blue-600"
    >
        <i class="fa-solid fa-arrow-left text-[22px]"></i>
        <span>Kembali</span>
    </a>

    <h1 class="text-3xl font-bold">
        Pengaturan
    </h1>

    <p class="mt-2 text-gray-500">
        Kelola informasi profil akun administrator.
    </p>

</div>

{{-- Banner --}}
<div class="mb-8 overflow-hidden bg-blue-600 shadow-lg rounded-3xl">

    <div class="flex items-center gap-5 px-8 py-7">

        <div class="flex items-center justify-center h-14 w-14 rounded-2xl bg-white/20">

            <i class="fa-solid fa-gear text-[30px] text-white"></i>

        </div>

        <div>

            <h2 class="text-3xl font-bold text-white">
                Profil Administrator
            </h2>

            <p class="mt-1 text-blue-100">
                Perbarui informasi akun administrator.
            </p>

        </div>

    </div>

</div>

{{-- Form --}}
<form
    action="{{ url('/dashboard/setting/' . $user->id . '/update') }}"
    method="POST"
    enctype="multipart/form-data"
    class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-3xl"
>

    @csrf
    @method('PUT')

    {{-- Header --}}
    <div class="px-8 py-6 border-b border-gray-200">

        <div class="flex items-center gap-3">

            <div class="w-1 h-10 bg-blue-600 rounded-full"></div>

            <div>

                <h2 class="text-2xl font-bold">
                    Informasi Profil
                </h2>

                <p class="text-gray-500">
                    Lengkapi data administrator.
                </p>

            </div>

        </div>

    </div>

    <div class="p-8 space-y-8">

        {{-- Foto --}}
        <div>

            <label class="block mb-3 font-semibold">
                Foto Profil
            </label>

            <div class="flex items-center gap-6">

                <div class="relative w-32 h-32 overflow-hidden bg-gray-100 border border-gray-300 rounded-full">

                    @if($avatar)
                        <img
                            src="{{ asset('storage/' . $avatar) }}"
                            alt="Foto Profil"
                            id="preview-image"
                            class="object-cover w-full h-full"
                        >
                    @else
                        <img
                            id="preview-image"
                            src=""
                            alt="Preview"
                            class="hidden object-cover w-full h-full"
                        >

                        <div
                            id="image-placeholder"
                            class="flex items-center justify-center h-full text-gray-400"
                        >
                            <i class="fa-solid fa-camera text-[40px]"></i>
                        </div>
                    @endif

                </div>

                <div class="flex-1">

                    <input
                        type="file"
                        name="avatar"
                        id="avatar"
                        accept="image/jpeg,image/png,image/webp"
                        onchange="previewImage(event)"
                        class="block w-full border border-gray-300 rounded-xl file:mr-4 file:rounded-xl file:border-0 file:bg-blue-100 file:px-5 file:py-3 file:font-semibold file:text-blue-700"
                    >

                    <p class="mt-2 text-sm text-gray-500">
                        JPG, PNG atau WEBP (Max 5MB)
                    </p>

                    @error('avatar')
                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>

        {{-- Informasi --}}
        <div class="grid gap-6 md:grid-cols-2">

            {{-- Nama Lengkap --}}
            <div>

                <label
                    for="fullname"
                    class="block mb-2 font-semibold"
                >
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="fullname"
                    id="fullname"
                    value="{{ old('fullname', $fullname) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                @error('fullname')
                    <p class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Username --}}
            <div>

                <label
                    for="username"
                    class="block mb-2 font-semibold"
                >
                    Username
                </label>

                <input
                    type="text"
                    name="username"
                    id="username"
                    value="{{ old('username', $username) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                @error('username')
                    <p class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Email --}}
            <div>

                <label
                    for="email"
                    class="block mb-2 font-semibold"
                >
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    id="email"
                    value="{{ old('email', $email) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                @error('email')
                    <p class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- No Telepon --}}
            <div>

                <label
                    for="phone"
                    class="block mb-2 font-semibold"
                >
                    No. Telepon
                </label>

                <input
                    type="text"
                    name="phone"
                    id="phone"
                    value="{{ old('phone', $phone) }}"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                @error('phone')
                    <p class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>

        <hr>

        {{-- Password --}}
        <div class="grid gap-6 md:grid-cols-2">

            {{-- Password Baru --}}
            <div>

                <label
                    for="password"
                    class="block mb-2 font-semibold"
                >
                    Password Baru
                </label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Kosongkan jika tidak diubah"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                @error('password')
                    <p class="mt-1 text-sm text-red-500">
                        {{ $message }}
                    </p>
                @enderror

            </div>

            {{-- Konfirmasi Password --}}
            <div>

                <label
                    for="password_confirmation"
                    class="block mb-2 font-semibold"
                >
                    Konfirmasi Password
                </label>

                <input
                    type="password"
                    name="password_confirmation"
                    id="password_confirmation"
                    placeholder="Ulangi password baru"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

            </div>

        </div>

    </div>

    {{-- Footer --}}
    <div class="flex justify-end gap-4 px-8 py-6 border-t border-gray-200 bg-gray-50">

        <a
            href="{{ url()->previous() }}"
            class="px-8 py-3 font-semibold border border-gray-300 rounded-xl hover:bg-gray-100"
        >
            Batal
        </a>

        <button
            type="submit"
            class="px-10 py-3 font-semibold text-white bg-blue-600 rounded-xl hover:opacity-90"
        >
            Simpan Perubahan
        </button>

    </div>

</form>

</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview-image');
        const placeholder = document.getElementById('image-placeholder');

        if (!input.files || !input.files[0]) {
            return;
        }

        const file = input.files[0];

        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 5MB.');
            input.value = '';
            return;
        }

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');

        if (placeholder) {
            placeholder.classList.add('hidden');
        }
    }
</script>

@endsection
