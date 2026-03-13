<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }

        /* Profile Layout Constraints */
        .profile-wrapper { max-width: 56rem; margin: 0 auto; width: 100%; }
        
        /* Header */
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 2rem; gap: 1rem; width: 100%; }
        .page-title { font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em; }

        /* Profile Container */
        .profile-container { display: flex; flex-direction: column; gap: 2rem; }
        
        /* Modern Profile Card */
        .profile-card { 
            background-color: #ffffff; 
            border-radius: 1rem; 
            border: 1px solid #f1f5f9; 
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); 
            padding: 1.5rem; 
            transition: all 0.3s ease; 
        }
        
        /* Profile Card Content Area */
        .profile-card-content { max-width: 48rem; }

        /* --------------------------------------------------- */
        /* Desktop & Tablet Overrides                          */
        /* --------------------------------------------------- */
        @media (min-width: 640px) { 
            .profile-card { padding: 2.5rem; } 
        }
    </style>

    <div id="main-content" class="page-wrapper" style="transition: all 0.3s ease-in-out;">
        <div class="profile-wrapper">
            
            <div class="header-flex">
                <h2 class="page-title">Profile Settings</h2>
            </div>

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

                <div class="profile-card" style="border-color: #fee2e2;">
                    <div class="profile-card-content">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>