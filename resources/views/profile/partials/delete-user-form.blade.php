<section class="delete-section">
    <style>
        /* Section Header Title */ 
        .title { font-size: 1.25rem; font-weight: 800; color: var(--text-dark); margin-bottom: 0.25rem; margin-top: 0; transition: color 0.3s ease; }
        
        /* Section Header Desc */ 
        .section-header p { font-size: 0.9rem; color: var(--text-muted); margin-bottom: 0; font-weight: 500; line-height: 1.5; transition: color 0.3s ease; }
        
        /* Delete Section Spacing */ 
        .delete-section { display: flex; flex-direction: column; gap: 1.5rem; }
        
        /* Form Input - Unified 44px Height */ 
        .form-input { height: 44px; width: 100%; padding: 0 1rem; border: 1px solid var(--input-border); border-radius: 0.5rem; font-size: 0.95rem; color: var(--input-text); background-color: var(--input-bg); transition: all 0.2s ease; font-family: inherit; box-sizing: border-box; }
        
        /* Form Input Focus - Red theme for destructive action */ 
        .form-input:focus { outline: none; border-color: #ef4444; box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15); }
        
        /* Input Width 75 Desktop */ 
        .input-w-75 { width: 100%; }
        @media (min-width: 640px) { .input-w-75 { width: 75%; } }
        
        /* Danger Button - Unified Styling */ 
        .btn-danger { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 2rem; border-radius: 0.5rem; font-size: 0.95rem; font-weight: 600; cursor: pointer; border: none; color: white; background-color: #ef4444; transition: all 0.2s ease; font-family: inherit; box-shadow: 0 1px 2px rgba(239, 68, 68, 0.2); }
        .btn-danger:hover { background-color: #dc2626; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }
        .btn-danger:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(239, 68, 68, 0.2); }
        
        /* Secondary Button (Cancel) */ 
        .btn-secondary { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 2rem; border-radius: 0.5rem; font-size: 0.95rem; font-weight: 600; cursor: pointer; border: 1px solid var(--border-light); color: var(--text-muted); background-color: transparent; transition: all 0.2s ease; font-family: inherit; box-shadow: 0 1px 2px rgba(0,0,0,0.02); }
        .btn-secondary:hover { background-color: var(--bg-alt); color: var(--text-dark); border-color: var(--input-border); transform: translateY(-1px); }
        .btn-secondary:active { transform: translateY(0); }
        
        /* Modal Spacing */ 
        .modal-content-pad { padding: 2rem; background-color: var(--card-bg); transition: background-color 0.3s ease; }
        .modal-actions { margin-top: 2rem; display: flex; justify-content: flex-end; gap: 1rem; }
        
        .mt-6 { margin-top: 1.5rem; }
        .mt-2 { margin-top: 0.5rem; }
        
        /* Error Text */ 
        .text-error { font-size: 0.875rem; color: #ef4444; font-weight: 500; display: block; margin-top: 0.5rem; transition: color 0.3s ease; }
        body.dark .text-error { color: #f87171; }
        
        /* Screen Reader Only */ 
        .sr-only { position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border-width: 0; }
        
        /* Mobile Buttons Stretch */ 
        @media (max-width: 640px) { 
            .btn-danger, .btn-secondary { width: 100%; } 
            .modal-actions { flex-direction: column; align-items: stretch; gap: 1rem; } 
            .modal-content-pad { padding: 1.5rem; }
        }
    </style>

    <header class="section-header">
        <h2 class="title">{{ __('Delete Account') }}</h2>
        <p class="mt-2">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</p>
    </header>

    <div class="mt-6">
        <button 
            type="button"
            class="btn-danger"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            {{ __('Delete Account') }}
        </button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="modal-content-pad">
            @csrf
            @method('delete')

            <div class="section-header">
                <h2 class="title" style="font-size: 1.5rem;">{{ __('Are you sure you want to delete your account?') }}</h2>
                <p class="mt-2">{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}</p>
            </div>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Password') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="form-input input-w-75"
                    placeholder="{{ __('Password') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="text-error" />
            </div>

            <div class="modal-actions">
                <button type="button" class="btn-secondary" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </button>

                <button type="submit" class="btn-danger">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>