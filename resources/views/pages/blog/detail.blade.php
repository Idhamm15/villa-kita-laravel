@extends('layouts.app')

@section('content')

    <x-banner
        breadcrumb="Blog"
        :name="$data->title"
    />

    {{-- Detail Blog --}}
    <section class="relative z-50 -mt-10 rounded-t-[50px] bg-white py-24 pb-16">

        {{-- Hero --}}
        <div class="relative h-[260px] mx-6 -mt-36 rounded-2xl md:mx-24 md:h-[420px]">

            <img
                src="{{ asset('storage/' . $data->thumbnail) }}"
                alt="{{ $data->title }}"
                class="absolute inset-0 object-cover w-full h-full rounded-2xl"
            >

            <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-sky-900/80 to-sky-600/40"></div>

        </div>

        {{-- Header --}}
        <div class="relative z-10 max-w-5xl px-6 mx-auto -mt-24">

            <div class="px-8 py-10 bg-white shadow-xl rounded-3xl md:px-16">

                <h1 class="text-3xl font-bold text-center text-slate-800 md:text-5xl">
                    {{ $data->title }}
                </h1>

                <div class="flex flex-wrap items-center justify-center gap-8 mt-8 text-gray-500">

                    {{-- Date --}}
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-calendar"></i>

                        <span>
                            {{ $data->created_at?->translatedFormat('d F Y') }}
                        </span>
                    </div>

                    {{-- Author --}}
                    <div class="flex items-center gap-2">
                        <i class="fa-regular fa-user"></i>

                        <span>
                            {{ $data->author ?? 'Admin' }}
                        </span>
                    </div>

                </div>

            </div>

        </div>

        {{-- Content --}}
        <div class="max-w-4xl px-6 py-20 mx-auto">

            <article class="space-y-8 text-lg leading-9 text-slate-700">

                {!! $data->content !!}

            </article>

        </div>

    </section>


    {{-- Related Articles --}}
    <section class="py-24 bg-slate-50">

        <div class="px-6 mx-auto max-w-7xl">

            <h2 class="text-4xl font-bold text-center mb-14 text-slate-800">
                Related Articles
            </h2>

            @if ($relatedBlogs->isEmpty())

                <div class="py-10 text-center">
                    <p class="text-gray-500">
                        Belum ada artikel terkait.
                    </p>
                </div>

            @else

                <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">

                    @foreach ($relatedBlogs as $item)

                        <article
                            class="overflow-hidden transition bg-white shadow rounded-3xl hover:-translate-y-2 hover:shadow-xl"
                        >

                            {{-- Image --}}
                            <a href="{{ url('/blog/' . $item->slug) }}">

                                <div class="relative h-60">

                                    <img
                                        src="{{ asset('storage/' . $item->thumbnail) }}"
                                        alt="{{ $item->title }}"
                                        class="object-cover w-full h-full"
                                    >

                                </div>

                            </a>

                            {{-- Content --}}
                            <div class="p-6">

                                {{-- Date --}}
                                <div class="flex items-center gap-2 text-sm text-gray-500">

                                    <i class="fa-regular fa-calendar"></i>

                                    <span>
                                        {{ $item->created_at?->translatedFormat('d F Y') }}
                                    </span>

                                </div>

                                {{-- Title --}}
                                <a href="{{ url('/blog/' . $item->slug) }}">

                                    <h3 class="mt-4 text-2xl font-bold transition text-slate-800 hover:text-sky-600">
                                        {{ $item->title }}
                                    </h3>

                                </a>

                                {{-- Description --}}
                                <p class="mt-4 text-slate-600">
                                    {{ Str::limit(strip_tags($item->content), 150) }}
                                </p>

                                {{-- Link --}}
                                <a
                                    href="{{ url('/blog/' . $item->slug) }}"
                                    class="inline-flex mt-6 font-semibold text-sky-600 hover:text-sky-700"
                                >
                                    Baca Selengkapnya →
                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>

            @endif

        </div>

    </section>


    {{-- Back To Top --}}
    <button
        type="button"
        onclick="window.scrollTo({
            top: 0,
            behavior: 'smooth'
        })"
        class="fixed z-50 flex items-center justify-center text-white transition rounded-full shadow-xl bottom-6 right-6 h-14 w-14 bg-sky-600 hover:scale-110"
    >
        <i class="text-lg fa-solid fa-arrow-up"></i>
    </button>

@endsection