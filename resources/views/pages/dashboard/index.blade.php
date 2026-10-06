@extends('layouts.admin')

@section('title', 'Dashboard - Villa Kita')

@section('content')

@php

    /*
    |--------------------------------------------------------------------------
    | DATA STATISTICS
    |--------------------------------------------------------------------------
    */

    $statistics = [
        'totalBooking' => [
            'value' => $total_booking,
            'percentage' => 12,
        ],

        'totalOwner' => [
            'value' => $total_owner,
            'percentage' => 8,
        ],

        'totalProperty' => [
            'value' => $total_property,
            'percentage' => 5,
        ],

        'totalRevenue' => [
            'value' => $total_revenue,
            'percentage' => 15,
        ],
    ];


    /*
    |--------------------------------------------------------------------------
    | DATA LATEST BOOKINGS
    |--------------------------------------------------------------------------
    */

    $latestBookings = [
        [
            'id' => 1,
            'bookingCode' => 'VKT-20260924-001',
            'createdAt' => '2026-09-24',
            'nameGuest' => 'Andi Pratama',

            'user' => [
                'email' => 'andi@gmail.com',
            ],

            'product' => [
                'name' => 'Villa Harmoni Tegal',
                'location' => 'Kota Tegal',
            ],

            'checkIn' => '2026-09-26',
            'checkOut' => '2026-09-28',
            'totalGuest' => 4,
            'totalPrice' => 1500000,
            'paymentMethod' => 'BCA',
            'status' => 'PAID',
        ],

        [
            'id' => 2,
            'bookingCode' => 'VKT-20260924-002',
            'createdAt' => '2026-09-24',
            'nameGuest' => 'Siti Rahma',

            'user' => [
                'email' => 'siti@gmail.com',
            ],

            'product' => [
                'name' => 'Villa Bahagia Tegal',
                'location' => 'Kabupaten Tegal',
            ],

            'checkIn' => '2026-09-27',
            'checkOut' => '2026-09-29',
            'totalGuest' => 6,
            'totalPrice' => 1700000,
            'paymentMethod' => 'QRIS',
            'status' => 'PENDING',
        ],

        [
            'id' => 3,
            'bookingCode' => 'VKT-20260923-003',
            'createdAt' => '2026-09-23',
            'nameGuest' => 'Budi Santoso',

            'user' => [
                'email' => 'budi@gmail.com',
            ],

            'product' => [
                'name' => 'Villa Puncak Indah',
                'location' => 'Kota Tegal',
            ],

            'checkIn' => '2026-09-30',
            'checkOut' => '2026-10-01',
            'totalGuest' => 2,
            'totalPrice' => 950000,
            'paymentMethod' => 'GoPay',
            'status' => 'PAID',
        ],

        [
            'id' => 4,
            'bookingCode' => 'VKT-20260923-004',
            'createdAt' => '2026-09-23',
            'nameGuest' => 'Dewi Lestari',

            'user' => [
                'email' => 'dewi@gmail.com',
            ],

            'product' => [
                'name' => 'Villa Keluarga Sejahtera',
                'location' => 'Kabupaten Tegal',
            ],

            'checkIn' => '2026-10-02',
            'checkOut' => '2026-10-04',
            'totalGuest' => 6,
            'totalPrice' => 2400000,
            'paymentMethod' => 'Mandiri',
            'status' => 'CANCELLED',
        ],

        [
            'id' => 5,
            'bookingCode' => 'VKT-20260922-005',
            'createdAt' => '2026-09-22',
            'nameGuest' => 'Fajar Nugraha',

            'user' => [
                'email' => 'fajar@gmail.com',
            ],

            'product' => [
                'name' => 'Villa Sunset View',
                'location' => 'Kota Tegal',
            ],

            'checkIn' => '2026-10-05',
            'checkOut' => '2026-10-06',
            'totalGuest' => 4,
            'totalPrice' => 650000,
            'paymentMethod' => 'BRI',
            'status' => 'EXPIRED',
        ],
    ];

@endphp


<div class="p-6 space-y-8 bg-gray-100 rounded-3xl">

    {{-- Header --}}
    <div>

        <h1 class="text-5xl font-bold text-slate-900">
            Dashboard
        </h1>

        <p class="mt-2 text-lg text-slate-500">
            Selamat datang kembali, Super Admin
        </p>

    </div>


    {{-- Statistik --}}
    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">

        {{-- Total Booking --}}
        <x-admin.stat-card
            title="Total Booking"
            :value="$statistics['totalBooking']['value'] ?? 0"
            :subtitle="($statistics['totalBooking']['percentage'] ?? 0) . '% dari bulan lalu'"
            icon="fa-calendar-check"
            gradient="bg-gradient-to-r from-blue-500 to-blue-700"
        />


        {{-- Total Owner --}}
        <x-admin.stat-card
            title="Total Owner"
            :value="$statistics['totalOwner']['value'] ?? 0"
            :subtitle="($statistics['totalOwner']['percentage'] ?? 0) . '% dari bulan lalu'"
            icon="fa-users"
            gradient="bg-gradient-to-r from-emerald-500 to-emerald-600"
        />


        {{-- Total Properti --}}
        <x-admin.stat-card
            title="Total Properti"
            :value="$statistics['totalProperty']['value'] ?? 0"
            :subtitle="($statistics['totalProperty']['percentage'] ?? 0) . '% dari bulan lalu'"
            icon="fa-house"
            gradient="bg-gradient-to-r from-violet-500 to-fuchsia-600"
        />


        {{-- Total Revenue --}}
        <x-admin.stat-card
            title="Total Revenue"
            :value="'Rp ' . number_format($statistics['totalRevenue']['value'] ?? 0, 0, ',', '.')"
            :subtitle="($statistics['totalRevenue']['percentage'] ?? 0) . '% dari bulan lalu'"
            icon="fa-circle-dollar-to-slot"
            gradient="bg-gradient-to-r from-orange-500 to-orange-600"
        />

    </div>


    {{-- Bottom --}}
    <div class="grid gap-6 xl:grid-cols-1">

        {{-- Booking --}}
        <div class="w-full overflow-x-auto">

            @if ($latest_bookings->count() > 0)

                <table class="w-full">

                    <thead>
                        <tr class="border-b border-gray-200 bg-gray-50">

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Booking
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Tamu
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Properti
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Check-in / Check-out
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Total
                            </th>

                            <th class="px-6 py-4 text-sm font-semibold text-left text-gray-600">
                                Status
                            </th>

                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($latest_bookings as $booking)

                            <tr class="transition border-b border-gray-100 hover:bg-gray-50">

                                {{-- BOOKING --}}
                                <td class="px-6 py-5">

                                    <div class="font-semibold text-gray-900">
                                        {{ $booking['order_id'] }}
                                    </div>

                                    <div class="mt-1 text-xs text-gray-400">
                                        {{ \Carbon\Carbon::parse($booking['created_at'])->locale('id')->translatedFormat('d M Y') }}
                                    </div>

                                </td>


                                {{-- TAMU --}}
                                <td class="px-6 py-5">

                                    <div class="font-medium text-gray-900">
                                        {{ $booking['name_guest'] }}
                                    </div>

                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ $booking['user']['email'] ?? '-' }}
                                    </div>

                                </td>


                                {{-- PROPERTI --}}
                                <td class="px-6 py-5">

                                    <div class="font-medium text-gray-900">
                                        {{ $booking['product']['name'] ?? '-' }}
                                    </div>

                                    <div class="mt-1 text-sm text-gray-500">
                                        {{ $booking['product']['location'] ?? '-' }}
                                    </div>

                                </td>


                                {{-- CHECK IN / CHECK OUT --}}
                                <td class="px-6 py-5">

                                    <div class="text-sm font-medium text-gray-900">

                                        {{ \Carbon\Carbon::parse($booking['check_in'])->locale('id')->translatedFormat('d M Y') }}

                                    </div>

                                    <div class="mt-1 text-sm text-gray-500">

                                        s/d

                                        {{ \Carbon\Carbon::parse($booking['check_out'])->locale('id')->translatedFormat('d M Y') }}

                                    </div>

                                    <div class="mt-1 text-xs text-gray-400">

                                        {{ $booking['total_guest'] }} tamu

                                    </div>

                                </td>


                                {{-- TOTAL --}}
                                <td class="px-6 py-5">

                                    <div class="font-semibold text-gray-900">

                                        Rp {{ number_format($booking['total_price'], 0, ',', '.') }}

                                    </div>

                                    <div class="mt-1 text-xs text-gray-500">

                                        {{ $booking['payment_method'] ?? '-' }}

                                    </div>

                                </td>


                                {{-- STATUS --}}
                                <td class="px-6 py-5">

                                    @php
                                        $statusClass = match ($booking['status']) {
                                            'PAID' => 'bg-green-100 text-green-700',
                                            'PENDING' => 'bg-yellow-100 text-yellow-700',
                                            'CANCELLED' => 'bg-red-100 text-red-700',
                                            'EXPIRED' => 'bg-gray-100 text-gray-700',
                                            'FAILED' => 'bg-red-100 text-red-700',
                                            default => 'bg-gray-100 text-gray-700',
                                        };
                                    @endphp

                                    <span
                                        class="inline-flex rounded-full px-3 py-1 text-xs font-semibold {{ $statusClass }}"
                                    >
                                        {{ $booking['status'] }}
                                    </span>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>


                {{-- PAGINATION --}}
                <div class="flex flex-col gap-3 px-6 py-5 border-t border-gray-100 sm:flex-row sm:items-center sm:justify-between">

                    {{-- INFO --}}
                    <div class="text-sm text-gray-500">

                        Menampilkan
                        <span class="font-medium text-gray-700">
                            {{ $latest_bookings->firstItem() ?? 0 }}
                        </span>

                        sampai

                        <span class="font-medium text-gray-700">
                            {{ $latest_bookings->lastItem() ?? 0 }}
                        </span>

                        dari

                        <span class="font-medium text-gray-700">
                            {{ $latest_bookings->total() }}
                        </span>

                        booking

                    </div>


                    {{-- BUTTON --}}
                    <div>

                        {{ $latest_bookings->links() }}

                    </div>

                </div>


            @else

                {{-- Empty State --}}
                <div class="flex flex-col items-center justify-center h-64 text-gray-400">

                    <i class="fa-regular fa-clock text-[60px]"></i>

                    <p class="mt-4">
                        Belum ada booking
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>

@endsection
