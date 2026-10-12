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
            <label for="nameGuest" class="block mb-2 text-sm font-medium">
                Nama Lengkap
            </label>

            <input
                type="text"
                id="nameGuest"
                name="nameGuest"
                value="{{ old('nameGuest') }}"
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
                    name="checkIn"
                    value="{{ old('checkIn') }}"
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
                    name="checkOut"
                    value="{{ old('checkOut') }}"
                    class="w-full px-4 py-3 transition border outline-none rounded-xl focus:border-blue-600"
                >
            </div>

        </div>

        {{-- Total Tamu --}}
        <div>
            <label for="totalGuest" class="block mb-2 text-sm font-medium">
                Total Tamu
            </label>

            <input
                type="number"
                id="totalGuest"
                name="totalGuest"
                min="1"
                value="{{ old('totalGuest', 1) }}"
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