<div
    id="{{ $id ?? 'section-loading' }}"
    class="absolute inset-0 z-50 flex items-center justify-center bg-gray-100 rounded-lg"
>
    <div class="flex flex-col items-center gap-4">

        <div class="w-12 h-12 border-4 rounded-full border-slate-200 border-t-cyan-500 animate-spin"></div>

        <span class="text-sm font-medium text-slate-500">
            {{ $text ?? 'Memuat...' }}
        </span>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const loader = document.getElementById('{{ $id ?? 'section-loading' }}');

        if (!loader) {
            return;
        }

        setTimeout(function () {
            loader.classList.add('hidden');
        }, {{ $duration ?? 3000 }});

    });
</script>