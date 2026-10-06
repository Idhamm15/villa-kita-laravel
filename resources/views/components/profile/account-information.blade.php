@php
    $user = auth()->user();
@endphp

<div class="space-y-8">

    {{-- Header --}}
    <div>
        <h1 class="text-4xl font-bold">
            Settings
        </h1>

        <p class="mt-2 text-gray-500">
            Manage your personal information.
        </p>
    </div>

    {{-- Tabs --}}
    <div class="border-b">
        <button
            type="button"
            class="px-2 pb-3 font-semibold text-blue-600 border-b-2 border-blue-600"
        >
            Account Information
        </button>
    </div>

    {{-- Card --}}
    <div class="overflow-hidden bg-white shadow rounded-2xl">

        {{-- Title --}}
        <div class="px-6 py-5 border-b">
            <h2 class="text-xl font-semibold">
                Personal Data
            </h2>
        </div>

        {{-- Form --}}
        <form
            action="{{ route('my.profil_update') }}"
            method="POST"
            enctype="multipart/form-data"
        >
            @csrf
            @method('PUT')

            <div class="p-6 space-y-6">

                {{-- Foto --}}
                <div>

                    <label class="block mb-3 font-semibold">
                        Foto Profil
                    </label>

                    <div class="flex items-center gap-6">

                        <div class="relative w-32 h-32 overflow-hidden bg-gray-100 border border-gray-300 rounded-full">

                            @if($user->avatar)
                                <img
                                    src="{{ asset('storage/' . $user->avatar) }}"
                                    alt="Foto Profil"
                                    id="preview-image"
                                    class="object-cover w-full h-full"
                                >
                            @else
                                <img
                                    id="preview-image"
                                    src=""
                                    alt="Preview"
                                    class="hidden object-cover w-full h-full"
                                >

                                <div
                                    id="image-placeholder"
                                    class="flex items-center justify-center h-full text-gray-400"
                                >
                                    <i class="fa-solid fa-camera text-[40px]"></i>
                                </div>
                            @endif

                        </div>

                        <div class="flex-1">

                            <input
                                type="file"
                                name="avatar"
                                id="avatar"
                                accept="image/jpeg,image/png,image/webp"
                                onchange="previewImage(event)"
                                class="block w-full border border-gray-300 rounded-xl file:mr-4 file:rounded-xl file:border-0 file:bg-blue-100 file:px-5 file:py-3 file:font-semibold file:text-blue-700"
                            >

                            <p class="mt-2 text-sm text-gray-500">
                                JPG, PNG atau WEBP (Max 5MB)
                            </p>

                            @error('avatar')
                                <p class="mt-1 text-sm text-red-500">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>

                    </div>

                </div>

                {{-- Full Name --}}
                <div>
                    <label
                        for="fullname"
                        class="block mb-2 text-sm font-medium"
                    >
                        Full Name
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="fullname"
                        name="fullname"
                        type="text"
                        value="{{ old('fullname', $user->fullname) }}"
                        class="w-full px-4 py-3 transition border border-gray-300 rounded-lg outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        required
                    >

                    <p class="mt-2 text-sm text-gray-500">
                        Your full name will appear on your profile.
                    </p>

                    @error('fullname')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Username --}}
                <div>
                    <label
                        for="username"
                        class="block mb-2 text-sm font-medium"
                    >
                        Username
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="username"
                        name="username"
                        type="text"
                        value="{{ old('username', $user->username) }}"
                        class="w-full px-4 py-3 transition border border-gray-300 rounded-lg outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                        required
                    >

                    <p class="mt-2 text-sm text-gray-500">
                        Your username will appear on your profile.
                    </p>

                    @error('username')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Email --}}
                <div>
                    <label
                        for="email"
                        class="block mb-2 text-sm font-medium"
                    >
                        Email
                        <span class="text-red-500">*</span>
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', $user->email) }}"
                        class="w-full px-4 py-3 text-gray-500 bg-gray-100 border border-gray-300 rounded-lg"
                        readonly
                    >

                    <p class="mt-2 text-sm text-gray-500">
                        Email cannot be changed.
                    </p>

                    @error('email')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                
                {{-- No Telepon --}}
                <div>

                    <label
                        for="phone"
                        class="block mb-2 font-semibold"
                    >
                        No. Telepon
                    </label>

                    <input
                        type="text"
                        name="phone"
                        id="phone"
                        value="{{ old('phone', $user->phone) }}"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:border-blue-600 focus:outline-none"
                    >

                    @error('phone')
                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

            {{-- Footer --}}
            <div class="flex justify-end gap-3 px-6 py-5 border-t bg-gray-50">

                {{-- Cancel --}}
                <a
                    href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-2 rounded-lg border border-gray-300 bg-white px-5 py-2.5 font-medium transition hover:bg-gray-100"
                >
                    {{-- X Icon --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>

                    Cancel
                </a>

                {{-- Save --}}
                <button
                    type="submit"
                    class="inline-flex items-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 font-medium text-white transition hover:bg-blue-700"
                >
                    {{-- Save Icon --}}
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="18"
                        height="18"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        stroke-linecap="round"
                        stroke-linejoin="round"
                    >
                        <path d="M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z"></path>
                        <path d="M17 21v-8H7v8"></path>
                        <path d="M7 3v5h8"></path>
                    </svg>

                    Save
                </button>

            </div>

        </form>

    </div>

</div>

<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('preview-image');
        const placeholder = document.getElementById('image-placeholder');

        if (!input.files || !input.files[0]) {
            return;
        }

        const file = input.files[0];

        if (file.size > 5 * 1024 * 1024) {
            alert('Ukuran gambar maksimal 5MB.');
            input.value = '';
            return;
        }

        preview.src = URL.createObjectURL(file);
        preview.classList.remove('hidden');

        if (placeholder) {
            placeholder.classList.add('hidden');
        }
    }
</script>