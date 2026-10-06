<section id="blog-section" class="py-10 bg-gray-100">

    
    <div class="px-5 mx-auto max-w-7xl">

        <div class="grid gap-8 lg:grid-cols-12">

            {{-- ================= SIDEBAR ================= --}}
            <aside class="space-y-5 lg:col-span-3">

                {{-- Search --}}
                <div class="p-4 bg-white rounded-lg shadow">

                    <div class="relative">

                        <i
                            class="absolute text-gray-400 fa-solid fa-magnifying-glass left-3 top-3"
                        ></i>

                        <input
                            type="text"
                            placeholder="Type villa name"
                            class="w-full py-2 pl-10 pr-3 text-sm border rounded-md outline-none focus:border-blue-500 focus:ring-0"
                        >

                    </div>

                </div>


                {{-- Capacity --}}
                <div class="p-4 bg-white rounded-lg shadow">

                    <h3 class="mb-4 font-semibold text-gray-700">
                        Villa capacity
                    </h3>

                    <div class="space-y-3">

                        <label class="flex items-center gap-3 cursor-pointer">
                            <input
                                type="checkbox"
                                class="text-blue-500 border-gray-300 rounded focus:ring-blue-500"
                            >

                            <span class="text-gray-700">
                                4 Person(s)
                            </span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer">
                            <input
                                type="checkbox"
                                class="text-blue-500 border-gray-300 rounded focus:ring-blue-500"
                            >

                            <span class="text-gray-700">
                                6 Person(s)
                            </span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer">
                            <input
                                type="checkbox"
                                class="text-blue-500 border-gray-300 rounded focus:ring-blue-500"
                            >

                            <span class="text-gray-700">
                                2 Person(s)
                            </span>
                        </label>

                    </div>

                </div>


                {{-- Location --}}
                <div class="p-4 bg-white rounded-lg shadow">

                    <h3 class="mb-4 font-semibold text-gray-700">
                        Locations
                    </h3>

                    <div class="space-y-4">

                        <label class="flex items-center gap-3 cursor-pointer">

                            <input
                                type="checkbox"
                                checked
                                class="text-blue-500 border-gray-300 rounded focus:ring-blue-500"
                            >

                            <span class="text-gray-700">
                                All
                            </span>

                        </label>


                        <label class="flex items-start gap-3 cursor-pointer">

                            <input
                                type="checkbox"
                                class="mt-1 text-blue-500 border-gray-300 rounded focus:ring-blue-500"
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


                        <label class="flex items-start gap-3 cursor-pointer">

                            <input
                                type="checkbox"
                                class="mt-1 text-blue-500 border-gray-300 rounded focus:ring-blue-500"
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
                    class="w-full py-3 font-semibold text-white transition bg-orange-500 rounded-lg hover:bg-orange-600"
                >
                    Filter
                </button>

            </aside>


            {{-- ================= PRODUCT ================= --}}
            <main class="lg:col-span-9">

                <h2 class="mb-5 text-2xl font-bold text-gray-800">
                    Showing villa in all locations
                </h2>

                {{-- Product Wrapper --}}
                <div class="relative">

                    {{-- Loading --}}
                    <x-loading
                        id="villa-loading"
                        text="Memuat villa..."
                        duration="3000"
                    />

                    {{-- Villa Grid --}}
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">

                        @foreach ($data as $villa)

                            <div
                                class="overflow-hidden transition duration-300 bg-white rounded-lg shadow hover:-translate-y-1 hover:shadow-lg"
                            >

                                {{-- Image --}}
                                <div class="relative h-52">

                                    <img
                                        src="{{ asset('storage/' . $villa['thumbnail']) }}"
                                        alt="{{ $villa['name'] }}"
                                        class="object-cover w-full h-full"
                                    >

                                </div>

                                {{-- Content --}}
                                <div class="p-4">

                                    <a
                                        href="{{ url('/sewa-villa/' . $villa['id']) }}"
                                        class="text-lg font-bold leading-6 text-gray-700 transition line-clamp-2 hover:text-blue-600"
                                    >
                                        {{ $villa['name'] }}
                                    </a>

                                    {{-- Duration --}}
                                    <div class="flex items-center gap-1 mt-2 text-sm text-orange-500">

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

                    {{-- Pagination --}}
                    <div class="flex items-center justify-center gap-2 mt-10">

                        {{-- Previous --}}
                        @if ($data->onFirstPage())

                            <span
                                class="flex items-center justify-center w-10 h-10 text-gray-400 bg-gray-100 rounded-full"
                            >
                                <i class="fa-solid fa-chevron-left"></i>
                            </span>

                        @else

                            <a
                                href="{{ $data->previousPageUrl() }}"
                                class="flex items-center justify-center w-10 h-10 text-gray-600 transition bg-white border rounded-full hover:bg-blue-500 hover:text-white"
                            >
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>

                        @endif


                        {{-- Pages --}}
                        @foreach ($data->getUrlRange(1, $data->lastPage()) as $page => $url)

                            @if ($page == $data->currentPage())

                                <span
                                    class="flex items-center justify-center w-10 h-10 font-semibold text-white bg-blue-500 rounded-full shadow"
                                >
                                    {{ $page }}
                                </span>

                            @else

                                <a
                                    href="{{ $url }}"
                                    class="flex items-center justify-center w-10 h-10 font-semibold text-gray-600 transition bg-white border rounded-full hover:bg-blue-500 hover:text-white"
                                >
                                    {{ $page }}
                                </a>

                            @endif

                        @endforeach


                        {{-- Next --}}
                        @if ($data->hasMorePages())

                            <a
                                href="{{ $data->nextPageUrl() }}"
                                class="flex items-center justify-center w-10 h-10 text-gray-600 transition bg-white border rounded-full hover:bg-blue-500 hover:text-white"
                            >
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>

                        @else

                            <span
                                class="flex items-center justify-center w-10 h-10 text-gray-400 bg-gray-100 rounded-full"
                            >
                                <i class="fa-solid fa-chevron-right"></i>
                            </span>

                        @endif

                    </div>

                </div>

            </main>

        </div>

    </div>

</section>