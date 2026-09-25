@props([
    'booking' => [],
])

@php
    $bookingCode = $booking['bookingCode'] ?? '-';
    $checkIn = $booking['checkIn'] ?? null;
    $checkOut = $booking['checkOut'] ?? null;
    $totalGuest = $booking['totalGuest'] ?? 0;

    $discount = (float) ($booking['discount'] ?? 0);
    $totalPrice = (float) ($booking['totalPrice'] ?? 0);

    $product = $booking['product'] ?? [];

    $productName = $product['name'] ?? '-';
    $thumbnail = $product['thumbnail'] ?? '';
    $capacity = $product['capacity'] ?? 0;
    $price = (float) ($product['price'] ?? 0);
    $serviceFee = (float) ($product['serviceFee'] ?? 0);

    $formatCurrency = function ($value) {
        return 'Rp ' . number_format((float) $value, 0, ',', '.');
    };

    $formatDate = function ($date) {
        if (!$date) {
            return '-';
        }

        return \Carbon\Carbon::parse($date)
            ->locale('id')
            ->translatedFormat('d M Y');
    };

    $nights = 1;

    if ($checkIn && $checkOut) {
        $nights = max(
            1,
            (int) ceil(
                \Carbon\Carbon::parse($checkIn)
                    ->diffInSeconds(\Carbon\Carbon::parse($checkOut))
                / 86400
            )
        );
    }
@endphp

<div class="overflow-hidden rounded-2xl bg-white shadow-lg">

    <div class="border-b p-6">
        <h2 class="text-xl font-bold">
            Ringkasan Booking
        </h2>

        <p class="text-xs text-gray-500">
            Booking ID : {{ $bookingCode }}
        </p>
    </div>

    <div class="space-y-5 p-6">

        {{-- Product --}}
        <div class="flex gap-4">

            <div class="relative h-24 w-24 overflow-hidden rounded-xl">

                @if ($thumbnail)
                    <img
                        src="{{ $thumbnail }}"
                        alt="{{ $productName }}"
                        class="h-full w-full object-cover"
                    >
                @else
                    <div class="flex h-full w-full items-center justify-center bg-gray-100">
                        <i class="fa-regular fa-image text-2xl text-gray-400"></i>
                    </div>
                @endif

            </div>

            <div class="flex-1">

                <h3 class="font-semibold">
                    {{ $productName }}
                </h3>

                <span class="mt-2 inline-flex rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-700">
                    Maks {{ $capacity }} Tamu
                </span>

            </div>

        </div>

        <hr>

        {{-- Booking Detail --}}
        <div class="space-y-3 text-sm">

            <div class="flex justify-between">
                <span>Check In</span>

                <span>
                    {{ $formatDate($checkIn) }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Check Out</span>

                <span>
                    {{ $formatDate($checkOut) }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Total Tamu</span>

                <span>
                    {{ $totalGuest }} Orang
                </span>
            </div>

            <div class="flex justify-between">
                <span>Lama Menginap</span>

                <span>
                    {{ $nights }} Malam
                </span>
            </div>

        </div>

        <hr>

        {{-- Payment Detail --}}
        <div class="space-y-3">

            <div class="flex justify-between">
                <span>Harga Villa</span>

                <span>
                    {{ $formatCurrency($price) }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Subtotal</span>

                <span>
                    {{ $formatCurrency($totalPrice) }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Biaya Layanan</span>

                <span>
                    {{ $formatCurrency($serviceFee) }}
                </span>
            </div>

            <div class="flex justify-between">
                <span>Diskon</span>

                <span class="text-green-600">
                    -{{ $formatCurrency($discount) }}
                </span>
            </div>

            <hr>

            <div class="flex justify-between text-lg font-bold text-blue-600">
                <span>Total</span>

                <span>
                    {{ $formatCurrency($totalPrice) }}
                </span>
            </div>

        </div>

        <hr>

        {{-- Benefits --}}
        <div class="space-y-2 text-sm">

            <div class="flex items-center gap-2 text-green-600">
                <i class="fa-solid fa-circle-check text-[18px]"></i>
                Konfirmasi Instan
            </div>

            <div class="flex items-center gap-2 text-green-600">
                <i class="fa-solid fa-circle-dollar-to-slot text-[18px]"></i>
                Pembatalan Gratis
            </div>

        </div>

    </div>

</div>