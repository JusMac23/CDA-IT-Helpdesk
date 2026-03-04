<section class="delete-section">
    <style>
        /* Shared Header Styles */
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

        .delete-section {
            display: flex;
            flex-direction: column;
            gap: 1.5rem; /* Replaces space-y-6 */
        }

        /* Input Styles */
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
            border-color: var(--danger, #ef4444);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2);
        }

        .input-w-75 {
            width: 100%;
        }
        @media (min-width: 640px) {
            .input-w-75 { width: 75%; } /* Replaces w-3/4 on larger screens */
        }

        /* Buttons */
        .btn-danger {
            background-color: var(--danger, #ef4444);
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

        .btn-danger:hover {
            background-color: #dc2626; /* Darker red */
        }

        .btn-secondary {
            background-color: #ffffff;
            color: var(--text-main, #1f2937);
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
            font-weight: 600;
            border: 1px solid var(--border-color, #d1d5db);
            cursor: pointer;
            transition: background-color 0.2s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-secondary:hover {
            background-color: #f3f4f6;
        }

        /* Modal Specific Styling */
        .modal-content-pad {
            padding: 1.5rem; /* Replaces p-6 */
        }

        .modal-actions {
            margin-top: 1.5rem;
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem; /* Replaces ms-3 */
        }

        .mt-6 { margin-top: 1.5rem; }
        .mt-2 { margin-top: 0.5rem; }
        
        .text-error { font-size: 0.875rem; color: var(--danger, #ef4444); }

        /* Screen reader only class (for the password label) */
        .sr-only {
            position: absolute;
            width: 1px;
            height: 1px;
            padding: 0;
            margin: -1px;
            overflow: hidden;
            clip: rect(0, 0, 0, 0);
            white-space: nowrap;
            border-width: 0;
        }
    </style>

    <header class="section-header">
        <h2>{{ __('Delete Account') }}</h2>
        <p>{{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}</p>
    </header>

    <div>
        <x-danger-button
            class="btn-danger"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >{{ __('Delete Account') }}</x-danger-button>
    </div>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="modal-content-pad">
            @csrf
            @method('delete')

            <div class="section-header">
                <h2>{{ __('Are you sure you want to delete your account?') }}</h2>
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

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-error" />
            </div>

            <div class="modal-actions">
                <x-secondary-button class="btn-secondary" x-on:click="$dispatch('close')">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-danger-button class="btn-danger">
                    {{ __('Delete Account') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>