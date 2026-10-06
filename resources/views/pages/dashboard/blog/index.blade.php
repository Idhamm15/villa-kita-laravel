@extends('layouts.admin')

@section('title', 'Kelola Properti - Villa Kita')

@section('content')

<div class="p-6 bg-gray-100 rounded-3xl">

<div class="p-6 bg-gray-100 border border-gray-200 rounded-3xl">

    {{-- Header --}}
    <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Kelola Blog
            </h1>

            <p class="mt-1 text-gray-500">
                Kelola Kategori Properti
            </p>
        </div>

        <a
            href="{{ url('/dashboard/blog/create') }}"
            class="px-5 py-3 font-medium text-white transition bg-blue-600 hover:bg-blue-700 rounded-xl"
        >
            + Tambah Blog
        </a>

    </div>


    {{-- Search --}}
    <div class="mb-6">

        <form method="GET" action="{{ url('/dashboard/blog') }}">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Properti..."
                class="w-full px-4 py-3 border border-gray-200 md:w-96 rounded-xl bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"
            >

        </form>

    </div>


    {{-- Table --}}
    <div class="py-5 overflow-x-auto bg-white px-7 rounded-2xl">

        @if(count($data ?? []) > 0)

            <table class="w-full">

                <thead>
                    <tr class="border-b border-gray-200">

                        <th class="py-4 text-left text-gray-600">
                            Judul
                        </th>

                        <th class="py-4 text-left text-gray-600">
                            Content
                        </th>

                        <th class="py-4 text-left text-gray-600">
                            Status
                        </th>

                        <th class="py-4 text-left text-gray-600">
                            Terakhir Update
                        </th>

                        <th class="py-4 text-center text-gray-600">
                            Aksi
                        </th>

                    </tr>
                </thead>


                <tbody>

                    @foreach($data as $blog)

                        <tr class="border-b border-gray-100">

                            {{-- Judul --}}
                            <td class="py-4 font-medium text-gray-900">
                                {{ $blog['title'] ?? $blog->name ?? '-' }}
                            </td>


                            {{-- Content --}}
                            <td class="py-4 font-medium text-gray-900">
                                <a
                                    href="{{ url('/dashboard/blog/' . ($blog['id'] ?? $blog->id) . '/edit') }}"
                                    class="text-blue-600 transition hover:text-blue-800 hover:underline"
                                >
                                    Lihat Isi
                                </a>
                            </td>


                            {{-- Status --}}
                            <td class="py-4">
                                @if ($blog->is_published)
                                    <span class="px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full">
                                        Published
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-sm font-medium text-gray-700 bg-gray-100 rounded-full">
                                        Draft
                                    </span>
                                @endif
                            </td>


                            {{-- Terakhir Update --}}
                            <td class="py-4 font-medium text-gray-900">
                                {{ $blog['updated_at'] ?? $blog->updated_at ?? '-' }}
                            </td>


                            {{-- Action --}}
                            <td class="py-4">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- Edit --}}
                                    <a
                                        href="{{ url('/dashboard/blog/' . ($blog['id'] ?? $blog->id) . '/edit') }}"
                                        class="p-2 text-blue-600 transition bg-blue-100 rounded-lg hover:bg-blue-200"
                                        title="Edit Product"
                                    >
                                        <i class="fa-solid fa-pen text-[18px]"></i>
                                    </a>


                                    {{-- Delete --}}
                                    {{-- <form
                                        action="{{ url('/dashboard/blog/' . ($blog['id'] ?? $blog->id)) }}"
                                        method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="p-2 text-red-600 transition bg-red-100 rounded-lg hover:bg-red-200"
                                            title="Hapus Product"
                                        >
                                            <i class="fa-solid fa-trash text-[18px]"></i>
                                        </button>

                                    </form> --}}
{{-- 
                                        <x-button.detail 
                                            href="{{ route('masjid.pengaturan.master.category_donasi.show', $item->id) }}"
                                        >
                                            Detail
                                        </x-button.detail>                                        
                                        <x-button.edit 
                                            href="{{ route('masjid.pengaturan.master.category_donasi.edit', $item->id) }}"
                                        >
                                            Edit
                                        </x-button.edit>                                         --}}
                                        <x-button.delete
                                            :action="route('dashboard.blog.delete', $blog['id'] ?? $blog->id)"
                                        />

                                </div>

                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

        @else

            {{-- Empty State --}}
            <div class="flex flex-col items-center justify-center h-64 text-gray-400">

                <i class="fa-regular fa-folder-open text-[60px]"></i>

                <p class="mt-4 text-gray-500">
                    Tidak ada data
                </p>

            </div>

        @endif


        {{-- Pagination --}}
        @if(!empty($pagination) && ($pagination['totalPages'] ?? 0) > 0)

            <div class="flex flex-col items-center justify-between gap-4 mt-6 md:flex-row">

                <div class="text-sm text-gray-500">

                    Menampilkan halaman

                    <b>
                        {{ $pagination['page'] ?? 1 }}
                    </b>

                    dari

                    <b>
                        {{ $pagination['totalPages'] ?? 1 }}
                    </b>

                    <span class="ml-2">
                        ({{ $pagination['total'] ?? 0 }} data)
                    </span>

                </div>


                <div class="flex items-center gap-2">

                    {{-- Sebelumnya --}}
                    @php
                        $currentPage = $pagination['page'] ?? 1;
                        $totalPages = $pagination['totalPages'] ?? 1;
                    @endphp

                    @if($currentPage > 1)

                        <a
                            href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}"
                            class="px-4 py-2 border rounded-lg hover:bg-gray-100"
                        >
                            Sebelumnya
                        </a>

                    @else

                        <button
                            disabled
                            class="px-4 py-2 border rounded-lg opacity-50 cursor-not-allowed"
                        >
                            Sebelumnya
                        </button>

                    @endif


                    {{-- Nomor halaman --}}
                    @for($i = 1; $i <= $totalPages; $i++)

                        @if($i == $currentPage)

                            <span
                                class="px-4 py-2 text-white bg-blue-600 rounded-lg"
                            >
                                {{ $i }}
                            </span>

                        @else

                            <a
                                href="{{ request()->fullUrlWithQuery(['page' => $i]) }}"
                                class="px-4 py-2 border rounded-lg hover:bg-gray-100"
                            >
                                {{ $i }}
                            </a>

                        @endif

                    @endfor


                    {{-- Berikutnya --}}
                    @if($currentPage < $totalPages)

                        <a
                            href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}"
                            class="px-4 py-2 border rounded-lg hover:bg-gray-100"
                        >
                            Berikutnya
                        </a>

                    @else

                        <button
                            disabled
                            class="px-4 py-2 border rounded-lg opacity-50 cursor-not-allowed"
                        >
                            Berikutnya
                        </button>

                    @endif

                </div>

            </div>

        @endif

    </div>

</div>

</div>

@endsection
