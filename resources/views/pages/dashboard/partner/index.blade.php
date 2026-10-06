@extends('layouts.admin')

@section('title', 'Kelola Partner - Villa Kita')

@section('content')

@php
$partnerData = $partners ?? [];

// Jika pagination dikirim dari controller
$currentPage = data_get($pagination ?? [], 'page', 1);
$totalPage = data_get($pagination ?? [], 'totalPage', 1);
$totalData = data_get($pagination ?? [], 'total', 0);


@endphp

<div class="p-6 bg-gray-100 rounded-3xl">

<div class="p-6 bg-gray-100 border-gray-200 rounded-3xl">

    {{-- ==========================
        HEADER
    ========================== --}}

    <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-900">
                Kelola Partner
            </h1>

            <p class="mt-1 text-gray-500">
                Kelola Pemilik Villa terdaftar di system
            </p>

        </div>


        <a
            href="{{ url('/dashboard/partner/create') }}"
            class="px-5 py-3 font-medium text-white transition bg-blue-600 rounded-xl hover:bg-blue-700"
        >
            + Tambah Partner
        </a>

    </div>


    {{-- ==========================
        SEARCH
    ========================== --}}

    <div class="mb-6">

        <form
            method="GET"
            action="{{ url('/dashboard/partner') }}"
        >

            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari nama partner..."
                class="w-full px-4 py-3 bg-white border border-gray-300 outline-none rounded-xl focus:border-blue-600"
            >

        </form>

    </div>


    {{-- ==========================
        PARTNER
    ========================== --}}

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 xl:grid-cols-4">

        @forelse($data as $partner)

            <div
                class="overflow-hidden transition bg-white border border-gray-200 shadow-sm rounded-2xl hover:-translate-y-1 hover:shadow-lg"
            >

                {{-- ==========================
                    IMAGE
                ========================== --}}

                <div class="relative flex items-center justify-center h-40 bg-gray-50">

                    {{-- STATUS --}}

                    @if(data_get($partner, 'status', false))

                        <span class="absolute px-3 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-md right-3 top-3">
                            Aktif
                        </span>

                    @else

                        <span class="absolute px-3 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-md right-3 top-3">
                            Tidak Aktif
                        </span>

                    @endif


                    {{-- IMAGE --}}

                    @php
                        $partnerImage = data_get($partner, 'image');

                        if ($partnerImage && !filter_var($partnerImage, FILTER_VALIDATE_URL)) {
                            $partnerImage = asset('storage/' . ltrim($partnerImage, '/'));
                        }

                        $partnerImage = $partnerImage
                            ?: 'https://placehold.co/120x120/png';
                    @endphp

                    <img
                        src="{{ $partnerImage }}"
                        alt="{{ data_get($partner, 'name', 'Partner') }}"
                        class="object-cover rounded-lg h-30 w-30"
                    >

                </div>


                {{-- ==========================
                    BODY
                ========================== --}}

                <div class="p-4">

                    <h3 class="text-lg font-semibold truncate">
                        {{ data_get($partner, 'name', '-') }}
                    </h3>


                    <div class="flex gap-2 mt-5">

                        {{-- ==========================
                            STATUS
                        ========================== --}}

                        <form
                            action="{{ url('/dashboard/partner/' . data_get($partner, 'id')) . '/toggle-status' }}"
                            method="POST"
                            class="flex-1"
                        >

                            @csrf
                            @method('PATCH')

                            @if(data_get($partner, 'status', false))

                                <button
                                    type="submit"
                                    class="w-full py-2 text-sm font-medium transition bg-gray-100 rounded-lg hover:bg-red-100"
                                >
                                    Nonaktifkan
                                </button>

                            @else

                                <button
                                    type="submit"
                                    class="w-full py-2 text-sm font-medium text-green-700 transition bg-green-100 rounded-lg hover:bg-green-200"
                                >
                                    Aktifkan
                                </button>

                            @endif

                        </form>


                        {{-- ==========================
                            EDIT
                        ========================== --}}

                        <a
                            href="{{ url('/dashboard/partner/' . data_get($partner, 'id') . '/edit') }}"
                            class="p-2 text-blue-600 transition bg-blue-100 rounded-lg hover:bg-blue-200"
                            title="Edit Partner"
                        >
                            <i class="fa-solid fa-pen text-[18px]"></i>
                        </a>


                        {{-- ==========================
                            DELETE
                        ========================== --}}

                        <form
                            action="{{ url('/dashboard/partner/' . data_get($partner, 'id')) }}"
                            method="POST"
                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus partner ini?')"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="p-2 text-red-600 transition bg-red-100 rounded-lg hover:bg-red-200"
                                title="Hapus Partner"
                            >
                                <i class="fa-solid fa-trash text-[18px]"></i>
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        @empty

            {{-- ==========================
                EMPTY
            ========================== --}}

            <div class="p-10 text-center bg-white shadow col-span-full rounded-2xl">

                <i class="mb-3 text-4xl text-gray-400 fa-regular fa-folder-open"></i>

                <p class="text-gray-500">
                    Data partner tidak ditemukan.
                </p>

            </div>

        @endforelse

    </div>


    {{-- ==========================
        PAGINATION
    ========================== --}}

    @if($totalPage > 1)

        <div class="flex items-center justify-between mt-8">

            <p class="text-sm text-gray-500">

                Halaman

                <span class="font-semibold text-gray-900">
                    {{ $currentPage }}
                </span>

                dari

                <span class="font-semibold text-gray-900">
                    {{ $totalPage }}
                </span>

            </p>


            <div class="flex gap-2">

                {{-- PREVIOUS --}}

                @if($currentPage > 1)

                    <a
                        href="{{ request()->fullUrlWithQuery(['page' => $currentPage - 1]) }}"
                        class="px-4 py-2 text-sm font-medium bg-white border border-gray-300 rounded-lg hover:bg-gray-100"
                    >
                        Sebelumnya
                    </a>

                @else

                    <button
                        type="button"
                        disabled
                        class="px-4 py-2 text-sm font-medium bg-white border border-gray-300 rounded-lg opacity-50 cursor-not-allowed"
                    >
                        Sebelumnya
                    </button>

                @endif


                {{-- NEXT --}}

                @if($currentPage < $totalPage)

                    <a
                        href="{{ request()->fullUrlWithQuery(['page' => $currentPage + 1]) }}"
                        class="px-4 py-2 text-sm font-medium bg-white border border-gray-300 rounded-lg hover:bg-gray-100"
                    >
                        Berikutnya
                    </a>

                @else

                    <button
                        type="button"
                        disabled
                        class="px-4 py-2 text-sm font-medium bg-white border border-gray-300 rounded-lg opacity-50 cursor-not-allowed"
                    >
                        Berikutnya
                    </button>

                @endif

            </div>

        </div>

    @endif

</div>

</div>

@endsection
