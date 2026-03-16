<section>
    <style>
        /* --- Theme Variables --- */
        :root {
            --input-bg: #ffffff;
            --input-border: #cbd5e1;
            --input-text: #334155;
            --text-dark: #0f172a;
            --text-muted: #475569;
        }

        body.dark {
            /* Elevated input backgrounds and brighter borders for visibility */
            --input-bg: #1e293b; 
            --input-border: #64748b; 
            --input-text: #f1f5f9;
            --text-dark: #f8fafc;
            --text-muted: #9ca3af;
        }

        /* Section Header */ 
        .title { font-size: 1.25rem; font-weight: 800; color: var(--text-dark); margin-bottom: 0.25rem; margin-top: 0; transition: color 0.3s ease; }
        .section-header p { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0; font-weight: 500; transition: color 0.3s ease; }
        
        /* Form Spacing */ 
        .form-spacing { margin-top: 2rem; display: flex; flex-direction: column; gap: 1.5rem; }
        
        /* Form Group */ 
        .form-group { display: flex; flex-direction: column; }
        
        /* Form Label */ 
        .form-label { font-size: 0.875rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.5rem; display: block; transition: color 0.3s ease; }
        
        /* Form Input - Unified 44px Height & Dynamic Outline */ 
        .form-input { 
            height: 44px; width: 100%; padding: 0 1rem; 
            border: 1px solid var(--input-border); 
            border-radius: 0.5rem; font-size: 0.95rem; 
            color: var(--input-text); 
            background-color: var(--input-bg); 
            transition: all 0.2s ease; font-family: inherit; box-sizing: border-box; 
        }
        
        /* Form Input Focus */ 
        .form-input:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }
        body.dark .form-input:focus { border-color: #818cf8; box-shadow: 0 0 0 3px rgba(129, 140, 248, 0.25); }
        
        /* Primary Button - Unified Styling */ 
        .btn-primary { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 2rem; border-radius: 0.5rem; font-size: 0.95rem; font-weight: 600; cursor: pointer; border: none; color: white; background-color: #4f46e5; transition: all 0.2s ease; font-family: inherit; box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }
        .btn-primary:hover { background-color: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
        .btn-primary:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }
        
        /* Form Actions */ 
        .form-actions { display: flex; align-items: center; gap: 1rem; margin-top: 0.5rem; }
        
        /* Error Text */ 
        .text-error { font-size: 0.875rem; color: #ef4444; margin-top: 0.5rem; font-weight: 500; transition: color 0.3s ease; }
        body.dark .text-error { color: #f87171; }
        
        /* Saved Text */ 
        .text-saved { font-size: 0.9rem; font-weight: 500; color: var(--text-muted); transition: color 0.3s ease; }
        
        /* Mobile Button Stretch */ 
        @media (max-width: 640px) { 
            .form-actions { flex-direction: column; align-items: stretch; } 
            .btn-primary { width: 100%; } 
            .text-saved { text-align: center; }
        }
    </style>

    <header class="section-header">
        <h2 class="title">{{ __('Update Password') }}</h2>
        <p>{{ __('Ensure your account is using a long, random password to stay secure.') }}</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="form-spacing">
        @csrf
        @method('put')

        <div class="form-group">
            <x-input-label for="update_password_current_password" :value="__('Current Password')" class="form-label" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="form-input" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="text-error" />
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password" :value="__('New Password')" class="form-label" />
            <x-text-input id="update_password_password" name="password" type="password" class="form-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="text-error" />
        </div>

        <div class="form-group">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" class="form-label" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="text-error" />
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-primary">
                {{ __('Save Password') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-saved"
                ><i class="fas fa-check" style="margin-right: 0.25rem; color: #10b981;"></i> {{ __('Saved successfully.') }}</p>
            @endif
        </div>
    </form>
</section>