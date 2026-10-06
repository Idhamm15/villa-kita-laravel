@extends('layouts.admin')

@section('title', 'Detail Booking - Villa Kita')

@section('content')

@php
    use Carbon\Carbon;

    $bookingData = $data ?? null;

    $nameGuest = data_get($bookingData, 'name_guest')
        ?: data_get($bookingData, 'user.fullname')
        ?: '-';

    $emailGuest = data_get($bookingData, 'email')
        ?: data_get($bookingData, 'email')
        ?: '-';

    $phoneGuest = data_get($bookingData, 'phone', '-');

    $totalGuest = data_get($bookingData, 'total_guest', 0);

    $productName = data_get($bookingData, 'product.name', '-');
    $productLocation = data_get($bookingData, 'product.location', '-');
    $productPrice = data_get($bookingData, 'product.price', 0);

    $bookingStatus = data_get($bookingData, 'status', '-');
    $paymentMethod = data_get($bookingData, 'payment_method', '-');

    $totalPrice = data_get($bookingData, 'total_price', 0);

    $checkIn = data_get($bookingData, 'check_in');
    $checkOut = data_get($bookingData, 'check_out');

    $nights = 0;

    if ($checkIn && $checkOut) {
        $nights = Carbon::parse($checkIn)
            ->diffInDays(Carbon::parse($checkOut));
    }

    $bookingStatusClass = match (strtoupper($bookingStatus)) {
        'PAID', 'COMPLETED' =>
            'bg-green-100 text-green-700',

        'PENDING' =>
            'bg-yellow-100 text-yellow-700',

        'CANCELLED', 'FAILED', 'EXPIRED' =>
            'bg-red-100 text-red-700',

        default =>
            'bg-gray-100 text-gray-700',
    };

    $formatCurrency = function ($value) {
        return 'Rp ' . number_format((float) $value, 0, ',', '.');
    };

    $formatDate = function ($date) {
        if (!$date) {
            return '-';
        }

        return Carbon::parse($date)
            ->locale('id')
            ->translatedFormat('d F Y');
    };

    $formatDateTime = function ($date) {
        if (!$date) {
            return '-';
        }

        return Carbon::parse($date)
            ->locale('id')
            ->translatedFormat('d F Y, H:i') . ' WIB';
    };
@endphp

<div class="p-12 bg-gray-100 rounded-3xl">

    {{-- ==========================
        HEADER
    ========================== --}}

    <div class="mb-8">

        <button
            type="button"
            onclick="history.back()"
            class="flex items-center gap-2 mb-5 text-gray-500 hover:text-blue-600"
        >
            <i class="fa-solid fa-arrow-left text-[22px]"></i>
            <span>Kembali</span>
        </button>

        <h1 class="text-3xl font-bold text-gray-900">
            Detail Booking
        </h1>

        <p class="mt-1 text-sm text-gray-500">
            Booking Code:
            <span class="font-medium text-gray-700">
                {{ data_get($bookingData, 'booking_code', '-') }}
            </span>
        </p>

    </div>

    <div class="grid gap-6 lg:grid-cols-3">

        {{-- ==========================
            LEFT
        ========================== --}}

        <div class="space-y-6 lg:col-span-2">

            {{-- ==========================
                INFORMASI TAMU
            ========================== --}}

            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-2xl">

                <h2 class="mb-6 text-xl font-bold">
                    Informasi Tamu
                </h2>

                <div class="grid gap-6 md:grid-cols-2">

                    <div>
                        <p class="text-sm text-gray-500">
                            Nama Lengkap
                        </p>

                        <p class="font-semibold">
                            {{ $nameGuest }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Email
                        </p>

                        <p class="font-semibold">
                            {{ $emailGuest }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            No. Telepon
                        </p>

                        <p class="font-semibold">
                            {{ $phoneGuest }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">
                            Jumlah Tamu
                        </p>

                        <p class="font-semibold">
                            {{ $totalGuest }} Orang
                        </p>
                    </div>

                </div>

            </div>


            {{-- ==========================
                INFORMASI PROPERTI
            ========================== --}}

            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-2xl">

                <h2 class="mb-5 text-xl font-bold">
                    Informasi Properti
                </h2>

                <div class="flex gap-4">

                    <div class="flex items-center justify-center text-blue-600 bg-blue-100 h-14 w-14 shrink-0 rounded-xl">
                        <i class="fa-solid fa-house text-[26px]"></i>
                    </div>

                    <div>

                        <h3 class="text-xl font-semibold">
                            {{ $productName }}
                        </h3>

                        <p class="mt-2 text-gray-500">
                            {{ $productLocation }}
                        </p>

                        <p class="mt-3 font-semibold text-blue-600">
                            Harga per malam
                            {{ $formatCurrency($productPrice) }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- ==========================
                DETAIL BOOKING
            ========================== --}}

            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-2xl">

                <h2 class="mb-6 text-xl font-bold">
                    Detail Booking
                </h2>

                <div class="grid gap-8 md:grid-cols-2">

                    {{-- LEFT --}}

                    <div class="space-y-6">

                        <div>
                            <p class="text-sm text-gray-500">
                                Check-in
                            </p>

                            <p class="font-semibold">
                                {{ $formatDate($checkIn) }}
                            </p>

                            <p class="text-purple-600">
                                14.00 WIB
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Durasi Menginap
                            </p>

                            <p class="font-semibold">
                                {{ $nights }} Malam
                            </p>
                        </div>

                    </div>


                    {{-- RIGHT --}}

                    <div class="space-y-6">

                        <div>
                            <p class="text-sm text-gray-500">
                                Check-out
                            </p>

                            <p class="font-semibold">
                                {{ $formatDate($checkOut) }}
                            </p>

                            <p class="text-purple-600">
                                12.00 WIB
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">
                                Jumlah Tamu
                            </p>

                            <p class="font-semibold">
                                {{ $totalGuest }} Orang
                            </p>
                        </div>

                    </div>

                </div>


                {{-- CATATAN --}}

                @if (data_get($bookingData, 'note'))

                    <div class="pt-6 mt-8 border-t">

                        <p class="text-sm text-gray-500">
                            Catatan
                        </p>

                        <p class="mt-1 font-medium">
                            {{ data_get($bookingData, 'note') }}
                        </p>

                    </div>

                @endif

            </div>

        </div>


        {{-- ==========================
            RIGHT
        ========================== --}}

        <div class="space-y-6">

            {{-- ==========================
                STATUS
            ========================== --}}

            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-2xl">

                <h2 class="mb-5 text-xl font-bold">
                    Status
                </h2>

                <div class="space-y-4">

                    <div>

                        <p class="text-sm text-gray-500">
                            Booking Status
                        </p>

                        <span
                            class="mt-2 inline-flex rounded-full px-3 py-1 text-sm font-semibold {{ $bookingStatusClass }}"
                        >
                            {{ $bookingStatus }}
                        </span>

                    </div>


                    <div>

                        <p class="text-sm text-gray-500">
                            Payment Method
                        </p>

                        <span class="inline-flex px-3 py-1 mt-2 text-sm font-semibold text-gray-700 bg-gray-100 rounded-full">
                            {{ $paymentMethod ?: '-' }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- ==========================
                PEMBAYARAN
            ========================== --}}

            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-2xl">

                <h2 class="mb-5 text-xl font-bold">
                    Pembayaran
                </h2>

                <div class="space-y-4">

                    <div class="flex items-center gap-3">

                        <div class="flex items-center justify-center w-10 h-10 text-purple-600 bg-purple-100 rounded-lg">
                            <i class="fa-solid fa-credit-card text-[20px]"></i>
                        </div>

                        <div>

                            <p class="text-sm text-gray-500">
                                Metode Pembayaran
                            </p>

                            <p class="font-semibold">
                                {{ $paymentMethod ?: '-' }}
                            </p>

                        </div>

                    </div>


                    <hr>


                    <div class="flex justify-between">

                        <span>
                            Harga per malam
                        </span>

                        <span>
                            {{ $formatCurrency($productPrice) }}
                        </span>

                    </div>


                    <div class="flex justify-between">

                        <span>
                            Durasi
                        </span>

                        <span>
                            {{ $nights }} malam
                        </span>

                    </div>


                    <hr>


                    <div class="flex justify-between text-lg font-bold">

                        <span>
                            Total
                        </span>

                        <span class="text-purple-600">
                            {{ $formatCurrency($totalPrice) }}
                        </span>

                    </div>


                    {{-- TRANSACTION ID --}}

                    @if (data_get($bookingData, 'transactionId'))

                        <hr>

                        <div>

                            <p class="text-sm text-gray-500">
                                Transaction ID
                            </p>

                            <p class="mt-1 font-semibold break-all">
                                {{ data_get($bookingData, 'transactionId') }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>


            {{-- ==========================
                INFORMASI LAIN
            ========================== --}}

            <div class="p-6 bg-white border border-gray-200 shadow-sm rounded-2xl">

                <h2 class="mb-5 text-xl font-bold">
                    Informasi Lainnya
                </h2>

                <div class="space-y-4">

                    {{-- CREATED AT --}}

                    <div>

                        <p class="text-sm text-gray-500">
                            Dibuat pada
                        </p>

                        <p class="font-semibold">
                            {{ $formatDateTime(data_get($bookingData, 'created_at')) }}
                        </p>

                    </div>


                    {{-- BOOKING CODE --}}

                    <div>

                        <p class="text-sm text-gray-500">
                            Booking Code
                        </p>

                        <p class="font-semibold break-all">
                            {{ data_get($bookingData, 'booking_code', '-') }}
                        </p>

                    </div>


                    {{-- ORDER ID --}}

                    @if (data_get($bookingData, 'orderId'))

                        <div>

                            <p class="text-sm text-gray-500">
                                Order ID
                            </p>

                            <p class="font-semibold break-all">
                                {{ data_get($bookingData, 'orderId') }}
                            </p>

                        </div>

                    @endif


                    {{-- PAID AT --}}

                    @if (data_get($bookingData, 'paidAt'))

                        <div>

                            <p class="text-sm text-gray-500">
                                Dibayar pada
                            </p>

                            <p class="font-semibold">
                                {{ $formatDateTime(data_get($bookingData, 'paidAt')) }}
                            </p>

                        </div>

                    @endif


                    {{-- EXPIRED AT --}}

                    @if (data_get($bookingData, 'expiredAt'))

                        <div>

                            <p class="text-sm text-gray-500">
                                Expired pada
                            </p>

                            <p class="font-semibold">
                                {{ $formatDateTime(data_get($bookingData, 'expiredAt')) }}
                            </p>

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection