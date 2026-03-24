<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0" style="background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('{{ asset('images/banner-bg.png') }}') no-repeat center center/cover fixed;">
        <!-- Logo outside the card -->
        <div class="w-full sm:max-w-md mb-8">
            <x-authentication-card-logo />
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white bg-opacity-90 shadow-lg overflow-hidden sm:rounded-lg">
            <x-validation-errors class="mb-4" />

            @session('status')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ $value }}
            </div>
            @endsession

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mt-4">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                </div>

                <div class="flex items-center justify-between block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                </div>

                <div class="flex items-center justify-end mt-4">

                    @if (Route::has('register'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 ms-4"
                        href="{{ route('register') }}">
                        {{ __('Not registered? Create an account') }}
                    </a>
                    @endif


                    <x-button class="ms-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>
                <div class="mt-3">
                    <div class="flex items-center">
                        <div class="flex-grow border-t border-gray-300"></div>
                        <span class="mx-3 text-gray-500 text-sm">OR</span>
                        <div class="flex-grow border-t border-gray-300"></div>
                    </div>

                    <a href="/auth/google"
                        class="mt-4 w-full inline-flex justify-center items-center gap-3 px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-700 text-sm font-medium hover:bg-gray-100 transition">

                        <!-- Google Icon SVG -->
                        <svg class="w-5 h-5" viewBox="0 0 48 48">
                            <path fill="#EA4335" d="M24 9.5c3.54 0 6.73 1.22 9.24 3.6l6.9-6.9C35.68 2.3 30.2 0 24 0 14.64 0 6.6 5.4 2.6 13.2l8.04 6.24C12.5 13.1 17.8 9.5 24 9.5z" />
                            <path fill="#4285F4" d="M46.5 24c0-1.64-.14-3.2-.4-4.7H24v9h12.7c-.54 2.9-2.18 5.36-4.66 7l7.18 5.6C43.8 36.6 46.5 30.8 46.5 24z" />
                            <path fill="#FBBC05" d="M10.64 28.44A14.5 14.5 0 0 1 9.5 24c0-1.54.26-3.04.74-4.44L2.2 13.32A23.94 23.94 0 0 0 0 24c0 3.9.94 7.6 2.6 10.8l8.04-6.36z" />
                            <path fill="#34A853" d="M24 48c6.48 0 11.92-2.14 15.9-5.82l-7.18-5.6c-2 1.34-4.56 2.12-8.72 2.12-6.2 0-11.5-3.6-13.36-8.94l-8.04 6.36C6.6 42.6 14.64 48 24 48z" />
                        </svg>

                        <span>Continue with Google</span>
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>