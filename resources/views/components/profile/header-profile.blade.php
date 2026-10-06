@php
    $user = auth()->user();

    $name = $user->fullname ?? $user->username ?? 'User';
    $image = $user->image ?? null;
    $role = $user->role ?? null;
    $avatar = $user->avatar ?? null;

    $menus = [
        [
            'title' => 'Purchase List',
            'href' => '/my/purchase-list',
            'icon' => 'clipboard-list',
        ],
        [
            'title' => 'My Booking',
            'href' => '/my/my-booking',
            'icon' => 'calendar-days',
        ],
        [
            'title' => 'My Account',
            'href' => '/my/profil',
            'icon' => 'user',
        ],
    ];
@endphp

<div class="bg-white border-gray-400 shadow-sm rounded-2xl">

    {{-- Profile --}}
    <div class="flex items-center gap-4 p-5">

        <img
            src="{{ $avatar ? asset('storage/' . $avatar) : asset('images/avatar.png') }}"
            alt="profile"
            class="h-[60px] w-[60px] rounded-full object-cover"
        >

        <div>

            <h2 class="text-lg font-bold">
                {{ $name }}
            </h2>

            <p class="text-sm text-gray-500">
                {{ in_array($role, ['ADMIN', 'OWNER']) ? 'ADMIN' : 'GUEST' }}
            </p>

        </div>

    </div>

    <hr class="border-gray-400">

    {{-- Menu --}}
    <div class="py-3">

        @foreach ($menus as $menu)

            @php
                $active = request()->is(ltrim($menu['href'], '/'));
            @endphp

            <a
                href="{{ $menu['href'] }}"
                class="mx-3 mb-2 flex items-center gap-3 rounded-lg px-4 py-3 transition
                {{ $active
                    ? 'bg-blue-600 text-white'
                    : 'hover:bg-gray-100'
                }}"
            >

                {{-- Clipboard List --}}
                @if ($menu['icon'] === 'clipboard-list')
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <rect width="8" height="4" x="8" y="2" rx="1" ry="0"></rect>
                        <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path>
                        <path d="M12 11h4"></path>
                        <path d="M12 16h4"></path>
                        <path d="M8 11h.01"></path>
                        <path d="M8 16h.01"></path>
                    </svg>

                {{-- Calendar --}}
                @elseif ($menu['icon'] === 'calendar-days')
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M8 2v4"></path>
                        <path d="M16 2v4"></path>
                        <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                        <path d="M3 10h18"></path>
                        <path d="M8 14h.01"></path>
                        <path d="M12 14h.01"></path>
                        <path d="M16 14h.01"></path>
                        <path d="M8 18h.01"></path>
                        <path d="M12 18h.01"></path>
                        <path d="M16 18h.01"></path>
                    </svg>

                {{-- User --}}
                @elseif ($menu['icon'] === 'user')
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="20"
                        height="20"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                @endif

                {{ $menu['title'] }}

            </a>

        @endforeach

        <hr class="my-3 border-gray-400">

        {{-- Logout --}}
        <form
            action="{{ route('logout') }}"
            method="POST"
        >
            @csrf

            <button
                type="submit"
                class="mx-3 flex w-[calc(100%-24px)] items-center gap-3 rounded-lg px-4 py-3 text-red-500 transition hover:bg-red-50"
            >

                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="20"
                    height="20"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" x2="9" y1="12" y2="12"></line>
                </svg>

                Log Out

            </button>

        </form>

    </div>

</div>