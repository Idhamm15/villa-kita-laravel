@extends('layouts.admin')

@section('title', 'Kelola Booking - Villa Kita')

@section('content')

<div class="p-6 bg-gray-100 rounded-3xl">

<div class="p-6 bg-gray-100 rounded-3xl">

    {{-- ==========================
        HEADER
    ========================== --}}

    <div class="flex flex-col gap-4 mb-6 md:flex-row md:items-center md:justify-between">

        <div>

            <h1 class="text-3xl font-bold text-gray-900">
                Kelola Booking
            </h1>

            <p class="mt-1 text-gray-500">
                Kelola seluruh data booking pelanggan
            </p>

        </div>

    </div>


    {{-- ==========================
        FILTER
    ========================== --}}

    <div class="p-4 mb-6 bg-white border border-gray-200 shadow-sm rounded-2xl">

        <form
            method="GET"
            action="{{ url('/admin/booking') }}"
        >

            <div class="grid gap-4 md:grid-cols-2">

                {{-- SEARCH --}}

                <div class="relative">

                    <i
                        class="absolute text-gray-400 -translate-y-1/2 fa-solid fa-magnifying-glass left-4 top-1/2"
                    ></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari booking, tamu, email, atau properti..."
                        class="w-full py-3 pl-12 pr-4 transition bg-white border border-gray-200 outline-none rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                    >

                </div>


                {{-- STATUS --}}

                <select
                    name="status"
                    onchange="this.form.submit()"
                    class="w-full px-4 py-3 transition bg-white border border-gray-200 outline-none rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >

                    <option value="">
                        Semua Status
                    </option>

                    <option
                        value="PENDING"
                        {{ request('status') === 'PENDING' ? 'selected' : '' }}
                    >
                        Pending
                    </option>

                    <option
                        value="PAID"
                        {{ request('status') === 'PAID' ? 'selected' : '' }}
                    >
                        Paid
                    </option>

                    <option
                        value="CANCELLED"
                        {{ request('status') === 'CANCELLED' ? 'selected' : '' }}
                    >
                        Cancelled
                    </option>

                    <option
                        value="EXPIRED"
                        {{ request('status') === 'EXPIRED' ? 'selected' : '' }}
                    >
                        Expired
                    </option>

                    <option
                        value="FAILED"
                        {{ request('status') === 'FAILED' ? 'selected' : '' }}
                    >
                        Failed
                    </option>

                </select>

            </div>

        </form>

    </div>


    {{-- ==========================
        TABLE
    ========================== --}}

<div class="py-5 overflow-x-auto bg-white px-7 rounded-2xl">

<table class="w-full">

    <thead>

        <tr class="border-b border-gray-200">

            <th class="py-4 text-left text-gray-600">
                Tamu
            </th>

            <th class="py-4 text-left text-gray-600">
                Properti
            </th>

            <th class="py-4 text-left text-gray-600">
                Check In / Check Out
            </th>

            <th class="py-4 text-left text-gray-600">
                Total
            </th>

            <th class="py-4 text-left text-gray-600">
                Status
            </th>

            <th class="py-4 text-left text-gray-600">
                Payment
            </th>

            <th class="py-4 text-center text-gray-600">
                Aksi
            </th>

        </tr>

    </thead>


    <tbody>

        {{-- CEK DATA BOOKING --}}
        @if(!empty($booking) && count($booking) > 0)

            @foreach($booking as $item)

                @php

                    /*
                    |--------------------------------------------------------------------------
                    | DATA AMAN
                    |--------------------------------------------------------------------------
                    */

                    $id = data_get($item, 'id');

                    $nameGuest = data_get(
                        $item,
                        'nameGuest'
                    ) ?: '-';

                    $email = data_get(
                        $item,
                        'user.email'
                    ) ?: '-';

                    $productName = data_get(
                        $item,
                        'product.name'
                    ) ?: '-';

                    $productLocation = data_get(
                        $item,
                        'product.location'
                    ) ?: '-';

                    $checkIn = data_get(
                        $item,
                        'checkIn'
                    );

                    $checkOut = data_get(
                        $item,
                        'checkOut'
                    );

                    $totalPrice = data_get(
                        $item,
                        'totalPrice',
                        0
                    ) ?? 0;

                    $status = data_get(
                        $item,
                        'status'
                    ) ?: '-';

                    $paymentMethod = data_get(
                        $item,
                        'paymentMethod'
                    ) ?: '-';


                    /*
                    |--------------------------------------------------------------------------
                    | STATUS CLASS
                    |--------------------------------------------------------------------------
                    */

                    $statusClass = match ($status) {

                        'PAID' =>
                            'bg-green-100 text-green-700',

                        'PENDING' =>
                            'bg-yellow-100 text-yellow-700',

                        'CANCELLED' =>
                            'bg-red-100 text-red-700',

                        'EXPIRED' =>
                            'bg-gray-100 text-gray-700',

                        'FAILED' =>
                            'bg-red-100 text-red-700',

                        default =>
                            'bg-gray-100 text-gray-700',

                    };

                @endphp


                <tr class="border-b border-gray-100">

                    {{-- TAMU --}}

                    <td class="py-4">

                        <div class="font-medium text-gray-900">
                            {{ $nameGuest }}
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ $email }}
                        </div>

                    </td>


                    {{-- PROPERTI --}}

                    <td class="py-4">

                        <div class="font-medium text-gray-900">
                            {{ $productName }}
                        </div>

                        <div class="text-sm text-gray-500">
                            {{ $productLocation }}
                        </div>

                    </td>


                    {{-- CHECK IN / CHECK OUT --}}

                    <td class="py-4">

                        <div class="text-sm">

                            {{-- CHECK IN --}}
                            <div>

                                @if(!empty($checkIn))

                                    @try

                                        {{ \Carbon\Carbon::parse($checkIn)
                                            ->locale('id')
                                            ->translatedFormat('d M Y') }}

                                    {{-- @catch(\Exception $e)

                                        -

                                    @endtry --}}

                                @else

                                    -

                                @endif

                            </div>


                            {{-- CHECK OUT --}}
                            <div class="text-gray-500">

                                @if(!empty($checkOut))

                                    @try

                                        {{ \Carbon\Carbon::parse($checkOut)
                                            ->locale('id')
                                            ->translatedFormat('d M Y') }}
{{-- 
                                    @catch(\Exception $e)

                                        -

                                    @endtry --}}

                                @else

                                    -

                                @endif

                            </div>

                        </div>

                    </td>


                    {{-- TOTAL --}}

                    <td class="py-4 font-medium">

                        Rp {{ number_format(
                            is_numeric($totalPrice)
                                ? $totalPrice
                                : 0,
                            0,
                            ',',
                            '.'
                        ) }}

                    </td>


                    {{-- STATUS --}}

                    <td class="py-4">

                        <span
                            class="inline-flex rounded-full px-3 py-1 text-xs font-medium {{ $statusClass }}"
                        >
                            {{ $status }}
                        </span>

                    </td>


                    {{-- PAYMENT --}}

                    <td class="py-4">

                        <span
                            class="inline-flex px-3 py-1 text-xs font-medium text-gray-700 bg-gray-100 rounded-full"
                        >
                            {{ $paymentMethod }}
                        </span>

                    </td>


                    {{-- AKSI --}}

                    <td class="py-4">

                        <div class="flex items-center justify-center gap-2">

                            @if(!empty($id))

                                <a
                                    href="{{ url('/admin/booking/' . $id) }}"
                                    class="p-2 text-blue-600 transition bg-blue-100 rounded-lg hover:bg-blue-200"
                                    title="Lihat Booking"
                                >
                                    <i class="fa-solid fa-eye text-[18px]"></i>
                                </a>

                            @else

                                <span
                                    class="p-2 text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed"
                                    title="ID booking tidak tersedia"
                                >
                                    <i class="fa-solid fa-eye text-[18px]"></i>
                                </span>

                            @endif

                        </div>

                    </td>

                </tr>

            @endforeach


        @else

            {{-- DATA KOSONG --}}

            <tr>

                <td
                    colspan="7"
                    class="py-16 text-center"
                >

                    <div class="flex flex-col items-center justify-center">

                        <div class="flex items-center justify-center w-16 h-16 text-gray-400 bg-gray-100 rounded-full">

                            <i class="text-2xl fa-regular fa-calendar-xmark"></i>

                        </div>

                        <p class="mt-4 font-medium text-gray-600">
                            Tidak ada data booking
                        </p>

                        <p class="mt-1 text-sm text-gray-400">
                            Belum terdapat booking yang tersedia.
                        </p>

                    </div>

                </td>

            </tr>

        @endif

    </tbody>

</table>


{{-- ==========================
    PAGINATION
========================== --}}

@php

    $pagination = $pagination ?? [];

    $currentPage = (int) (
        data_get($pagination, 'page', 1) ?: 1
    );

    $totalPage = (int) (
        data_get($pagination, 'totalPage', 1) ?: 1
    );

    $totalData = (int) (
        data_get($pagination, 'total', 0) ?: 0
    );

    // Pastikan minimal 1
    $currentPage = max($currentPage, 1);
    $totalPage = max($totalPage, 1);
    $totalData = max($totalData, 0);

@endphp


</div>

</div>

@endsection