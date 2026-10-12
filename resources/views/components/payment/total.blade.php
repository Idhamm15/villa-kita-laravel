@props([
    'booking' => [],
    'product' => [],
])

@php
    $discount = (float) ($booking['discount'] ?? 0);
    $totalPrice = (float) ($booking['totalPrice'] ?? 0);

    $checkIn = $booking['checkIn'] ?? null;
    $checkOut = $booking['checkOut'] ?? null;

    $price = (float) ($product['price'] ?? 0);
    
    $subTotal = (float) ($booking['subTotal'] ?? 0);
    $serviceFee = (float) ($product['serviceFee'] ?? 0);

    $formatCurrency = function ($value) {
        return 'Rp ' . number_format((float) $value, 0, ',', '.');
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

<div class="p-6 bg-white shadow-lg rounded-2xl">

    <h2 class="mb-6 text-xl font-bold">
        Payment Summary
    </h2>

    <div class="space-y-4">

        <div class="flex justify-between">
            <span>Harga Villa/Trip</span>
            <span>
                {{ $formatCurrency($price) }}
            </span>
        </div>

        <div class="flex justify-between">
            <span>Lama Menginap</span>
            <span>
                {{ $nights }} Malam
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

        <div class="flex justify-between text-2xl font-bold text-blue-600">
            <span>Total</span>

            <span>
                {{ $formatCurrency($totalPrice) }}
            </span>
        </div>

    </div>

</div>