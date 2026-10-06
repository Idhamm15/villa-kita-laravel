@if ($bookings->isEmpty())

    {{-- Empty --}}
    <div class="p-10 text-center bg-white shadow-md rounded-2xl">

        <div class="flex items-center justify-center w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-full">
            <svg
                xmlns="http://www.w3.org/2000/svg"
                width="28"
                height="28"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round"
                class="text-gray-400"
            >
                <path d="M8 2v4"></path>
                <path d="M16 2v4"></path>
                <rect width="18" height="18" x="3" y="4" rx="2"></rect>
                <path d="M3 10h18"></path>
            </svg>
        </div>

        <h3 class="text-lg font-semibold text-gray-800">
            Belum Ada Booking
        </h3>

        <p class="mt-2 text-gray-500">
            Kamu belum memiliki riwayat booking.
        </p>

    </div>

@else

    <div class="space-y-6">

        @foreach ($bookings as $booking)

            <div class="transition bg-white shadow-md rounded-2xl hover:shadow-lg">

                {{-- Header --}}
                <div class="flex flex-col justify-between gap-3 p-6 border-b border-gray-400 md:flex-row md:items-center">

                    <div>
                        <p class="text-sm text-gray-500">
                            Booking ID
                        </p>

                        <h2 class="text-lg font-bold">
                            #{{ $booking->booking_code ?? $booking->id }}
                        </h2>
                    </div>

                    @php
                        $status = $booking->payment_status;

                        $statusClass = match ($status) {
                            'PAID' => 'bg-green-100 text-green-700',
                            'PENDING' => 'bg-yellow-100 text-yellow-700',
                            default => 'bg-red-100 text-red-700',
                        };

                        $statusText = $status === 'PAID'
                            ? 'Confirmed'
                            : $status;
                    @endphp

                    <span
                        class="rounded-full px-4 py-1 text-sm font-medium {{ $statusClass }}"
                    >
                        {{ $statusText }}
                    </span>

                </div>

                {{-- Body --}}
                <div class="p-6">

                    <h3 class="text-xl font-semibold">
                        {{ $booking->product?->name ?? '-' }}
                    </h3>

                    <p class="flex items-center gap-2 mt-1 text-gray-500">

                        {{-- Map Pin --}}
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                        >
                            <path d="M20 10c0 4.993-8 12-8 12S4 14.993 4 10a8 8 0 1 1 16 0Z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>

                        {{ $booking->product?->location ?? '-' }}

                    </p>

                    <div class="grid gap-4 mt-5 md:grid-cols-3">

                        {{-- Check In --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Check In
                            </p>

                            <div class="flex items-center gap-2 mt-1 font-medium">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="18"
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
                                </svg>

                                {{ $booking->check_in
                                    ? \Carbon\Carbon::parse($booking->check_in)->locale('id')->translatedFormat('d M Y')
                                    : '-'
                                }}

                            </div>

                        </div>

                        {{-- Check Out --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Check Out
                            </p>

                            <div class="flex items-center gap-2 mt-1 font-medium">

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="18"
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
                                </svg>

                                {{ $booking->check_out
                                    ? \Carbon\Carbon::parse($booking->check_out)->locale('id')->translatedFormat('d M Y')
                                    : '-'
                                }}

                            </div>

                        </div>

                        {{-- Total --}}
                        <div>

                            <p class="text-sm text-gray-500">
                                Total
                            </p>

                            <div class="mt-1 text-lg font-bold text-blue-600">
                                Rp {{ number_format($booking->total_price ?? 0, 0, ',', '.') }}
                            </div>

                        </div>

                    </div>

                </div>

                {{-- Footer --}}
                <div class="flex flex-col gap-4 px-6 py-4 border-t border-gray-400 bg-gray-50 md:flex-row md:items-center md:justify-between">

                    <span class="text-sm text-gray-500">
                        Booked on

                        {{ $booking->created_at
                            ? \Carbon\Carbon::parse($booking->created_at)->locale('id')->translatedFormat('d M Y')
                            : '-'
                        }}
                    </span>

                    <div class="flex gap-3">

                        {{-- Invoice --}}
                        <a
                            href="{{ url('/booking/process', $booking->order_id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm border rounded-lg hover:bg-gray-100"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7z"></path>
                                <path d="M14 2v6h6"></path>
                                <path d="M16 13H8"></path>
                                <path d="M16 17H8"></path>
                                <path d="M10 9H8"></path>
                            </svg>

                            Invoice

                        </a>

                        {{-- Detail --}}
                        <a
                            href="{{ url('profile/my-booking/detail', $booking->id) }}"
                            class="inline-flex items-center gap-2 px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700"
                        >

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M2.062 12.348a1 1 0 0 0 0 .304C3.423 16.74 7.31 20 12 20c4.69 0 8.577-3.26 9.938-7.348a1 1 0 0 0 0-.304C20.577 7.26 16.69 4 12 4c-4.69 0-8.577 3.26-9.938 7.348Z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>

                            Detail

                        </a>

                    </div>

                </div>

            </div>

        @endforeach

    </div>

@endif