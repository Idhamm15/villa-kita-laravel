<section class="relative h-[430px] w-full">

    {{-- Background --}}
    <img
        src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=1920&q=80"
        alt="Hero"
        class="absolute inset-0 h-full w-full object-cover"
    >

    {{-- Overlay --}}
    <div class="absolute inset-0 bg-black/35"></div>

    {{-- Search --}}
    <div class="absolute inset-0 flex items-center justify-center px-5">

        <div class="flex h-20 w-full max-w-3xl rounded-xl bg-white p-4 shadow-2xl">

            {{-- Input --}}
            <div class="flex flex-1 items-center rounded-lg border border-gray-300 px-5">

                {{-- Search Icon --}}
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="mr-3 h-6 w-6 text-gray-500"
                >
                    <circle cx="11" cy="11" r="8"></circle>
                    <path d="m21 21-4.3-4.3"></path>
                </svg>

                <input
                    type="text"
                    name="search"
                    placeholder="Mau liburan kemana?"
                    class="h-14 w-full border-none text-lg text-gray-600 outline-none focus:ring-0"
                >

            </div>

            {{-- Button --}}
            <button
                type="button"
                class="ml-5 rounded-lg bg-sky-500 px-12 text-xl font-semibold text-white transition hover:bg-sky-600"
            >
                Search
            </button>

        </div>

    </div>

</section>

