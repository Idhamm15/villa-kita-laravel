@extends('layouts.auth')

@section('content')
    <div class="min-h-screen bg-slate-100 flex items-center justify-center p-6">
        <div class="w-full max-w-xl rounded-2xl bg-white shadow-sm px-10 py-12">

            {{-- Logo --}}
            <div class="flex justify-center mb-8">
                <div class="flex items-center gap-2">
                    <div class="flex h-10 w-10 items-center justify-center rounded-full bg-violet-100">
                        <span class="text-xl">🏡</span>
                    </div>

                    <h1 class="text-3xl font-bold text-slate-800">
                        Villa<span class="text-sky-500">Kita</span>
                    </h1>
                </div>
            </div>

            {{-- Heading --}}
            <div class="text-center">
                <h2 class="text-2xl font-bold text-sky-500">
                    Hi, Welcome Back
                </h2>

                <p class="mt-3 text-sx text-slate-500">
                    Enter your credentials to continue
                </p>
            </div>

            {{-- Form --}}
            <form
                class="mt-10 space-y-6"
                action="{{ url('/login') }}"
                method="POST"
            >
                @csrf

                {{-- Email --}}
                <div class="rounded-xl border border-sky-500 px-5 py-3">
                    <label class="block text-sm text-gray-500">
                        Email Address / Username
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="example@email.com"
                        class="mt-1 w-full border-none bg-transparent text-lg text-gray-700 font-semibold outline-none"
                        required
                    >
                </div>

                {{-- Password --}}
                <div class="rounded-xl border border-sky-500 px-5 py-3">
                    <label class="block text-sm text-gray-500">
                        Password
                    </label>

                    <div class="mt-1 flex items-center">
                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="••••••••"
                            class="w-full border-none bg-transparent text-lg font-semibold outline-none text-gray-700"
                            required
                        >

                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="text-gray-500 hover:text-sky-500"
                        >
                            <i id="passwordIcon" class="fa-regular fa-eye text-xl"></i>
                        </button>
                    </div>
                </div>

                {{-- Remember --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-3 text-lg text-gray-600">
                        <input
                            type="checkbox"
                            name="remember"
                            value="1"
                            class="h-5 w-5 rounded border-gray-300 accent-sky-500"
                        >

                        Keep me logged in
                    </label>

                    <a
                        href="{{ url('/forgot-password') }}"
                        class="font-medium text-sky-500 hover:underline"
                    >
                        Forgot Password?
                    </a>
                </div>

                {{-- Button --}}
                <button
                    type="submit"
                    class="w-full rounded-lg bg-sky-500 py-4 text-xl font-semibold text-white transition hover:bg-sky-700"
                >
                    Sign In
                </button>
            </form>

            {{-- Divider --}}
            <div class="my-8 border-t"></div>

            {{-- Footer --}}
            <p class="text-center text-lg text-gray-600 font-medium">
                Don't have an account?
                <a
                    href="{{ url('/register') }}"
                    class="font-semibold text-sky-500 hover:underline"
                >
                    Register
                </a>
            </p>

        </div>
    </div>

    {{-- Toggle Password --}}
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('passwordIcon');

            if (password.type === 'password') {
                password.type = 'text';

                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';

                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
@endsection


