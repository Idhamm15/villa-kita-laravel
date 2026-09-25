@extends('layouts.app')

@section('content')

    <x-banner
        breadcrumb="Blog"
        {{-- name="Villa Harmoni Tegal" --}}
        {{-- location="Kota Tegal"
        status="Open"
        openTime="24 Hours"
        :show-action="true" --}}
    />
    
    @php
        $blogs = [
            [
                'id' => 1,
                'slug' => 'tips-memilih-villa-di-puncak',
                'title' => '7 Tips Memilih Villa Terbaik di Puncak Bogor',
                'thumbnail' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=1200&q=80',
                'created_at' => '2026-07-01',
                'author' => 'Admin',
                'description' => 'Temukan tips memilih villa terbaik di Puncak Bogor agar liburan bersama keluarga menjadi lebih nyaman dan menyenangkan.',
            ],
            [
                'id' => 2,
                'slug' => 'villa-private-pool-bandung',
                'title' => 'Rekomendasi Villa Private Pool di Bandung',
                'thumbnail' => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?w=1200&q=80',
                'created_at' => '2026-07-02',
                'author' => 'Admin',
                'description' => 'Nikmati pengalaman menginap dengan private pool di villa-villa terbaik kawasan Lembang dan Dago.',
            ],
            [
                'id' => 3,
                'slug' => 'staycation-jakarta',
                'title' => 'Staycation Mewah di Jakarta dengan Villa Eksklusif',
                'thumbnail' => 'https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?w=1200&q=80',
                'created_at' => '2026-07-03',
                'author' => 'Admin',
                'description' => 'Pilihan villa eksklusif di Jakarta yang cocok untuk staycation bersama pasangan maupun keluarga.',
            ],
            [
                'id' => 4,
                'slug' => 'villa-instagramable',
                'title' => 'Villa Instagramable untuk Liburan Akhir Pekan',
                'thumbnail' => 'https://images.unsplash.com/photo-1600047509807-ba8f99d2cdde?w=1200&q=80',
                'created_at' => '2026-07-04',
                'author' => 'Admin',
                'description' => 'Cari villa dengan desain estetik? Berikut rekomendasi villa yang cocok untuk foto-foto dan healing.',
            ],
            [
                'id' => 5,
                'slug' => 'villa-keluarga-besar',
                'title' => 'Villa untuk Rombongan Keluarga Besar',
                'thumbnail' => 'https://images.unsplash.com/photo-1613977257363-707ba9348227?w=1200&q=80',
                'created_at' => '2026-07-05',
                'author' => 'Admin',
                'description' => 'Villa dengan kapasitas besar lengkap dengan BBQ area, kolam renang, dan halaman luas.',
            ],
            [
                'id' => 6,
                'slug' => 'villa-puncak-murah',
                'title' => 'Villa Murah di Puncak Mulai 500 Ribuan',
                'thumbnail' => 'https://images.unsplash.com/photo-1605146769289-440113cc3d00?w=1200&q=80',
                'created_at' => '2026-07-06',
                'author' => 'Admin',
                'description' => 'Pilihan villa budget friendly dengan fasilitas lengkap untuk liburan hemat bersama keluarga.',
            ],
        ];
    @endphp

    <section class="z-50 -mt-10 rounded-t-[50px] bg-white py-24 pb-16">

        <div class="mx-auto max-w-7xl px-6 lg:px-8">

            {{-- Search --}}
            <div class="mb-16">

                <div class="relative">

                    <input
                        type="text"
                        name="search"
                        placeholder="Cari artikel..."
                        class="w-full rounded-xl border border-slate-200 py-4 pl-5 pr-12 text-gray-600 outline-none focus:border-cyan-500 focus:ring-0"
                    >

                    <i class="fa-solid fa-magnifying-glass absolute right-5 top-1/2 -translate-y-1/2 text-slate-400"></i>

                </div>

            </div>


            {{-- List Blog --}}
            <div class="grid gap-10 sm:grid-cols-2 xl:grid-cols-3">

                @foreach ($blogs as $blog)

                    <article class="group">

                        {{-- Thumbnail --}}
                        <a href="{{ url('/blog/' . $blog['slug']) }}">

                            <div class="relative aspect-[4/3] overflow-hidden rounded-3xl">

                                <img
                                    src="{{ $blog['thumbnail'] }}"
                                    alt="{{ $blog['title'] }}"
                                    class="h-full w-full object-cover transition duration-500 group-hover:scale-110"
                                >

                            </div>

                        </a>


                        {{-- Meta --}}
                        <div class="mt-5 flex items-center gap-6 text-sm text-slate-500">

                            <div class="flex items-center gap-2">

                                <i class="fa-regular fa-calendar-days"></i>

                                <span>
                                    {{ \Carbon\Carbon::parse($blog['created_at'])->locale('id')->translatedFormat('j F Y') }}
                                </span>

                            </div>


                            <div class="flex items-center gap-2">

                                <i class="fa-solid fa-user"></i>

                                <span>
                                    {{ $blog['author'] }}
                                </span>

                            </div>

                        </div>


                        {{-- Title --}}
                        <a href="{{ url('/blog/' . $blog['slug']) }}">

                            <h2 class="mt-5 text-2xl font-bold text-[#01085a] transition group-hover:text-cyan-600">
                                {{ $blog['title'] }}
                            </h2>

                        </a>


                        {{-- Description --}}
                        <p class="mt-4 leading-8 text-slate-600">
                            {{ $blog['description'] }}
                        </p>


                        {{-- Read More --}}
                        <a
                            href="{{ url('/blog/' . $blog['slug']) }}"
                            class="mt-6 inline-flex items-center font-semibold text-cyan-600 hover:text-cyan-700"
                        >
                            Baca Selengkapnya →
                        </a>

                    </article>

                @endforeach

            </div>

        </div>

    </section>

@endsection