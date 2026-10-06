@extends('layouts.admin')

@section('title', 'Tambah Partner - Villa Kita')

@section('content')

<div class="p-6 bg-gray-100 rounded-3xl md:p-12">

{{-- HEADER --}}
<div class="mb-8">

    <a
        href="{{ url('/dashboard/partner') }}"
        class="flex items-center gap-2 mb-5 text-gray-500 transition hover:text-blue-600"
    >
        <i class="fa-solid fa-arrow-left text-[22px]"></i>
        <span>Kembali</span>
    </a>

    <h1 class="text-3xl font-bold text-gray-900">
        Tambah Partner Baru
    </h1>

    <p class="mt-2 text-gray-500">
        Tambahkan partner baru untuk ditampilkan pada homepage.
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
                Informasi Partner
            </h2>

            <p class="mt-1 text-blue-100">
                Lengkapi informasi partner di bawah ini.
            </p>

        </div>

    </div>

</div>


{{-- FORM --}}
<form
    action="{{ url('/dashboard/partner/store') }}"
    method="POST"
    enctype="multipart/form-data"
    class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-3xl"
>

    @csrf

    {{-- FORM HEADER --}}
    <div class="px-8 py-6 border-b border-gray-400">

        <div class="flex items-center gap-3">

            <div class="w-1 h-10 bg-blue-600 rounded-full"></div>

            <div>

                <h2 class="text-2xl font-bold">
                    Informasi Dasar
                </h2>

                <p class="text-gray-500">
                    Masukkan informasi partner.
                </p>

            </div>

        </div>

    </div>


    <div class="p-8 space-y-8">

        {{-- LOGO --}}
        <div>

            <label class="block mb-3 font-semibold">
                Logo Partner
            </label>

            <div class="flex flex-col gap-6 sm:flex-row">

                {{-- Preview --}}
                <div class="relative flex items-center justify-center w-32 h-32 overflow-hidden border-2 border-gray-300 border-dashed shrink-0 rounded-2xl bg-gray-50">

                    <img
                        id="preview-image"
                        src=""
                        alt="Preview logo partner"
                        class="hidden object-contain w-full h-full p-2"
                    >

                    <span
                        id="preview-placeholder"
                        class="text-sm text-gray-400"
                    >
                        Preview
                    </span>

                </div>


                {{-- Input --}}
                <div class="flex-1">

                    <input
                        type="file"
                        name="image"
                        id="image"
                        accept="image/jpeg,image/png,image/webp"
                        class="block w-full border border-gray-300 rounded-xl file:mr-4 file:rounded-xl file:border-0 file:bg-blue-100 file:px-5 file:py-3 file:font-semibold file:text-blue-700"
                        onchange="previewImage(event)"
                    >

                    <p class="mt-2 text-sm text-gray-500">
                        Format JPG, PNG, WEBP (Max 5MB)
                    </p>

                    @error('image')
                        <p class="mt-2 text-sm text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- NAME --}}
        <div>

            <label
                for="name"
                class="block mb-2 font-semibold"
            >
                Nama Partner
            </label>

            <input
                type="text"
                name="name"
                id="name"
                value="{{ old('name') }}"
                placeholder="Nama perusahaan / partner"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
            >

            @error('name')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- SORT --}}
        <div>

            <label
                for="sort"
                class="block mb-2 font-semibold"
            >
                Urutan Tampil
            </label>

            <input
                type="number"
                name="sort"
                id="sort"
                value="{{ old('sort', 0) }}"
                min="0"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
            >

            <p class="mt-2 text-sm text-gray-500">
                Semakin kecil angka, semakin awal ditampilkan.
            </p>

            @error('sort')
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
                    name="status"
                    value="1"
                    {{ old('status', true) ? 'checked' : '' }}
                    class="w-5 h-5 rounded"
                >

                <span class="font-medium">
                    Aktif (tampilkan di homepage)
                </span>

            </label>

        </div>

    </div>


    {{-- FOOTER --}}
    <div class="flex flex-col-reverse gap-4 px-8 py-6 border-t border-gray-400 bg-gray-50 sm:flex-row sm:justify-end">

        <a
            href="{{ url('/dashboard/partner') }}"
            class="px-8 py-3 font-semibold text-center border border-gray-300 rounded-xl hover:bg-gray-100"
        >
            Batal
        </a>

        <button
            type="submit"
            class="px-10 py-3 font-semibold text-white bg-blue-600 rounded-xl hover:opacity-90"
        >
            Simpan Partner
        </button>

    </div>

</form>

</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview-image');
        const placeholder = document.getElementById('preview-placeholder');

        if (!input.files || !input.files[0]) {
            preview.src = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            return;
        }

        const file = input.files[0];

        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 5MB.');
            input.value = '';
            preview.src = '';
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            return;
        }

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
    }
</script>

@endsection