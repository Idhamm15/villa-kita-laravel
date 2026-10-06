@php
    $villas = [
        [
            'id' => 1,
            'image' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80',
            'title' => 'Villa Nyaman dengan Pemandangan Pegunungan',
            'location' => 'Bogor, Jawa Barat',
            'price' => 750000,
            'type' => 'Malam',
            'link' => 'sewa-villa',
        ],
        [
            'id' => 2,
            'image' => 'https://images.unsplash.com/photo-1601918774946-25832a4be0d6?auto=format&fit=crop&w=800&q=80',
            'title' => 'Villa Modern untuk Liburan Keluarga',
            'location' => 'Bandung, Jawa Barat',
            'price' => 850000,
            'type' => 'Malam',
            'link' => 'sewa-villa',
        ],
        [
            'id' => 3,
            'image' => 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?auto=format&fit=crop&w=800&q=80',
            'title' => 'Villa Private dengan Kolam Renang',
            'location' => 'Puncak, Jawa Barat',
            'price' => 1200000,
            'type' => 'Malam',
            'link' => 'sewa-villa',
        ],
        [
            'id' => 4,
            'image' => 'https://images.unsplash.com/photo-1544986581-efac024faf62?auto=format&fit=crop&w=800&q=80',
            'title' => 'Villa Eksotis Dekat Pantai',
            'location' => 'Bali, Indonesia',
            'price' => 1500000,
            'type' => 'Malam',
            'link' => 'sewa-villa',
        ],
        [
            'id' => 5,
            'image' => 'https://images.unsplash.com/photo-1584132967334-10e028bd69f7?auto=format&fit=crop&w=800&q=80',
            'title' => 'Villa Mewah untuk Staycation',
            'location' => 'Yogyakarta, Indonesia',
            'price' => 950000,
            'type' => 'Malam',
            'link' => 'sewa-villa',
        ],
    ];
@endphp


<section class="relative z-10 -mt-20">

    <div class="mx-auto w-full rounded-tl-[40px] rounded-tr-[40px] bg-white px-10 py-12 shadow-xl">

        {{-- Title --}}
        <h2 class="text-3xl font-bold text-black">
            Top Villa Picks
        </h2>

        {{-- Description --}}
        <p class="mt-3 text-lg text-gray-500">
            Temukan villa terbaik untuk liburan bersama keluarga.
        </p>


        {{-- Villa List --}}
        <div class="grid grid-cols-1 gap-6 mt-10 md:grid-cols-2 lg:grid-cols-5">

            @foreach ($data as $villa)

                <div
                    class="overflow-hidden transition duration-300 bg-white shadow-2xl rounded-xl hover:-translate-y-1 hover:shadow-lg"
                >

                    {{-- Image --}}
                    <div class="relative w-full h-60">

                        <img
                            src="{{ $villa['thumbnail'] ? asset('storage/' . $villa['thumbnail']) : '' }}"
                            alt="{{ $villa['title'] }}"
                            class="object-cover w-full h-full"
                        >
                    </div>


                    {{-- Content --}}
                    <div class="p-4 space-y-3">

                        {{-- Title & Location --}}
                        <div>

                            <h3 class="text-xl font-semibold text-gray-700 line-clamp-2">
                                {{ $villa['title'] }}
                            </h3>

                            <p class="mt-1 text-gray-500">
                                {{ $villa['location'] }}
                            </p>

                        </div>


                        {{-- Check In --}}
                        <div class="flex items-center gap-2 text-orange-500">

                            <i class="fa-solid fa-clock"></i>

                            <span>
                                Check In 14.00
                            </span>

                        </div>


                        {{-- Price --}}
                        <div class="text-gray-400">

                            Start from

                            <span class="font-semibold text-sky-600">
                                Rp {{ number_format($villa['price'], 0, ',', '.') }}
                            </span>

                            <span class="text-gray-500">
                                / {{ $villa['type'] }}
                            </span>

                        </div>


                        {{-- Detail --}}
                        <a
                            href="{{ $villa['type'] === 'VILLA'
                                ? url('/sewa-villa/' . $villa['id'])
                                : url('/trip/' . $villa['id']) }}"
                            class="inline-flex items-center justify-center w-full px-4 py-3 mt-4 text-sm font-semibold text-white transition rounded-xl bg-sky-600 hover:bg-sky-700"
                        >
                            Lihat Detail
                        </a>

                    </div>

                </div>

            @endforeach

        </div>

    </div>

</section>