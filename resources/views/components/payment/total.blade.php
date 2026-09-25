@props([
    'booking' => [],
])

@php
    $discount = (float) ($booking['discount'] ?? 0);
    $totalPrice = (float) ($booking['totalPrice'] ?? 0);

    $product = $booking['product'] ?? [];

    $price = (float) ($product['price'] ?? 0);
    $serviceFee = (float) ($product['serviceFee'] ?? 0);

    $formatCurrency = function ($value) {
        return 'Rp ' . number_format((float) $value, 0, ',', '.');
    };
@endphp

<div class="rounded-2xl bg-white p-6 shadow-lg">

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
            <span>Subtotal</span>
            <span>
                {{ $formatCurrency($price) }}
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
            <span>
                {{ $formatCurrency($discount) }}
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