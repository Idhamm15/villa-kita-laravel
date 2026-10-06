@extends('layouts.admin')

@section('title', 'Tambah User - Villa Kita')

@section('content')

<div class="p-6 bg-gray-100 rounded-3xl md:p-12">
    
{{-- HEADER --}}
<div class="mb-8">

    <a
        href="{{ url('/dashboard/user') }}"
        class="flex items-center gap-2 mb-5 text-gray-500 hover:text-blue-600"
    >
        <i class="fa-solid fa-arrow-left text-[22px]"></i>
        <span>Kembali</span>
    </a>

    <h1 class="text-3xl font-bold text-gray-900">
        Tambah User Baru
    </h1>

    <p class="mt-2 text-gray-500">
        Tambahkan user baru ke dalam sistem.
    </p>

</div>


{{-- BANNER --}}
<div class="mb-8 overflow-hidden bg-blue-600 shadow-lg rounded-3xl">

    <div class="flex items-center gap-5 px-8 py-7">

        <div class="flex items-center justify-center h-14 w-14 rounded-2xl bg-white/20">
            <i class="fa-solid fa-plus text-[30px] text-white"></i>
        </div>

        <div>

            <h2 class="text-3xl font-bold text-white">
                Informasi User
            </h2>

            <p class="mt-1 text-blue-100">
                Lengkapi informasi user di bawah ini.
            </p>

        </div>

    </div>

</div>


{{-- FORM --}}
<form
    action="{{ url('/dashboard/management-user/store') }}"
    method="POST"
    class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-3xl"
>

    @csrf

    {{-- FORM HEADER --}}
    <div class="px-8 py-6 border-b border-gray-300">

        <div class="flex items-center gap-3">

            <div class="w-1 h-10 bg-blue-600 rounded-full"></div>

            <div>

                <h2 class="text-2xl font-bold">
                    Informasi Dasar
                </h2>

                <p class="text-gray-500">
                    Masukkan informasi akun user.
                </p>

            </div>

        </div>

    </div>


    {{-- FORM BODY --}}
    <div class="p-8 space-y-8">

        {{-- USERNAME --}}
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
                value="{{ old('username') }}"
                placeholder="Masukkan username"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
            >

            @error('username')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- FULLNAME --}}
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
                value="{{ old('fullname') }}"
                placeholder="Masukkan nama lengkap"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
            >

            @error('fullname')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- EMAIL + PHONE --}}
        <div class="grid gap-6 md:grid-cols-2">

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
                    value="{{ old('email') }}"
                    placeholder="user@example.com"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                @error('email')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


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
                    value="{{ old('phone') }}"
                    placeholder="08xxxxxxxxxx"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                @error('phone')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>


        {{-- PASSWORD + ROLE --}}
        <div class="grid gap-6 md:grid-cols-2">

            <div>

                <label
                    for="password"
                    class="block mb-2 font-semibold"
                >
                    Password
                </label>

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Masukkan password"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                @error('password')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div>

                <label
                    for="role"
                    class="block mb-2 font-semibold"
                >
                    Role
                </label>

                <select
                    name="role"
                    id="role"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                    <option value="USER" {{ old('role', 'USER') === 'USER' ? 'selected' : '' }}>
                        USER
                    </option>

                    <option value="ADMIN" {{ old('role') === 'ADMIN' ? 'selected' : '' }}>
                        ADMIN
                    </option>

                    <option value="OWNER" {{ old('role') === 'OWNER' ? 'selected' : '' }}>
                        OWNER
                    </option>

                </select>

                @error('role')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>


        {{-- BANK --}}
        <div class="grid gap-6 md:grid-cols-2">

            <div>

                <label
                    for="nameBank"
                    class="block mb-2 font-semibold"
                >
                    Nama Bank
                </label>

                <input
                    type="text"
                    name="nameBank"
                    id="nameBank"
                    value="{{ old('nameBank') }}"
                    placeholder="Contoh: BCA"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                @error('nameBank')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            <div>

                <label
                    for="noBank"
                    class="block mb-2 font-semibold"
                >
                    No. Rekening
                </label>

                <input
                    type="text"
                    name="noBank"
                    id="noBank"
                    value="{{ old('noBank') }}"
                    placeholder="Nomor rekening"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                @error('noBank')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>


        {{-- ADDRESS --}}
        <div>

            <label
                for="address"
                class="block mb-2 font-semibold"
            >
                Alamat
            </label>

            <textarea
                name="address"
                id="address"
                rows="4"
                placeholder="Alamat lengkap"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
            >{{ old('address') }}</textarea>

            @error('address')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- STATUS --}}
        <div>

            <label class="flex items-center gap-3 cursor-pointer">

                <input
                    type="checkbox"
                    name="isActive"
                    value="1"
                    {{ old('isActive', true) ? 'checked' : '' }}
                    class="w-5 h-5 rounded"
                >

                <span class="font-semibold">
                    User Aktif
                </span>

            </label>

        </div>

    </div>


    {{-- FOOTER --}}
    <div class="flex justify-end gap-4 px-8 py-6 border-t border-gray-300 bg-gray-50">

        <a
            href="{{ url('/dashboard/user') }}"
            class="px-8 py-3 font-semibold border border-gray-300 rounded-xl hover:bg-gray-100"
        >
            Batal
        </a>

        <button
            type="submit"
            class="px-10 py-3 font-semibold text-white rounded-xl bg-gradient-to-r from-blue-600 to-blue-700 disabled:cursor-not-allowed disabled:opacity-50"
        >
            Simpan User
        </button>

    </div>

</form>

</div>

@endsection