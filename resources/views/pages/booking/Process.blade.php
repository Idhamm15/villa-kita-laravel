@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-slate-50">

        <div class="container px-4 py-10 mx-auto max-w-7xl">

            {{-- Booking Steps --}}
            <x-booking.steps :current-step="2" />

            {{-- Payment Header --}}
            <x-payment.header />

            {{-- ==========================
                VALIDATION ERROR
            ========================== --}}

            @if ($errors->any())

                <div class="p-5 mb-6 text-red-700 border border-red-200 rounded-2xl bg-red-50">

                    <p class="mb-2 font-semibold">
                        Terdapat kesalahan:
                    </p>

                    <ul class="pl-5 space-y-1 text-sm list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>

                </div>

            @endif

            <form
                action="{{ url('/booking/payment/store/' . $data->order_id) }}"
                method="POST"
            >
                @csrf
                @method('PUT')

                <div class="grid gap-8 mt-8 lg:grid-cols-12">

                    {{-- Left Content --}}
                    <div class="space-y-6 lg:col-span-8">

                        {{-- Payment Method --}}
                        <x-payment.method
                            :value="old('payment_method', '')"
                        />

                        {{-- Payment Total --}}
                        <x-payment.total
                           :booking="[
                                'checkIn' => $data->check_in ?? '-',
                                'checkOut' => $data->check_out ?? '-',
                                'subTotal' => $data->sub_total ?? 0,
                                'totalPrice' => $data->total_price ?? 0,
                                'discount' => $data->discount ?? 0,
                            ]"
                           :product="[
                                'price' => $data->product->price ?? '-',
                                'serviceFee' => $data->product->service_fee ?? 0,
                            ]"
                        />

                        {{-- Pay Button --}}
                        <button
                            type="submit"
                            class="w-full py-4 text-lg font-semibold text-white transition bg-blue-600 rounded-2xl hover:bg-blue-700"
                        >
                            Pay with
                            <span class="uppercase">
                                {{ old('payment_method', 'payment') }}
                            </span>
                        </button>

                    </div>

                    {{-- Right Content --}}
                    <div class="lg:col-span-4">

                        <div class="sticky top-24">

                            <x-payment.summary-payment
                                :booking="[
                                    'bookingCode' => $data->booking_code ?? '-',
                                    'checkIn' => $data->check_in ?? '-',
                                    'checkOut' => $data->check_out ?? '2026-09-27 12:00',
                                    'totalGuest' => $data->total_guest ?? 0,
                                    'discount' => $data->discount ?? 50000,
                                    'voucherCode' => $data->voucher_code ?? '',
                                    'subTotal' => $data->sub_total ?? 0,
                                    'totalPrice' => $data->total_price ?? 1000,
                                ]"
                                :product="[
                                    'id' => $data->product->id ?? 1,
                                    'name' => $data->product->name ?? 'Villa',
                                    'thumbnail' => $data->product->thumbnail ?? '',
                                    'roomName' => 'Villa',
                                    'capacity' => $data->product->capacity ?? 1,
                                    'price' => $data->product->price ?? 1000,
                                    'serviceFee' => $data->product->service_fee ?? 100,
                                ]"
                            />

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

@endsection