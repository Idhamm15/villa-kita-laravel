@props([
    'value' => 'SELF',
])

<div class="rounded-2xl bg-white p-6 shadow-lg">
    <div class="grid gap-6 md:grid-cols-2">

        {{-- SELF --}}
        <label
            class="
                flex cursor-pointer items-start gap-3 rounded-xl border p-5 transition
                {{ $value === 'SELF'
                    ? 'border-blue-600 bg-blue-50'
                    : 'border-gray-200 hover:border-blue-500'
                }}
            "
        >
            <input
                type="radio"
                name="visitor_type"
                value="SELF"
                {{ $value === 'SELF' ? 'checked' : '' }}
                class="mt-1"
            >

            <div>
                <p class="font-semibold">
                    Saya akan Menginap/Trip
                </p>

                <p class="text-sm text-gray-500">
                    Pemesan dan tamu yang menginap/trip adalah orang yang sama.
                </p>
            </div>
        </label>

        {{-- SOMEONE ELSE --}}
        <label
            class="
                flex cursor-pointer items-start gap-3 rounded-xl border p-5 transition
                {{ $value === 'SOMEONE_ELSE'
                    ? 'border-blue-600 bg-blue-50'
                    : 'border-gray-200 hover:border-blue-500'
                }}
            "
        >
            <input
                type="radio"
                name="visitor_type"
                value="SOMEONE_ELSE"
                {{ $value === 'SOMEONE_ELSE' ? 'checked' : '' }}
                class="mt-1"
            >

            <div>
                <p class="font-semibold">
                    Saya memesan untuk orang lain
                </p>

                <p class="text-sm text-gray-500">
                    Booking ini ditujukan untuk tamu lain yang akan menginap/trip.
                </p>
            </div>
        </label>

    </div>
</div>