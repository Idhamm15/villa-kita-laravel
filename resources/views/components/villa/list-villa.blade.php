@php
    $villas = [
        [
            'id' => 1,
            'name' => 'Villa Harmoni Tegal',
            'thumbnail' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?auto=format&fit=crop&w=800&q=80',
            'price' => 750000,
            'location' => 'KOTA TEGAL',
            'capacity' => 4,
        ],
        [
            'id' => 2,
            'name' => 'Villa Bahagia Tegal',
            'thumbnail' => 'https://images.unsplash.com/photo-1601918774946-25832a4be0d6?auto=format&fit=crop&w=800&q=80',
            'price' => 850000,
            'location' => 'KABUPATEN TEGAL',
            'capacity' => 6,
        ],
        [
            'id' => 3,
            'name' => 'Villa Puncak Indah',
            'thumbnail' => 'https://images.unsplash.com/photo-1582268611958-ebfd161ef9cf?auto=format&fit=crop&w=800&q=80',
            'price' => 950000,
            'location' => 'KOTA TEGAL',
            'capacity' => 2,
        ],
        [
            'id' => 4,
            'name' => 'Villa Keluarga Sejahtera',
            'thumbnail' => 'https://images.unsplash.com/photo-1544986581-efac024faf62?auto=format&fit=crop&w=800&q=80',
            'price' => 1200000,
            'location' => 'KABUPATEN TEGAL',
            'capacity' => 6,
        ],
        [
            'id' => 5,
            'name' => 'Villa Sunset View',
            'thumbnail' => 'https://images.unsplash.com/photo-1584132967334-10e028bd69f7?auto=format&fit=crop&w=800&q=80',
            'price' => 650000,
            'location' => 'KOTA TEGAL',
            'capacity' => 4,
        ],
        [
            'id' => 6,
            'name' => 'Villa Asri Tegal',
            'thumbnail' => 'https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?auto=format&fit=crop&w=800&q=80',
            'price' => 900000,
            'location' => 'KABUPATEN TEGAL',
            'capacity' => 4,
        ],
    ];
@endphp


<section class="bg-gray-100 py-10">

    <div class="mx-auto max-w-7xl px-5">

        <div class="grid gap-8 lg:grid-cols-12">

            {{-- ================= SIDEBAR ================= --}}
            <aside class="space-y-5 lg:col-span-3">

                {{-- Search --}}
                <div class="rounded-lg bg-white p-4 shadow">

                    <div class="relative">

                        <i
                            class="fa-solid fa-magnifying-glass absolute left-3 top-3 text-gray-400"
                        ></i>

                        <input
                            type="text"
                            placeholder="Type villa name"
                            class="w-full rounded-md border py-2 pl-10 pr-3 text-sm outline-none focus:border-blue-500 focus:ring-0"
                        >

                    </div>

                </div>


                {{-- Capacity --}}
                <div class="rounded-lg bg-white p-4 shadow">

                    <h3 class="mb-4 font-semibold text-gray-700">
                        Villa capacity
                    </h3>

                    <div class="space-y-3">

                        <label class="flex cursor-pointer items-center gap-3">
                            <input
                                type="checkbox"
                                class="rounded border-gray-300 text-blue-500 focus:ring-blue-500"
                            >

                            <span class="text-gray-700">
                                4 Person(s)
                            </span>
                        </label>

                        <label class="flex cursor-pointer items-center gap-3">
                            <input
                                type="checkbox"
                                class="rounded border-gray-300 text-blue-500 focus:ring-blue-500"
                            >

                            <span class="text-gray-700">
                                6 Person(s)
                            </span>
                        </label>

                        <label class="flex cursor-pointer items-center gap-3">
                            <input
                                type="checkbox"
                                class="rounded border-gray-300 text-blue-500 focus:ring-blue-500"
                            >

                            <span class="text-gray-700">
                                2 Person(s)
                            </span>
                        </label>

                    </div>

                </div>


                {{-- Location --}}
                <div class="rounded-lg bg-white p-4 shadow">

                    <h3 class="mb-4 font-semibold text-gray-700">
                        Locations
                    </h3>

                    <div class="space-y-4">

                        <label class="flex cursor-pointer items-center gap-3">

                            <input
                                type="checkbox"
                                checked
                                class="rounded border-gray-300 text-blue-500 focus:ring-blue-500"
                            >

                            <span class="text-gray-700">
                                All
                            </span>

                        </label>


                        <label class="flex cursor-pointer items-start gap-3">

                            <input
                                type="checkbox"
                                class="mt-1 rounded border-gray-300 text-blue-500 focus:ring-blue-500"
                            >

                            <div>

                                <p class="text-gray-700">
                                    KOTA TEGAL
                                </p>

                                <small class="text-gray-500">
                                    JAWA TENGAH
                                </small>

                            </div>

                        </label>


                        <label class="flex cursor-pointer items-start gap-3">

                            <input
                                type="checkbox"
                                class="mt-1 rounded border-gray-300 text-blue-500 focus:ring-blue-500"
                            >

                            <div>

                                <p class="text-gray-700">
                                    KABUPATEN TEGAL
                                </p>

                                <small class="text-gray-500">
                                    JAWA TENGAH
                                </small>

                            </div>

                        </label>

                    </div>

                </div>


                {{-- Filter --}}
                <button
                    type="button"
                    class="w-full rounded-lg bg-orange-500 py-3 font-semibold text-white transition hover:bg-orange-600"
                >
                    Filter
                </button>

            </aside>


            {{-- ================= PRODUCT ================= --}}
            <main class="lg:col-span-9">

                <h2 class="mb-5 text-2xl font-bold text-gray-800">
                    Showing villa in all locations
                </h2>


                {{-- Villa Grid --}}
                <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                    @foreach ($villas as $villa)

                        <div
                            class="overflow-hidden rounded-lg bg-white shadow transition duration-300 hover:-translate-y-1 hover:shadow-lg"
                        >

                            {{-- Image --}}
                            <div class="relative h-52">

                                <img
                                    src="{{ $villa['thumbnail'] }}"
                                    alt="{{ $villa['name'] }}"
                                    class="h-full w-full object-cover"
                                >

                            </div>


                            {{-- Content --}}
                            <div class="p-4">

                                <a
                                    href="{{ url('/sewa-villa/' . $villa['id']) }}"
                                    class="line-clamp-2 text-lg font-bold leading-6 text-gray-700 transition hover:text-blue-600"
                                >
                                    {{ $villa['name'] }}
                                </a>


                                {{-- Duration --}}
                                <div class="mt-2 flex items-center gap-1 text-sm text-orange-500">

                                    <i class="fa-regular fa-clock"></i>

                                    <span>
                                        24 Hours
                                    </span>

                                </div>


                                {{-- Price --}}
                                <p class="mt-2 text-sm text-gray-500">

                                    Menu start from

                                    <span class="font-semibold text-blue-600">
                                        Rp {{ number_format($villa['price'], 0, ',', '.') }}
                                    </span>

                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>


                {{-- Pagination --}}
                <div class="mt-10 flex justify-center">

                    <button
                        type="button"
                        class="h-10 w-10 rounded-full bg-blue-400 font-semibold text-white shadow"
                    >
                        1
                    </button>

                </div>

            </main>

        </div>

    </div>

</section>