<x-guest-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* layout */
        .confirm-password-container{width:100%;}

        /* text */
        .instruction-text{font-size:.875rem;color:#4b5563;margin-bottom:1.5rem;line-height:1.5;text-align:center;}
        .error-text{color:#ef4444;font-size:.875rem;margin-top:.5rem;display:block;}

        /* form */
        .form-group{margin-bottom:1.25rem;}
        .form-group label{display:block;font-size:.875rem;font-weight:600;color:#374151;margin-bottom:.35rem;}
        .custom-input{width:100%;padding:.65rem .75rem;border:1px solid #d1d5db;border-radius:.5rem;display:block;box-sizing:border-box;font-family:inherit;font-size:.95rem;transition:all .2s ease;}
        .custom-input:focus{outline:none;border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.2);}

        /* buttons */
        .btn-primary{width:100%;padding:.75rem;border-radius:.5rem;border:none;color:#fff;font-size:1rem;font-weight:600;font-family:inherit;transition:all .2s;cursor:pointer;background:#2563eb;margin-top:1.5rem;display:flex;justify-content:center;align-items:center;box-shadow:0 4px 6px -1px rgba(37,99,235,.2);}
        .btn-primary:hover{background:#1d4ed8;}
        .btn-primary.auto-width{width:auto;padding:.65rem 1.5rem;}
        .button-container{display:flex;justify-content:flex-end;margin-top:1rem;}
    </style>

    <div class="confirm-password-container">
        
        <p class="instruction-text">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="form-group">
                <x-input-label for="password" :value="__('Password')" />
                <input id="password" class="custom-input" 
                    type="password" name="password" 
                    required autocomplete="current-password" 
                    placeholder="Confirm your password" />
                
                @if ($errors->has('password'))
                    <span class="error-text">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="button-container">
                <button type="submit" class="btn-primary auto-width">
                    <i class="fa-solid fa-shield-halved" style="margin-right: 0.5rem;"></i>
                    {{ __('Confirm') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>