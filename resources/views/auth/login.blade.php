<x-guest-layout>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Authentication Error',
                text: '{{ session('error') }}',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
            });
        });
    </script>
    @endif

    @if(session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                showConfirmButton: true,
                confirmButtonColor: '#3085d6',
                timer: 3000
            });
        });
    </script>
    @endif

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <!-- Regular login + forgot password -->
        <div class="mt-4 flex flex-col items-center text-center w-full">
            <x-primary-button class="mb-2 w-full justify-center">
                {{ __('Log in') }}
            </x-primary-button>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" 
                class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- resources/views/auth/login.blade.php -->
        <div class="social-login mt-6 text-center border-4 border-gray-400 rounded-lg p-2 shadow-sm hover:shadow-lg transition duration-200">
            <a href="{{ route('auth.authentik') }}" class="btn btn-authentik inline-flex items-center justify-center gap-2">
                <span class="mr-2">Sign in with</span>
                <img src="{{ asset('images/authentik.png') }}" alt="Authentik Logo" class="w-30 h-5">
            </a>
        </div>

        <div class="social-login mt-4 text-center border-4 border-gray-400 rounded-lg p-2 shadow-sm hover:shadow-lg transition duration-200">
            <a href="{{ route('auth.google') }}" class="btn btn-google inline-flex items-center justify-center gap-2">
                <span class="mr-2">Sign in with</span>
                <img src="{{ asset('images/google-logo.png') }}" alt="Google Logo" class="w-10 h-5">
            </a>
        </div>
    </form>
</x-guest-layout>
