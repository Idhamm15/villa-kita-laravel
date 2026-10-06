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
    <div class="px-6 mx-auto -mt-24 max-w-7xl">

        {{-- Gallery --}}
        <div class="grid gap-3 mt-10 shadow-2xl lg:grid-cols-3">

            {{-- Main Image --}}
            <div class="relative h-[420px] overflow-hidden rounded-2xl lg:col-span-2">
                <img
                    src="{{ $data['thumbnail'] ? asset('storage/' . $data['thumbnail']) : '' }}"
                    alt="{{ $data['name'] }}"
                    class="object-cover w-full h-full transition duration-500 hover:scale-105"
                >
            </div>

            {{-- Gallery Images --}}
            <div class="grid grid-cols-2 gap-3 shadow-2xl">

                @foreach ($data->images as $index => $img)

                    <div
                        class="relative h-[200px] overflow-hidden rounded-2xl cursor-pointer"
                        onclick="openGallery({{ $index }})"
                    >

                        <img
                            src="{{ asset('storage/' . $img->image) }}"
                            alt="{{ $data->name }} - {{ $index + 1 }}"
                            class="object-cover w-full h-full transition duration-500 hover:scale-105"
                        >

                        {{-- Overlay --}}
                        @if ($index === 3 && $data->images->count() > 4)
                            <div class="absolute inset-0 flex items-center justify-center bg-black/50">

                                <div class="flex items-center gap-2 px-5 py-3 text-lg font-semibold text-white rounded-lg bg-white/20 backdrop-blur-md">
                                    <i class="fa-solid fa-images"></i>
                                    Lihat Semua Foto
                                </div>

                            </div>
                        @endif

                    </div>

                @endforeach

            </div>


            {{-- Gallery Popup --}}
            <div
                id="gallery-modal"
                class="fixed inset-0 z-[9999] items-center justify-center hidden bg-black/90"
            >

                {{-- Close --}}
                <button
                    type="button"
                    onclick="closeGallery()"
                    class="absolute z-10 flex items-center justify-center w-10 h-10 text-2xl text-white rounded-full top-5 right-5 bg-white/10 hover:bg-white/20"
                >
                    <i class="fa-solid fa-xmark"></i>
                </button>


                {{-- Previous --}}
                <button
                    type="button"
                    onclick="previousImage()"
                    class="absolute z-10 flex items-center justify-center w-12 h-12 text-xl text-white rounded-full left-4 bg-white/10 hover:bg-white/20"
                >
                    <i class="fa-solid fa-chevron-left"></i>
                </button>


                {{-- Image --}}
                <div class="flex items-center justify-center w-full h-full px-20 py-16">

                    <img
                        id="gallery-image"
                        src=""
                        alt="Gallery"
                        class="object-contain max-w-full max-h-full rounded-xl"
                    >

                </div>


                {{-- Next --}}
                <button
                    type="button"
                    onclick="nextImage()"
                    class="absolute z-10 flex items-center justify-center w-12 h-12 text-xl text-white rounded-full right-4 bg-white/10 hover:bg-white/20"
                >
                    <i class="fa-solid fa-chevron-right"></i>
                </button>


                {{-- Counter --}}
                <div
                    id="gallery-counter"
                    class="absolute px-4 py-2 text-sm text-white -translate-x-1/2 rounded-lg bottom-5 left-1/2 bg-black/50"
                ></div>

            </div>

        </div>

        {{-- Product Header --}}
        <div class="p-8 mt-8 bg-white shadow-lg rounded-2xl">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">

                <div>
                    <h1 class="text-3xl font-bold text-slate-900">
                        {{ $data['name'] }}
                    </h1>

                    <p class="mt-2 text-lg text-slate-600">
                        {{ $data['location'] ?? $data['address'] }}
                    </p>
                </div>

                {{-- Status --}}
                <div class="space-y-2 text-right">
                    <p class="text-sm text-slate-500">
                        Status
                    </p>

                    @if ($product['isActive'])
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-emerald-100 text-emerald-700">
                            Open
                        </span>
                    @else
                        <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-rose-100 text-rose-700">
                            Closed
                        </span>
                    @endif
                </div>
            </div>

            {{-- Property Information --}}
            <div class="grid gap-6 mt-8 lg:grid-cols-12">

                <div class="p-6 shadow-sm rounded-2xl bg-slate-50 lg:col-span-3">
                    <p class="text-sm font-semibold text-slate-500">
                        Max Tamu
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $data['max_guest'] ?? '-' }}
                    </p>
                </div>

                <div class="p-6 shadow-sm rounded-2xl bg-slate-50 lg:col-span-3">
                    <p class="text-sm font-semibold text-slate-500">
                        Kamar Tidur
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $data['total_bedroom'] ?? '-' }}
                    </p>
                </div>

                <div class="p-6 shadow-sm rounded-2xl bg-slate-50 lg:col-span-3">
                    <p class="text-sm font-semibold text-slate-500">
                        Kamar Mandi
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        {{ $data['total_bathroom'] ?? '-' }}
                    </p>
                </div>

                <div class="p-6 shadow-sm rounded-2xl bg-slate-50 lg:col-span-3">
                    <p class="text-sm font-semibold text-slate-500">
                        Unit
                    </p>

                    <p class="mt-2 text-3xl font-bold text-slate-900">
                        /{{ $data['type'] ?? '-' }}
                    </p>
                </div>

            </div>
        </div>

        {{-- Description + Booking --}}
        <div class="grid gap-6 mt-8 lg:grid-cols-12">

            {{-- About --}}
            <div class="p-8 bg-white shadow-lg rounded-2xl lg:col-span-8">

                <div class="flex items-center gap-3 text-slate-900">
                    <i class="text-2xl text-blue-600 fa-regular fa-circle-question"></i>

                    <span class="font-semibold">
                        Tentang {{ $data['type'] }}
                    </span>
                </div>

                <p class="mt-6 leading-8 text-slate-600">
                    {{ $data['description'] }}
                </p>

                {{-- Detail --}}
                <div class="grid gap-4 mt-8 sm:grid-cols-2">

                    <div class="p-4 rounded-xl bg-slate-50">
                        <p class="font-semibold">
                            Kategori
                        </p>

                        <p class="mt-2 text-slate-600">
                            {{ $data['type'] }}
                        </p>
                    </div>

                    <div class="p-4 rounded-xl bg-slate-50">
                        <p class="font-semibold">
                            Tipe Booking
                        </p>

                        <p class="mt-2 text-slate-600">
                            {{ $data['booking_type'] }}
                        </p>
                    </div>

                    <div class="p-4 rounded-xl bg-slate-50">
                        <p class="font-semibold">
                            Alamat
                        </p>

                        <p class="mt-2 text-slate-600">
                            {{ $data['address'] }}
                        </p>
                    </div>

                    <div class="p-4 rounded-xl bg-slate-50">
                        <p class="font-semibold">
                            Jumlah Stok
                        </p>

                        <p class="mt-2 text-slate-600">
                            {{ $data['stock'] ?? '-' }}
                        </p>
                    </div>

                </div>

                {{-- Facilities --}}
                <div class="mt-8">

                    <h3 class="text-lg font-bold text-slate-900">
                        Fasilitas
                    </h3>

                    <ul class="grid gap-3 mt-4 sm:grid-cols-2">
                        @foreach ($data->items->where('type', 'FACILITY') as $item)
                            <li class="p-4 rounded-xl bg-slate-50 text-slate-600">
                                <i class="mr-2 fa-solid fa-check text-emerald-500"></i>
                                {{ $item->name }}
                            </li>
                        @endforeach
                    </ul>

                </div>

                {{-- Include --}}
                <div class="mt-8">

                    <h3 class="text-lg font-bold text-slate-900">
                        Termasuk
                    </h3>

                    <ul class="grid gap-3 mt-4 sm:grid-cols-2">
                        @foreach ($data->items->where('type', 'INCLUDE') as $item)
                            <li class="p-4 rounded-xl bg-slate-50 text-slate-600">
                                <i class="mr-2 fa-solid fa-check text-emerald-500"></i>
                                {{ $item->name }}
                            </li>
                        @endforeach
                    </ul>

                </div>

                {{-- Exclude --}}
                <div class="mt-8">

                    <h3 class="text-lg font-bold text-slate-900">
                        Tidak Termasuk
                    </h3>

                    <ul class="grid gap-3 mt-4 sm:grid-cols-2">
                        @foreach ($data->items->where('type', 'EXCLUDE') as $item)
                            <li class="p-4 rounded-xl bg-slate-50 text-slate-600">
                                <i class="mr-2 fa-solid fa-check text-emerald-500"></i>
                                {{ $item->name }}
                            </li>
                        @endforeach
                    </ul>

                </div>
                
            </div>

            {{-- Sidebar --}}
            <div class="space-y-6 lg:col-span-4">

                {{-- Booking Card --}}
                <div class="p-8 bg-white shadow-lg rounded-2xl">

                    <p class="text-sm text-slate-500">
                        Booking mulai dari
                    </p>

                    <div class="flex items-end gap-3 mt-4">

                        <span class="text-4xl font-bold text-orange-600">
                            Rp {{ number_format($data->price, 0, ',', '.') }}
                        </span>

                        <span class="pb-2 text-sm text-slate-500">
                            {{ $data->type === 'VILLA' ? '/ malam' : '/ trip' }}
                        </span>

                    </div>

                    <p class="mt-2 text-sm line-through text-slate-400">
                        Rp {{ number_format($data['start_price'], 0, ',', '.') }}
                    </p>

                    <a
                        href="{{ url('/booking/' . 1) }}"
                        class="inline-flex items-center justify-center w-full gap-2 px-6 py-3 mt-8 text-white transition bg-orange-500 rounded-xl hover:bg-orange-600"
                    >
                        <i class="fa-regular fa-calendar-check"></i>
                        Pesan Sekarang
                    </a>

                </div>

                {{-- Location Card --}}
                <div class="p-8 bg-white shadow-lg rounded-2xl">

                    <div class="flex items-center gap-3">
                        <i class="text-2xl text-blue-600 fa-solid fa-location-dot"></i>

                        <h2 class="text-xl font-bold text-blue-700">
                            Lokasi
                        </h2>
                    </div>

                    <hr class="my-5">

                    @php
                            $mapsUrl = $data['url_maps'] ?? null;

                            if ($mapsUrl) {
                                $embedUrl = 'https://www.google.com/maps?q=' . urlencode($mapsUrl) . '&output=embed';
                            }
                        @endphp

                        @if ($embedUrl ?? false)
                            <div class="overflow-hidden border rounded-xl border-slate-200">
                                <iframe
                                    src="{{ $embedUrl }}"
                                    width="100%"
                                    height="200"
                                    loading="lazy"
                                    allowfullscreen
                                    referrerpolicy="no-referrer-when-downgrade"
                                    class="border-0"
                                ></iframe>
                            </div>
                        @endif

                    <div class="mt-4">

                        <h3 class="font-semibold text-slate-800">
                            {{ $data['location'] }}
                        </h3>

                        <p class="text-sm text-slate-600">
                            {{ $data['address'] }}
                        </p>

                        <a
                            href="{{ $data['url_maps'] }}"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="inline-flex items-center px-4 py-2 mt-3 text-white transition bg-blue-600 rounded-lg hover:bg-blue-700"
                        >
                            <i class="mr-2 fa-solid fa-map-location-dot"></i>
                            Buka di Google Maps
                        </a>

                    </div>
                </div>

            </div>
        </div>

        {{-- Reviews --}}
        <div class="p-8 mt-10 bg-white shadow-lg rounded-2xl">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-3">
                    <i class="text-2xl text-blue-600 fa-regular fa-message"></i>

                    <h2 class="text-xl font-bold text-blue-700">
                        Rating & Ulasan
                    </h2>
                </div>

                <div class="text-right">

                    <div class="flex items-center justify-end gap-1">

                        <i class="text-xl text-yellow-400 fa-solid fa-star"></i>

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

                    <div class="h-full p-6 transition border rounded-xl border-slate-200 hover:shadow-md">

                        <div class="flex items-center gap-3">

                            <div class="flex items-center justify-center w-12 h-12 text-lg font-bold text-white bg-blue-600 rounded-full">
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
                        <div class="flex gap-1 my-4">

                            @for ($i = 1; $i <= 5; $i++)

                                @if ($i <= $review['rating'])
                                    <i class="text-lg text-yellow-400 fa-solid fa-star"></i>
                                @else
                                    <i class="text-lg fa-regular fa-star text-slate-300"></i>
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

    

    <script>
        const galleryImages = @json(
            $data->images->map(function ($img) {
                return asset('storage/' . $img->image);
            })->values()
        );

        let currentImageIndex = 0;

        function openGallery(index) {

            currentImageIndex = index;

            const modal = document.getElementById('gallery-modal');

            modal.classList.remove('hidden');
            modal.classList.add('flex');

            document.body.classList.add('overflow-hidden');

            updateGallery();
        }

        function closeGallery() {

            const modal = document.getElementById('gallery-modal');

            modal.classList.add('hidden');
            modal.classList.remove('flex');

            document.body.classList.remove('overflow-hidden');
        }

        function updateGallery() {

            const image = document.getElementById('gallery-image');
            const counter = document.getElementById('gallery-counter');

            image.src = galleryImages[currentImageIndex];

            counter.textContent =
                `${currentImageIndex + 1} / ${galleryImages.length}`;
        }

        function nextImage() {

            currentImageIndex++;

            if (currentImageIndex >= galleryImages.length) {
                currentImageIndex = 0;
            }

            updateGallery();
        }

        function previousImage() {

            currentImageIndex--;

            if (currentImageIndex < 0) {
                currentImageIndex = galleryImages.length - 1;
            }

            updateGallery();
        }


        // ESC untuk menutup
        document.addEventListener('keydown', function (event) {

            const modal = document.getElementById('gallery-modal');

            if (modal.classList.contains('hidden')) {
                return;
            }

            if (event.key === 'Escape') {
                closeGallery();
            }

            if (event.key === 'ArrowRight') {
                nextImage();
            }

            if (event.key === 'ArrowLeft') {
                previousImage();
            }

        });
    </script>
</section>