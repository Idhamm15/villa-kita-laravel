@props(['href'])

<a href="{{ $href }}"
   class="px-4 py-2 mt-10 text-white transition duration-300 bg-primary rounded-3xl hover:bg-primary-hover">
    {{ $slot }}
</a>