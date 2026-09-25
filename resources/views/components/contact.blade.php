{{-- HERO --}}
<section class="bg-sky-700 py-24 text-white">
    <div class="mx-auto max-w-7xl px-6 text-center">

        <h1 class="text-5xl font-bold">
            Hubungi Kami
        </h1>

        <p class="mx-auto mt-6 max-w-2xl text-lg text-sky-100">
            Ada pertanyaan mengenai villa, reservasi, ataupun kerja sama?
            Tim Villa Kita siap membantu Anda.
        </p>

    </div>
</section>

{{-- CONTACT --}}
<section class="z-50 -mt-10 rounded-t-[50px] bg-slate-50 py-20 pb-16">
    <div class="mx-auto grid max-w-7xl gap-10 px-6 lg:grid-cols-2">

        {{-- LEFT --}}
        <div>

            <h2 class="text-4xl font-bold text-slate-800">
                Mari Terhubung
            </h2>

            <p class="mt-5 leading-8 text-slate-600">
                Jangan ragu menghubungi kami apabila Anda membutuhkan
                informasi mengenai villa, booking, ataupun rekomendasi
                tempat menginap terbaik.
            </p>

            <div class="mt-10 space-y-6">

                {{-- Alamat --}}
                <div class="flex gap-4">

                    <div class="rounded-xl bg-sky-100 p-4">
                        <i class="fa-solid fa-location-dot text-xl text-sky-600"></i>
                    </div>

                    <div>
                        <h3 class="font-semibold">
                            Alamat
                        </h3>

                        <p class="text-slate-500">
                            Jl. Pajajaran No.123, Bogor,
                            Jawa Barat
                        </p>
                    </div>

                </div>


                {{-- Telepon --}}
                <div class="flex gap-4">

                    <div class="rounded-xl bg-sky-100 p-4">
                        <i class="fa-solid fa-phone text-xl text-sky-600"></i>
                    </div>

                    <div>
                        <h3 class="font-semibold">
                            Telepon
                        </h3>

                        <p class="text-slate-500">
                            +62 812-3456-7890
                        </p>
                    </div>

                </div>


                {{-- Email --}}
                <div class="flex gap-4">

                    <div class="rounded-xl bg-sky-100 p-4">
                        <i class="fa-solid fa-envelope text-xl text-sky-600"></i>
                    </div>

                    <div>
                        <h3 class="font-semibold">
                            Email
                        </h3>

                        <p class="text-slate-500">
                            hello@villakita.id
                        </p>
                    </div>

                </div>


                {{-- Jam Operasional --}}
                <div class="flex gap-4">

                    <div class="rounded-xl bg-sky-100 p-4">
                        <i class="fa-regular fa-clock text-xl text-sky-600"></i>
                    </div>

                    <div>
                        <h3 class="font-semibold">
                            Jam Operasional
                        </h3>

                        <p class="text-slate-500">
                            Senin - Minggu
                            <br>
                            08.00 - 22.00 WIB
                        </p>
                    </div>

                </div>

            </div>

        </div>


        {{-- RIGHT --}}
        <div class="rounded-3xl bg-white p-8 shadow-lg">

            <h2 class="text-3xl font-bold text-slate-800">
                Kirim Pesan
            </h2>

            <form
                action="#"
                method="POST"
                class="mt-8 space-y-5"
            >

                @csrf

                {{-- Nama --}}
                <input
                    type="text"
                    name="name"
                    placeholder="Nama Lengkap"
                    class="w-full rounded-xl border border-gray-300 p-4 text-gray-700 outline-none placeholder:text-gray-400 focus:border-sky-500 focus:ring-0"
                >

                {{-- Email --}}
                <input
                    type="email"
                    name="email"
                    placeholder="Alamat Email"
                    class="w-full rounded-xl border border-gray-300 p-4 text-gray-700 outline-none placeholder:text-gray-400 focus:border-sky-500 focus:ring-0"
                >

                {{-- Subject --}}
                <input
                    type="text"
                    name="subject"
                    placeholder="Subjek"
                    class="w-full rounded-xl border border-gray-300 p-4 text-gray-700 outline-none placeholder:text-gray-400 focus:border-sky-500 focus:ring-0"
                >

                {{-- Message --}}
                <textarea
                    name="message"
                    rows="6"
                    placeholder="Tulis pesan Anda..."
                    class="w-full rounded-xl border border-gray-300 p-4 text-gray-700 outline-none placeholder:text-gray-400 focus:border-sky-500 focus:ring-0"
                ></textarea>

                {{-- Submit --}}
                <button
                    type="submit"
                    class="flex items-center gap-3 rounded-xl border-gray-300 bg-sky-600 px-8 py-4 font-semibold text-white transition hover:bg-sky-700"
                >
                    <i class="fa-solid fa-paper-plane"></i>
                    Kirim Pesan
                </button>

            </form>

        </div>

    </div>
</section>


{{-- MAP --}}
<section class="bg-blue-200 py-10">

    <div class="mx-auto max-w-7xl px-6">

        <div class="overflow-hidden rounded-3xl shadow-lg">

            <iframe
                src="https://www.google.com/maps?q=Bogor&output=embed"
                class="h-[450px] w-full border-0"
                loading="lazy"
                allowfullscreen
                referrerpolicy="no-referrer-when-downgrade"
            ></iframe>

        </div>

    </div>

</section>


{{-- FAQ --}}
<section class="bg-slate-50 py-24">

    <div class="mx-auto max-w-5xl px-6">

        <h2 class="mb-12 text-center text-4xl font-bold text-gray-700">
            Pertanyaan Umum
        </h2>

        <div class="space-y-6">

            {{-- FAQ 1 --}}
            <div class="rounded-2xl bg-white p-6 shadow">

                <div class="flex items-center gap-3 font-semibold text-gray-700">

                    <i class="fa-regular fa-message text-lg text-sky-600"></i>

                    Bagaimana cara melakukan booking?

                </div>

                <p class="mt-4 text-slate-600">
                    Anda dapat melakukan booking langsung melalui halaman
                    detail villa atau menghubungi customer service kami.
                </p>

            </div>


            {{-- FAQ 2 --}}
            <div class="rounded-2xl bg-white p-6 shadow">

                <div class="flex items-center gap-3 font-semibold text-gray-700">

                    <i class="fa-regular fa-message text-lg text-sky-600"></i>

                    Apakah bisa refund?

                </div>

                <p class="mt-4 text-slate-600">
                    Refund mengikuti kebijakan masing-masing villa dan waktu
                    pembatalan.
                </p>

            </div>


            {{-- FAQ 3 --}}
            <div class="rounded-2xl bg-white p-6 shadow">

                <div class="flex items-center gap-3 font-semibold text-gray-700">

                    <i class="fa-regular fa-message text-lg text-sky-600"></i>

                    Apakah tersedia customer service 24 jam?

                </div>

                <p class="mt-4 text-slate-600">
                    Customer service kami tersedia setiap hari pukul
                    08.00-22.00 WIB.
                </p>

            </div>

        </div>

    </div>

</section>