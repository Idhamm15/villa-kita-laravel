@extends('layouts.admin')

@section('title', 'Tambah Blog - Villa Kita')

@section('content')

@php
$categories = [
    'Tips',
    'Informasi',
    'Edukasi',
    'Liburan',
    'Penginapan',
];

$mediaImages = $images ?? [];

@endphp

<div class="p-12 bg-gray-100 rounded-3xl">

{{-- ==========================
    HEADER
========================== --}}

<div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

    <div>

        <button
            type="button"
            onclick="history.back()"
            class="flex items-center gap-2 mb-5 text-gray-500 hover:text-blue-600"
        >
            <i class="fa-solid fa-arrow-left text-[22px]"></i>
            <span>Kembali</span>
        </button>

        <h1 class="text-3xl font-bold text-gray-900">
            Tambah Blog
        </h1>

        <p class="mt-1 text-gray-500">
            Buat blog baru untuk website
        </p>

    </div>

</div>


{{-- ==========================
    VALIDATION ERROR
========================== --}}

@if ($errors->any())

    <div class="p-5 mb-6 text-red-700 border border-red-200 rounded-2xl bg-red-50">

        <p class="mb-2 font-semibold">
            Terdapat kesalahan:
        </p>

        <ul class="pl-5 space-y-1 text-sm list-disc">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif


{{-- ==========================
    FORM
========================== --}}

<form
    id="blogForm"
    action="{{ url('/dashboard/blog/store') }}"
    method="POST"
    enctype="multipart/form-data"
>

    @csrf

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-4">

        {{-- ==========================
            EDITOR
        ========================== --}}

        <div class="xl:col-span-3">

            <div class="p-8 bg-white border border-gray-200 rounded-3xl">

                {{-- TITLE --}}

                <input
                    type="text"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="Tambahkan Judul"
                    class="w-full mb-8 text-5xl font-bold text-gray-900 bg-transparent border-none outline-none"
                    required
                />


                {{-- ==========================
                    EDITOR TOOLBAR
                ========================== --}}

                <div class="sticky top-0 z-10 pb-4 mb-4 bg-white border-b border-gray-200">

                    <div class="flex flex-wrap gap-2">

                        {{-- BOLD --}}

                        <button
                            type="button"
                            onclick="applyFormat('bold')"
                            class="px-3 py-2 font-bold bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            B
                        </button>


                        {{-- ITALIC --}}

                        <button
                            type="button"
                            onclick="applyFormat('italic')"
                            class="px-3 py-2 italic bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            I
                        </button>


                        {{-- UNDERLINE --}}

                        <button
                            type="button"
                            onclick="applyFormat('underline')"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            U
                        </button>


                        {{-- H1 --}}

                        <button
                            type="button"
                            onclick="applyFormat('formatBlock', 'H1')"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            H1
                        </button>


                        {{-- H2 --}}

                        <button
                            type="button"
                            onclick="applyFormat('formatBlock', 'H2')"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            H2
                        </button>


                        {{-- UNORDERED LIST --}}

                        <button
                            type="button"
                            onclick="applyFormat('insertUnorderedList')"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            • List
                        </button>


                        {{-- ORDERED LIST --}}

                        <button
                            type="button"
                            onclick="applyFormat('insertOrderedList')"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            1. List
                        </button>


                        {{-- LINK --}}

                        <button
                            type="button"
                            onclick="insertLink()"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            Link
                        </button>


                        {{-- IMAGE --}}

                        <button
                            type="button"
                            onclick="openMediaModal()"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            Image
                        </button>


                        {{-- ALIGN LEFT --}}

                        <button
                            type="button"
                            onclick="applyFormat('justifyLeft')"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            ⬅
                        </button>


                        {{-- ALIGN CENTER --}}

                        <button
                            type="button"
                            onclick="applyFormat('justifyCenter')"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            ⬌
                        </button>


                        {{-- ALIGN RIGHT --}}

                        <button
                            type="button"
                            onclick="applyFormat('justifyRight')"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            ➡
                        </button>


                        {{-- JUSTIFY --}}

                        <button
                            type="button"
                            onclick="applyFormat('justifyFull')"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            ☰
                        </button>


                        <div class="w-px h-8 mx-1 bg-gray-300"></div>


                        {{-- TEXT COLOR --}}

                        <div class="flex items-center gap-2 px-2 py-1 border rounded-lg bg-gray-50">

                            <span class="text-sm text-gray-500">
                                Text
                            </span>

                            @php
                                $textColors = [
                                    '#000000',
                                    '#EF4444',
                                    '#F97316',
                                    '#EAB308',
                                    '#22C55E',
                                    '#3B82F6',
                                    '#8B5CF6',
                                    '#EC4899',
                                ];
                            @endphp

                            @foreach ($textColors as $color)

                                <button
                                    type="button"
                                    title="{{ $color }}"
                                    onclick="applyFormat('foreColor', '{{ $color }}')"
                                    class="w-6 h-6 transition border border-gray-300 rounded-full hover:scale-110"
                                    style="background-color: {{ $color }}"
                                ></button>

                            @endforeach

                        </div>


                        {{-- HIGHLIGHT --}}

                        <button
                            type="button"
                            onclick="changeBackgroundColor()"
                            class="px-3 py-2 bg-gray-100 rounded-lg hover:bg-gray-200"
                        >
                            🖍 Highlight
                        </button>

                    </div>

                </div>


                {{-- ==========================
                    EDITOR AREA
                ========================== --}}

                <div
                    id="editor"
                    contenteditable="true"
                    class="min-h-[700px] rounded-2xl bg-white p-8 text-lg leading-8 text-gray-700 outline-none"
                >{!! old('content') !!}</div>

                {{-- Hidden content yang akan dikirim ke Laravel --}}

                <textarea
                    name="content"
                    id="content"
                    class="hidden"
                >{{ old('content') }}</textarea>

            </div>

        </div>


        {{-- ==========================
            SIDEBAR
        ========================== --}}

        <div class="space-y-6">

            {{-- ==========================
                PUBLISH
            ========================== --}}

            <div class="p-6 bg-white border border-gray-200 rounded-3xl">

                <h3 class="mb-4 font-semibold text-gray-900">
                    Publish
                </h3>

                <button
                    type="submit"
                    name="is_published"
                    value="1"
                    onclick="document.getElementById('isPublished').value = '1'"
                    class="w-full py-3 mb-3 font-medium text-white transition bg-blue-600 rounded-xl hover:bg-blue-700"
                >
                    Publish Artikel
                </button>

                <button
                    type="submit"
                    name="is_published"
                    value="0"
                    onclick="document.getElementById('isPublished').value = '0'"
                    class="w-full py-3 font-medium text-gray-700 transition bg-gray-100 rounded-xl hover:bg-gray-200"
                >
                    Simpan Draft
                </button>

                <input
                    type="hidden"
                    name="is_published"
                    id="isPublished"
                    value="{{ old('isPublished', 0) }}"
                >

            </div>


            {{-- ==========================
                THUMBNAIL
            ========================== --}}

            <div class="p-6 bg-white border border-gray-200 rounded-3xl">

                <h3 class="mb-4 font-semibold text-gray-900">
                    Thumbnail
                </h3>

                <div class="space-y-4">

                    {{-- Preview --}}

                    <div
                        id="thumbnailPreview"
                        class="hidden overflow-hidden rounded-2xl"
                    >
                        <img
                            id="thumbnailImage"
                            src=""
                            alt="Thumbnail preview"
                            class="object-cover w-full h-48"
                        >
                    </div>


                    {{-- Empty Preview --}}

                    <div
                        id="thumbnailEmpty"
                        class="flex items-center justify-center h-48 text-gray-500 border-2 border-gray-300 border-dashed rounded-2xl"
                    >
                        Belum ada thumbnail
                    </div>


                    {{-- File Input --}}

                    <input
                        type="file"
                        name="thumbnail"
                        id="thumbnail"
                        accept="image/jpeg,image/png,image/webp"
                        class="block w-full border border-gray-300 rounded-xl file:mr-4 file:rounded-xl file:border-0 file:bg-blue-100 file:px-5 file:py-3 file:font-semibold file:text-blue-700"
                    />

                    <p class="text-sm text-gray-500">
                        JPG, PNG, WEBP. Maksimal 2MB.
                    </p>

                </div>

            </div>


            {{-- ==========================
                CATEGORY
            ========================== --}}

            <div class="p-6 bg-white border border-gray-200 rounded-3xl">

                <h3 class="mb-4 font-semibold text-gray-900">
                    Kategori
                </h3>

                <select
                    name="category"
                    class="w-full p-3 border border-gray-200 outline-none rounded-xl focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                    required
                >

                    <option value="">
                        Pilih Kategori
                    </option>

                    @foreach ($categories as $category)

                        <option
                            value="{{ $category }}"
                            @selected(old('category') === $category)
                        >
                            {{ $category }}
                        </option>

                    @endforeach

                </select>

            </div>

        </div>

    </div>

</form>
```

</div>

{{-- ==========================
MEDIA LIBRARY MODAL
========================== --}}

<div
    id="mediaModal"
    class="fixed inset-0 z-50 items-center justify-center hidden bg-black/50"
>

```
<div class="w-full max-w-5xl p-6 bg-white rounded-3xl">

    {{-- HEADER --}}

    <div class="flex items-center justify-between mb-6">

        <h2 class="text-xl font-bold">
            Media Library
        </h2>

        <button
            type="button"
            onclick="closeMediaModal()"
            class="text-xl text-gray-500 hover:text-gray-900"
        >
            ✕
        </button>

    </div>


    {{-- UPLOAD --}}

    <div
        class="p-10 mb-6 text-center border-2 border-gray-300 border-dashed rounded-2xl"
    >

        <i class="mb-3 text-4xl text-gray-400 fa-solid fa-cloud-arrow-up"></i>

        <p class="font-medium text-gray-700">
            Drag & Drop Image
        </p>

        <p class="mt-1 text-sm text-gray-500">
            Pilih gambar dari Media Library
        </p>

    </div>


    {{-- GALLERY --}}

    <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-6">

        @forelse ($mediaImages as $image)

            @php
                $imageUrl = data_get($image, 'url')
                    ?: data_get($image, 'image')
                    ?: data_get($image, 'path');

                $imageTitle = data_get($image, 'title')
                    ?: data_get($image, 'name')
                    ?: 'Image';
            @endphp

            @if ($imageUrl)

                <div
                    onclick="selectMediaImage('{{ $imageUrl }}')"
                    data-media-url="{{ $imageUrl }}"
                    class="overflow-hidden border-2 border-gray-200 cursor-pointer media-item rounded-xl"
                >

                    <img
                        src="{{ $imageUrl }}"
                        alt="{{ $imageTitle }}"
                        class="object-cover w-full h-24"
                    >

                </div>

            @endif

        @empty

            <div class="py-10 text-center text-gray-500 col-span-full">

                <i class="mb-3 text-4xl fa-regular fa-images"></i>

                <p>
                    Belum ada gambar di Media Library.
                </p>

            </div>

        @endforelse

    </div>


    {{-- FOOTER --}}

    <div class="flex justify-end gap-3 mt-6">

        <button
            type="button"
            onclick="closeMediaModal()"
            class="px-5 py-2 bg-gray-100 rounded-xl hover:bg-gray-200"
        >
            Batal
        </button>

        <button
            type="button"
            onclick="handleInsertImage()"
            class="px-5 py-2 text-white bg-blue-600 rounded-xl hover:bg-blue-700"
        >
            Insert Image
        </button>

    </div>

</div>
```

</div>

{{-- ==========================
JAVASCRIPT
========================== --}}

<script>

    let selectedImage = null;

    /*
    |--------------------------------------------------------------------------
    | Editor
    |--------------------------------------------------------------------------
    */

    function applyFormat(command, value = null) {

        document.execCommand(
            command,
            false,
            value
        );

        document.getElementById('editor').focus();

        syncEditorContent();
    }


    function insertLink() {

        const url = prompt('Masukkan URL:');

        if (!url) {
            return;
        }

        document.execCommand(
            'createLink',
            false,
            url
        );

        document.getElementById('editor').focus();

        syncEditorContent();
    }


    function changeBackgroundColor() {

        const color = prompt(
            'Masukkan warna highlight, contoh: yellow atau #FFFF00',
            'yellow'
        );

        if (!color) {
            return;
        }

        document.execCommand(
            'hiliteColor',
            false,
            color
        );

        document.getElementById('editor').focus();

        syncEditorContent();
    }


    function syncEditorContent() {

        const editor = document.getElementById('editor');

        const content = document.getElementById('content');

        content.value = editor.innerHTML;
    }


    /*
    |--------------------------------------------------------------------------
    | Thumbnail Preview
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('thumbnail')
        .addEventListener('change', function (event) {

            const file = event.target.files[0];

            const preview = document.getElementById('thumbnailPreview');

            const image = document.getElementById('thumbnailImage');

            const empty = document.getElementById('thumbnailEmpty');

            if (!file) {

                preview.classList.add('hidden');

                empty.classList.remove('hidden');

                image.src = '';

                return;
            }

            const url = URL.createObjectURL(file);

            image.src = url;

            preview.classList.remove('hidden');

            empty.classList.add('hidden');

        });


    /*
    |--------------------------------------------------------------------------
    | Media Modal
    |--------------------------------------------------------------------------
    */

    function openMediaModal() {

        const modal = document.getElementById('mediaModal');

        modal.classList.remove('hidden');

        modal.classList.add('flex');

    }


    function closeMediaModal() {

        const modal = document.getElementById('mediaModal');

        modal.classList.add('hidden');

        modal.classList.remove('flex');

    }


    /*
    |--------------------------------------------------------------------------
    | Select Media
    |--------------------------------------------------------------------------
    */

    function selectMediaImage(url) {

        selectedImage = url;

        document
            .querySelectorAll('.media-item')
            .forEach(function (item) {

                item.classList.remove(
                    'border-blue-500'
                );

                item.classList.add(
                    'border-gray-200'
                );

            });


        const selected = document.querySelector(
            `[data-media-url="${CSS.escape(url)}"]`
        );

        if (selected) {

            selected.classList.remove(
                'border-gray-200'
            );

            selected.classList.add(
                'border-blue-500'
            );

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Insert Image To Editor
    |--------------------------------------------------------------------------
    */

    function handleInsertImage() {

        if (!selectedImage) {

            alert('Silakan pilih gambar terlebih dahulu.');

            return;

        }

        const editor = document.getElementById('editor');

        editor.focus();

        document.execCommand(
            'insertImage',
            false,
            selectedImage
        );

        syncEditorContent();

        closeMediaModal();

    }


    /*
    |--------------------------------------------------------------------------
    | Sync Editor Before Submit
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('blogForm')
        .addEventListener('submit', function () {

            syncEditorContent();

        });


    /*
    |--------------------------------------------------------------------------
    | Keyboard Shortcut
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('editor')
        .addEventListener('input', function () {

            syncEditorContent();

        });

</script>

@endsection