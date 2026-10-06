@props(['href'])

<a href="{{ $href }}"
   class="px-5 py-2 font-semibold text-white transition duration-300 ease-in-out bg-gray-700 rounded-lg shadow-md hover:bg-gray-800">
    {{ $slot }}
</a>