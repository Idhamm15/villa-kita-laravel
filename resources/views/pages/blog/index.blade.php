@extends('layouts.app')

@section('content')

    <x-banner
        name="Blog Terkini"
    />

    <section
        id="blog-section"
        class="relative z-50 -mt-10 rounded-t-[50px] bg-white py-24 pb-16"
    >

        {{-- Loading --}}
        <div
            id="section-loading"
            class="absolute inset-0 z-50 flex items-center justify-center rounded-t-[50px] bg-white"
        >
            <div class="flex flex-col items-center gap-4">

                <div class="w-12 h-12 border-4 rounded-full border-slate-200 border-t-cyan-500 animate-spin"></div>

                <span class="text-sm font-medium text-slate-500">
                    Memuat blog...
                </span>

            </div>
        </div>


        <div class="px-6 mx-auto max-w-7xl lg:px-8">

            {{-- Search --}}
            <div class="mb-16">

                <form
                    action="{{ url('/blog') }}"
                    method="GET"
                    onsubmit="showLoading()"
                >

                    <div class="grid grid-cols-4 gap-3">

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari blog..."
                            class="w-full col-span-3 px-5 py-4 text-gray-600 border outline-none rounded-xl border-slate-200 focus:border-cyan-500 focus:ring-0"
                        >

                        <button
                            type="submit"
                            class="flex items-center justify-center col-span-1 gap-2 px-5 py-4 text-sm font-semibold text-white rounded-xl bg-cyan-500 hover:bg-cyan-600"
                        >
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Cari Blog
                        </button>

                    </div>

                </form>

            </div>

            {{-- List Blog --}}
            <div class="grid gap-10 sm:grid-cols-2 xl:grid-cols-3">

                @foreach ($data as $blog)

                    <article class="group">

                        {{-- Thumbnail --}}
                        <a href="{{ url('/blog/' . $blog['slug']) }}">

                            <div class="relative aspect-[4/3] overflow-hidden rounded-3xl">

                                <img
                                    src="{{ asset('storage/' . $blog['thumbnail']) }}"
                                    alt="{{ $blog['title'] }}"
                                    class="object-cover w-full h-full transition duration-500 group-hover:scale-110"
                                >

                            </div>

                        </a>


                        {{-- Meta --}}
                        <div class="flex items-center gap-6 mt-5 text-sm text-slate-500">

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
                            {{ strip_tags($blog['content'] ?? '') }}
                        </p>


                        {{-- Read More --}}
                        <a
                            href="{{ url('/blog/' . $blog['slug']) }}"
                            class="inline-flex items-center mt-6 font-semibold text-cyan-600 hover:text-cyan-700"
                        >
                            Baca Selengkapnya →
                        </a>

                    </article>

                @endforeach

            </div>

        </div>

    </section>

    <script>
        const startTime = Date.now();

        window.addEventListener('load', function () {

            const loader = document.getElementById('section-loading');

            const elapsed = Date.now() - startTime;
            const remaining = Math.max(3000 - elapsed, 0);

            setTimeout(function () {

                if (loader) {
                    loader.classList.add('hidden');
                }

            }, remaining);
        });


        function showLoading() {

            const loader = document.getElementById('section-loading');

            if (loader) {
                loader.classList.remove('hidden');
            }
        }
    </script>


@endsection