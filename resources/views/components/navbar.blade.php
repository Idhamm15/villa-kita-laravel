<header class="w-full bg-white shadow-sm">
    <div class="mx-auto flex h-20 max-w-7xl items-center justify-between px-6">

        {{-- ==================== LOGO ==================== --}}
        <a
            href="{{ url('/') }}"
            class="flex items-center gap-1 text-xl font-semibold text-black transition hover:text-sky-500"
        >
            <img
                src="{{ asset('img/logo.png') }}"
                alt="Villa Kita"
                class="h-20 w-16 object-contain"
            >

            <span>Villa Kita</span>
        </a>


        {{-- ==================== MENU ==================== --}}
        <nav class="hidden items-center gap-4 md:flex">

            {{-- Beranda --}}
            <a
                href="{{ url('/') }}"
                class="flex items-center gap-2 rounded-full px-4 py-2 text-lg font-medium transition-all duration-200
                {{ request()->is('/')
                    ? 'bg-sky-500 text-white shadow-md'
                    : 'text-black hover:bg-sky-50 hover:text-sky-500'
                }}"
            >
                <i class="fa-solid fa-house text-sm"></i>
                <span>Beranda</span>
            </a>


            {{-- Sewa Villa --}}
            <a
                href="{{ url('/sewa-villa') }}"
                class="flex items-center gap-2 rounded-full px-4 py-2 text-lg font-medium transition-all duration-200
                {{ request()->is('sewa-villa*')
                    ? 'bg-sky-500 text-white shadow-md'
                    : 'text-black hover:bg-sky-50 hover:text-sky-500'
                }}"
            >
                <i class="fa-solid fa-house-chimney text-sm"></i>
                <span>Sewa Villa</span>
            </a>


            {{-- Trip --}}
            <a
                href="{{ url('/trip') }}"
                class="flex items-center gap-2 rounded-full px-4 py-2 text-lg font-medium transition-all duration-200
                {{ request()->is('trip*')
                    ? 'bg-sky-500 text-white shadow-md'
                    : 'text-black hover:bg-sky-50 hover:text-sky-500'
                }}"
            >
                <i class="fa-solid fa-person-running text-sm"></i>
                <span>Trip</span>
            </a>


            {{-- Blog --}}
            <a
                href="{{ url('/blog') }}"
                class="flex items-center gap-2 rounded-full px-4 py-2 text-lg font-medium transition-all duration-200
                {{ request()->is('blog*')
                    ? 'bg-sky-500 text-white shadow-md'
                    : 'text-black hover:bg-sky-50 hover:text-sky-500'
                }}"
            >
                <i class="fa-solid fa-pen text-sm"></i>
                <span>Blog</span>
            </a>


            {{-- Tersimpan --}}
            <a
                href="{{ url('/tersimpan') }}"
                class="flex items-center gap-2 rounded-full px-4 py-2 text-lg font-medium transition-all duration-200
                {{ request()->is('tersimpan*')
                    ? 'bg-sky-500 text-white shadow-md'
                    : 'text-black hover:bg-sky-50 hover:text-sky-500'
                }}"
            >
                <i class="fa-solid fa-bookmark text-sm"></i>
                <span>Tersimpan</span>
            </a>


            {{-- Kontak --}}
            <a
                href="{{ url('/kontak') }}"
                class="flex items-center gap-2 rounded-full px-4 py-2 text-lg font-medium transition-all duration-200
                {{ request()->is('kontak*')
                    ? 'bg-sky-500 text-white shadow-md'
                    : 'text-black hover:bg-sky-50 hover:text-sky-500'
                }}"
            >
                <i class="fa-solid fa-phone text-sm"></i>
                <span>Kontak</span>
            </a>

        </nav>


        {{-- ==================== RIGHT SIDE ==================== --}}
        <div class="flex items-center">

            @auth

                {{-- ==================== USER DROPDOWN ==================== --}}
                <div
                    x-data="{ open: false }"
                    class="relative"
                >

                    {{-- User Button --}}
                    <button
                        type="button"
                        @click="open = !open"
                        class="flex items-center gap-3 rounded-full px-3 py-2 transition hover:bg-gray-100"
                    >

                        {{-- Avatar --}}
                        @if(auth()->user()->image)

                            <img
                                src="{{ asset('storage/' . auth()->user()->image) }}"
                                alt="{{ auth()->user()->fullname ?? auth()->user()->username }}"
                                class="h-11 w-11 rounded-full object-cover"
                            >

                        @else

                            <div
                                class="flex h-11 w-11 items-center justify-center rounded-full bg-sky-500 text-lg font-semibold text-white"
                            >
                                {{ strtoupper(
                                    substr(
                                        auth()->user()->fullname
                                            ?? auth()->user()->username
                                            ?? 'U',
                                        0,
                                        1
                                    )
                                ) }}
                            </div>

                        @endif


                        {{-- Username --}}
                        <span class="hidden font-medium text-gray-700 lg:block">
                            {{ auth()->user()->fullname ?? auth()->user()->username }}
                        </span>


                        {{-- Arrow --}}
                        <i
                            class="fa-solid fa-chevron-down text-xs text-gray-500 transition-transform duration-200"
                            :class="{ 'rotate-180': open }"
                        ></i>

                    </button>


                    {{-- ==================== DROPDOWN ==================== --}}
                    <div
                        x-show="open"
                        x-transition
                        @click.outside="open = false"
                        class="absolute right-0 z-50 mt-2 w-52 overflow-hidden rounded-xl border border-gray-100 bg-white py-2 shadow-xl"
                    >

                        {{-- Profile --}}
                        <a
                            href="{{ url('/profile') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 transition hover:bg-gray-50 hover:text-sky-500"
                        >
                            <i class="fa-solid fa-user w-5 text-gray-500"></i>

                            <span>Profile</span>
                        </a>


                        {{-- Divider --}}
                        <div class="my-1 border-t border-gray-100"></div>


                        {{-- Logout --}}
                        <form
                            action="{{ route('logout') }}"
                            method="POST"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="flex w-full items-center gap-3 px-4 py-3 text-left text-sm text-red-600 transition hover:bg-red-50"
                            >
                                <i class="fa-solid fa-right-from-bracket w-5"></i>

                                <span>Logout</span>
                            </button>
                        </form>

                    </div>

                </div>


            @else

                {{-- ==================== LOGIN ==================== --}}
                <a
                    href="{{ url('/login') }}"
                    class="flex items-center gap-2 rounded-lg bg-gray-300 px-8 py-3 text-lg font-semibold text-white transition hover:bg-gray-400"
                >
                    <i class="fa-solid fa-right-to-bracket"></i>

                    <span>Login</span>
                </a>

            @endauth

        </div>

    </div>
</header>