@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-slate-50">

        <div class="container mx-auto max-w-7xl px-4 py-10">

            {{-- Booking Steps --}}
            <x-booking.steps :current-step="2" />

            {{-- Payment Header --}}
            <x-payment.header />

            <form
                action="{{ url('/booking/payment') }}"
                method="POST"
            >
                @csrf

                <div class="mt-8 grid gap-8 lg:grid-cols-12">

                    {{-- Left Content --}}
                    <div class="space-y-6 lg:col-span-8">

                        {{-- Payment Method --}}
                        <x-payment.method
                            :value="old('paymentMethod', '')"
                        />

                        {{-- Payment Total --}}
                        <x-payment.total
                           :booking="[
                                'bookingCode' => 'VKT-20260923-001',
                                'checkIn' => '2026-09-25 14:00',
                                'checkOut' => '2026-09-27 12:00',
                                'totalGuest' => 4,
                                'discount' => 50000,
                                'voucherCode' => '',
                            ]"
                        />

                        {{-- Pay Button --}}
                        <button
                            type="submit"
                            class="w-full rounded-2xl bg-blue-600 py-4 text-lg font-semibold text-white transition hover:bg-blue-700"
                        >
                            Pay with
                            <span class="uppercase">
                                {{ old('paymentMethod', 'payment') }}
                            </span>
                        </button>

                    </div>

                    {{-- Right Content --}}
                    <div class="lg:col-span-4">

                        <div class="sticky top-24">

                            <x-payment.summary-payment
                            :booking="[
                                'bookingCode' => 'VKT-20260923-001',
                                'checkIn' => '2026-09-25 14:00',
                                'checkOut' => '2026-09-27 12:00',
                                'totalGuest' => 4,
                                'discount' => 50000,
                                'voucherCode' => '',
                            ]"
                            :product="[
                                'id' => '1',
                                'name' => 'Villa Harmoni Tegal',
                                'thumbnail' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800',
                                'roomName' => 'Villa',
                                'capacity' => 8,
                                'price' => 750000,
                                'serviceFee' => 25000,
                            ]"
                            />

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection