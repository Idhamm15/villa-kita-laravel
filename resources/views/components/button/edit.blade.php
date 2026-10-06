@props(['href'])

<a href="{{ $href }}" class="px-5 py-2 text-white transition duration-300 bg-yellow-500 rounded-3xl hover:bg-yellow-600">
    <i class="mr-1 fas fa-edit"></i> {{ $slot }}
</a>