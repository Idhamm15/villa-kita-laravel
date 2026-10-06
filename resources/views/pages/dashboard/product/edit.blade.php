{{-- resources/views/admin/product/create.blade.php --}}

@extends('layouts.admin')

@section('title', 'Edit Properti - Villa Kita')

@section('content')

<div class="p-6 bg-gray-100 rounded-3xl md:p-12">

{{-- ==========================
    HEADER
========================== --}}

<div class="mb-8">

    <a
        href="{{ url('/dashboard/product') }}"
        class="flex items-center gap-2 mb-5 text-gray-500 hover:text-blue-600"
    >
        <i class="fa-solid fa-arrow-left text-[22px]"></i>

        <span>
            Kembali
        </span>
    </a>

    <h1 class="text-3xl font-bold text-gray-900">
        Edit Properti Baru
    </h1>

    <p class="mt-2 text-gray-500">
        Editkan properti baru untuk ditampilkan pada homepage.
    </p>

</div>


{{-- ==========================
    BANNER
========================== --}}

<div class="mb-8 overflow-hidden bg-blue-600 shadow-lg rounded-3xl">

    <div class="flex items-center gap-5 px-8 py-7">

        <div class="flex items-center justify-center h-14 w-14 rounded-2xl bg-white/20">
            <i class="fa-solid fa-plus text-[30px] text-white"></i>
        </div>

        <div>

            <h2 class="text-3xl font-bold text-white">
                Informasi Properti
            </h2>

            <p class="mt-1 text-blue-100">
                Lengkapi informasi properti di bawah ini.
            </p>

        </div>

    </div>

</div>


{{-- ==========================
    FORM
========================== --}}

<form
    action="{{ url('/dashboard/product', $data->id) . '/update' }}"
    method="POST"
    enctype="multipart/form-data"
    class="overflow-hidden border border-gray-200 shadow-sm rounded-3xl"
>
    @csrf
    @method('PUT')


    {{-- ==========================
        INFORMASI DASAR
    ========================== --}}

    <div class="bg-white">

        <div class="px-8 py-6 border-b border-gray-200">

            <div class="flex items-center gap-3">

                <div class="w-1 h-10 bg-blue-600 rounded-full"></div>

                <div>

                    <h2 class="text-2xl font-bold">
                        Informasi Kategori
                    </h2>

                    <p class="text-gray-500">
                        Lengkapi informasi kategori di bawah ini.
                    </p>

                </div>

            </div>

        </div>


        <div class="p-8 space-y-8">

            <div>

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- Nama Properti --}}

                    <div>

                        <label class="block mb-2 font-semibold">
                            Nama Properti *
                        </label>

                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $data->name ?? '') }}"
                            placeholder="Masukkan nama properti"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                        @error('name')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Tipe Properti --}}

                   <div>

                        <label class="block mb-2 font-semibold">
                            Tipe Properti *
                        </label>

                        <select
                            name="type"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                            <option value="" disabled
                                {{ old('type', $data->type ?? '') === '' ? 'selected' : '' }}>
                                -- Pilih Tipe Properti --
                            </option>

                            <option
                                value="VILLA"
                                {{ old('type', $data->type ?? '') === 'VILLA' ? 'selected' : '' }}
                            >
                                Villa
                            </option>

                            <option
                                value="TRIP"
                                {{ old('type', $data->type ?? '') === 'TRIP' ? 'selected' : '' }}
                            >
                                Trip
                            </option>

                        </select>

                        @error('type')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Lokasi --}}

                    <div>

                        <label class="block mb-2 font-semibold">
                            Lokasi *
                        </label>

                        <input
                            type="text"
                            name="location"
                            value="{{ old('location', $data->location ?? '') }}"
                            placeholder="Contoh: Bandung, Jawa Barat"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                    </div>


                    {{-- Alamat --}}

                    <div>

                        <label class="block mb-2 font-semibold">
                            Alamat
                        </label>

                        <input
                            type="text"
                            name="address"
                            value="{{ old('address', $data->address ?? '') }}"
                            placeholder="Contoh: Jl. Merdeka No.123"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                    </div>

                </div>


                {{-- URL Google Maps --}}

                <div class="mt-6">

                    <label class="block mb-2 font-semibold">
                        URL Google Maps
                    </label>

                    <input
                        type="text"
                        name="url_maps"
                        value="{{ old('url_maps', $data->url_maps ?? '') }}"
                        placeholder="https://maps.app.goo.gl/xxxxx"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                    >

                    <p class="mt-2 text-sm text-gray-500">
                        Buka Google Maps → cari lokasi → klik "Bagikan" → salin link
                    </p>

                </div>


                {{-- Booking / Owner --}}

                <div class="grid grid-cols-1 gap-6 mt-6 md:grid-cols-2">

                    {{-- Booking --}}

                    <div>

                        <label class="block mb-2 font-semibold">
                            Tipe Booking *
                        </label>

                        <select
                            name="booking_type"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                            <option
                                value=""
                                disabled
                                {{ old('booking_type', $data->booking_type ?? '') == '' ? 'selected' : '' }}
                            >
                                -- Pilih Tipe Booking --
                            </option>

                            <option
                                value="MENGINAP"
                                {{ old('booking_type', $data->booking_type ?? '') == 'MENGINAP' ? 'selected' : '' }}
                            >
                                Menginap
                            </option>

                            <option
                                value="HARIAN"
                                {{ old('booking_type', $data->booking_type ?? '') == 'HARIAN' ? 'selected' : '' }}
                            >
                                Harian
                            </option>

                        </select>

                        @error('booking_type')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Owner --}}

                    <div>

                        <label class="block mb-2 font-semibold">
                            Pemilik Properti *
                        </label>

                        <select
                            name="owner_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                            <option value="" disabled
                                {{ old('owner_id', $data->owner_id ?? '') == '' ? 'selected' : '' }}>
                                -- Pilih Pemilik --
                            </option>

                            @forelse($owners ?? [] as $owner)

                                <option
                                    value="{{ $owner->id }}"
                                    {{ old('owner_id', $data->owner_id ?? '') == $owner->id ? 'selected' : '' }}
                                >
                                    {{ $owner->fullname }}
                                </option>

                            @empty

                                <option value="" disabled>
                                    Belum ada pemilik
                                </option>

                            @endforelse

                        </select>

                        @error('owner_id')
                            <p class="mt-1 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Kamar Tidur --}}

                    <div>

                        <label class="block mb-2 font-semibold">
                            Jumlah Kamar Tidur
                        </label>

                        <input
                            type="number"
                            name="total_bedroom"
                            value="{{ old('total_bedroom', $data->total_bedroom ?? '') }}"
                            min="0"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                    </div>


                    {{-- Kamar Mandi --}}

                    <div>

                        <label class="block mb-2 font-semibold">
                            Jumlah Kamar Mandi
                        </label>

                        <input
                            type="number"
                            name="total_bathroom"
                            value="{{ old('total_bathroom', $data->total_bathroom ?? '') }}"
                            min="0"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                    </div>


                    {{-- Max Tamu --}}

                    <div>

                        <label class="block mb-2 font-semibold">
                            Max Tamu *
                        </label>

                        <input
                            type="number"
                            name="max_guest"
                            value="{{ old('max_guest', $data->max_guest ?? '') }}"
                            min="1"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                    </div>


                    {{-- Luas --}}

                    <div>

                        <label class="block mb-2 font-semibold">
                            Luas (m²)
                        </label>

                        <input
                            type="number"
                            name="wide"
                            value="{{ old('wide', $data->wide ?? '') }}"
                            min="0"
                            placeholder="Contoh: 45"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                    </div>

                </div>

            </div>


            <hr class="border-gray-200">


            {{-- ==========================
                HARGA
            ========================== --}}

            <div>

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-1 rounded-full h-7 bg-emerald-500"></div>

                    <h2 class="text-2xl font-bold">
                        Harga
                    </h2>

                </div>


                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>

                        <label class="block mb-2 font-semibold">
                            Harga Awal (Opsional)
                        </label>

                        <input
                            type="number"
                            name="price_start"
                            value="{{ old('price_start', $data->price_start ?? '') }}"
                            min="0"
                            placeholder="Harga sebelum diskon"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                    </div>


                    <div>

                        <label class="block mb-2 font-semibold">
                            Harga Akhir *
                        </label>

                        <input
                            type="number"
                            name="price"
                            value="{{ old('price', $data->price ?? '') }}"
                            min="0"
                            placeholder="Harga utama"
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                        >

                    </div>

                </div>

            </div>


            <hr class="border-gray-200">


            {{-- ==========================
                DESKRIPSI
            ========================== --}}

            <div>

                <div class="flex items-center gap-3 mb-6">

                    <div class="w-1 bg-purple-600 rounded-full h-7"></div>

                    <h2 class="text-2xl font-bold">
                        Deskripsi
                    </h2>

                </div>

                <textarea
                    rows="6"
                    name="description"
                    placeholder="Deskripsi singkat tentang properti..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >{{ old('description', $data->description ?? '') }}</textarea>

            </div>

        </div>

    </div>


    {{-- ==========================
        THUMBNAIL
    ========================== --}}

    <div class="mt-20 bg-white">

        <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-3xl">

            <div class="px-8 py-6 bg-blue-600">

                <div class="flex items-center gap-4">

                    <div class="flex items-center justify-center h-14 w-14 rounded-2xl bg-white/20">

                        <i class="fa-solid fa-image text-[28px] text-white"></i>

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-white">
                            Upload Thumbnail Properti
                        </h2>

                        <p class="mt-1 text-blue-100">
                            Upload foto properti dengan kualitas terbaik.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Preview Thumbnail --}}

            <div
                id="thumbnail-preview"
                class="{{ $data->thumbnail ? '' : 'hidden' }} mx-12 mt-6"
            >

                <p class="mb-3 font-semibold text-gray-700">
                    Thumbnail
                </p>

                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                    <div class="relative overflow-hidden border border-gray-200 rounded-xl">

                        <img
                            id="thumbnail-image"
                            src="{{ $data->thumbnail ? asset('storage/' . $data->thumbnail) : '' }}"
                            alt="Thumbnail"
                            class="object-cover w-full h-32"
                        >

                        <button
                            type="button"
                            id="remove-thumbnail"
                            class="absolute px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full right-2 top-2 hover:bg-red-600"
                        >
                            ×
                        </button>

                        <div
                            id="thumbnail-name"
                            class="px-2 py-2 text-xs text-gray-500 truncate"
                        >
                            {{ $data->thumbnail ? basename($data->thumbnail) : '' }}
                        </div>

                    </div>

                </div>

            </div>


            <div class="p-8">

                <label
                    for="thumbnail"
                    class="flex min-h-[220px] cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-blue-300 bg-gray-50 transition hover:border-blue-500 hover:bg-blue-50"
                >

                    <i class="fa-regular fa-folder-open mb-4 text-[52px] text-yellow-400"></i>

                    <h3 class="text-lg font-semibold text-gray-800">
                        Drag & Drop gambar di sini
                    </h3>

                    <p class="mt-1 text-gray-500">
                        atau klik tombol di bawah untuk memilih gambar
                    </p>

                    <p class="mt-2 text-sm text-gray-400">
                        JPEG, PNG, WEBP, HEIC • Maks 10MB / file • Maks 1 thumbnail
                    </p>

                    <div class="px-6 py-3 mt-6 font-semibold text-white transition bg-blue-600 rounded-xl hover:bg-blue-700">

                        <span class="flex items-center gap-2">

                            <i class="fa-solid fa-upload"></i>

                            Pilih Gambar

                        </span>

                    </div>

                    <input
                        id="thumbnail"
                        name="thumbnail"
                        type="file"
                        accept="image/jpeg,image/png,image/webp,image/heic"
                        class="hidden"
                    >

                </label>


                <div class="px-5 py-4 mt-6 text-sm text-blue-700 border border-blue-200 rounded-xl bg-blue-50">

                    <span class="font-semibold">
                        💡 Tips:
                    </span>

                    Gambar akan menjadi
                    <b>cover/thumbnail</b>.
                    Anda bisa mengubahnya nanti dengan memilih gambar lainnya.

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================
        GALLERY
    ========================== --}}

    <div class="mt-20 bg-white">

        <div class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-3xl">

            <div class="px-8 py-6 bg-blue-600">

                <div class="flex items-center gap-4">

                    <div class="flex items-center justify-center h-14 w-14 rounded-2xl bg-white/20">

                        <i class="fa-solid fa-images text-[28px] text-white"></i>

                    </div>

                    <div>

                        <h2 class="text-2xl font-bold text-white">
                            Upload Gambar Properti
                        </h2>

                        <p class="mt-1 text-blue-100">
                            Upload foto properti dengan kualitas terbaik.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Preview Gallery --}}
            <div
                id="images-preview-wrapper"
                class="{{ $data->images->count() > 0 ? '' : 'hidden' }} mx-12 mt-6"
            >
                <p class="mb-3 font-semibold text-gray-700">
                    Gambar Gallery
                    (<span id="image-count">{{ $data->images->count() }}</span>/12)
                </p>

                <div
                    id="images-preview"
                    class="grid grid-cols-2 gap-4 md:grid-cols-4"
                >

                    {{-- GALLERY LAMA --}}
                    @foreach ($data->images as $image)
                        <div
                            class="relative overflow-hidden border border-gray-200 rounded-xl existing-gallery-image"
                            data-id="{{ $image->id }}"
                        >

                            <img
                                src="{{ asset('storage/' . $image->image) }}"
                                alt="Gallery"
                                class="object-cover w-full h-32"
                            >

                            <button
                                type="button"
                                class="absolute px-2 py-1 text-xs font-bold text-white bg-red-500 rounded-full remove-existing-image right-2 top-2 hover:bg-red-600"
                                data-id="{{ $image->id }}"
                            >
                                ×
                            </button>

                            <div class="px-2 py-2 text-xs text-gray-500 truncate">
                                {{ basename($image->image) }}
                            </div>

                        </div>
                    @endforeach

                </div>
            </div>

            {{-- ID gambar gallery yang akan dihapus --}}
            <div id="deleted-images-container"></div>

            <div class="p-8">

                <label
                    for="images"
                    class="flex min-h-[220px] cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-blue-300 bg-gray-50 transition hover:border-blue-500 hover:bg-blue-50"
                >

                    <i class="fa-regular fa-folder-open mb-4 text-[52px] text-yellow-400"></i>

                    <h3 class="text-lg font-semibold text-gray-800">
                        Drag & Drop gambar di sini
                    </h3>

                    <p class="mt-1 text-gray-500">
                        atau klik tombol di bawah untuk memilih gambar
                    </p>

                    <p class="mt-2 text-sm text-gray-400">
                        JPEG, PNG, WEBP, HEIC • Maks 10MB / file • Maks 12 gambar
                    </p>

                    <div class="px-6 py-3 mt-6 font-semibold text-white transition bg-blue-600 rounded-xl hover:bg-blue-700">

                        <span class="flex items-center gap-2">

                            <i class="fa-solid fa-upload"></i>

                            Pilih Gambar

                        </span>

                    </div>

                    <input
                        id="images"
                        name="images[]"
                        type="file"
                        multiple
                        accept="image/jpeg,image/png,image/webp,image/heic"
                        class="hidden"
                    >

                </label>


                <div class="px-5 py-4 mt-6 text-sm text-blue-700 border border-blue-200 rounded-xl bg-blue-50">

                    <span class="font-semibold">
                        💡 Tips:
                    </span>

                    Gambar untuk gallery produk, Anda bisa mengubahnya nanti dengan memilih gambar lainnya.

                </div>

            </div>

        </div>

    </div>


    {{-- ==========================
        DETAIL PROPERTI
    ========================== --}}

    <div class="mt-20 overflow-hidden bg-white border border-gray-200 shadow-sm rounded-3xl">

        <div class="px-8 py-6 bg-blue-600 border-b border-gray-200">

            <h2 class="text-2xl font-bold text-white">
                Detail Properti
            </h2>

            <p class="mt-1 text-gray-100">
                Lengkapi informasi detail untuk properti Anda.
            </p>

        </div>


        <div class="p-8 space-y-8">

            {{-- Tipe Unit --}}

            <div>

                <label class="block mb-2 font-semibold">
                    Tipe Unit
                </label>

                <input
                    type="text"
                    name="type_unit"
                    value="{{ old('type_unit') }}"
                    placeholder="Contoh: Deluxe Room, Suite, Villa Eksklusif"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                >

                <p class="mt-2 text-sm text-gray-500">
                    Nama tipe spesifik unit ini.
                </p>

            </div>


            {{-- ==========================
                FASILITAS
            ========================== --}}

            <div>

                <h3 class="mb-4 text-lg font-bold">
                    Fasilitas
                </h3>

                @php
                    $defaultFacilities = [
                        'WiFi',
                        'AC',
                        'TV',
                        'Kolam Renang',
                        'Parkir',
                        'Dapur',
                        'Kamar Mandi',
                        'Air Panas',
                    ];

                    // Ambil dari database
                    $databaseFacilities = [];

                    if (isset($data)) {
                        $databaseFacilities = $data->items
                            ->where('type', 'FACILITY')
                            ->pluck('name')
                            ->toArray();
                    }

                    // old() hanya digunakan jika ada data hasil submit sebelumnya
                    $selectedFacilities = old(
                        'facility',
                        $databaseFacilities
                    );

                    // Custom facility = fasilitas yang tidak termasuk default
                    $customFacilities = collect($selectedFacilities)
                        ->filter(function ($item) use ($defaultFacilities) {
                            return !in_array($item, $defaultFacilities);
                        })
                        ->values();
                @endphp


                {{-- DEFAULT FACILITIES --}}
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                    @foreach($defaultFacilities as $item)

                        <label class="flex items-center gap-2 cursor-pointer">

                            <input
                                type="checkbox"
                                name="facility[]"
                                value="{{ $item }}"
                                {{ in_array($item, $selectedFacilities) ? 'checked' : '' }}
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            >

                            <span class="text-sm text-gray-700">
                                {{ $item }}
                            </span>

                        </label>

                    @endforeach

                </div>


                {{-- CUSTOM FACILITY --}}
                <div class="flex gap-3 mt-6">

                    <input
                        type="text"
                        id="custom-facility"
                        placeholder="Masukkan fasilitas baru"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                    >

                    <button
                        type="button"
                        id="add-facility"
                        class="px-6 text-white bg-blue-600 rounded-xl hover:bg-blue-700"
                    >
                        Tambah
                    </button>

                </div>


                {{-- CUSTOM FACILITY LIST --}}
                <div
                    id="custom-facility-list"
                    class="flex flex-wrap gap-2 mt-5"
                >

                    @foreach($customFacilities as $facility)

                        <div
                            class="flex items-center gap-2 px-3 py-2 text-sm text-blue-700 bg-blue-100 rounded-lg"
                            data-facility="{{ $facility }}"
                        >

                            <span>{{ $facility }}</span>

                            <button
                                type="button"
                                class="font-bold text-red-500 remove-facility"
                            >
                                ×
                            </button>

                            <input
                                type="hidden"
                                name="facility[]"
                                value="{{ $facility }}"
                            >

                        </div>

                    @endforeach

                </div>

            </div>


            <hr>


            {{-- ==========================
                INCLUDED
            ========================== --}}

            <div>

                <h3 class="mb-4 text-lg font-bold">
                    Harga Sudah Termasuk
                </h3>

                @php
                    $defaultIncluded = [
                        'Sarapan',
                        'Air Mineral',
                        'Handuk',
                        'Perlengkapan Mandi',
                    ];

                    // Ambil dari database
                    $databaseIncluded = $data->items
                        ->where('type', 'INCLUDE')
                        ->sortBy('sort')
                        ->pluck('name')
                        ->toArray();

                    // old() hanya digunakan setelah submit/validasi gagal
                    $selectedIncluded = old(
                        'included',
                        $databaseIncluded
                    );

                    // Ambil custom item yang bukan default
                    $customIncluded = collect($selectedIncluded)
                        ->filter(function ($item) use ($defaultIncluded) {
                            return !in_array($item, $defaultIncluded);
                        })
                        ->values();
                @endphp


                {{-- DEFAULT INCLUDED --}}
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                    @foreach($defaultIncluded as $item)

                        <label class="flex items-center gap-2 cursor-pointer">

                            <input
                                type="checkbox"
                                name="included[]"
                                value="{{ $item }}"
                                @checked(in_array($item, $selectedIncluded))
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            >

                            <span class="text-sm text-gray-700">
                                {{ $item }}
                            </span>

                        </label>

                    @endforeach

                </div>


                {{-- CUSTOM INCLUDED --}}
                <div class="flex gap-3 mt-6">

                    <input
                        type="text"
                        id="new-included"
                        placeholder="Masukkan item baru"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                    >

                    <button
                        type="button"
                        id="add-included"
                        class="px-6 text-white bg-blue-600 rounded-xl hover:bg-blue-700"
                    >
                        Tambah
                    </button>

                </div>


                {{-- CUSTOM LIST --}}
                <div
                    id="included-list"
                    class="flex flex-wrap gap-2 mt-5"
                >

                    @foreach($customIncluded as $item)

                        <div
                            class="flex items-center gap-2 px-3 py-2 text-sm text-blue-700 bg-blue-100 rounded-lg"
                            data-included="{{ $item }}"
                        >

                            <span>
                                {{ $item }}
                            </span>

                            <button
                                type="button"
                                class="font-bold text-red-500 remove-included"
                            >
                                ×
                            </button>

                            <input
                                type="hidden"
                                name="included[]"
                                value="{{ $item }}"
                            >

                        </div>

                    @endforeach

                </div>

            </div>


            <hr>


            {{-- ==========================
                EXCLUDED
            ========================== --}}

            <div>

                <h3 class="mb-4 text-lg font-bold">
                    Harga Belum Termasuk
                </h3>

                @php
                    $defaultExcluded = [
                        'Laundry',
                        'Transportasi',
                        'Extra Bed',
                        'BBQ',
                    ];

                    // Ambil data EXCLUDE dari database
                    $databaseExcluded = $data->items
                        ->where('type', 'EXCLUDE')
                        ->sortBy('sort')
                        ->pluck('name')
                        ->toArray();

                    // Jika ada old input, gunakan old.
                    // Jika tidak ada, gunakan data database.
                    $selectedExcluded = old(
                        'excluded',
                        $databaseExcluded
                    );

                    // Custom item
                    $customExcluded = collect($selectedExcluded)
                        ->filter(function ($item) use ($defaultExcluded) {
                            return !in_array($item, $defaultExcluded);
                        })
                        ->values();
                @endphp


                {{-- DEFAULT EXCLUDED --}}
                <div class="grid grid-cols-2 gap-4 md:grid-cols-4">

                    @foreach($defaultExcluded as $item)

                        <label class="flex items-center gap-2 cursor-pointer">

                            <input
                                type="checkbox"
                                name="excluded[]"
                                value="{{ $item }}"
                                @checked(in_array($item, $selectedExcluded))
                                class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                            >

                            <span class="text-sm text-gray-700">
                                {{ $item }}
                            </span>

                        </label>

                    @endforeach

                </div>


                {{-- CUSTOM EXCLUDED --}}
                <div class="flex gap-3 mt-6">

                    <input
                        type="text"
                        id="new-excluded"
                        placeholder="Masukkan item baru"
                        class="flex-1 px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                    >

                    <button
                        type="button"
                        id="add-excluded"
                        class="px-6 text-white bg-blue-600 rounded-xl hover:bg-blue-700"
                    >
                        Tambah
                    </button>

                </div>


                {{-- CUSTOM LIST --}}
                <div
                    id="excluded-list"
                    class="flex flex-wrap gap-2 mt-5"
                >

                    @foreach($customExcluded as $item)

                        <div
                            class="flex items-center gap-2 px-3 py-2 text-sm text-blue-700 bg-blue-100 rounded-lg"
                            data-excluded="{{ $item }}"
                        >

                            <span>
                                {{ $item }}
                            </span>

                            <button
                                type="button"
                                class="font-bold text-red-500 remove-excluded"
                            >
                                ×
                            </button>

                            <input
                                type="hidden"
                                name="excluded[]"
                                value="{{ $item }}"
                            >

                        </div>

                    @endforeach

                </div>

            </div>

        </div>


        {{-- ==========================
            FOOTER
        ========================== --}}

        <div class="flex flex-col-reverse gap-4 p-8 border-t border-gray-200 bg-gray-50 md:flex-row md:justify-between">

            <a
                href="{{ url('/admin/product') }}"
                class="px-10 py-3 font-semibold text-center border border-gray-300 rounded-xl hover:bg-gray-100"
            >
                Batal
            </a>

            <button
                type="submit"
                class="px-10 py-3 font-semibold text-white bg-blue-600 rounded-xl hover:opacity-90"
            >
                ✓ Simpan Properti
            </button>

        </div>

    </div>

</form>

</div>

{{-- ==========================
JAVASCRIPT
========================== --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | THUMBNAIL PREVIEW
    |--------------------------------------------------------------------------
    */

    const thumbnailInput = document.getElementById('thumbnail');
    const thumbnailPreview = document.getElementById('thumbnail-preview');
    const thumbnailImage = document.getElementById('thumbnail-image');
    const thumbnailName = document.getElementById('thumbnail-name');
    const removeThumbnail = document.getElementById('remove-thumbnail');

    thumbnailInput?.addEventListener('change', function () {

        const file = this.files?.[0];

        if (!file) {
            return;
        }

        thumbnailImage.src = URL.createObjectURL(file);
        thumbnailName.textContent = file.name;

        thumbnailPreview.classList.remove('hidden');

    });

    removeThumbnail?.addEventListener('click', function () {

        thumbnailInput.value = '';

        thumbnailImage.src = '';

        thumbnailName.textContent = '';

        thumbnailPreview.classList.add('hidden');

        document.getElementById('remove-thumbnail-input').value = '1';

    });

    /*
    |--------------------------------------------------------------------------
    | GALLERY PREVIEW
    |--------------------------------------------------------------------------
    */

    const imagesInput = document.getElementById('images');
    const imagesPreviewWrapper = document.getElementById('images-preview-wrapper');
    const imagesPreview = document.getElementById('images-preview');
    const imageCount = document.getElementById('image-count');
    const deletedImagesContainer = document.getElementById('deleted-images-container');

    let existingImagesCount = {{ $data->images->count() }};

    imagesInput?.addEventListener('change', function () {

        const files = Array.from(this.files || []);

        const totalImages = existingImagesCount + files.length;

        if (totalImages > 12) {

            alert('Maksimal 12 gambar gallery.');

            this.value = '';

            return;
        }

        // Hapus preview gambar baru sebelumnya
        document
            .querySelectorAll('.new-gallery-preview')
            .forEach(element => element.remove());

        if (totalImages === 0) {

            imagesPreviewWrapper.classList.add('hidden');

            imageCount.textContent = 0;

            return;
        }

        imagesPreviewWrapper.classList.remove('hidden');

        imageCount.textContent = totalImages;


        /*
        |--------------------------------------------------------------------------
        | PREVIEW GAMBAR BARU
        |--------------------------------------------------------------------------
        */

        files.forEach(function (file) {

            const wrapper = document.createElement('div');

            wrapper.className =
                'new-gallery-preview relative overflow-hidden rounded-xl border border-gray-200';


            const image = document.createElement('img');

            image.src = URL.createObjectURL(file);

            image.alt = file.name;

            image.className =
                'h-32 w-full object-cover';


            const removeButton = document.createElement('button');

            removeButton.type = 'button';

            removeButton.innerHTML = '×';

            removeButton.className =
                'absolute right-2 top-2 rounded-full bg-red-500 px-2 py-1 text-xs font-bold text-white hover:bg-red-600';


            removeButton.addEventListener('click', function () {

                wrapper.remove();

                // Tidak bisa menghapus individual file dari FileList
                // sehingga input perlu dibuat ulang jika ingin benar-benar
                // menghapus file tertentu.
            });


            const name = document.createElement('div');

            name.textContent = file.name;

            name.className =
                'truncate px-2 py-2 text-xs text-gray-500';


            wrapper.appendChild(image);

            wrapper.appendChild(removeButton);

            wrapper.appendChild(name);

            imagesPreview.appendChild(wrapper);

        });

    });

    /*
    |--------------------------------------------------------------------------
    | REMOVE EXISTING GALLERY IMAGE
    |--------------------------------------------------------------------------
    */

    document.querySelectorAll('.remove-existing-image').forEach(button => {

        button.addEventListener('click', function () {

            const imageId = this.dataset.id;

            const wrapper = this.closest('.existing-gallery-image');

            if (!wrapper) return;

            // Masukkan ID ke hidden input
            const input = document.createElement('input');

            input.type = 'hidden';

            input.name = 'delete_images[]';

            input.value = imageId;

            deletedImagesContainer.appendChild(input);

            // Hapus dari tampilan
            wrapper.remove();

            existingImagesCount--;

            imageCount.textContent =
                existingImagesCount + imagesInput.files.length;

            if (
                existingImagesCount === 0 &&
                imagesInput.files.length === 0
            ) {
                imagesPreviewWrapper.classList.add('hidden');
            }

        });

    });

    /*
    |--------------------------------------------------------------------------
    | CUSTOM ITEM
    |--------------------------------------------------------------------------
    */

    function addCustomItem(inputId, listId, fieldName) {

        const input = document.getElementById(inputId);
        const list = document.getElementById(listId);

        if (!input || !list) {
            return;
        }

        const value = input.value.trim();

        if (!value) {
            return;
        }


        /*
        | Cek apakah item sudah ada
        */

        const existingInputs = list.querySelectorAll(
            `input[name="${fieldName}[]"]`
        );

        const exists = Array.from(existingInputs).some(function (element) {

            return element.value.toLowerCase() === value.toLowerCase();

        });

        if (exists) {

            input.value = '';

            return;
        }


        /*
        | Wrapper
        */

        const wrapper = document.createElement('div');

        wrapper.className =
            'flex items-center gap-2 rounded-lg bg-blue-50 px-3 py-2 text-sm text-blue-700';


        /*
        | Text
        */

        const span = document.createElement('span');

        span.textContent = value;


        /*
        | Hidden input
        */

        const hiddenInput = document.createElement('input');

        hiddenInput.type = 'hidden';

        hiddenInput.name = `${fieldName}[]`;

        hiddenInput.value = value;


        /*
        | Delete button
        */

        const button = document.createElement('button');

        button.type = 'button';

        button.textContent = '×';

        button.className =
            'font-bold text-blue-500 hover:text-red-500';


        button.addEventListener('click', function () {

            wrapper.remove();

        });


        wrapper.appendChild(span);

        wrapper.appendChild(hiddenInput);

        wrapper.appendChild(button);

        list.appendChild(wrapper);


        input.value = '';

        input.focus();

    }


    /*
    |--------------------------------------------------------------------------
    | FACILITY
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('add-facility')
        ?.addEventListener('click', function () {

            addCustomItem(
                'custom-facility',
                'custom-facility-list',
                'facility'
            );

        });


    document
        .getElementById('custom-facility')
        ?.addEventListener('keydown', function (event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                addCustomItem(
                    'custom-facility',
                    'custom-facility-list',
                    'facility'
                );

            }

        });


    /*
    |--------------------------------------------------------------------------
    | INCLUDED
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('add-included')
        ?.addEventListener('click', function () {

            addCustomItem(
                'new-included',
                'included-list',
                'included'
            );

        });


    document
        .getElementById('new-included')
        ?.addEventListener('keydown', function (event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                addCustomItem(
                    'new-included',
                    'included-list',
                    'included'
                );

            }

        });


    /*
    |--------------------------------------------------------------------------
    | EXCLUDED
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('add-excluded')
        ?.addEventListener('click', function () {

            addCustomItem(
                'new-excluded',
                'excluded-list',
                'excluded'
            );

        });


    document
        .getElementById('new-excluded')
        ?.addEventListener('keydown', function (event) {

            if (event.key === 'Enter') {

                event.preventDefault();

                addCustomItem(
                    'new-excluded',
                    'excluded-list',
                    'excluded'
                );

            }

        });

});

</script>

@endsection