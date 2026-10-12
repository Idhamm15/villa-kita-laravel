@props([
    'booking' => [],
    'product' => [],
])

@php
    $bookingCode = $booking['bookingCode'] ?? '-';
    $checkIn = $booking['checkIn'] ?? null;
    $checkOut = $booking['checkOut'] ?? null;
    $totalGuest = $booking['totalGuest'] ?? 0;

    $discount = (float) ($booking['discount'] ?? 0);
    $subTotal = (float) ($booking['subTotal'] ?? 0);
    $totalPrice = (float) ($booking['totalPrice'] ?? 0);

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

<div class="overflow-hidden bg-white shadow-lg rounded-2xl">

    <div class="p-6 border-b">
        <h2 class="text-xl font-bold">
            Ringkasan Booking
        </h2>

        <p class="text-xs text-gray-500">
            Booking ID : {{ $bookingCode }}
        </p>
    </div>

    <div class="p-6 space-y-5">

        {{-- Product --}}
        <div class="flex gap-4">

            <div class="relative w-24 h-24 overflow-hidden rounded-xl">

                @if ($thumbnail)
                    <img
                        src="{{ !empty($thumbnail) ? asset('storage/' . $thumbnail) : '' }}"
                        alt="{{ $productName }}"
                        class="object-cover w-full h-full"
                    >
                @else
                    <div class="flex items-center justify-center w-full h-full bg-gray-100">
                        <i class="text-2xl text-gray-400 fa-regular fa-image"></i>
                    </div>
                @endif

            </div>

            <div class="flex-1 min-w-0">

                {{-- Nama Produk --}}
                <h3 class="text-base font-bold leading-snug text-gray-900 md:text-lg">
                    {{ $productName }}
                </h3>

                {{-- Kapasitas Tamu --}}
                <div class="flex items-center gap-2 mt-2">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-sky-700 bg-sky-50 border border-sky-100 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-4 h-4"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="1.8">
                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2m6-10a4 4 0 1 0 0-8 4 4 0 0 0 0 8Zm12 10v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"/>
                        </svg>
                        Maks. {{ $capacity }} tamu
                    </span>
                </div>

                {{-- Harga --}}
                <div class="mt-3 flex items-baseline gap-1.5">
                    <span class="text-lg font-bold md:text-xl text-sky-700">
                        Rp{{ number_format($price, 0, ',', '.') }}
                    </span>
                    <span class="text-sm text-gray-500">
                        / malam
                    </span>
                </div>

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
                    {{ $formatCurrency($subTotal) }}
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