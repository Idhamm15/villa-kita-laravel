@props([
    'booking' => [],
    'product' => [],
])

@php
    $bookingCode = $booking['bookingCode'] ?? null;
    $checkIn = $booking['checkIn'] ?? null;
    $checkOut = $booking['checkOut'] ?? null;
    $totalGuest = $booking['totalGuest'] ?? 0;
    $discount = $booking['discount'] ?? 0;
    $voucherCode = $booking['voucherCode'] ?? '';

    $productName = $product['name'] ?? 'Villa';
    $thumbnail = $product['thumbnail'] ?? '/images/no-image.png';
    $roomName = $product['roomName'] ?? 'Villa';
    $capacity = $product['capacity'] ?? 0;
    $price = $product['price'] ?? 0;

    // Biaya layanan
    $serviceFee = isset($product['serviceFee'])
        ? (float) $product['serviceFee']
        : 25000;

    // Hitung lama menginap / trip
    $nights = 1;

    if ($checkIn && $checkOut) {
        try {
            $start = \Carbon\Carbon::parse($checkIn);
            $end = \Carbon\Carbon::parse($checkOut);

            $diff = $start->diffInSeconds($end) / (60 * 60 * 24);

            $nights = max(1, (int) ceil($diff));
        } catch (\Exception $e) {
            $nights = 1;
        }
    }

    // Perhitungan harga
    $subtotal = (float) $price * $nights;
    $discount = (float) $discount;

    $total = $subtotal + $serviceFee - $discount;

    // Format Rupiah
    $formatCurrency = function ($value) {
        return 'Rp ' . number_format($value, 0, ',', '.');
    };

    // Format tanggal
    $formatDate = function ($date) {
        if (!$date) {
            return '-';
        }

        try {
            return \Carbon\Carbon::parse($date)
                ->locale('id')
                ->translatedFormat('d M Y');
        } catch (\Exception $e) {
            return '-';
        }
    };
@endphp

<div class="overflow-hidden rounded-2xl bg-white shadow-lg">

    {{-- Header --}}
    <div class="border-b p-6">
        <h2 class="text-xl font-bold">
            Ringkasan Booking
        </h2>

        <p class="text-xs text-gray-500">
            Booking ID : {{ $bookingCode ?? '-' }}
        </p>
    </div>

    <div class="space-y-5 p-6">

        {{-- PRODUCT --}}
        <div class="flex gap-4">

            <div class="relative h-24 w-24 shrink-0 overflow-hidden rounded-xl">
                <img
                    src="{{ $thumbnail }}"
                    alt="{{ $productName }}"
                    class="h-full w-full object-cover"
                >
            </div>

            <div class="flex-1">

                <h3 class="font-semibold">
                    {{ $productName }}
                </h3>

                <p class="text-sm text-gray-500">
                    {{ $roomName }}
                </p>

                <span class="mt-2 inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                    Maks {{ $capacity }} Tamu
                </span>

            </div>

        </div>

        <hr>

        {{-- STAY --}}
        <div class="space-y-3 text-sm">

            {{-- Check In --}}
            <div class="flex justify-between">

                <div class="flex items-center gap-2 text-gray-500">
                    <i class="fa-regular fa-calendar-days"></i>
                    Check In
                </div>

                <span>
                    {{ $formatDate($checkIn) }}
                </span>

            </div>

            {{-- Check Out --}}
            <div class="flex justify-between">

                <div class="flex items-center gap-2 text-gray-500">
                    <i class="fa-regular fa-clock"></i>
                    Check Out
                </div>

                <span>
                    {{ $formatDate($checkOut) }}
                </span>

            </div>

            {{-- Total Tamu --}}
            <div class="flex justify-between">

                <div class="flex items-center gap-2 text-gray-500">
                    <i class="fa-solid fa-users"></i>
                    Total Tamu
                </div>

                <span>
                    {{ $totalGuest }} Orang
                </span>

            </div>

            {{-- Lama Menginap --}}
            <div class="flex justify-between">

                <span>
                    Lama Menginap/Trip
                </span>

                <span>
                    {{ $nights }} Malam
                </span>

            </div>

        </div>

        <hr>

        {{-- VOUCHER --}}
        <div>

            <div class="mb-3 flex items-center gap-2">

                <i class="fa-solid fa-ticket text-orange-500"></i>

                <h3 class="font-semibold">
                    Voucher
                </h3>

            </div>

            <div class="flex gap-2">

                <input
                    type="text"
                    name="voucherCode"
                    value="{{ old('voucherCode', $voucherCode) }}"
                    placeholder="Masukkan kode voucher"
                    class="flex-1 rounded-lg border px-4 py-2 text-sm outline-none focus:border-blue-500"
                >

                <button
                    type="submit"
                    name="apply_voucher"
                    value="1"
                    class="rounded-lg bg-orange-500 px-4 py-2 text-sm font-semibold text-white hover:bg-orange-600"
                >
                    Gunakan
                </button>

            </div>

        </div>

        <hr>

        {{-- PRICE --}}
        <div class="space-y-3">

            {{-- Harga --}}
            <div class="flex justify-between">

                <span>
                    Harga Villa/Trip
                </span>

                <span>
                    {{ $formatCurrency($price) }}
                </span>

            </div>

            {{-- Durasi --}}
            <div class="flex justify-between">

                <span>
                    Lama Menginap/Trip
                </span>

                <span>
                    {{ $nights }} x
                </span>

            </div>

            {{-- Subtotal --}}
            <div class="flex justify-between">

                <span>
                    Subtotal
                </span>

                <span>
                    {{ $formatCurrency($subtotal) }}
                </span>

            </div>

            {{-- Service Fee --}}
            <div class="flex justify-between">

                <span>
                    Biaya Layanan
                </span>

                <span>
                    {{ $formatCurrency($serviceFee) }}
                </span>

            </div>

            {{-- Discount --}}
            <div class="flex justify-between">

                <span>
                    Diskon
                </span>

                <span class="text-green-600">
                    -{{ $formatCurrency($discount) }}
                </span>

            </div>

            <hr>

            {{-- Total --}}
            <div class="flex justify-between text-lg font-bold text-blue-600">

                <span>
                    Total
                </span>

                <span>
                    {{ $formatCurrency($total) }}
                </span>

            </div>

        </div>

        <hr>

        {{-- BENEFIT --}}
        <div class="space-y-2 text-sm">

            <div class="flex items-center gap-2 text-green-600">

                <i class="fa-solid fa-circle-check"></i>

                Konfirmasi Instan

            </div>

            <div class="flex items-center gap-2 text-green-600">

                <i class="fa-solid fa-circle-dollar-to-slot"></i>

                Pembatalan Gratis

            </div>

        </div>

    </div>

</div>