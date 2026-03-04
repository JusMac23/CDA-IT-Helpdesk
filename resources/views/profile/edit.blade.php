<x-app-layout>
    <style>
        /* Profile Layout Styles */
        .profile-header {
            margin-bottom: 24px;
        }
        
        .profile-title {
            font-size: 24px;
            font-weight: 700;
            color: var(--text-main, #1f2937);
            line-height: 1.25;
        }

        .profile-container {
            display: flex;
            flex-direction: column;
            gap: 24px; /* Replaces space-y-6 */
        }

        .profile-card {
            background-color: white;
            padding: 16px; /* Replaces p-4 */
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            border-radius: 8px; /* Replaces rounded-lg */
            border: 1px solid var(--border-color, #e5e7eb);
        }

        .profile-card-content {
            max-width: 576px; /* Replaces max-w-xl */
        }

        /* Replaces sm:p-8 */
        @media (min-width: 640px) {
            .profile-card {
                padding: 32px; 
            }
        }
    </style>

    <div id="main-content" style="transition: all 0.3s ease-in-out;">
        
        <div class="profile-header">
            <h2 class="profile-title">
                {{ __('Profile') }}
            </h2>
        </div>

        <div class="profile-container">
            
            @if(auth()->user()->can('view_profile') || auth()->user()->can('edit_profile'))
            <div class="profile-card">
                <div class="profile-card-content">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            @endif
            
            @can('update_password')
            <div class="profile-card">
                <div class="profile-card-content">
                    @include('profile.partials.update-password-form')
                </div>
            </div>
            @endcan

            @can('delete_profile')
            <div class="profile-card">
                <div class="profile-card-content">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            @endcan
            
        </div>
    </div>
</x-app-layout>