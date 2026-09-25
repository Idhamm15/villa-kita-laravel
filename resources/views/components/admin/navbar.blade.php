{{-- Mobile Header --}}
<div
    class="flex items-center justify-between p-4 mb-6 bg-gray-100 rounded-3xl lg:hidden"
>
    <button
        type="button"
        @click="sidebarOpen = true"
        class="p-2 rounded-lg hover:bg-gray-200"
    >
        <i class="fa-solid fa-bars"></i>
    </button>

    <h1 class="text-lg font-bold">
        Analytics Hub
    </h1>

    <div class="w-10"></div>
</div>


{{-- Desktop Header --}}
<div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">

    <div>
        <h1 class="text-3xl font-bold text-slate-900">
            Analytics Dashboard
        </h1>

        <p class="mt-1 text-slate-500">
            Comprehensive data insights and performance metrics
        </p>
    </div>

    <div class="flex gap-3">

        <a
            href="{{ url('/') }}"
            class="
                flex items-center gap-2
                rounded-2xl bg-orange-600
                px-4 py-2.5
                text-white
                transition
                hover:bg-orange-700
            "
        >
            Kembali ke Website
        </a>

    </div>

</div>