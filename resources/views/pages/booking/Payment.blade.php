@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-slate-50">
        <div class="container px-4 py-10 mx-auto max-w-7xl">

            {{-- Booking Steps --}}
            <x-booking.steps :current-step="3" />

            {{-- Main Content --}}
            <div class="grid gap-12 lg:grid-cols-12">

                {{-- LEFT --}}
                <div class="space-y-12 lg:col-span-12">

                    <x-payment.payment-countdown/>
                    <x-payment.payment-instruction/>
                    <x-payment.transfer-guide/>
                    <x-payment.payment-completed/>

                </div>

                {{-- RIGHT --}}
                {{-- <div class="lg:col-span-4">

                    <div class="sticky top-24">

                        <x-booking.summary
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

                </div> --}}

            </div>

        </div>
    </div>

@endsection