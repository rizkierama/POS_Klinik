<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-500 to-indigo-600">
        <div class="w-full max-w-md bg-white rounded-xl shadow-2xl p-10">

            <!-- Logo -->
            <div class="flex justify-center mb-8">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Klinik Azizi" class="w-24 h-24 rounded-full shadow-md">
            </div>

            <!-- Judul -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Selamat Datang</h1>
                <p class="text-gray-500 text-sm">Silakan login untuk masuk ke sistem.</p>
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form Login -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold"/>
                    <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold"/>
                    <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
                </div>

                <!-- Tombol -->
                <div class="flex items-center justify-end mt-4">
                    <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-md">
                        {{ __('Login') }}
                    </x-primary-button>
                </div>
            </form>

        </div>
    </div>
</x-guest-layout>
