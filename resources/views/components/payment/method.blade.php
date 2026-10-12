@props([
    'value' => '',
])

@php
    $virtualAccounts = [
        [
            'label' => 'BCA Virtual Account',
            'value' => 'bca',
            'image' => '/img/payment_method/bca.png',
        ],
        [
            'label' => 'BNI Virtual Account',
            'value' => 'bni',
            'image' => '/img/payment_method/bni.png',
        ],
        [
            'label' => 'BRI Virtual Account',
            'value' => 'bri',
            'image' => '/img/payment_method/bri.png',
        ],
        [
            'label' => 'Mandiri Bill',
            'value' => 'mandiri',
            'image' => '/img/payment_method/mandiri.png',
        ],
        [
            'label' => 'Permata Virtual Account',
            'value' => 'permata',
            'image' => '/img/payment_method/permata.png',
        ],
        [
            'label' => 'CIMB Virtual Account',
            'value' => 'cimb',
            'image' => '/img/payment_method/cimb.png',
        ],
    ];

    $eWallets = [
        [
            'label' => 'GoPay',
            'value' => 'gopay',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/8/86/Gopay_logo.svg',
        ],
        [
            'label' => 'ShopeePay',
            'value' => 'shopeepay',
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/f/fe/Shopee.svg',
        ],
    ];

    $qrPayments = [
        [
            'label' => 'QRIS (DANA, OVO, GoPay, LinkAja, dll)',
            'value' => 'qris',
            'image' => '/img/payment_method/qris.png',
        ],
    ];
@endphp

<div class="p-6 bg-white shadow-sm rounded-2xl">

    <h2 class="mb-6 text-xl font-bold">
        Payment Method
    </h2>

    <div class="space-y-8">

        {{-- Virtual Account --}}
        <div>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-blue-600 fa-solid fa-building-columns"></i>
                <span class="font-semibold">Virtual Account</span>
            </div>

            <div class="space-y-3">
                @foreach ($virtualAccounts as $item)
                    <label
                        class="flex cursor-pointer items-center justify-between rounded-xl border p-4 transition
                        {{ $value === $item['value']
                            ? 'border-blue-600 bg-blue-50'
                            : 'hover:border-blue-300' }}"
                    >
                        <div class="flex items-center gap-3">
                            <input
                                type="radio"
                                name="payment_method"
                                value="{{ $item['value'] }}"
                                {{ $value === $item['value'] ? 'checked' : '' }}
                            >

                            <span>{{ $item['label'] }}</span>
                        </div>

                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['label'] }}"
                            class="object-contain w-16 h-8"
                            loading="lazy"
                        >
                    </label>
                @endforeach
            </div>
        </div>

        {{-- E-Wallet --}}
        {{-- <div>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-blue-600 fa-solid fa-wallet"></i>
                <span class="font-semibold">E-Wallet</span>
            </div>

            <div class="space-y-3">
                @foreach ($eWallets as $item)
                    <label
                        class="flex cursor-pointer items-center justify-between rounded-xl border p-4 transition
                        {{ $value === $item['value']
                            ? 'border-blue-600 bg-blue-50'
                            : 'hover:border-blue-300' }}"
                    >
                        <div class="flex items-center gap-3">
                            <input
                                type="radio"
                                name="payment_method"
                                value="{{ $item['value'] }}"
                                {{ $value === $item['value'] ? 'checked' : '' }}
                            >

                            <span>{{ $item['label'] }}</span>
                        </div>

                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['label'] }}"
                            class="object-contain w-16 h-8"
                            loading="lazy"
                        >
                    </label>
                @endforeach
            </div>
        </div> --}}

        {{-- QRIS --}}
        {{-- <div>
            <div class="flex items-center gap-2 mb-4">
                <i class="text-blue-600 fa-solid fa-qrcode"></i>
                <span class="font-semibold">QRIS</span>
            </div>

            <div class="space-y-3">
                @foreach ($qrPayments as $item)
                    <label
                        class="flex cursor-pointer items-center justify-between rounded-xl border p-4 transition
                        {{ $value === $item['value']
                            ? 'border-blue-600 bg-blue-50'
                            : 'hover:border-blue-300' }}"
                    >
                        <div class="flex items-center gap-3">
                            <input
                                type="radio"
                                name="payment_method"
                                value="{{ $item['value'] }}"
                                {{ $value === $item['value'] ? 'checked' : '' }}
                            >

                            <span>{{ $item['label'] }}</span>
                        </div>

                        <img
                            src="{{ $item['image'] }}"
                            alt="{{ $item['label'] }}"
                            class="object-contain w-16 h-8"
                            loading="lazy"
                        >
                    </label>
                @endforeach
            </div>

            <p class="mt-3 text-sm text-gray-500">
                QRIS dapat dibayar menggunakan DANA, OVO, GoPay,
                LinkAja, mobile banking, dan aplikasi lain yang mendukung QRIS.
            </p>
        </div> --}}
    
    </div>
</div>