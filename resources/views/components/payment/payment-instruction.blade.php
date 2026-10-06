@props([
    'booking',
])

@php
    $paymentStatus = strtoupper(trim($booking->payment_status ?? $booking->paymentStatus ?? ''));

    $paymentMethod = $booking->payment_method ?? $booking->paymentMethod ?? '-';

    $virtualAccounts = [
        [
            'value' => 'BCA',
            'label' => 'BCA Virtual Account',
        ],
        [
            'value' => 'BNI',
            'label' => 'BNI Virtual Account',
        ],
        [
            'value' => 'BRI',
            'label' => 'BRI Virtual Account',
        ],
        [
            'value' => 'MANDIRI',
            'label' => 'Mandiri Virtual Account',
        ],
        [
            'value' => 'CIMB',
            'label' => 'CIMB Virtual Account',
        ],
    ];

    $paymentMethodData = collect($virtualAccounts)
        ->firstWhere('value', $paymentMethod);

    $paymentMethodLabel = $paymentMethodData['label'] ?? $paymentMethod;

    $paymentToken = $booking->payment_token ?? $booking->paymentToken ?? null;

    $totalPrice = $booking->total_price ?? $booking->totalPrice ?? 0;
@endphp


<div class="overflow-hidden bg-white shadow-lg rounded-2xl">

    {{-- Header --}}
    <div class="flex items-center justify-between px-6 py-5 bg-blue-100">

        <h2 class="text-2xl font-bold">
            {{ $paymentMethodLabel }}
        </h2>

    </div>


    {{-- Information --}}
    <div class="p-4 text-yellow-700 border-l-4 border-yellow-400 bg-yellow-50">
        You can only transfer from {{ $paymentMethodLabel }}.
    </div>


    {{-- Payment Status --}}
    <div class="flex items-center justify-between px-6 py-4 bg-white border-b">

        <span class="text-sm text-gray-500">
            Payment Status
        </span>

        @php
            $statusClass = match ($paymentStatus) {
                'PAID' => 'bg-green-100 text-green-700',
                'PENDING' => 'bg-yellow-100 text-yellow-700',
                'EXPIRED', 'FAILED' => 'bg-red-100 text-red-700',
                default => 'bg-gray-100 text-gray-700',
            };
        @endphp

        <span
            class="px-3 py-1 text-sm font-semibold rounded-full {{ $statusClass }}"
        >
            {{ $paymentStatus ?: '-' }}
        </span>

    </div>


    <div class="divide-y">

        {{-- Account Number --}}
        <div class="flex items-center justify-between p-6">

            <div>

                <p class="text-gray-500">
                    Account Number
                </p>

                <h3 class="mt-2 text-2xl font-bold">
                    {{ $paymentToken ?? 'Loading...' }}
                </h3>

            </div>

            <button
                type="button"
                {{ !$paymentToken ? 'disabled' : '' }}
                onclick="copyPaymentText(
                    '{{ $paymentToken }}',
                    'Account number successfully copied.'
                )"
                class="text-gray-700 transition hover:text-blue-600 disabled:cursor-not-allowed disabled:opacity-50"
            >
                <i class="text-lg fa-regular fa-copy"></i>
            </button>

        </div>


        {{-- Account Holder --}}
        <div class="flex justify-between p-6">

            <div>

                <p class="text-gray-500">
                    Account Holder
                </p>

                <h3 class="mt-2 font-semibold">
                    PT Villa Kita Indonesia
                </h3>

            </div>

        </div>


        {{-- Transfer Amount --}}
        <div class="flex items-center justify-between p-6">

            <div>

                <p class="text-gray-500">
                    Transfer Amount
                </p>

                <h3 class="mt-2 text-2xl font-bold text-blue-600">
                    Rp {{ number_format($totalPrice, 0, ',', '.') }}
                </h3>

            </div>

            <button
                type="button"
                onclick="copyPaymentText(
                    '{{ $totalPrice }}',
                    'Transfer amount successfully copied.'
                )"
                class="font-semibold text-blue-600 transition hover:text-blue-800"
            >
                <i class="text-lg fa-regular fa-copy"></i>
            </button>

        </div>

    </div>

</div>


<script>
    function copyPaymentText(text, message = 'Successfully copied.') {

        if (!text) {
            return;
        }

        navigator.clipboard.writeText(text)
            .then(() => {

                // Jika SweetAlert2 tersedia
                if (typeof Swal !== 'undefined') {

                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: message,
                        showConfirmButton: false,
                        timer: 2000,
                        timerProgressBar: true
                    });

                } else {

                    alert(message);

                }

            })
            .catch(() => {

                alert('Failed to copy.');

            });

    }
</script>