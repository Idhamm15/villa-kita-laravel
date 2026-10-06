@extends('layouts.admin')

@section('title', 'Kelola Properti - Villa Kita')

@section('content')

<div class="p-6 bg-gray-100 rounded-3xl">

<div class="p-6 bg-gray-100 border border-gray-200 rounded-3xl">

    {{-- Header --}}
    <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

        <div>
            <h1 class="text-3xl font-bold text-gray-900">
                Kelola Voucher
            </h1>

            <p class="mt-1 text-gray-500">
                Kelola Voucher
            </p>
        </div>

        <a
            href="{{ url('/dashboard/voucher/create') }}"
            class="px-5 py-3 font-medium text-white transition bg-blue-600 hover:bg-blue-700 rounded-xl"
        >
            + Tambah Voucher
        </a>

    </div>


    {{-- Search --}}
    <div class="mb-6">

        <form method="GET" action="{{ url('/admin/product') }}">

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Voucher..."
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
                            Kode
                        </th>

                        <th class="py-4 text-left text-gray-600">
                            Deskripsi
                        </th>

                        <th class="py-4 text-left text-gray-600">
                            Diskon
                        </th>

                        <th class="py-4 text-left text-gray-600">
                            Min Pembelian
                        </th>

                        <th class="py-4 text-left text-gray-600">
                            Berlaku
                        </th>
                        
                        <th class="py-4 text-left text-gray-600">
                            Status
                        </th>

                        <th class="py-4 text-center text-gray-600">
                            Aksi
                        </th>

                    </tr>
                </thead>


                <tbody>

                    @foreach($data as $voucher)

                        <tr class="border-b border-gray-100">
         {{-- 'code',
        'description',
        'discount',     
        'min_purchase',
        'date_expired',
        'status', --}}
                            {{-- Kode --}}
                            <td class="py-4 font-medium text-gray-900">
                                {{ $voucher['code'] ?? $voucher->code ?? '-' }}
                            </td>


                            {{-- Deskripsi --}}
                            <td class="py-4 font-medium text-gray-900">
                                {{ $voucher['description'] ?? $voucher->description ?? '-' }}
                            </td>


                            {{-- Diskon --}}
                            <td class="py-4 font-medium text-gray-900">
                                Rp {{ number_format($voucher['discount'] ?? $voucher->discount ?? 0, 0, ',', '.') }}
                            </td>

                            {{-- Min Pembelian --}}
                            <td class="py-4 font-medium text-gray-900">
                                Rp {{ number_format($voucher['min_purchase'] ?? $voucher->min_purchase ?? 0, 0, ',', '.') }}
                            </td>
                            
                            {{-- Berlaku --}}
                            <td class="py-4 font-medium text-gray-900">
                                {{ $voucher['date_expired'] ?? $voucher->date_expired ?? '-' }}
                            </td>
                            
                            {{-- Status --}}
                            <td class="py-4">
                                @if ($voucher['status'] ?? $voucher->status)
                                    <span class="px-3 py-1 text-sm font-medium text-green-700 bg-green-100 rounded-full">
                                        Aktif
                                    </span>
                                @else
                                    <span class="px-3 py-1 text-sm font-medium text-red-700 bg-red-100 rounded-full">
                                        Tidak Aktif
                                    </span>
                                @endif
                            </td>


                            {{-- Action --}}
                            <td class="py-4">

                                <div class="flex items-center justify-center gap-2">

                                    {{-- Edit --}}
                                    <a
                                        href="{{ url('/dashboard/voucher/' . ($voucher['id'] ?? $voucher->id) . '/edit') }}"
                                        class="p-2 text-blue-600 transition bg-blue-100 rounded-lg hover:bg-blue-200"
                                        title="Edit data"
                                    >
                                        <i class="fa-solid fa-pen text-[18px]"></i>
                                    </a>


                                    {{-- Delete --}}
                                    <form
                                        action="{{ url('/dashboard/voucher/' . ($voucher['id'] ?? $voucher->id)) }}"
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

                                    </form>

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
