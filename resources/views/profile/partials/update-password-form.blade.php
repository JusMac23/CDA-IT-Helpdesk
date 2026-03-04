<section>
    <style>
        /* Note: If you place these forms on the same page, you only need this CSS block once. */
        .section-header h2 {
            font-size: 1.125rem;
            font-weight: 600;
            color: var(--text-main, #1f2937);
            margin-bottom: 0.25rem;
        }
        
        .section-header p {
            font-size: 0.875rem;
            color: var(--text-muted, #6b7280);
            margin-bottom: 0;
        }

        .form-spacing {
            margin-top: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-main, #1f2937);
            margin-bottom: 0.5rem;
            display: block;
        }

        .form-input {
            width: 100%;
            padding: 0.5rem 0.75rem;
            border: 1px solid var(--border-color, #e5e7eb);
            border-radius: 0.375rem;
            font-size: 0.875rem;
            color: var(--text-main, #1f2937);
            background-color: #ffffff;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: #38bdf8;
            box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2);
        }

        .btn-primary {
            background-color: var(--sidebar-bg, #133e5e);
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-primary:hover {
            background-color: #1a537d;
        }

        .form-actions {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .text-error { font-size: 0.875rem; color: var(--danger, #ef4444); margin-top: 0.5rem; }
        .text-saved { font-size: 0.875rem; color: var(--text-muted, #6b7280); }
    </style>

    <header class="section-header">
        <h2>{{ __('Update Password') }}</h2>
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
            <x-primary-button class="btn-primary">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-saved"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>