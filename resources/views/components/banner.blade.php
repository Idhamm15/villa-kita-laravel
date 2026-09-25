@props([
    'breadcrumb' => null,
    'name' => null,
    'location' => null,
    'status' => null,
    'openTime' => null,
    'closeTime' => null,
    'showAction' => false,
])

<section class="relative overflow-hidden bg-sky-700 text-white">

    {{-- Background Decoration --}} 
    <div class="absolute -left-40 top-0 h-96 w-96 rounded-full bg-blue-500/30 blur-3xl"></div>

    <div class="absolute -right-40 top-0 h-96 w-96 rounded-full bg-cyan-400/20 blur-3xl"></div>

    <div class="relative mx-auto mb-20 max-w-7xl px-6 py-10">

        {{-- Breadcrumb --}}
        <div class="flex items-center gap-2 text-sm text-blue-100">

            <span>
                Home
            </span>

            @if ($breadcrumb)
                <i class="fa-solid fa-chevron-right text-xs"></i>

                <span>
                    {{ $breadcrumb }}
                </span>
            @endif

            @if ($name)
                <i class="fa-solid fa-chevron-right text-xs"></i>

                <span class="font-semibold text-lime-300">
                    {{ $name }}
                </span>
            @endif

        </div>

        {{-- Header --}}
        <div class="mt-6 flex flex-col gap-6 lg:flex-row lg:items-start lg:justify-between">

            <div>

                {{-- Name --}}
                @if ($name)
                    <h1 class="text-4xl font-bold">
                        {{ $name }}
                    </h1>
                @endif

                {{-- Location --}}
                @if ($location)
                    <div class="mt-4 flex items-center gap-2 text-lg text-blue-100">

                        <i class="fa-solid fa-location-dot"></i>

                        <span>
                            {{ $location }}
                        </span>

                    </div>
                @endif

                {{-- Status & Opening Time --}}
                @if ($status || $openTime || $closeTime)

                    <div class="mt-3 flex items-center gap-2 text-lg">

                        <i class="fa-regular fa-clock"></i>

                        @if ($status)
                            <span class="font-semibold text-green-300">
                                {{ $status }}
                            </span>
                        @endif

                        @if ($status && ($openTime || $closeTime))
                            <span>
                                |
                            </span>
                        @endif

                        @if ($openTime || $closeTime)
                            <span>
                                {{ $openTime }}

                                @if ($openTime && $closeTime)
                                    -
                                @endif

                                {{ $closeTime }}
                            </span>
                        @endif

                    </div>

                @endif

            </div>

            {{-- Actions --}}
            @if ($showAction)

                <div class="flex gap-4">

                    {{-- Share --}}
                    <button
                        type="button"
                        class="rounded-full bg-white p-3 text-blue-600 transition hover:scale-105"
                        title="Bagikan"
                    >
                        <i class="fa-solid fa-share-nodes text-xl"></i>
                    </button>

                    {{-- Bookmark --}}
                    <button
                        type="button"
                        class="rounded-full bg-white p-3 text-blue-600 transition hover:scale-105"
                        title="Simpan"
                    >
                        <i class="fa-regular fa-bookmark text-xl"></i>
                    </button>

                </div>

            @endif

        </div>

    </div>

</section>
