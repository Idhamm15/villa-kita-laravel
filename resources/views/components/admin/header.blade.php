<div
    x-data="{ sidebarOpen: false }"
    class="min-h-screen"
>

    {{-- Overlay --}}
    <div
        x-show="sidebarOpen"
        x-transition.opacity
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/50 lg:hidden"
        style="display: none;"
    ></div>

    {{-- Sidebar --}}
    <aside
        class="fixed inset-y-0 left-0 z-50 flex flex-col w-64 transition-transform duration-300 transform bg-gray-100 lg:static lg:translate-x-0"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    >

        {{-- Logo --}}
        <div class="px-6 py-4">

            <div class="flex items-center justify-between">

                <div class="flex items-center gap-4">

                    <div class="flex items-center justify-center bg-white rounded-full h-14 w-14">
                        <img
                            src="{{ asset('img/logo.png') }}"
                            alt="Logo"
                            class="object-contain max-h-12 max-w-12"
                        >
                    </div>

                    <div>
                        <h1 class="text-lg font-bold text-slate-900">
                            Villa Kita
                        </h1>

                        <p class="text-xs text-slate-500">
                            Dashboard
                        </p>
                    </div>

                </div>

                {{-- Close Mobile --}}
                <button
                    type="button"
                    @click="sidebarOpen = false"
                    class="p-2 rounded-lg hover:bg-gray-200 lg:hidden"
                >
                    <i class="text-xl fa-solid fa-xmark"></i>
                </button>

            </div>

        </div>

        {{-- Menu --}}
        <nav class="flex-1 px-6 py-4 space-y-6 overflow-y-auto">

            {{-- Analytics --}}
            <div>

                <h3 class="mb-3 text-xs font-semibold tracking-wider uppercase text-slate-500">
                    Analytics
                </h3>

                <div class="space-y-1">

                    {{-- Overview --}}
                    <a
                        href="{{ url('/dashboard') }}"
                        class="
                            flex w-full items-center gap-3 rounded-2xl px-4 py-3
                            transition
                            {{ request()->is('dashboard') 
                                ? 'bg-[#276874] text-white' 
                                : 'text-slate-700 hover:bg-gray-200' }}
                        "
                    >
                        <i class="w-5 text-center fa-solid fa-table-columns"></i>
                        <span>Overview</span>
                    </a>

                    {{-- Kelola Properti --}}
                    <a
                        href="{{ url('/dashboard/product') }}"
                        class="
                            flex w-full items-center gap-3 rounded-2xl px-4 py-3
                            transition
                            {{ request()->is('dashboard/product*') 
                                ? 'bg-[#276874] text-white' 
                                : 'text-slate-700 hover:bg-gray-200' }}
                        "
                    >
                        <i class="w-5 text-center fa-solid fa-house"></i>
                        <span>Kelola Properti</span>
                    </a>

                    {{-- Booking --}}
                    <a
                        href="{{ url('/dashboard/booking') }}"
                        class="
                            flex w-full items-center gap-3 rounded-2xl px-4 py-3
                            transition
                            {{ request()->is('dashboard/booking*') 
                                ? 'bg-[#276874] text-white' 
                                : 'text-slate-700 hover:bg-gray-200' }}
                        "
                    >
                        <i class="w-5 text-center fa-solid fa-cart-shopping"></i>
                        <span>Booking</span>
                    </a>

                    {{-- Blog --}}
                    <a
                        href="{{ url('/dashboard/blog') }}"
                        class="
                            flex w-full items-center gap-3 rounded-2xl px-4 py-3
                            transition
                            {{ request()->is('dashboard/blog*') 
                                ? 'bg-[#276874] text-white' 
                                : 'text-slate-700 hover:bg-gray-200' }}
                        "
                    >
                        <i class="w-5 text-center fa-solid fa-newspaper"></i>
                        <span>Blog</span>
                    </a>

                    {{-- Voucher --}}
                    <a
                        href="{{ url('/dashboard/voucher') }}"
                        class="
                            flex w-full items-center gap-3 rounded-2xl px-4 py-3
                            transition
                            {{ request()->is('dashboard/voucher*') 
                                ? 'bg-[#276874] text-white' 
                                : 'text-slate-700 hover:bg-gray-200' }}
                        "
                    >
                        <i class="w-5 text-center fa-solid fa-ticket"></i>
                        <span>Voucher</span>
                    </a>

                    {{-- Partner --}}
                    <a
                        href="{{ url('/dashboard/partner') }}"
                        class="
                            flex w-full items-center gap-3 rounded-2xl px-4 py-3
                            transition
                            {{ request()->is('dashboard/partner*') 
                                ? 'bg-[#276874] text-white' 
                                : 'text-slate-700 hover:bg-gray-200' }}
                        "
                    >
                        <i class="w-5 text-center fa-solid fa-users"></i>
                        <span>Partner</span>
                    </a>

                    {{-- Kelola Pengguna --}}
                    <a
                        href="{{ url('/dashboard/management-user') }}"
                        class="
                            flex w-full items-center gap-3 rounded-2xl px-4 py-3
                            transition
                            {{ request()->is('dashboard/management-user*') 
                                ? 'bg-[#276874] text-white' 
                                : 'text-slate-700 hover:bg-gray-200' }}
                        "
                    >
                        <i class="w-5 text-center fa-solid fa-users"></i>
                        <span>Kelola Pengguna</span>
                    </a>

                </div>

            </div>

            {{-- Reports --}}
            <div>

                <h3 class="mb-3 text-xs font-semibold tracking-wider uppercase text-slate-500">
                    Reports
                </h3>

                <div class="space-y-1">

                    {{-- Laporan --}}
                    <a
                        href="{{ url('/dashboard/report') }}"
                        class="
                            flex w-full items-center gap-3 rounded-2xl px-4 py-3
                            transition
                            {{ request()->is('dashboard/report*') 
                                ? 'bg-[#276874] text-white' 
                                : 'text-slate-700 hover:bg-gray-200' }}
                        "
                    >
                        <i class="w-5 text-center fa-solid fa-file-lines"></i>
                        <span>Laporan</span>
                    </a>

                    {{-- Pengaturan --}}
                    <a
                        href="{{ url('/dashboard/setting') }}"
                        class="
                            flex w-full items-center gap-3 rounded-2xl px-4 py-3
                            transition
                            {{ request()->is('dashboard/setting*') 
                                ? 'bg-[#276874] text-white' 
                                : 'text-slate-700 hover:bg-gray-200' }}
                        "
                    >
                        <i class="w-5 text-center fa-solid fa-gear"></i>
                        <span>Pengaturan</span>
                    </a>

                </div>

                {{-- Logout --}}
                <form
                    action="{{ url('/logout') }}"
                    method="POST"
                >
                    @csrf

                    <button
                        type="submit"
                        class="flex items-center w-full gap-3 px-4 py-3 mt-3 text-red-600 transition rounded-xl hover:bg-red-500 hover:text-white"
                    >
                        <i class="w-5 text-center fa-solid fa-right-from-bracket"></i>

                        <span>
                            Logout
                        </span>
                    </button>
                </form>

            </div>

        </nav>

        {{-- Profile --}}
        <div class="px-6 pb-6">

            <div class="flex items-center gap-3">

                <img
                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop"
                    alt="Profile"
                    class="object-cover w-12 h-12 rounded-full"
                >

                <div class="min-w-0">

                    <p class="font-semibold truncate text-slate-900">
                        Admin
                    </p>

                    <p class="text-sm truncate text-slate-500">
                        admin@satujutuh.net
                    </p>

                </div>

            </div>

        </div>

    </aside>

</div>