<x-app-layout>
    <style>
        /* Profile Header */ .profile-header { margin-bottom: 24px; }
        /* Profile Title */ .profile-title { font-size: 24px; font-weight: 700; color: var(--text-main, #1f2937); line-height: 1.25; }
        /* Profile Container */ .profile-container { display: flex; flex-direction: column; gap: 24px; }
        /* Profile Card */ .profile-card { background-color: white; padding: 16px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 8px; border: 1px solid var(--border-color, #e5e7eb); }
        /* Profile Card Content */ .profile-card-content { max-width: 576px; }
        /* Profile Card Desktop */ @media (min-width: 640px) { .profile-card { padding: 32px; } }
    </style>

    <div id="main-content" style="transition: all 0.3s ease-in-out;">

        <div class="profile-container">
            
            <div class="profile-card">
                <div class="profile-card-content">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>
            
            <div class="profile-card">
                <div class="profile-card-content">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="profile-card">
                <div class="profile-card-content">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>