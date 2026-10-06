<header class="w-full bg-white shadow-sm">
    <div class="flex items-center justify-between h-20 px-6 mx-auto max-w-7xl">

        {{-- ==================== LOGO ==================== --}}
        <a
            href="{{ url('/') }}"
            class="flex items-center gap-1 text-xl font-semibold text-black transition hover:text-sky-500"
        >
            <img
                src="{{ asset('img/logo.png') }}"
                alt="Villa Kita"
                class="object-contain w-16 h-20"
            >

            <span>Villa Kita</span>
        </a>


        {{-- ==================== MENU ==================== --}}
        <nav class="items-center hidden gap-4 md:flex">

            {{-- Beranda --}}
            <a
                href="{{ url('/') }}"
                class="flex items-center gap-2 rounded-full px-4 py-2 text-lg font-medium transition-all duration-200
                {{ request()->is('/')
                    ? 'bg-sky-500 text-white shadow-md'
                    : 'text-black hover:bg-sky-50 hover:text-sky-500'
                }}"
            >
                <i class="text-sm fa-solid fa-house"></i>
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
                <i class="text-sm fa-solid fa-house-chimney"></i>
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
                <i class="text-sm fa-solid fa-person-running"></i>
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
                <i class="text-sm fa-solid fa-pen"></i>
                <span>Blog</span>
            </a>


            {{-- Tersimpan --}}
            {{-- <a
                href="{{ url('/tersimpan') }}"
                class="flex items-center gap-2 rounded-full px-4 py-2 text-lg font-medium transition-all duration-200
                {{ request()->is('tersimpan*')
                    ? 'bg-sky-500 text-white shadow-md'
                    : 'text-black hover:bg-sky-50 hover:text-sky-500'
                }}"
            >
                <i class="text-sm fa-solid fa-bookmark"></i>
                <span>Tersimpan</span>
            </a> --}}


            {{-- Kontak --}}
            <a
                href="{{ url('/kontak') }}"
                class="flex items-center gap-2 rounded-full px-4 py-2 text-lg font-medium transition-all duration-200
                {{ request()->is('kontak*')
                    ? 'bg-sky-500 text-white shadow-md'
                    : 'text-black hover:bg-sky-50 hover:text-sky-500'
                }}"
            >
                <i class="text-sm fa-solid fa-phone"></i>
                <span>Kontak</span>
            </a>

        </nav>


        {{-- ==================== RIGHT SIDE ==================== --}}
        <div class="flex items-center">

            @auth

                {{-- ==================== USER DROPDOWN ==================== --}}
                <div
                    id="user-dropdown-wrapper"
                    class="relative"
                >

                    {{-- ==================== USER BUTTON ==================== --}}
                    <button
                        type="button"
                        id="user-dropdown-button"
                        class="flex items-center gap-3 px-3 py-2 transition rounded-full hover:bg-gray-100"
                    >

                        {{-- Avatar --}}
                        @if(auth()->user()->image)

                            <img
                                src="{{ asset('storage/' . auth()->user()->image) }}"
                                alt="{{ auth()->user()->fullname ?? auth()->user()->username }}"
                                class="object-cover rounded-full h-11 w-11"
                            >

                        @else

                            <div
                                class="flex items-center justify-center text-lg font-semibold text-white rounded-full h-11 w-11 bg-sky-500"
                            >
                                {{
                                    strtoupper(
                                        substr(
                                            auth()->user()->fullname
                                                ?? auth()->user()->username
                                                ?? 'U',
                                            0,
                                            1
                                        )
                                    )
                                }}
                            </div>

                        @endif


                        {{-- Username --}}
                        <span class="hidden font-medium text-gray-700 lg:block">
                            {{ auth()->user()->fullname ?? auth()->user()->username }}
                        </span>


                        {{-- Arrow --}}
                        <i
                            id="user-dropdown-arrow"
                            class="text-xs text-gray-500 transition-transform duration-200 fa-solid fa-chevron-down"
                        ></i>

                    </button>


                    {{-- ==================== DROPDOWN ==================== --}}
                    <div
                        id="user-dropdown-menu"
                        class="absolute right-0 z-50 hidden py-2 mt-2 overflow-hidden bg-white border border-gray-100 shadow-xl w-52 rounded-xl"
                    >

                        {{-- Profile --}}
                        <a
                            href="{{ url('/my/profil') }}"
                            class="flex items-center gap-3 px-4 py-3 text-sm text-gray-700 transition hover:bg-gray-50 hover:text-sky-500"
                        >
                            <i class="w-5 text-gray-500 fa-solid fa-user"></i>

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
                                class="flex items-center w-full gap-3 px-4 py-3 text-sm text-left text-red-600 transition hover:bg-red-50"
                            >
                                <i class="w-5 fa-solid fa-right-from-bracket"></i>

                                <span>Logout</span>
                            </button>
                        </form>

                    </div>

                </div>


            @else

                {{-- ==================== LOGIN ==================== --}}
                <a
                    href="{{ url('/login') }}"
                    class="flex items-center gap-2 px-8 py-3 text-lg font-semibold text-white transition bg-gray-300 rounded-lg hover:bg-gray-400"
                >
                    <i class="fa-solid fa-right-to-bracket"></i>

                    <span>Login</span>
                </a>

            @endauth

        </div>


        {{-- ==================== PURE JAVASCRIPT ==================== --}}
        @auth
        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const button = document.getElementById('user-dropdown-button');
                const menu = document.getElementById('user-dropdown-menu');
                const arrow = document.getElementById('user-dropdown-arrow');
                const wrapper = document.getElementById('user-dropdown-wrapper');

                if (!button || !menu) {
                    return;
                }

                // Toggle dropdown
                button.addEventListener('click', function (event) {

                    event.stopPropagation();

                    const isOpen = !menu.classList.contains('hidden');

                    if (isOpen) {
                        menu.classList.add('hidden');
                        arrow?.classList.remove('rotate-180');
                    } else {
                        menu.classList.remove('hidden');
                        arrow?.classList.add('rotate-180');
                    }

                });


                // Klik di luar dropdown
                document.addEventListener('click', function (event) {

                    if (!wrapper.contains(event.target)) {

                        menu.classList.add('hidden');
                        arrow?.classList.remove('rotate-180');

                    }

                });


                // Escape untuk menutup dropdown
                document.addEventListener('keydown', function (event) {

                    if (event.key === 'Escape') {

                        menu.classList.add('hidden');
                        arrow?.classList.remove('rotate-180');

                    }

                });

            });
        </script>
        @endauth

    </div>
</header>