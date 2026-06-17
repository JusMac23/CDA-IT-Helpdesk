<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    
    <style>
        /* --- Theme Variables --- */
        :root {
            --card-bg: #ffffff;
            --text-dark: #0f172a;
            --text-muted: #475569;
            --border-light: #e2e8f0;
            --input-bg: #ffffff;
            --input-border: #cbd5e1;
            --input-text: #334155;
            --error-bg: #fef2f2;
            --error-border: #fecaca;
            --error-text: #991b1b;
            --error-title: #7f1d1d;
            --close-btn-hover: #f1f5f9;
            --close-btn-text: #94a3b8;
            --disabled-btn-bg: #cbd5e1;
            --disabled-btn-text: #f8fafc;
            --readonly-bg: #f8fafc;
            --link-color: #4f46e5;
            --link-hover: #4338ca;
        }

        body.dark {
            --card-bg: #0f172a; 
            --text-dark: #f8fafc;
            --text-muted: #9ca3af;
            --border-light: #334155; 
            --input-bg: #0f172a;
            --input-border: #4b5563;
            --input-text: #f1f5f9;
            --error-bg: rgba(153, 27, 27, 0.2);
            --error-border: rgba(248, 113, 113, 0.4);
            --error-text: #fca5a5;
            --error-title: #f87171;
            --close-btn-hover: #1e293b;
            --close-btn-text: #64748b;
            --disabled-btn-bg: #334155;
            --disabled-btn-text: #94a3b8;
            --readonly-bg: #1e293b;
            --link-color: #818cf8;
            --link-hover: #a5b4fc;
        }

        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }

        /* Main Layout */
        .container { max-width: 80rem; width: 100%; margin: 0 auto; padding: 0 2rem; }
        @media (max-width: 640px) { .container { padding: 0.01rem; } }

        /* Form Card */
        .form-card { background-color: var(--card-bg); border-radius: 1rem; border: 1px solid var(--border-light); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); padding: 2.5rem; position: relative; width: 100%; transition: background-color 0.3s ease, border-color 0.3s ease; }
        @media (max-width: 640px) { .form-card { padding: 1.5rem; border-radius: 0.75rem; } }

        /* Header */
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .section-title { font-size: 1.75rem; font-weight: 800; color: var(--text-dark); margin-top: 0; margin-bottom: 2rem; border-bottom: 1px solid var(--border-light); padding-bottom: 1.5rem; letter-spacing: -0.025em; width: 100%; transition: color 0.3s ease, border-color 0.3s ease; }
        .form-section-title { font-size: 1.15rem; font-weight: 700; color: var(--text-dark); margin: 1.5rem 0 1.25rem; padding-bottom: 0.5rem; width: 100%; transition: color 0.3s ease; }
        
        /* Close Button */
        .close-btn { position: absolute; top: 1.25rem; right: 1.25rem; color: var(--text-muted); font-size: 2.25rem; background: none; border: none; cursor: pointer; transition: color 0.2s, background-color 0.2s; line-height: 1; border-radius: 0.25rem; padding: 0 0.5rem; }
        .close-btn:hover { color: var(--text-dark); }

        /* Error Box */
        .error-box { background-color: var(--error-bg); border: 1px solid var(--error-border); color: var(--error-text); padding: 1.25rem 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem; display: flex; gap: 0.75rem; align-items: flex-start; width: 100%; transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease; }
        .error-icon { font-size: 1.5rem; margin-top: 0.125rem; color: #ef4444; }
        .error-title { font-weight: 700; font-size: 0.95rem; margin: 0 0 0.5rem 0; color: var(--error-title); transition: color 0.3s ease; }
        .error-list { list-style-type: disc; padding-left: 1.5rem; margin: 0; font-size: 0.9rem; line-height: 1.6; color: var(--error-text); font-weight: 500; transition: color 0.3s ease; }

        /* Form Controls */
        form { width: 100%; }
        .form-group { display: flex; flex-direction: column; margin-top: 1.5rem; width: 100%; }
        .form-label { font-size: 0.875rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.5rem; width: 100%; transition: color 0.3s ease; }
        .required-mark { color: #ef4444; margin-left: 0.125rem; }
        
        .form-input, .form-select { height: 44px; padding: 0 1rem; border: 1px solid var(--input-border); border-radius: 0.5rem; font-size: 0.95rem; color: var(--input-text); width: 100%; background-color: var(--input-bg); transition: all 0.2s; font-family: inherit; }
        .form-textarea { padding: 0.75rem 1rem; border: 1px solid var(--input-border); border-radius: 0.5rem; font-size: 0.95rem; color: var(--input-text); width: 100%; background-color: var(--input-bg); transition: all 0.2s; font-family: inherit; resize: vertical; min-height: 120px; }
        
        .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }
        .form-input::placeholder, .form-textarea::placeholder { color: var(--text-muted); opacity: 0.7; }
        
        /* Validation Error State */
        .input-error { border-color: #ef4444 !important; }
        .input-error:focus { box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15) !important; }

        /* Grid Layouts - Mobile First */
        .grid-2, .grid-3 { display: flex; flex-direction: column; gap: 0; width: 100%; margin-top: 0; }
        
        /* Terms and Conditions Checkbox */
        .terms-wrapper { margin-top: 2rem; width: 100%; }
        .terms-label { display: flex; align-items: flex-start; gap: 0.75rem; cursor: pointer; font-size: 0.9rem; color: var(--text-muted); line-height: 1.6; transition: color 0.3s ease; }
        .terms-checkbox { margin-top: 0.25rem; width: 1.125rem; height: 1.125rem; accent-color: #4f46e5; cursor: pointer; flex-shrink: 0; }
        .terms-link { color: var(--link-color); text-decoration: none; font-weight: 600; transition: color 0.2s; }
        .terms-link:hover { color: var(--link-hover); text-decoration: underline; }
        
        .submit-wrapper { display: flex; flex-direction: column; width: 100%; padding-top: 2rem; border-top: 1px solid var(--border-light); margin-top: 2rem; transition: border-color 0.3s ease; }
        
        /* Unified Button Styling */
        .btn-submit { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 2rem; background-color: #4f46e5; color: white; font-size: 0.95rem; font-weight: 600; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s ease; width: 100%; font-family: inherit; box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }
        .btn-submit i { margin-right: 0.5rem; font-size: 1rem; }
        .btn-submit:hover:not(:disabled) { background-color: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
        .btn-submit:active:not(:disabled) { transform: translateY(0); box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }
        .btn-submit:disabled { background-color: var(--disabled-btn-bg); color: var(--disabled-btn-text); cursor: not-allowed; box-shadow: none; transform: none; transition: background-color 0.3s ease, color 0.3s ease; }

        /* --------------------------------------------------- */
        /* Desktop & Tablet Overrides                          */
        /* --------------------------------------------------- */
        @media (min-width: 768px) {
            .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-top: 1.5rem; }
            .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 1.5rem; }
            .grid-2 .form-group, .grid-3 .form-group { margin-top: 0; }
            
            .submit-wrapper { flex-direction: row; justify-content: flex-end; }
            .btn-submit { width: auto; }
            .close-btn { top: 1.5rem; right: 2rem; }
        }
    </style>

    @can('create_databreach')
    <div id="main-content" class="page-wrapper">
        <div class="container">
            <div class="form-card">

                <button id="close" onclick="window.location.href='{{ route('databreach.index') }}'" class="close-btn" aria-label="Close form" title="Close">
                    &times;
                </button>

                <h2 class="section-title">Incident Report Form</h2>

                @if ($errors->any())
                <div class="error-box">
                    <span class="material-symbols-outlined" style="font-size: 1.25rem; margin-right: 0.2rem;">error</span>
                    <div>
                        <h4 class="error-title">Please fix the following errors:</h4>
                        <ul class="error-list">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                <form action="{{ route('databreach.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <h3 class="form-section-title">Please provide the incident information</h3>

                    <div class="grid-2">
                        <div class="form-group">
                            <label for="sender_fullname" class="form-label">
                                Full Name <span class="required-mark">*</span>
                            </label>
                            <input type="text" id="sender_fullname" name="sender_fullname" placeholder="e.g., Juan A. Dela Cruz" required class="form-input" autocomplete="name">
                        </div>

                        <div class="form-group">
                            <label for="sender_email" class="form-label">
                                Email Address <span class="required-mark">*</span>
                            </label>
                            <input type="email" id="sender_email" name="sender_email" placeholder="e.g., j_delacruz@cda.gov.ph" required class="form-input" autocomplete="email">
                        </div>
                    </div>

                    <div class="grid-3">
                        <div class="form-group">
                            <label for="date_occurrence" class="form-label">
                                Date of Occurrence <span class="required-mark">*</span>
                            </label>
                            <input type="datetime-local" id="date_occurrence" name="date_occurrence" required class="form-input" style="color: var(--input-text);">
                        </div>

                        <div class="form-group">
                            <label for="date_discovery" class="form-label">
                                Date of Discovery <span class="required-mark">*</span>
                            </label>
                            <input type="datetime-local" id="date_discovery" name="date_discovery" required class="form-input" style="color: var(--input-text);">
                        </div>

                        <div class="form-group">
                            <label for="date_notification" class="form-label">
                                Date of Notification <span class="required-mark">*</span>
                            </label>
                            <input type="datetime-local" id="date_notification" name="date_notification" required readonly
                                class="form-input" style="background-color: var(--readonly-bg); color: var(--text-muted); cursor: not-allowed;">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="pic" class="form-label">
                            Personal Information Controller <span class="required-mark">*</span>
                        </label>
                        <select id="pic" name="pic" required class="form-select">
                            <option value="">-- Select Region --</option>
                            <option value="CDA HO">CDA HO</option>
                            <option value="CDA CAR">CDA CAR</option>
                            <option value="CDA NIR">CDA NIR</option>
                            <option value="CDA NCR">CDA NCR</option>
                            <option value="CDA Region I">CDA Region I</option>
                            <option value="CDA Region II">CDA Region II</option>
                            <option value="CDA Region III">CDA Region III</option>
                            <option value="CDA Region IV-A">CDA Region IV-A</option>
                            <option value="CDA Region IV-B">CDA Region IV-B</option>
                            <option value="CDA Region V">CDA Region V</option>
                            <option value="CDA Region VI">CDA Region VI</option>
                            <option value="CDA Region VII">CDA Region VII</option>
                            <option value="CDA Region VIII">CDA Region VIII</option>
                            <option value="CDA Region IX">CDA Region IX</option>
                            <option value="CDA Region X">CDA Region X</option>
                            <option value="CDA Region XI">CDA Region XI</option>
                            <option value="CDA Region XII">CDA Region XII</option>
                            <option value="CDA Region XIII">CDA Region XIII</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="brief_summary" class="form-label">
                            Brief Summary of the Incident <span class="required-mark">*</span>
                        </label>
                        <textarea id="brief_summary" name="brief_summary" required rows="4"
                            placeholder="Provide a clear and concise description of the incident..."
                            class="form-textarea"></textarea>
                    </div>

                    <div class="terms-wrapper">
                        <label class="terms-label" for="terms_agree">
                            <input type="checkbox" id="terms_agree" name="terms_agree" required class="terms-checkbox">
                            <span>I have read and agree to the <a href="https://cda.gov.ph/cda-privacy-policy/" class="terms-link" target="_blank">Terms and Conditions</a> and the <a href="https://cda.gov.ph/cda-privacy-policy/" class="terms-link" target="_blank">Privacy Policy</a>, and I confirm that the information provided is accurate and true to the best of my knowledge. <span class="required-mark">*</span></span>
                        </label>
                    </div>

                    <div class="submit-wrapper">
                        <button type="submit" id="submitReportBtn" class="btn-submit" disabled>
                            <span>Submit Report</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // SweetAlert notifications
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{!! addslashes(session("success")) !!}',
                timer: 4000,
                showConfirmButton: false
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{!! addslashes(session("error")) !!}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        document.addEventListener("DOMContentLoaded", function () {
            
            // Set Exact Time
            const dateNotificationInput = document.getElementById('date_notification');
            if (dateNotificationInput) {
                const now = new Date();
                const year = now.getFullYear();
                const month = String(now.getMonth() + 1).padStart(2, '0');
                const day = String(now.getDate()).padStart(2, '0');
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                
                dateNotificationInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
            }

            // FORM VALIDATION ENHANCEMENT
            const form = document.querySelector('form');
            const termsCheckbox = document.getElementById('terms_agree');
            const submitBtn = document.getElementById('submitReportBtn');

            if (form) {
                form.addEventListener('submit', function (e) {
                    let isValid = true;
                    const requiredFields = this.querySelectorAll('[required]');

                    requiredFields.forEach(field => {
                        // For checkboxes, check if it's checked, otherwise check if value is trimmed
                        if (field.type === 'checkbox') {
                            if (!field.checked) isValid = false;
                        } else if (!field.value.trim()) {
                            isValid = false;
                            field.classList.add('input-error');
                        } else {
                            field.classList.remove('input-error');
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Missing Information',
                            text: 'Please fill in all required fields marked with an asterisk (*), and agree to the CDA Terms and Conditions and Privacy Policy.',
                            confirmButtonColor: '#4f46e5',
                            confirmButtonText: 'Okay'
                        });
                    }
                });

                // Real-time validation feedback
                form.querySelectorAll('input[type="text"], input[type="email"], input[type="datetime-local"], select, textarea').forEach(field => {
                    field.addEventListener('blur', function () {
                        if (this.hasAttribute('required') && !this.value.trim()) {
                            this.classList.add('input-error');
                        } else {
                            this.classList.remove('input-error');
                        }
                    });
                    
                    field.addEventListener('input', function() {
                        if (this.value.trim()) {
                            this.classList.remove('input-error');
                        }
                    });
                });
            }
            
            // Terms and Conditions Checkbox Logic
            if (termsCheckbox && submitBtn) {
                // Ensure initial state matches checkbox status on reload
                submitBtn.disabled = !termsCheckbox.checked;

                // Toggle submit button state when checkbox is clicked
                termsCheckbox.addEventListener('change', function() {
                    submitBtn.disabled = !this.checked;
                });
            }
        });
    </script>
    @endcan

</x-app-layout>