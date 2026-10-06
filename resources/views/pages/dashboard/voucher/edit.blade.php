@extends('layouts.admin')

@section('title', 'Edit Voucher Baru - Villa Kita')

@section('content')

<div class="p-6 bg-gray-100 rounded-3xl md:p-12">

{{-- HEADER --}}
<div class="mb-8">

    <a
        href="{{ url('/dashboard/voucher') }}"
        class="flex items-center gap-2 mb-5 text-gray-500 transition hover:text-blue-600"
    >
        <i class="fa-solid fa-arrow-left text-[22px]"></i>

        <span>Kembali</span>
    </a>

    <h1 class="text-3xl font-bold text-gray-900">
        Edit Voucher
    </h1>

    <p class="mt-2 text-gray-500">
        Edit voucher promo untuk memberikan potongan harga kepada pelanggan.
    </p>

</div>


{{-- BANNER --}}
<div class="mb-8 overflow-hidden bg-blue-600 shadow-lg rounded-3xl">

    <div class="flex items-center gap-5 px-8 py-7">

        <div class="flex items-center justify-center h-14 w-14 rounded-2xl bg-white/20">
            <i class="fa-solid fa-plus text-[30px] text-white"></i>
        </div>

        <div>

            <h2 class="text-3xl font-bold text-white">
                Informasi Voucher
            </h2>

            <p class="mt-1 text-blue-100">
                Lengkapi informasi voucher di bawah ini.
            </p>

        </div>

    </div>

</div>


{{-- FORM --}}
<form
    action="{{ url('/dashboard/voucher', $data->id) . '/update' }}"
    method="POST"
    class="overflow-hidden bg-white border border-gray-200 shadow-sm rounded-3xl"
>

    @csrf
    @method('PUT')

    {{-- FORM HEADER --}}
    <div class="px-8 py-6 border-b border-gray-300">

        <div class="flex items-center gap-3">

            <div class="w-1 h-10 bg-blue-600 rounded-full"></div>

            <div>

                <h2 class="text-2xl font-bold">
                    Informasi Voucher
                </h2>

                <p class="text-gray-500">
                    Lengkapi informasi voucher promo.
                </p>

            </div>

        </div>

    </div>


    {{-- FORM BODY --}}
    <div class="p-8 space-y-8">

        {{-- KODE VOUCHER --}}
        <div>

            <label
                for="code"
                class="block mb-2 font-semibold"
            >
                Kode Voucher
            </label>

            <input
                type="text"
                name="code"
                id="code"
                value="{{ old('code', $data->code) }}"
                placeholder="Contoh: DISC1022"
                maxlength="50"
                class="w-full px-4 py-3 uppercase border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600"
            >

            @error('code')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- DESKRIPSI --}}
        <div>

            <label
                for="description"
                class="block mb-2 font-semibold"
            >
                Deskripsi
            </label>

            <textarea
                name="description"
                id="description"
                rows="4"
                placeholder="Contoh: Diskon Rp100.000 untuk semua villa"
                class="w-full px-4 py-3 border border-gray-300 resize-none rounded-xl focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600"
            >{{ old('description', $data->description) }}</textarea>

            @error('description')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- DISCOUNT & MIN PURCHASE --}}
        <div class="grid gap-6 md:grid-cols-2">

            {{-- DISCOUNT --}}
            <div>

                <label
                    for="discount"
                    class="block mb-2 font-semibold"
                >
                    Nilai Diskon (Rp)
                </label>

                <input
                    type="number"
                    name="discount"
                    id="discount"
                    value="{{ old('discount', $data->discount) }}"
                    placeholder="100000"
                    min="0"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600"
                >

                @error('discount')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>


            {{-- MIN PURCHASE --}}
            <div>

                <label
                    for="minPurchase"
                    class="block mb-2 font-semibold"
                >
                    Minimal Pembelian (Rp)
                </label>

                <input
                    type="number"
                    name="min_purchase"
                    id="minPurchase"
                    value="{{ old('min_purchase', $data->min_purchase) }}"
                    placeholder="500000"
                    min="0"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600"
                >

                @error('min_purchase')
                    <p class="mt-2 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror

            </div>

        </div>


        {{-- DATE EXPIRED --}}
        <div>

            <label
                for="dateExpired"
                class="block mb-2 font-semibold"
            >
                Tanggal Kadaluarsa
            </label>

            <input
                type="date"
                name="date_expired"
                id="dateExpired"
                value="{{ old('date_expired', $data->date_expired) }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none focus:ring-1 focus:ring-blue-600"
            >

            <p class="mt-2 text-sm text-gray-500">
                Voucher tidak dapat digunakan setelah tanggal dan waktu ini.
            </p>

            @error('date_expired')
                <p class="mt-2 text-sm text-red-600">
                    {{ $message }}
                </p>
            @enderror

        </div>


        {{-- STATUS --}}
        <div>

            <label class="flex items-center gap-3 cursor-pointer">

                <input
                    type="checkbox"
                    name="status"
                    value="1"
                    {{ old('status', $data->status) ? 'checked' : '' }}
                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-600"
                >

                <span class="font-semibold">
                    Voucher Aktif
                </span>

            </label>

            <p class="mt-1 ml-8 text-sm text-gray-500">
                Jika aktif, voucher dapat digunakan oleh pelanggan.
            </p>

        </div>

    </div>


    {{-- FOOTER --}}
    <div class="flex flex-col-reverse gap-4 px-8 py-6 border-t border-gray-300 bg-gray-50 sm:flex-row sm:justify-end">

        <a
            href="{{ url('/dashboard/voucher') }}"
            class="px-8 py-3 font-semibold text-center transition border border-gray-300 rounded-xl hover:bg-gray-100"
        >
            Batal
        </a>

        <button
            type="submit"
            class="px-10 py-3 font-semibold text-white transition bg-blue-600 rounded-xl hover:bg-blue-800"
        >
            Simpan Voucher
        </button>

    </div>

</form>

</div>

@endsection