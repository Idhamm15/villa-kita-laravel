<form
    action="{{ $action }}"
    method="POST"
    onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')"
>
    @csrf
    @method('DELETE')

    <button
        type="submit"
        class="p-2 text-red-600 transition bg-red-100 rounded-lg hover:bg-red-200"
        title="Hapus Artikel"
    >
        <i class="fa-solid fa-trash text-[18px]"></i>
    </button>
</form>