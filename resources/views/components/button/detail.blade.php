@props(['href'])

<a href="{{ $href }}" class="px-5 py-2 text-white transition duration-300 bg-primary rounded-3xl hover:bg-primary-hover">
    <i class="mr-1 fas fa-eye"></i> {{ $slot }}
</a>