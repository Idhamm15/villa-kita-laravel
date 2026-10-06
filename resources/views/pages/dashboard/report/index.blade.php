@extends('layouts.admin')

@section('title', 'Laporan Keuangan - Villa Kita')

@section('content')

<div class="p-10 bg-gray-100 rounded-3xl">

{{-- HEADER --}}
<div class="mb-8">

    <a
        href="{{ url()->previous() }}"
        class="flex items-center gap-2 mb-5 text-gray-500 hover:text-blue-600"
    >
        <i class="fa-solid fa-arrow-left text-[20px]"></i>
        <span>Kembali</span>
    </a>

    <h1 class="text-3xl font-bold">
        Laporan Keuangan
    </h1>

    <p class="mt-2 text-gray-500">
        Monitoring pemasukan dan pengeluaran seluruh properti.
    </p>

</div>


{{-- BANNER --}}
<div class="mt-8 overflow-hidden bg-blue-600 rounded-3xl">

    <div class="flex items-center gap-5 px-8 py-8">

        <div class="flex items-center justify-center h-14 w-14 rounded-2xl bg-white/20">
            <i class="fa-solid fa-wallet text-[30px] text-white"></i>
        </div>

        <div>

            <h2 class="text-3xl font-bold text-white">
                Ringkasan Keuangan
            </h2>

            <p class="mt-1 text-blue-100">
                Statistik pendapatan dan pengeluaran properti.
            </p>

        </div>

    </div>

</div>


{{-- FILTER --}}
<form
    method="GET"
    action="{{ url('/dashboard/finance') }}"
    class="p-8 mt-8 bg-white border border-gray-200 shadow-sm rounded-3xl"
>

    <h2 class="mb-6 text-2xl font-bold">
        Filter Laporan
    </h2>

    <div class="grid gap-5 lg:grid-cols-5">

        {{-- PERIODE --}}
        <div>

            <label
                for="periode"
                class="block mb-2 font-semibold"
            >
                Periode
            </label>

            <input
                type="month"
                name="periode"
                id="periode"
                value="{{ request('periode') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl"
            >

        </div>


        {{-- PROPERTI --}}
        <div>

            <label
                for="property"
                class="block mb-2 font-semibold"
            >
                Properti
            </label>

            <select
                name="property"
                id="property"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl"
            >

                <option value="">
                    Semua Properti
                </option>

                @foreach(($products ?? []) as $product)

                    @php
                        $productId = data_get($product, 'id');
                        $productName = data_get($product, 'name', '-');
                    @endphp

                    <option
                        value="{{ $productId }}"
                        {{ request('property') == $productId ? 'selected' : '' }}
                    >
                        {{ $productName }}
                    </option>

                @endforeach

            </select>

        </div>


        {{-- KATEGORI --}}
        <div>

            <label
                for="category"
                class="block mb-2 font-semibold"
            >
                Kategori
            </label>

            <select
                name="category"
                id="category"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl"
            >

                <option value="">
                    Semua
                </option>

                <option
                    value="Pendapatan"
                    {{ request('category') === 'Pendapatan' ? 'selected' : '' }}
                >
                    Pendapatan
                </option>

                <option
                    value="Pengeluaran"
                    {{ request('category') === 'Pengeluaran' ? 'selected' : '' }}
                >
                    Pengeluaran
                </option>

            </select>

        </div>


        {{-- STATUS --}}
        <div>

            <label
                for="status"
                class="block mb-2 font-semibold"
            >
                Status
            </label>

            <select
                name="status"
                id="status"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl"
            >

                <option value="">
                    Semua
                </option>

                <option
                    value="PAID"
                    {{ request('status') === 'PAID' ? 'selected' : '' }}
                >
                    Lunas
                </option>

                <option
                    value="PENDING"
                    {{ request('status') === 'PENDING' ? 'selected' : '' }}
                >
                    Pending
                </option>

            </select>

        </div>


        {{-- SEARCH --}}
        <div>

            <label
                for="search"
                class="block mb-2 font-semibold"
            >
                Cari
            </label>

            <div class="relative">

                <i class="absolute text-gray-400 -translate-y-1/2 fa-solid fa-magnifying-glass left-4 top-1/2"></i>

                <input
                    type="text"
                    name="search"
                    id="search"
                    value="{{ request('search') }}"
                    placeholder="Cari..."
                    class="w-full py-3 pr-4 border border-gray-300 rounded-xl pl-11"
                >

            </div>

        </div>

    </div>


    {{-- BUTTON --}}
    <div class="flex justify-end gap-5 mt-6">

        <a
            href="{{ url('/dashboard/finance/export?' . http_build_query(request()->query())) }}"
            class="flex items-center gap-2 px-6 py-3 font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700"
        >
            <i class="fa-solid fa-download"></i>
            Export Excel
        </a>

        <button
            type="submit"
            class="flex items-center gap-2 px-6 py-3 font-semibold text-white bg-blue-600 rounded-xl hover:bg-blue-700"
        >
            <i class="fa-solid fa-magnifying-glass"></i>
            Filter
        </button>

    </div>

</form>


{{-- TABLE --}}
<div class="mt-8 overflow-hidden bg-white border border-gray-200 shadow-sm rounded-3xl">

    <div class="px-8 py-6 border-b border-gray-200">

        <h2 class="text-2xl font-bold">
            Riwayat Transaksi
        </h2>

    </div>


    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-gray-50">

                <tr class="text-left">

                    <th class="px-6 py-4">
                        Tanggal
                    </th>

                    <th class="px-6 py-4">
                        Invoice
                    </th>

                    <th class="px-6 py-4">
                        Properti
                    </th>

                    <th class="px-6 py-4">
                        Kategori
                    </th>

                    <th class="px-6 py-4">
                        Deskripsi
                    </th>

                    <th class="px-6 py-4 text-right">
                        Nominal
                    </th>

                    <th class="px-6 py-4">
                        Status
                    </th>

                </tr>

            </thead>


            <tbody>

                @forelse(($reports ?? []) as $item)

                    @php
                        $status = data_get($item, 'status', '-');

                        $categories = data_get($item, 'kategori', []);

                        if (is_array($categories)) {
                            $categories = implode(', ', $categories);
                        }

                        $nominal = data_get($item, 'nominal', 0);
                        $tanggal = data_get($item, 'tanggal');
                    @endphp

                    <tr class="border-t hover:bg-gray-50">

                        {{-- TANGGAL --}}
                        <td class="px-6 py-5">

                            @if($tanggal)

                                {{ \Carbon\Carbon::parse($tanggal)->locale('id')->translatedFormat('d M Y') }}

                            @else

                                -

                            @endif

                        </td>


                        {{-- INVOICE --}}
                        <td class="px-6 py-5 font-medium">
                            {{ data_get($item, 'invoice', '-') }}
                        </td>


                        {{-- PROPERTI --}}
                        <td class="px-6 py-5">
                            {{ data_get($item, 'properti', '-') }}
                        </td>


                        {{-- KATEGORI --}}
                        <td class="px-6 py-5">
                            {{ $categories ?: '-' }}
                        </td>


                        {{-- DESKRIPSI --}}
                        <td class="px-6 py-5">
                            {{ data_get($item, 'deskripsi', '-') }}
                        </td>


                        {{-- NOMINAL --}}
                        <td class="px-6 py-5 font-semibold text-right">
                            Rp {{ number_format((float) $nominal, 0, ',', '.') }}
                        </td>


                        {{-- STATUS --}}
                        <td class="px-6 py-5">

                            @if($status === 'PAID')

                                <span class="px-3 py-1 text-sm font-semibold text-green-700 bg-green-100 rounded-full">
                                    Lunas
                                </span>

                            @else

                                <span class="px-3 py-1 text-sm font-semibold text-yellow-700 bg-yellow-100 rounded-full">
                                    {{ $status }}
                                </span>

                            @endif

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7"
                            class="px-6 py-12 text-center text-gray-500"
                        >
                            Belum ada data laporan.
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

</div>

@endsection
