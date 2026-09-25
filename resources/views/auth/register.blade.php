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
                <h2 class="text-3xl font-bold text-sky-500">
                    Sign Up
                </h2>

                <p class="mt-3 text-gray-500">
                    Enter your details to continue
                </p>

                <p class="mt-6 text-xl font-semibold text-gray-800">
                    Sign up with Email address
                </p>
            </div>

            {{-- Form --}}
            <form
                class="mt-10 space-y-6"
                action="{{ url('/register') }}"
                method="POST"
            >
                @csrf

                {{-- Name --}}
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- First Name --}}
                    <div class="rounded-xl border border-sky-500 px-5 py-3">
                        <label class="block text-sm text-gray-500">
                            First Name
                        </label>

                        <input
                            type="text"
                            name="first_name"
                            value="{{ old('first_name') }}"
                            placeholder="John"
                            class="mt-1 w-full bg-transparent text-lg font-semibold text-gray-700 outline-none"
                            required
                        >
                    </div>

                    {{-- Last Name --}}
                    <div class="rounded-xl border border-sky-500 px-5 py-3">
                        <label class="block text-sm text-gray-500">
                            Last Name
                        </label>

                        <input
                            type="text"
                            name="last_name"
                            value="{{ old('last_name') }}"
                            placeholder="Doe"
                            class="mt-1 w-full bg-transparent text-lg font-semibold text-gray-700 outline-none"
                            required
                        >
                    </div>

                </div>

                {{-- Email --}}
                <div class="rounded-xl border border-sky-500 px-5 py-3">
                    <label class="block text-sm text-gray-500">
                        Email Address / Username
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="john@example.com"
                        class="mt-1 w-full bg-transparent text-lg font-semibold text-gray-700 outline-none"
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
                            class="w-full bg-transparent text-lg font-semibold text-gray-700 outline-none"
                            required
                        >

                        <button
                            type="button"
                            onclick="toggleRegisterPassword()"
                            class="text-gray-500 hover:text-sky-500"
                        >
                            <i
                                id="registerPasswordIcon"
                                class="fa-regular fa-eye text-xl"
                            ></i>
                        </button>

                    </div>
                </div>

                {{-- Agreement --}}
                <label class="flex items-center gap-3 text-gray-700">
                    <input
                        type="checkbox"
                        name="terms"
                        value="1"
                        class="h-5 w-5 rounded accent-sky-500"
                        required
                    >

                    <span>
                        Agree with
                        <a
                            href="{{ url('/terms') }}"
                            class="font-semibold text-sky-500 hover:underline"
                        >
                            Terms & Conditions
                        </a>
                    </span>
                </label>

                {{-- Button --}}
                <button
                    type="submit"
                    class="w-full rounded-lg bg-sky-500 py-4 text-lg font-semibold text-white transition hover:bg-sky-700"
                >
                    Sign Up
                </button>
            </form>

            {{-- Divider --}}
            <div class="my-8 border-t border-gray-200"></div>

            {{-- Footer --}}
            <p class="text-center text-gray-600">
                Already have an account?
                <a
                    href="{{ url('/login') }}"
                    class="font-semibold text-sky-500 hover:underline"
                >
                    Sign In
                </a>
            </p>

        </div>
    </div>

    {{-- Toggle Password --}}
    <script>
        function toggleRegisterPassword() {
            const password = document.getElementById('password');
            const icon = document.getElementById('registerPasswordIcon');

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