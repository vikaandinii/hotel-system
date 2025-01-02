<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center items-center h-screen bg-[#F5F5DC]">
        <div class="bg-[#964B00] shadow-md rounded-lg p-8 w-96">
            <h2 class="text-3xl font-bold text-[#F0E4CC] mb-4">Daftar</h2>
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-4">
                    <x-input-label for="name" :value="__('Nama')" />
                    <x-text-input id="name" class="block mt-1 w-full bg-[#F0E4CC] border-[#964B00] focus:border-[#964B00] focus:ring-[#964B00]" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full bg-[#F0E4CC] border-[#964B00] focus:border-[#964B00] focus:ring-[#964B00]" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full bg-[#F0E4CC] border-[#964B00] focus:border-[#964B00] focus:ring-[#964B00]"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" />

                    <x-text-input id="password_confirmation" class="block mt-1 w-full bg-[#F0E4CC] border-[#964B00] focus:border-[#964B00] focus:ring-[#964B00]"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mb-4">
                    <button class="bg-[#964B00] hover:bg-[#786C3B] text-[#F0E4CC] hover:text-[#F0E4CC] py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#964B00] dark:focus:ring-offset-[#F5F5DC]">
                        {{ __('Daftar') }}
                    </button>
                </div>
                <div class="flex items-center justify-end mb-4">
                    <a class="underline text-sm text-[#F0E4CC] dark:text-[#F0E4CC] hover:text-[#964B00] dark:hover:text-[#964B00] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#964B00] dark:focus:ring-offset-[#F5F5DC]" href="{{ route('login') }}">
                        {{ __('Sudah punya akun? Masuk sekarang') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>