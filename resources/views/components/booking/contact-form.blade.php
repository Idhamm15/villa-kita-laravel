<div class="overflow-hidden rounded-2xl bg-white shadow-lg">

    {{-- Header --}}
    <div class="border-b border-gray-300 p-6">
        <h2 class="text-xl font-bold">
            Detail Kontak
        </h2>

        <p class="text-sm text-gray-500">
            Lengkapi data tamu yang akan menginap/trip.
        </p>
    </div>

    {{-- Form Content --}}
    <div class="space-y-5 p-6">

        {{-- Nama --}}
        <div>
            <label class="mb-2 block text-sm font-medium">
                Nama Lengkap
            </label>

            <input
                type="text"
                name="nameGuest"
                value="{{ old('nameGuest') }}"
                placeholder="Masukkan nama lengkap"
                class="w-full rounded-xl border px-4 py-3 outline-none transition focus:border-blue-600"
            >
        </div>

        {{-- HP & Email --}}
        <div class="grid gap-5 md:grid-cols-2">

            {{-- Nomor HP --}}
            <div>
                <label class="mb-2 block text-sm font-medium">
                    Nomor HP
                </label>

                <input
                    type="tel"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="08xxxxxxxxxx"
                    class="w-full rounded-xl border px-4 py-3 outline-none transition focus:border-blue-600"
                >
            </div>

            {{-- Email --}}
            <div>
                <label class="mb-2 block text-sm font-medium">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="email@example.com"
                    class="w-full rounded-xl border px-4 py-3 outline-none transition focus:border-blue-600"
                >
            </div>

        </div>

        {{-- Check In Out --}}
        <div class="grid gap-5 md:grid-cols-2">

            {{-- Check In --}}
            <div>
                <label class="mb-2 block text-sm font-medium">
                    Tanggal & Jam Check In
                </label>

                <input
                    type="datetime-local"
                    name="checkIn"
                    value="{{ old('checkIn') }}"
                    class="w-full rounded-xl border px-4 py-3 outline-none transition focus:border-blue-600"
                >
            </div>

            {{-- Check Out --}}
            <div>
                <label class="mb-2 block text-sm font-medium">
                    Tanggal & Jam Check Out
                </label>

                <input
                    type="datetime-local"
                    name="checkOut"
                    value="{{ old('checkOut') }}"
                    class="w-full rounded-xl border px-4 py-3 outline-none transition focus:border-blue-600"
                >
            </div>

        </div>

        {{-- Total Tamu --}}
        <div>
            <label class="mb-2 block text-sm font-medium">
                Total Tamu
            </label>

            <input
                type="number"
                name="totalGuest"
                min="1"
                value="{{ old('totalGuest', 1) }}"
                class="w-full rounded-xl border px-4 py-3 outline-none transition focus:border-blue-600"
            >
        </div>

        {{-- Catatan --}}
        <div>
            <label class="mb-2 block text-sm font-medium">
                Catatan (Opsional)
            </label>

            <textarea
                name="note"
                rows="4"
                placeholder="Contoh: Datang malam hari, membutuhkan extra bed, dll."
                class="w-full rounded-xl border px-4 py-3 outline-none transition focus:border-blue-600"
            >{{ old('note') }}</textarea>
        </div>

    </div>

    {{-- Footer --}}
    <div class="border-t border-gray-300 p-6">
        <button
            type="submit"
            class="w-full rounded-xl bg-blue-600 py-4 font-semibold text-white transition hover:bg-blue-700"
        >
            Lanjut ke Pembayaran
        </button>
    </div>

</div>