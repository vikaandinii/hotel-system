<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center items-center h-screen bg-[#F5F5DC]">
        <div class="bg-[#964B00] shadow-md rounded-lg p-8 w-96">
            <h2 class="text-3xl font-bold text-[#F0E4CC] mb-4">Login</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full bg-[#F0E4CC] border-[#964B00] focus:border-[#964B00] focus:ring-[#964B00]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full bg-[#F0E4CC] border-[#964B00] focus:border-[#964B00] focus:ring-[#964B00]"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mb-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded dark:bg-[#964B00] border-[#964B00] dark:border-[#964B00] text-[#F0E4CC] shadow-sm focus:ring-[#964B00] dark:focus:ring-[#964B00] dark:focus:ring-offset-[#F5F5DC]" name="remember">
                        <span class="ms-2 text-sm text-[#F0E4CC] dark:text-[#F0E4CC]">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mb-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-[#F0E4CC] dark:text-[#F0E4CC] hover:text-[#964B00] dark:hover:text-[#964B00] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#964B00] dark:focus:ring-offset-[#F5F5DC]" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif

                    <button class="ms-3 bg-[#964B00] hover:bg-[#786C3B] text-[#F0E4CC] hover:text-[#F0E4CC] py-2 px-4 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#964B00] dark:focus:ring-offset-[#F5F5DC]">
                        {{ __('Log in') }}
                    </button>
                </div>
                <div class="flex items-center justify-end mb-4">
                    <a class="underline text-sm text-[#F0E4CC] dark:text-[#F0E4CC] hover:text-[#964B00] dark:hover:text-[#964B00] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#964B00] dark:focus:ring-offset-[#F5F5DC]" href="{{ route('register') }}">
                        {{ __('Belum punya akun? Daftar sekarang') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>