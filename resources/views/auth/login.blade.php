<x-guest-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* layout */
        .login-form-container{width:100%;}

        /* form */
        .form-group{margin-bottom:1.25rem;}
        .form-group label{display:block;font-size:.875rem;font-weight:600;color:#374151;margin-bottom:.35rem;}
        .custom-input{width:100%;padding:.65rem .75rem;border:1px solid #d1d5db;border-radius:.5rem;display:block;box-sizing:border-box;font-family:inherit;font-size:.95rem;transition:all .2s ease;}
        .custom-input:focus{outline:none;border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.2);}

        /* helpers */
        .flex-between{display:flex;align-items:center;justify-content:space-between;font-size:.875rem;margin:.5rem 0 1.5rem;}
        .remember-wrap{display:inline-flex;align-items:center;cursor:pointer;}
        .remember-wrap input[type=checkbox]{border-radius:4px;border:1px solid #d1d5db;width:1rem;height:1rem;cursor:pointer;}

        /* links */
        .text-link{color:#2563eb;text-decoration:none;font-weight:500;transition:color .2s ease;}
        .text-link:hover{color:#1d4ed8;text-decoration:underline;}

        /* divider */
        .divider{display:flex;align-items:center;text-align:center;margin:1.5rem 0;color:#9ca3af;}
        .divider hr{flex:1;border:0;border-top:1px solid #e5e7eb;}
        .divider span{padding:0 10px;font-size:.75rem;font-weight:600;}

        /* buttons */
        .btn-primary{width:100%;padding:.75rem;border-radius:.5rem;border:none;color:#fff;font-size:1rem;font-weight:600;font-family:inherit;transition:all .2s;display:flex;justify-content:center;align-items:center;}
        .btn-primary:not(:disabled){background:#2563eb;cursor:pointer;box-shadow:0 4px 6px -1px rgba(37,99,235,.2);}
        .btn-primary:not(:disabled):hover{background:#1d4ed8;}
        .btn-primary:disabled{background:#94a3b8;cursor:not-allowed;opacity:.7;}

        /* cda */
        .cda-button{display:flex;align-items:center;justify-content:center;width:100%;padding:.75rem;background:#fff;border:1px solid #d1d5db;border-radius:.5rem;text-decoration:none;color:#374151;font-weight:600;font-size:.95rem;transition:all .2s;box-shadow:0 1px 2px rgba(0,0,0,.05);}
        .cda-button:hover{background:#f9fafb;border-color:#9ca3af;color:#111827;}

        /* misc */
        .error-text{color:#ef4444;font-size:.875rem;margin-top:.5rem;display:block;}
        .footer-text{text-align:center;font-size:.75rem;color:#6b7280;margin:2rem 0 0;}
        
        /* Updated reCAPTCHA wrapper for responsive scaling */
        .recaptcha-wrapper { width: 100%; margin: 1rem 0; overflow: hidden; position: relative; }
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
                    required autofocus autocomplete="username" 
                    placeholder="Enter your email" />
                @if ($errors->has('email'))
                    <span class="error-text">{{ $errors->first('email') }}</span>
                @endif
            </div>

            {{-- Password --}}
            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <input id="password" class="custom-input"
                    type="password" name="password" required autocomplete="current-password" 
                    placeholder="Enter your password" />
                @if ($errors->has('password'))
                    <span class="error-text">{{ $errors->first('password') }}</span>
                @endif
            </div>

            {{-- Remember Me + Forgot Password --}}
            <div class="flex-between">
                <label for="remember_me" class="remember-wrap">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span style="margin-left: 0.5rem; color: #4b5563;">{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-link">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            {{-- reCAPTCHA --}}
            <div class="recaptcha-wrapper" id="recaptcha-container">
                <div class="g-recaptcha"
                    data-sitekey="{{ config('services.recaptcha.site_key') }}"
                    data-callback="enableLoginButton"
                    data-expired-callback="disableLoginButton"
                    data-error-callback="disableLoginButton"></div>
            </div>
            
            @if ($errors->has('g-recaptcha-response'))
                <span class="error-text" style="margin-bottom: 1rem; margin-top: -0.5rem;">{{ $errors->first('g-recaptcha-response') }}</span>
            @endif

            {{-- Login Button --}}
            <div>
                <button type="submit" id="login-button" class="btn-primary" disabled>
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
        <div>
            <a href="{{ route('auth.authentik') }}" class="cda-button">
                <i class="fa-solid fa-building-columns" style="margin-right: 0.5rem; color: #4b5563;"></i> 
                Continue with CDAOauth
            </a>
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
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'error',
                    title: 'User not found',
                    text: '{{ session("error_message") }}',
                    confirmButtonColor: '#2563eb',
                });
            });
        @endif

        // reCAPTCHA callbacks
        function enableLoginButton() {
            const button = document.getElementById('login-button');
            if (button) {
                button.disabled = false;
            }
        }

        function disableLoginButton() {
            const button = document.getElementById('login-button');
            if (button) {
                button.disabled = true;
            }
        }

        // Dynamically Resize reCAPTCHA 
        function resizeRecaptcha() {
            const wrapper = document.getElementById('recaptcha-container');
            const recaptcha = document.querySelector('.g-recaptcha');
            
            if (wrapper && recaptcha) {

                const wrapperWidth = wrapper.offsetWidth;
                const scale = wrapperWidth / 304;
                
                recaptcha.style.transform = `scale(${scale})`;
                recaptcha.style.transformOrigin = '0 0';
                
                wrapper.style.height = `${78 * scale}px`;
            }
        }

        window.addEventListener('resize', resizeRecaptcha);
        window.addEventListener('load', resizeRecaptcha);

        setTimeout(resizeRecaptcha, 500);
        setTimeout(resizeRecaptcha, 1500); 
    </script>
</x-guest-layout>