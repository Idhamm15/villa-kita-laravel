@php
    $paymentStatus = strtoupper(trim(
        $booking['paymentStatus'] ?? $booking['payment_status'] ?? ''
    ));

    $paymentMethod = strtoupper(trim(
        $booking['paymentMethod'] ?? $booking['payment_method'] ?? '-'
    ));

    $virtualAccounts = [
        'BCA' => [
            'label' => 'BCA Virtual Account',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/5/5c/Bank_Central_Asia.svg',
        ],
        'BNI' => [
            'label' => 'BNI Virtual Account',
            'image' => 'https://upload.wikimedia.org/wikipedia/id/5/55/BNI_logo.svg',
        ],
        'BRI' => [
            'label' => 'BRI Virtual Account',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/6/68/BANK_BRI_logo.svg',
        ],
        'MANDIRI' => [
            'label' => 'Mandiri Virtual Account',
            'image' => 'https://upload.wikimedia.org/wikipedia/id/9/92/Logo_Bank_Mandiri.svg',
        ],
        'CIMB' => [
            'label' => 'CIMB Virtual Account',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/1/1b/CIMB_Niaga_logo.svg',
        ],
    ];

    $paymentMethodData = $virtualAccounts[$paymentMethod] ?? null;
    $paymentMethodLabel = $paymentMethodData['label'] ?? $paymentMethod;
    $paymentMethodImage = $paymentMethodData['image'] ?? null;

    $paymentToken = $booking['paymentToken']
        ?? $booking['payment_token']
        ?? null;

    $totalPrice = (float) (
        $booking['totalPrice']
        ?? $booking['total_price']
        ?? 0
    );
@endphp



<div class="overflow-hidden bg-white shadow-lg rounded-2xl">

    {{-- Header --}}
    <div class="flex items-center justify-between px-6 py-5 bg-blue-100">
        <div class="flex items-center gap-4">
            @if ($paymentMethodImage)
                <img
                    src="{{ $paymentMethodImage }}"
                    alt="{{ $paymentMethodLabel }}"
                    class="object-contain w-16 h-10"
                    referrerpolicy="no-referrer"
                >
            @endif

            <h2 class="text-2xl font-bold uppercase">
                {{ $paymentMethodLabel }}
            </h2>
        </div>
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