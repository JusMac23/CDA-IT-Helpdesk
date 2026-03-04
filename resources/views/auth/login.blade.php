<x-guest-layout>
    <style>
        .login-form-container { max-width: 400px; margin: 0 auto; }
        .form-group { margin-bottom: 1.25rem; }
        .custom-input { width: 100%; padding: 0.50rem; margin-top: 0.25rem; border: 1px solid #d1d5db; border-radius: 0.75rem; display: block; box-sizing: border-box; }
        .custom-input:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.2); }
        .flex-between { display: flex; align-items: center; justify-content: space-between; font-size: 0.875rem; margin-top: 0.5rem; }
        .text-link { color: #4f46e5; text-decoration: none; font-weight: 500; }
        .text-link:hover { color: #4338ca; }
        .divider { display: flex; align-items: center; text-align: center; margin: 1.5rem 0; color: #9ca3af; }
        .divider hr { flex: 1; border: 0; border-top: 1px solid #e5e7eb; }
        .divider span { padding: 0 10px; font-size: 0.75rem; font-weight: bold; }
        .btn-primary { width: 100%; padding: 0.50rem; border-radius: 0.75rem; border: none; color: white; font-weight: 600; transition: background-color 0.2s; }
        .cda-button { display: flex; align-items: center; justify-content: center; width: 100%; padding: 0.50rem; background-color: #ffffff; border: 1px solid #d1d5db; border-radius: 0.75rem; text-decoration: none; color: #374151; transition: all 0.2s; }
        .cda-button:hover { background-color: #f9fafb; border-color: #a5b4fc; }
        .footer-text { text-align: center; font-size: 0.75rem; color: #6b7280; margin-top: 1.5rem; }
    </style>

    <div class="login-form-container">
        {{-- Session Status --}}
        <x-auth-session-status class="mb-4" :status="session('status')" />

        {{-- Login Form --}}
        <form method="POST" action="{{ route('login') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <x-input-label for="email" :value="__('Email')" />
                <input id="email" class="custom-input" 
                    type="email" name="email" value="{{ old('email') }}" 
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;" />
            </div>

            {{-- Password --}}
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <input id="password" class="custom-input"
                    type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;" />
            </div>

            {{-- Remember Me + Forgot Password --}}
            <div class="flex-between">
                <label for="remember_me" style="display: inline-flex; align-items: center; cursor: pointer;">
                    <input id="remember_me" type="checkbox" name="remember" style="border-radius: 4px; border: 1px solid #d1d5db;">
                    <span style="margin-left: 0.5rem; color: #374151;">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-link">
                    {{ __('Forgot password?') }}
                </a>
                @endif
            </div>

            {{-- reCAPTCHA --}}
            <div style="margin: 1rem 0;">
                <div class="g-recaptcha"
                    data-sitekey="{{ config('services.recaptcha.site_key') }}"
                    data-callback="enableLoginButton"></div>

                @if ($errors->has('g-recaptcha-response'))
                    <x-input-error :messages="$errors->get('g-recaptcha-response')" style="color: #ef4444; margin-top: 0.5rem;" />
                @endif
            </div>

            {{-- Login Button --}}
            <div style="margin-top: 1.5rem;">
                <button type="submit" id="login-button" class="btn-primary"
                    style="background-color: #cbd5e1; cursor: not-allowed; pointer-events: none;">
                    {{ __('Log in') }}
                </button>
            </div>
        </form>

        {{-- Divider --}}
        <div class="divider">
            <hr>
            <span>OR</span>
            <hr>
        </div>

        {{-- Social Logins --}}
        <div style="margin-top: 1.5rem;">
            <div style="display: flex; flex-direction: column; align-items: center;">
                {{-- Authentik --}}
                <a href="{{ route('auth.authentik') }}" class="cda-button">
                    <span style="font-weight: 500;">
                        <i class="fa-solid fa-building-columns" style="margin-right: 0.5rem;"></i> Continue with CDAOauth
                    </span>
                </a>
            </div>
        </div>

        {{-- Footer --}}
        <p class="footer-text">
            &copy; {{ date('Y') }} CDA ICTD. All rights reserved.
        </p>
    </div>

    <script src="/assets/js/sweetalert2.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        // SweetAlert Logic
        @if(session('success'))
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    confirmButtonColor: '#2563eb',
                    timer: 3000
                });
            });
        @endif

        @if(session('error'))
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'Authentication Error',
                    text: '{{ session('error') }}',
                    confirmButtonColor: '#2563eb',
                });
            });
        @endif

        @if(session('error_swal'))
            Swal.fire({
                icon: 'error',
                title: 'User not found',
                text: '{{ session("error_message") }}',
            });
        @endif

        // reCAPTCHA callback
        function enableLoginButton() {
            const button = document.getElementById('login-button');
            if (button) {
                button.style.backgroundColor = '#2563eb';
                button.style.cursor = 'pointer';
                button.style.pointerEvents = 'auto';
            }
        }
    </script>
</x-guest-layout>