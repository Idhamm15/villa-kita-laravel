@props([
    'value' => '',
])

@php
    $virtualAccounts = [
        [
            'label' => 'BCA Virtual Account',
            'value' => 'bca',
        ],
        [
            'label' => 'BNI Virtual Account',
            'value' => 'bni',
        ],
        [
            'label' => 'BRI Virtual Account',
            'value' => 'bri',
        ],
        [
            'label' => 'Mandiri Bill',
            'value' => 'mandiri',
        ],
        [
            'label' => 'Permata Virtual Account',
            'value' => 'permata',
        ],
        [
            'label' => 'CIMB Virtual Account',
            'value' => 'cimb',
        ],
    ];

    $eWallets = [
        [
            'label' => 'GoPay',
            'value' => 'gopay',
        ],
        [
            'label' => 'ShopeePay',
            'value' => 'shopeepay',
        ],
    ];

    $qrPayments = [
        [
            'label' => 'QRIS (DANA, OVO, GoPay, LinkAja, dll)',
            'value' => 'qris',
        ],
    ];
@endphp

<div class="rounded-2xl bg-white p-6 shadow-sm">

    <h2 class="mb-6 text-xl font-bold">
        Payment Method
    </h2>

    <div class="space-y-8">

        {{-- Virtual Account --}}
        <div>
            <div class="mb-4 flex items-center gap-2">
                <i class="fa-solid fa-building-columns text-blue-600"></i>

                <span class="font-semibold">
                    Virtual Account
                </span>
            </div>

            <div class="space-y-3">
                @foreach ($virtualAccounts as $item)
                    <label
                        class="
                            flex cursor-pointer items-center justify-between
                            rounded-xl border p-4 transition
                            {{ $value === $item['value']
                                ? 'border-blue-600 bg-blue-50'
                                : 'hover:border-blue-300' }}
                        "
                    >
                        <div class="flex items-center gap-3">
                            <input
                                type="radio"
                                name="paymentMethod"
                                value="{{ $item['value'] }}"
                                {{ $value === $item['value'] ? 'checked' : '' }}
                            >

                            <span>
                                {{ $item['label'] }}
                            </span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- E-Wallet --}}
        <div>
            <div class="mb-4 flex items-center gap-2">
                <i class="fa-solid fa-wallet text-blue-600"></i>

                <span class="font-semibold">
                    E-Wallet
                </span>
            </div>

            <div class="space-y-3">
                @foreach ($eWallets as $item)
                    <label
                        class="
                            flex cursor-pointer items-center justify-between
                            rounded-xl border p-4 transition
                            {{ $value === $item['value']
                                ? 'border-blue-600 bg-blue-50'
                                : 'hover:border-blue-300' }}
                        "
                    >
                        <div class="flex items-center gap-3">
                            <input
                                type="radio"
                                name="paymentMethod"
                                value="{{ $item['value'] }}"
                                {{ $value === $item['value'] ? 'checked' : '' }}
                            >

                            <span>
                                {{ $item['label'] }}
                            </span>
                        </div>
                    </label>
                @endforeach
            </div>
        </div>

        {{-- QRIS --}}
        <div>
            <div class="mb-4 flex items-center gap-2">
                <i class="fa-solid fa-qrcode text-blue-600"></i>

                <span class="font-semibold">
                    QRIS
                </span>
            </div>

            <div class="space-y-3">
                @foreach ($qrPayments as $item)
                    <label
                        class="
                            flex cursor-pointer items-center justify-between
                            rounded-xl border p-4 transition
                            {{ $value === $item['value']
                                ? 'border-blue-600 bg-blue-50'
                                : 'hover:border-blue-300' }}
                        "
                    >
                        <div class="flex items-center gap-3">
                            <input
                                type="radio"
                                name="paymentMethod"
                                value="{{ $item['value'] }}"
                                {{ $value === $item['value'] ? 'checked' : '' }}
                            >

                            <span>
                                {{ $item['label'] }}
                            </span>
                        </div>
                    </label>
                @endforeach
            </div>

            <p class="mt-3 text-sm text-gray-500">
                QRIS dapat dibayar menggunakan DANA, OVO,
                GoPay, LinkAja, mobile banking, dan aplikasi
                lain yang mendukung QRIS.
            </p>
        </div>

    </div>
</div>