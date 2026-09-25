@extends('layouts.app')

@section('content')
<section class="bg-gray-50 py-12 mb-30">
    <div class="mx-auto max-w-7xl px-6">

        {{-- Heading --}}
        <h2 class="text-3xl font-bold text-slate-900">
            List Tersimpan
        </h2>

        <p class="mt-2 text-slate-600">
            A place to keep all your favorite items!
        </p>

        {{-- Empty State --}}
        <div class="mt-8 flex items-center gap-8 rounded-2xl border border-slate-200 bg-white p-8 shadow-sm">

            {{-- Icon --}}
            <div class="flex h-28 w-28 shrink-0 items-center justify-center rounded-full bg-sky-100">
                <div class="relative flex items-center justify-center">
                    <i class="fa-regular fa-bookmark text-[52px] text-sky-600"></i>

                    <span class="absolute -right-2 -top-1 flex h-6 w-6 items-center justify-center rounded-full bg-white">
                        <i class="fa-solid fa-xmark text-sm text-sky-600"></i>
                    </span>
                </div>
            </div>

            {{-- Content --}}
            <div>
                <h3 class="text-2xl font-bold text-slate-900">
                    No Saved Item Yet
                </h3>

                <p class="mt-3 max-w-2xl text-lg leading-8 text-slate-500">
                    Start building your bucket list to compare and track the
                    items you love!
                </p>
            </div>

        </div>
    </div>
</section>

     
@endsection