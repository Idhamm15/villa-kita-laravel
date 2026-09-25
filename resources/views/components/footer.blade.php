<footer class="relative mt-30 overflow-hidden bg-gray-800 text-white">

    {{-- ==================== BACKGROUND SHAPE ==================== --}}
    <div class="absolute left-0 top-20 h-[400px] w-[400px] opacity-10">
        <div class="h-full w-full rounded-full border border-cyan-400"></div>
    </div>

    <div class="absolute right-0 top-20 h-[400px] w-[400px] opacity-10">
        <div class="h-full w-full rounded-full border border-cyan-400"></div>
    </div>


    <div class="relative z-10 mx-auto max-w-7xl px-6 lg:px-10">

        {{-- ==================== TOP CONTACT ==================== --}}
        <div class="grid grid-cols-1 gap-8 border-b border-white/10 py-10 md:grid-cols-3">

            {{-- EMAIL --}}
            <div class="flex items-center gap-5">

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-white/10">
                    <i class="fa-solid fa-envelope text-lg text-white"></i>
                </div>

                <div>
                    <p class="mb-1 text-sm text-white/60">
                        Email
                    </p>

                    <h4 class="text-lg font-semibold">
                        villakita@gmail.com
                    </h4>
                </div>

            </div>


            {{-- PHONE --}}
            <div class="flex items-center gap-5">

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-white/10">
                    <i class="fa-solid fa-phone text-lg text-white"></i>
                </div>

                <div>
                    <p class="mb-1 text-sm text-white/60">
                        Telepon
                    </p>

                    <h4 class="text-lg font-semibold">
                        +62 123 234 2345 (Admin)
                    </h4>
                </div>

            </div>


            {{-- ADDRESS --}}
            <div class="flex items-center gap-5">

                <div class="flex h-14 w-14 items-center justify-center rounded-full bg-white/10">
                    <i class="fa-solid fa-location-dot text-lg text-white"></i>
                </div>

                <div>
                    <p class="mb-1 text-sm text-white/60">
                        Alamat Kantor
                    </p>

                    <h4 class="text-lg font-semibold">
                        Jakarta, Indonesia
                    </h4>
                </div>

            </div>

        </div>


        {{-- ==================== MAIN FOOTER ==================== --}}
        <div class="grid grid-cols-1 gap-14 py-16 md:grid-cols-2 lg:grid-cols-4">

            {{-- ==================== ABOUT ==================== --}}
            <div>

                <h3 class="mb-6 text-xl font-bold">
                    Tentang Kami
                </h3>

                <p class="leading-8 text-white/70">
                    Sewa villa dan hotel dengan mudah dan cepat.
                    Temukan villa impian Anda di berbagai lokasi
                    terbaik di Indonesia.
                </p>


                {{-- OFFICE --}}
                <div class="mt-8">

                    <p class="mb-4 font-semibold">
                        Office :
                    </p>

                    <div class="space-y-5 text-white/70">
                        <p class="leading-7">
                            Jakarta, Indonesia
                        </p>
                    </div>

                </div>


                {{-- SOCIAL MEDIA --}}
                <div class="mt-5 flex space-x-3">

                    {{-- Facebook --}}
                    <a
                        href="#"
                        aria-label="Facebook"
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-gray-700 transition hover:bg-yellow-500 hover:text-white"
                    >
                        <i class="fa-brands fa-facebook-f text-sm"></i>
                    </a>


                    {{-- Twitter --}}
                    <a
                        href="#"
                        aria-label="Twitter"
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-gray-700 transition hover:bg-yellow-500 hover:text-white"
                    >
                        <i class="fa-brands fa-twitter text-sm"></i>
                    </a>


                    {{-- Instagram --}}
                    <a
                        href="#"
                        aria-label="Instagram"
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-gray-700 transition hover:bg-yellow-500 hover:text-white"
                    >
                        <i class="fa-brands fa-instagram text-sm"></i>
                    </a>


                    {{-- LinkedIn --}}
                    <a
                        href="#"
                        aria-label="LinkedIn"
                        class="flex h-9 w-9 items-center justify-center rounded-full bg-white text-gray-700 transition hover:bg-yellow-500 hover:text-white"
                    >
                        <i class="fa-brands fa-linkedin-in text-sm"></i>
                    </a>

                </div>

            </div>


            {{-- ==================== SERVICES ==================== --}}
            <div>

                <h3 class="mb-6 text-xl font-bold">
                    Layanan Kami
                </h3>

                <ul class="space-y-4 text-white/80">

                    <li>
                        <a
                            href="{{ url('/sewa-villa') }}"
                            class="transition hover:text-cyan-300"
                        >
                            Jasa Pemesanan Villa
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/sewa-hotel') }}"
                            class="transition hover:text-cyan-300"
                        >
                            Jasa Pemesanan Hotel
                        </a>
                    </li>

                </ul>

            </div>


            {{-- ==================== QUICK LINK ==================== --}}
            <div>

                <h3 class="mb-6 text-xl font-bold">
                    Pintasan Link
                </h3>

                <ul class="space-y-4 text-white/80">

                    <li>
                        <a
                            href="{{ url('/sewa-villa-bogor') }}"
                            class="transition hover:text-cyan-300"
                        >
                            Sewa Villa Bogor
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/sewa-villa-jakarta') }}"
                            class="transition hover:text-cyan-300"
                        >
                            Sewa Villa Jakarta
                        </a>
                    </li>

                    <li>
                        <a
                            href="{{ url('/sewa-villa-bandung') }}"
                            class="transition hover:text-cyan-300"
                        >
                            Sewa Villa Bandung
                        </a>
                    </li>

                </ul>

            </div>


            {{-- ==================== PAGES ==================== --}}
            <div>

                <h3 class="mb-6 text-xl font-bold">
                    Halaman
                </h3>

                <ul class="space-y-4 text-white/80">

                    {{-- Beranda --}}
                    <li>
                        <a
                            href="{{ url('/') }}"
                            class="transition hover:text-cyan-300"
                        >
                            Beranda
                        </a>
                    </li>


                    {{-- Sewa Villa --}}
                    <li>
                        <a
                            href="{{ url('/sewa-villa') }}"
                            class="transition hover:text-cyan-300"
                        >
                            Sewa Villa
                        </a>
                    </li>


                    {{-- Trip --}}
                    <li>
                        <a
                            href="{{ url('/trip') }}"
                            class="transition hover:text-cyan-300"
                        >
                            Trip
                        </a>
                    </li>


                    {{-- Blog --}}
                    <li>
                        <a
                            href="{{ url('/blog') }}"
                            class="transition hover:text-cyan-300"
                        >
                            Blog
                        </a>
                    </li>


                    {{-- Tersimpan --}}
                    <li>
                        <a
                            href="{{ url('/tersimpan') }}"
                            class="transition hover:text-cyan-300"
                        >
                            Tersimpan
                        </a>
                    </li>


                    {{-- Kontak --}}
                    <li>
                        <a
                            href="{{ url('/kontak') }}"
                            class="transition hover:text-cyan-300"
                        >
                            Kontak
                        </a>
                    </li>

                </ul>

            </div>

        </div>

    </div>


    {{-- ==================== BOTTOM BAR ==================== --}}
    <div class="relative z-10 bg-blue-300 py-4">

        <div
            class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-4 px-6 text-sm font-medium text-white md:flex-row lg:px-10"
        >

            <p>
                Copyright © {{ date('Y') }} Villa Kita. All rights reserved.
            </p>

            <p>
                Developed by Villa Kita
            </p>

        </div>

    </div>

</footer>