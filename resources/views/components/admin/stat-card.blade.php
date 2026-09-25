@props([
    'title',
    'value',
    'subtitle',
    'icon',
    'gradient',
])

<div class="rounded-3xl p-6 shadow-lg text-white {{ $gradient }}">

    {{-- HEADER --}}
    <div class="flex items-start justify-between">

        <div>
            <p class="text-sm font-medium text-black/90">
                {{ $title }}
            </p>
        </div>

        <div class="p-3 rounded-xl bg-black/20">
            <i class="fa-solid {{ $icon }} text-[22px]"></i>
        </div>

    </div>


    {{-- VALUE --}}
    <div class="mt-8">

        <h3 class="text-3xl font-bold text-black/90">
            {{ $value }}
        </h3>

        <div class="flex items-center gap-2 mt-3 text-sm text-black/90">

            <i class="fa-solid fa-arrow-trend-up text-[15px]"></i>

            {{ $subtitle }}

        </div>

    </div>

</div>