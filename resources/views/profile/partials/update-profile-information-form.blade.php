<section>
    <style>
        /* Section Header Title */ .title { font-size: 1.5rem; font-weight: 900; color: #111827; margin-bottom: 0; margin-top: 0; }
        /* Section Header Desc */ .section-header p { font-size: 0.875rem; color: var(--text-muted, #6b7280); margin-bottom: 0; }
        /* Form Spacing */ .form-spacing { margin-top: 1.5rem; display: flex; flex-direction: column; gap: 1.5rem; }
        /* Form Group */ .form-group { display: flex; flex-direction: column; }
        /* Form Label */ .form-label { font-size: 0.875rem; font-weight: 600; color: var(--text-main, #1f2937); margin-bottom: 0.5rem; display: block; }
        /* Form Input */ .form-input { width: 100%; padding: 0.725rem 1.0rem; border: 1px solid var(--border-color, #e5e7eb); border-radius: 0.375rem; font-size: 0.875rem; color: var(--text-main, #1f2937); background-color: #ffffff; transition: border-color 0.2s ease, box-shadow 0.2s ease; font-family: inherit; }
        /* Form Input Focus */ .form-input:focus { outline: none; border-color: #38bdf8; box-shadow: 0 0 0 3px rgba(56, 189, 248, 0.2); }
        /* Readonly Input */ .form-input[readonly] { background-color: #f3f4f6; color: var(--text-muted, #6b7280); cursor: not-allowed; }
        /* Primary Button */ .btn-primary { background-color: var(--sidebar-bg, #133e5e); color: #ffffff; padding: 0.725rem 1.0rem; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 600; border: none; cursor: pointer; transition: background-color 0.2s ease; display: inline-flex; align-items: center; justify-content: center; }
        /* Primary Btn Hover */ .btn-primary:hover { background-color: #1a537d; }
        /* Form Actions */ .form-actions { display: flex; align-items: center; gap: 1rem; }
        /* Success Text */ .text-success { font-size: 0.875rem; color: #16a34a; font-weight: 500; margin-top: 0.5rem; }
        /* Error Text */ .text-error { font-size: 0.875rem; color: var(--danger, #ef4444); margin-top: 0.5rem; }
        /* Saved Text */ .text-saved { font-size: 0.875rem; color: var(--text-muted, #6b7280); }
        /* Link Text */ .link-text { font-size: 0.875rem; color: var(--text-muted, #6b7280); text-decoration: underline; cursor: pointer; background: none; border: none; padding: 0; margin-top: 0.5rem; }
        /* Link Text Hover */ .link-text:hover { color: var(--text-main, #1f2937); }
        /* Mobile Button Stretch */ @media (max-width: 768px) { .form-actions { flex-direction: column; align-items: stretch; } .btn-primary { width: 100%; } }
    </style>

    <header class="section-header">
        <h3 class="title">Profile Information</h3>
        <p>{{ __("Update your account's profile information and email address.") }}</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="form-spacing">
        @csrf
        @method('patch')

        @php
            $isDpo = auth()->user()->hasRole('DPO'); 
        @endphp

        <div class="form-group">
            <x-input-label for="name" :value="__('Name')" class="form-label" />
            <x-text-input id="name" name="name" type="text" class="form-input" 
                :value="old('name', $user->name)" 
                autofocus autocomplete="name" 
                :readonly="$isDpo" /> {{-- Conditionally apply readonly --}}
            <x-input-error class="text-error" :messages="$errors->get('name')" />
        </div>

        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" class="form-label" />
            {{-- Replaced hardcoded 'readonly' with conditional --}}
            <x-text-input id="email" name="email" type="email" class="form-input" 
                :value="old('email', $user->email)" 
                required autocomplete="username" 
                :readonly="$isDpo" /> 
            <x-input-error class="text-error" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2" style="color: var(--text-main);">
                        {{ __('Your email address is unverified.') }}

                        {{-- Hide verification resend for DPOs --}}
                        @if(!$isDpo)
                        <button form="send-verification" class="link-text">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                        @endif
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        @if(!$isDpo)
        <div class="form-actions">
            @can('edit_profile')
            <x-primary-button class="btn-primary">
                {{ __('Save') }}
            </x-primary-button>
            @endcan

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-saved"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
        @endif
    </form>
</section>