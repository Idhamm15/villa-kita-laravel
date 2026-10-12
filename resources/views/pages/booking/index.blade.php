@extends('layouts.app')

@section('content')

    <div class="min-h-screen bg-slate-50">
        <div class="container px-4 py-10 mx-auto max-w-7xl">

            {{-- Booking Steps --}}
            <x-booking.steps :current-step="0" />

            {{-- Main Content --}}
            <div class="grid gap-8 lg:grid-cols-12">

                {{-- LEFT --}}
                <div class="space-y-6 lg:col-span-8">

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
                        id="bookingForm"
                        action="{{ url('/booking/store/' . $data->id) }}"
                        method="POST"
                    >
                        @csrf

                        {{-- Visitor Type --}}
                        <div class="p-6 bg-white shadow-lg rounded-2xl">
                            <div class="grid gap-6 md:grid-cols-2">

                                {{-- SELF --}}
                                <label
                                    class="
                                        flex cursor-pointer items-start gap-3 rounded-xl border p-5 transition
                                        {{ old('visitor_type', 'SELF') === 'SELF'
                                            ? 'border-blue-600 bg-blue-50'
                                            : 'border-gray-200 hover:border-blue-500'
                                        }}
                                    "
                                >
                                    <input
                                        type="radio"
                                        name="visitor_type"
                                        value="SELF"
                                        {{ old('visitor_type', 'SELF') === 'SELF' ? 'checked' : '' }}
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
                                        {{ old('visitor_type', 'SELF') === 'SOMEONE_ELSE'
                                            ? 'border-blue-600 bg-blue-50'
                                            : 'border-gray-200 hover:border-blue-500'
                                        }}
                                    "
                                >
                                    <input
                                        type="radio"
                                        name="visitor_type"
                                        value="SOMEONE_ELSE"
                                        {{ old('visitor_type', 'SELF') === 'SOMEONE_ELSE' ? 'checked' : '' }}
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

                        {{-- Jarak antara Visitor Type dan Contact Form --}}
                        <div class="h-6"></div>

                        {{-- Contact Form --}}
                        <div class="overflow-hidden bg-white shadow-lg rounded-2xl">

                            {{-- Header --}}
                            <div class="p-6 border-b border-gray-300">
                                <h2 class="text-xl font-bold">
                                    Detail Kontak
                                </h2>

                                <p class="text-sm text-gray-500">
                                    Lengkapi data tamu yang akan menginap/trip.
                                </p>
                            </div>

                            {{-- Form Content --}}
                            <div class="p-6 space-y-5">

                                {{-- Nama --}}
                                <div>
                                    <label for="name_guest" class="block mb-2 text-sm font-medium">
                                        Nama Lengkap
                                    </label>

                                    <input
                                        type="text"
                                        id="nameGuest"
                                        name="name_guest"
                                        value="{{ old('name_guest') }}"
                                        placeholder="Masukkan nama lengkap"
                                        class="w-full px-4 py-3 transition border outline-none rounded-xl focus:border-blue-600"
                                    >
                                </div>

                                {{-- HP & Email --}}
                                <div class="grid gap-5 md:grid-cols-2">

                                    {{-- Nomor HP --}}
                                    <div>
                                        <label for="phone" class="block mb-2 text-sm font-medium">
                                            Nomor HP
                                        </label>

                                        <input
                                            type="tel"
                                            id="phone"
                                            name="phone"
                                            value="{{ old('phone') }}"
                                            placeholder="08xxxxxxxxxx"
                                            class="w-full px-4 py-3 transition border outline-none rounded-xl focus:border-blue-600"
                                        >
                                    </div>

                                    {{-- Email --}}
                                    <div>
                                        <label for="email" class="block mb-2 text-sm font-medium">
                                            Email
                                        </label>

                                        <input
                                            type="email"
                                            id="email"
                                            name="email"
                                            value="{{ old('email') }}"
                                            placeholder="email@example.com"
                                            class="w-full px-4 py-3 transition border outline-none rounded-xl focus:border-blue-600"
                                        >
                                    </div>

                                </div>

                                {{-- Check In Out --}}
                                <div class="grid gap-5 md:grid-cols-2">

                                    {{-- Check In --}}
                                    <div>
                                        <label for="checkIn" class="block mb-2 text-sm font-medium">
                                            Tanggal & Jam Check In
                                        </label>

                                        <input
                                            type="datetime-local"
                                            id="checkIn"
                                            name="check_in"
                                            value="{{ old('check_in') }}"
                                            class="w-full px-4 py-3 transition border outline-none rounded-xl focus:border-blue-600"
                                        >
                                    </div>

                                    {{-- Check Out --}}
                                    <div>
                                        <label for="checkOut" class="block mb-2 text-sm font-medium">
                                            Tanggal & Jam Check Out
                                        </label>

                                        <input
                                            type="datetime-local"
                                            id="checkOut"
                                            name="check_out"
                                            value="{{ old('check_out') }}"
                                            class="w-full px-4 py-3 transition border outline-none rounded-xl focus:border-blue-600"
                                        >
                                    </div>

                                </div>

                                {{-- Discount Voucher --}}
                                <input
                                    type="hidden"
                                    id="discount"
                                    name="discount"
                                    value="{{ old('discount', $booking['discount'] ?? 0) }}"
                                >

                                {{-- Total Tamu --}}
                                <div>
                                    <label for="totalGuest" class="block mb-2 text-sm font-medium">
                                        Total Tamu
                                    </label>

                                    <input
                                        type="number"
                                        id="totalGuest"
                                        name="total_guest"
                                        min="1"
                                        value="{{ old('total_guest', 1) }}"
                                        class="w-full px-4 py-3 transition border outline-none rounded-xl focus:border-blue-600"
                                    >
                                </div>

                                {{-- Catatan --}}
                                <div>
                                    <label for="note" class="block mb-2 text-sm font-medium">
                                        Catatan (Opsional)
                                    </label>

                                    <textarea
                                        id="note"
                                        name="note"
                                        rows="4"
                                        placeholder="Contoh: Datang malam hari, membutuhkan extra bed, dll."
                                        class="w-full px-4 py-3 transition border outline-none rounded-xl focus:border-blue-600"
                                    >{{ old('note') }}</textarea>
                                </div>

                            </div>

                            {{-- Footer --}}
                            <div class="p-6 border-t border-gray-300">
                                <button
                                    type="submit"
                                    class="w-full py-4 font-semibold text-white transition bg-blue-600 rounded-xl hover:bg-blue-700"
                                >
                                    Lanjut ke Pembayaran
                                </button>
                            </div>

                        </div>

                    </form>

                    <input
                        type="hidden"
                        id="voucher_code"
                        name="voucherCode"
                        value="{{ $booking['voucherCode'] ?? '' }}"
                        form="bookingForm"
                    >

                </div>

                {{-- RIGHT --}}
                <div class="lg:col-span-4">
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
                </div>

            </div>

        </div>
    </div>

    <script>

        document.getElementById('applyVoucher')?.addEventListener('click', function () {
            const visibleVoucher = document.getElementById('voucherCode');
            const hiddenVoucher = document.getElementById('voucher_code');

            if (visibleVoucher && hiddenVoucher) {
                hiddenVoucher.value = visibleVoucher.value.trim();
            }
        });

        document.addEventListener('DOMContentLoaded', function () {
            const fields = {
                checkIn: document.getElementById('checkIn'),
                checkOut: document.getElementById('checkOut'),
                totalGuest: document.getElementById('totalGuest'),
            };

            // Data harga awal
            const price = @js((float) ($data['price'] ?? 0));
            const serviceFee = @js((float) ($product['serviceFee'] ?? 5000));

            // Diskon harus menggunakan let karena dapat berubah saat voucher digunakan
            let discount = @js((float) ($booking['discount'] ?? 0));
            let appliedVoucherCode = '';

            // Elemen voucher
            const voucherInput = document.getElementById('voucherCode');
            const voucherButton = document.getElementById('applyVoucher');
            const voucherMessage = document.getElementById('voucherMessage');

            /**
             * Format nominal ke Rupiah
             */
            function formatCurrency(value) {
                return 'Rp ' + Math.round(value).toLocaleString('id-ID');
            }

            /**
             * Format tanggal
             */
            function formatDate(value) {
                if (!value) return '-';

                const date = new Date(value);

                if (Number.isNaN(date.getTime())) return '-';

                return new Intl.DateTimeFormat('id-ID', {
                    day: '2-digit',
                    month: 'short',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                }).format(date);
            }

            /**
             * Update teks elemen HTML
             */
            function setText(id, value) {
                const element = document.getElementById(id);

                if (element) {
                    element.textContent = value;
                }
            }

            /**
             * Hitung durasi booking
             */
            function getNights() {
                const checkIn = fields.checkIn?.value;
                const checkOut = fields.checkOut?.value;

                if (!checkIn || !checkOut) {
                    return 1;
                }

                const start = new Date(checkIn);
                const end = new Date(checkOut);
                const diff = end.getTime() - start.getTime();

                if (diff <= 0) {
                    return 1;
                }

                return Math.max(1, Math.ceil(diff / 86400000));
            }

            /**
             * Hitung subtotal
             */
            function getPurchaseAmount() {
                return price * getNights();
            }

            /**
             * Tampilkan pesan voucher
             */
            function showVoucherMessage(message, type = 'error') {
                if (!voucherMessage) return;

                voucherMessage.textContent = message;

                voucherMessage.className = type === 'success'
                    ? 'mt-2 text-sm text-green-600'
                    : 'mt-2 text-sm text-red-600';
            }

            /**
             * Hapus voucher yang sudah diterapkan
             */
            function clearVoucher(message = '') {
                discount = 0;
                appliedVoucherCode = '';

                updateSummary();

                if (message) {
                    showVoucherMessage(message, 'error');
                }
            }

            /**
             * Update ringkasan booking
             */
            function updateSummary() {
                const checkIn = fields.checkIn?.value;
                const checkOut = fields.checkOut?.value;
                const totalGuest = Number(fields.totalGuest?.value || 1);

                setText('summaryCheckIn', formatDate(checkIn));
                setText('summaryCheckOut', formatDate(checkOut));
                setText('summaryGuest', `${Math.max(1, totalGuest)} Orang`);

                const nights = getNights();
                const subtotal = getPurchaseAmount();

                // Pastikan diskon tidak melebihi subtotal
                const validDiscount = Math.min(
                    Math.max(0, discount),
                    subtotal
                );

                const total = Math.max(
                    0,
                    subtotal + serviceFee - validDiscount
                );

                setText('summaryNights', `${nights} Malam`);
                setText('summaryDuration', `${nights} x`);
                setText('summaryPrice', formatCurrency(price));
                setText('summarySubtotal', formatCurrency(subtotal));
                setText('summaryServiceFee', formatCurrency(serviceFee));
                setText('summaryDiscount', '-' + formatCurrency(validDiscount));
                setText('summaryTotal', formatCurrency(total));
            }
            
            /**
             * Validasi dan terapkan voucher
             */
            voucherButton?.addEventListener('click', async function () {
                const code = voucherInput?.value.trim();

                if (!code) {
                    clearVoucher('Masukkan kode voucher terlebih dahulu.');

                    Swal.fire({
                        icon: 'warning',
                        title: 'Kode Voucher Kosong',
                        text: 'Masukkan kode voucher terlebih dahulu.',
                        confirmButtonText: 'OK',
                    });
                    return;
                }

                if (
                    fields.checkIn?.value &&
                    fields.checkOut?.value &&
                    new Date(fields.checkOut.value) <= new Date(fields.checkIn.value)
                ) {
                    clearVoucher('Tanggal check-out harus setelah check-in.');

                    Swal.fire({
                        icon: 'warning',
                        title: 'Tanggal Tidak Valid',
                        text: 'Tanggal check-out harus setelah check-in.',
                        confirmButtonText: 'OK',
                    });
                    return;
                }

                voucherButton.disabled = true;
                voucherButton.textContent = 'Memeriksa...';

                try {
                    const response = await fetch('/booking/validate-voucher', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN':
                                document.querySelector('meta[name="csrf-token"]')?.content || '',
                        },
                        body: JSON.stringify({
                            code: code,
                            product_id: @js($product['id'] ?? null),
                            purchase_amount: getPurchaseAmount(),
                        }),
                    });

                    const result = await response.json();

                    if (!response.ok || !result.valid) {
                        const message = result.message || 'Voucher tidak valid.';

                        clearVoucher(message);

                        Swal.fire({
                            icon: 'error',
                            title: 'Voucher Gagal Digunakan',
                            text: message,
                            confirmButtonText: 'Mengerti',
                        });
                        return;
                    }

                    // Simpan diskon dari API
                    const returnedDiscount = Number(result.discount);

                    if (!Number.isFinite(returnedDiscount) || returnedDiscount < 0) {
                        clearVoucher('Nominal diskon dari server tidak valid.');

                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi Kesalahan',
                            text: 'Nominal diskon dari server tidak valid.',
                            confirmButtonText: 'OK',
                        });
                        return;
                    }

                    discount = returnedDiscount;
                    appliedVoucherCode = code;

                    updateSummary();

                    const message =
                        `${result.message || 'Voucher berhasil digunakan.'} ` +
                        `Diskon ${formatCurrency(discount)}.`;

                    showVoucherMessage(message, 'success');

                    Swal.fire({
                        icon: 'success',
                        title: 'Voucher Berhasil!',
                        text: message,
                        confirmButtonText: 'Lanjutkan',
                        confirmButtonColor: '#2563eb',
                    });
                } catch (error) {
                    console.error('Voucher validation error:', error);

                    const message = 'Terjadi kesalahan saat memeriksa voucher.';

                    clearVoucher(message);

                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Memeriksa Voucher',
                        text: message,
                        confirmButtonText: 'Coba Lagi',
                    });
                } finally {
                    voucherButton.disabled = false;
                    voucherButton.textContent = 'Gunakan';
                }
            });
            
            /**
             * Jika tanggal berubah, validasi ulang voucher yang sudah diterapkan.
             */
            function handleBookingChange() {
                if (appliedVoucherCode) {
                    const code = appliedVoucherCode;

                    // Reset diskon lama agar tidak menggunakan diskon
                    // berdasarkan subtotal sebelumnya.
                    clearVoucher('Tanggal booking berubah. Silakan gunakan voucher kembali.');

                    if (voucherInput) {
                        voucherInput.value = code;
                    }
                } else {
                    updateSummary();
                }
            }

            Object.values(fields).forEach(function (input) {
                if (!input) return;

                input.addEventListener('input', handleBookingChange);
                input.addEventListener('change', handleBookingChange);
            });

            // Render ringkasan pertama kali
            updateSummary();
        });
    </script>
@endsection
