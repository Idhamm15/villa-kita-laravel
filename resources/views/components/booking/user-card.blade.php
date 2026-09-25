@props([
    'user' => [
        'fullname' => 'John Doe',
        'role' => 'Customer',
        'email' => null,
    ],
])

<div class="rounded-2xl bg-white p-6 shadow-lg">
    <div class="flex items-center gap-4">

        {{-- Avatar --}}
        <div class="flex h-14 w-14 items-center justify-center rounded-full bg-blue-100">
            <i class="fa-regular fa-circle-user text-[30px] text-blue-600"></i>
        </div>

        {{-- User Info --}}
        <div>
            <h3 class="font-bold">
                {{ $user['fullname'] ?? '-' }}
            </h3>

            <p class="text-sm text-gray-500">
                {{ $user['role'] ?? '-' }}
            </p>

            @if (!empty($user['email']))
                <p class="text-xs text-gray-400">
                    {{ $user['email'] }}
                </p>
            @endif
        </div>

    </div>
</div>