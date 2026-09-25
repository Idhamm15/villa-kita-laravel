@php
    /*
    |--------------------------------------------------------------------------
    | Static Product Data
    |--------------------------------------------------------------------------
    */

    $product = [
        'name' => 'Villa Harmoni Tegal',
        'location' => 'Kota Tegal',
        'address' => 'Jl. Raya Tegal, Jawa Tengah',
        'description' => 'Villa nyaman dengan fasilitas lengkap yang cocok untuk keluarga maupun liburan bersama teman. Lokasi strategis dan mudah dijangkau dari berbagai tempat di Kota Tegal.',
        'isActive' => true,

        'maxGuest' => 6,
        'totalBedroom' => 3,
        'totalBathroom' => 2,

        'typeUnit' => 'Malam',

        'type' => 'VILLA',
        'bookingType' => 'MENGINAP',

        'stock' => 3,

        'price' => 750000,
        'priceStart' => 850000,

        'urlMaps' => 'https://maps.google.com/?q=-6.8696,109.1402',

        'mapEmbedUrl' => 'https://www.google.com/maps?q=-6.8696,109.1402&output=embed',
    ];

    /*
    |--------------------------------------------------------------------------
    | Gallery
    |--------------------------------------------------------------------------
    */

    $gallery = [
        'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=1200&q=80',
        'https://images.unsplash.com/photo-1600566753190-17f0baa2a6c3?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=800&q=80',
        'https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?auto=format&fit=crop&w=800&q=80',
    ];

    /*
    |--------------------------------------------------------------------------
    | Facilities
    |--------------------------------------------------------------------------
    */

    $facilityItems = [
        'WiFi Gratis',
        'Kolam Renang',
        'AC',
        'TV',
        'Parkir Gratis',
        'Dapur',
        'Kulkas',
        'Air Panas',
    ];

    /*
    |--------------------------------------------------------------------------
    | Reviews
    |--------------------------------------------------------------------------
    */

    $reviews = [
        [
            'id' => 1,
            'name' => 'Andi Pratama',
            'date' => '12 September 2026',
            'rating' => 5,
            'comment' => 'Villa sangat nyaman dan bersih. Fasilitas lengkap dan cocok untuk liburan bersama keluarga.',
        ],
        [
            'id' => 2,
            'name' => 'Siti Rahma',
            'date' => '8 September 2026',
            'rating' => 5,
            'comment' => 'Pelayanan bagus, lokasi mudah ditemukan dan suasananya sangat nyaman.',
        ],
        [
            'id' => 3,
            'name' => 'Budi Santoso',
            'date' => '2 September 2026',
            'rating' => 4,
            'comment' => 'Villa cukup luas dan fasilitasnya lengkap. Sangat cocok untuk keluarga.',
        ],
    ];
@endphp

<section class="z-50 -mt-10 rounded-t-[50px] bg-white pb-16">
    <div class="mx-auto -mt-24 max-w-7xl px-6">

        {{-- Gallery --}}
        <div class="mt-10 grid gap-3 shadow-2xl lg:grid-cols-3">

            {{-- Main Image --}}
            <div class="relative h-[420px] overflow-hidden rounded-2xl lg:col-span-2">
                <img
                    src="{{ $gallery[0] }}"
                    alt="{{ $product['name'] }}"
                    class="h-full w-full object-cover transition duration-500 hover:scale-105"
                >
            </div>

            {{-- Gallery Images --}}
            <div class="grid grid-cols-2 gap-3 shadow-2xl">
                @foreach (array_slice($gallery, 1) as $index => $img)
                    <div class="relative h-[200px] overflow-hidden rounded-2xl">
                        <img
                            src="{{ $img }}"
                            alt="{{ $product['name'] }} - {{ $index + 2 }}"
                            class="h-full w-full object-cover transition duration-500 hover:scale-105"
                        >

                        {{-- Overlay --}}
                        @if ($index === 3)
                            <div class="absolute inset-0 flex items-center justify-center bg-black/50">
                                <button
                                    type="button"
                                    class="flex items-center gap-2 rounded-lg bg-white/20 px-5 py-3 text-lg font-semibold text-white backdrop-blur-md"
                                >
                                    <i class="fa-solid fa-images"></i>
                                    Lihat Semua Foto
                                </button>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Product Header --}}
        <div class="mt-8 rounded-2xl bg-white p-8 shadow-lg">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h1 class="text-3xl font-bold text-slate-900">
                        {{ $product['name'] }}
                    </h1>

                    <p class="mt-2 text-lg text-slate-600">
                        {{ $product['location'] ?? $product['address'] }}
                    </p>
                </div>

                {{-- Status --}}
                <div class="space-y-2 text-right">
                    <p class="text-sm text-slate-500">
                        Status
                    </p>

                    @if ($product['isActive'])
                        <span class="inline-flex rounded-full bg-emerald-100 px-3 py-1 text-sm font-semibold text-emerald-700">
                            Open
                        </span>
                    @else
                        <span class="inline-flex rounded-full bg-rose-100 px-3 py-1 text-sm font-semibold text-rose-700">
                            Closed
                        </span>
                    @endif
                </div>
            </div>

            {{-- Property Information --}}
            <div class="mt-8 grid gap-6 lg:grid-cols-12">

                <div class="rounded-2xl bg-slate-50 p-6 shadow-sm lg:col-span-3">
                    <p class="text-sm font-semibold text-slate-500">
                        Max Tamu
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $product['maxGuest'] }}
                    </p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-6 shadow-sm lg:col-span-3">
                    <p class="text-sm font-semibold text-slate-500">
                        Kamar Tidur
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $product['totalBedroom'] }}
                    </p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-6 shadow-sm lg:col-span-3">
                    <p class="text-sm font-semibold text-slate-500">
                        Kamar Mandi
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $product['totalBathroom'] }}
                    </p>
                </div>

                <div class="rounded-2xl bg-slate-50 p-6 shadow-sm lg:col-span-3">
                    <p class="text-sm font-semibold text-slate-500">
                        Unit
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        /{{ $product['typeUnit'] }}
                    </p>
                </div>

            </div>
        </div>

        {{-- Description + Booking --}}
        <div class="mt-8 grid gap-6 lg:grid-cols-12">

            {{-- About --}}
            <div class="rounded-2xl bg-white p-8 shadow-lg lg:col-span-8">

                <div class="flex items-center gap-3 text-slate-900">
                    <i class="fa-regular fa-circle-question text-2xl text-blue-600"></i>

                    <span class="font-semibold">
                        Tentang {{ $product['type'] }}
                    </span>
                </div>

                <p class="mt-6 leading-8 text-slate-600">
                    {{ $product['description'] }}
                </p>

                {{-- Detail --}}
                <div class="mt-8 grid gap-4 sm:grid-cols-2">

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="font-semibold">
                            Kategori
                        </p>

                        <p class="mt-2 text-slate-600">
                            {{ $product['type'] }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="font-semibold">
                            Tipe Booking
                        </p>

                        <p class="mt-2 text-slate-600">
                            {{ $product['bookingType'] }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="font-semibold">
                            Alamat
                        </p>

                        <p class="mt-2 text-slate-600">
                            {{ $product['address'] }}
                        </p>
                    </div>

                    <div class="rounded-xl bg-slate-50 p-4">
                        <p class="font-semibold">
                            Jumlah Stok
                        </p>

                        <p class="mt-2 text-slate-600">
                            {{ $product['stock'] }}
                        </p>
                    </div>

                </div>

                {{-- Facilities --}}
                <div class="mt-8">

                    <h3 class="text-lg font-bold text-slate-900">
                        Fasilitas
                    </h3>

                    <ul class="mt-4 grid gap-3 sm:grid-cols-2">
                        @foreach ($facilityItems as $item)
                            <li class="rounded-xl bg-slate-50 p-4 text-slate-600">
                                <i class="fa-solid fa-check mr-2 text-emerald-500"></i>
                                {{ $item }}
                            </li>
                        @endforeach
                    </ul>

                </div>
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6 lg:col-span-4">

                {{-- Booking Card --}}
                <div class="rounded-2xl bg-white p-8 shadow-lg">

                    <p class="text-sm text-slate-500">
                        Booking mulai dari
                    </p>

                    <div class="mt-4 flex items-end gap-3">

                        <span class="text-4xl font-bold text-orange-600">
                            Rp {{ number_format($product['price'], 0, ',', '.') }}
                        </span>

                        <span class="pb-2 text-sm text-slate-500">
                            / malam
                        </span>

                    </div>

                    <p class="mt-2 text-sm text-slate-400 line-through">
                        Rp {{ number_format($product['priceStart'], 0, ',', '.') }}
                    </p>

                    <a
                        href="{{ url('/booking/' . 1) }}"
                        class="mt-8 inline-flex w-full items-center justify-center gap-2 rounded-xl bg-orange-500 px-6 py-3 text-white transition hover:bg-orange-600"
                    >
                        <i class="fa-regular fa-calendar-check"></i>
                        Pesan Sekarang
                    </a>

                </div>

                {{-- Location Card --}}
                <div class="rounded-2xl bg-white p-8 shadow-lg">

                    <div class="flex items-center gap-3">
                        <i class="fa-solid fa-location-dot text-2xl text-blue-600"></i>

                        <h2 class="text-xl font-bold text-blue-700">
                            Lokasi
                        </h2>
                    </div>

                    <hr class="my-5">

                    <div class="overflow-hidden rounded-xl border border-slate-200">
                        <iframe
                            src="{{ $product['mapEmbedUrl'] }}"
                            width="100%"
                            height="200"
                            loading="lazy"
                            allowfullscreen
                            referrerpolicy="no-referrer-when-downgrade"
                            class="border-0"
                        ></iframe>
                    </div>

                    <div class="mt-4">

                        <h3 class="font-semibold text-slate-800">
                            {{ $product['name'] }}
                        </h3>

                        <p class="text-sm text-slate-600">
                            {{ $product['address'] }}
                        </p>

                        <a
                            href="{{ $product['urlMaps'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="mt-3 inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-white transition hover:bg-blue-700"
                        >
                            <i class="fa-solid fa-map-location-dot mr-2"></i>
                            Buka di Google Maps
                        </a>

                    </div>
                </div>

            </div>
        </div>

        {{-- Reviews --}}
        <div class="mt-10 rounded-2xl bg-white p-8 shadow-lg">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-3">
                    <i class="fa-regular fa-message text-2xl text-blue-600"></i>

                    <h2 class="text-xl font-bold text-blue-700">
                        Rating & Ulasan
                    </h2>
                </div>

                <div class="text-right">

                    <div class="flex items-center justify-end gap-1">

                        <i class="fa-solid fa-star text-xl text-yellow-400"></i>

                        <span class="text-2xl font-bold">
                            4.9
                        </span>

                    </div>

                    <p class="text-sm text-slate-500">
                        124 Ulasan
                    </p>

                </div>
            </div>

            <hr class="my-6">

            {{-- Reviews Grid --}}
            <div class="grid gap-5 md:grid-cols-2">

                @foreach ($reviews as $review)

                    <div class="h-full rounded-xl border border-slate-200 p-6 transition hover:shadow-md">

                        <div class="flex items-center gap-3">

                            <div class="flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-lg font-bold text-white">
                                {{ strtoupper(substr($review['name'], 0, 1)) }}
                            </div>

                            <div>
                                <h3 class="font-semibold">
                                    {{ $review['name'] }}
                                </h3>

                                <p class="text-sm text-slate-500">
                                    {{ $review['date'] }}
                                </p>
                            </div>

                        </div>

                        {{-- Rating --}}
                        <div class="my-4 flex gap-1">

                            @for ($i = 1; $i <= 5; $i++)

                                @if ($i <= $review['rating'])
                                    <i class="fa-solid fa-star text-lg text-yellow-400"></i>
                                @else
                                    <i class="fa-regular fa-star text-lg text-slate-300"></i>
                                @endif

                            @endfor

                        </div>

                        <p class="leading-7 text-slate-600">
                            "{{ $review['comment'] }}"
                        </p>

                    </div>

                @endforeach

            </div>

        </div>

    </div>
</section>