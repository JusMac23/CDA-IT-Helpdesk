<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
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
        }

        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }

        /* Main Layout */
        .container { max-width: 80rem; width: 100%; margin: 0 auto; padding: 0 2rem; }
        @media (max-width: 640px) { .container { padding: 0.5rem; } }

        /* Form Card - Added outline matching dark mode specs */
        .form-card { background-color: var(--card-bg); border-radius: 1rem; border: 1px solid var(--border-light); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); padding: 2.5rem; position: relative; width: 100%; transition: background-color 0.3s ease, border-color 0.3s ease; }
        @media (max-width: 640px) { .form-card { padding: 1.5rem; border-radius: 0.75rem; } }

        /* Header */
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .section-title { font-size: 1.75rem; font-weight: 800; color: var(--text-dark); margin-top: 0; margin-bottom: 2rem; border-bottom: 1px solid var(--border-light); padding-bottom: 1.5rem; letter-spacing: -0.025em; width: 100%; transition: color 0.3s ease, border-color 0.3s ease; }
        .form-section-title { font-size: 1.15rem; font-weight: 700; color: var(--text-dark); margin: 1.5rem 0 1.25rem; padding-bottom: 0.5rem; width: 100%; transition: color 0.3s ease; }
        
        .close-btn { position: absolute; top: 1.5rem; right: 1.5rem; color: var(--close-btn-text); font-size: 1.75rem; background: none; border: none; cursor: pointer; transition: all 0.2s; line-height: 1; border-radius: 0.25rem; padding: 0.25rem 0.5rem; }
        .close-btn:hover { color: var(--text-dark); background-color: var(--close-btn-hover); }

        /* Error Box */
        .error-box { background-color: var(--error-bg); border: 1px solid var(--error-border); color: var(--error-text); padding: 1.25rem 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem; display: flex; gap: 0.75rem; align-items: flex-start; width: 100%; transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease; }
        .error-icon { font-size: 1.5rem; margin-top: 0.125rem; color: #ef4444; }
        .error-title { font-weight: 700; font-size: 0.95rem; margin: 0 0 0.5rem 0; color: var(--error-title); transition: color 0.3s ease; }
        .error-list { list-style-type: disc; padding-left: 1.5rem; margin: 0; font-size: 0.9rem; line-height: 1.6; color: var(--error-text); font-weight: 500; transition: color 0.3s ease; }

        /* Form Controls - Unified Heights */
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
        
        /* reCAPTCHA & Submit - Mobile First */
        .recaptcha-wrapper { margin-top: 2rem; width: 100%; overflow: hidden; position: relative; }
        
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
            
            .recaptcha-wrapper { max-width: 304px; }
            .submit-wrapper { flex-direction: row; justify-content: flex-end; }
            .btn-submit { width: auto; }
            .close-btn { top: 2rem; right: 2rem; }
        }
    </style>

    @can('create_databreach')
    <div id="main-content" class="page-wrapper">
        <div class="container">
            <div class="form-card">

                <button id="close" onclick="window.location.href='{{ route('databreach.index') }}'" class="close-btn" aria-label="Close form" title="Close">
                    <i class="fas fa-times"></i>
                </button>

                <h2 class="section-title">Incident Report Form</h2>

                @if ($errors->any())
                <div class="error-box">
                    <i class="fas fa-exclamation-circle error-icon"></i>
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
                                class="form-input" style="background-color: var(--readonly-bg); color: var(--text-muted); cursor: not-allowed;" value="{{ \Carbon\Carbon::now('Asia/Manila')->format('Y-m-d\TH:i') }}">
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

                    <div class="recaptcha-wrapper" id="recaptcha-container">
                        <div class="g-recaptcha" id="recaptcha"
                            data-sitekey="{{ config('services.recaptcha.site_key') }}"
                            data-callback="enableSubmitButton"
                            data-expired-callback="disableSubmitButton"
                            data-error-callback="disableSubmitButton"></div>

                        @if ($errors->has('g-recaptcha-response'))
                            <div style="color: #ef4444; font-weight: 500; font-size: 0.875rem; margin-top: 0.75rem; width: 100%;">
                                <i class="fas fa-info-circle" style="margin-right: 0.25rem;"></i> {{ $errors->first('g-recaptcha-response') }}
                            </div>
                        @endif
                    </div>

                    <div class="submit-wrapper">
                        <button type="submit" id="submitReportBtn" class="btn-submit" disabled>
                            <i class="fas fa-paper-plane"></i>
                            <span>Submit Report</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            // FORM VALIDATION ENHANCEMENT
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    let isValid = true;
                    const requiredFields = this.querySelectorAll('[required]');

                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
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
                            text: 'Please fill in all required fields marked with an asterisk (*).',
                            confirmButtonColor: '#4f46e5',
                            confirmButtonText: 'Okay'
                        });
                    }
                });

                // Real-time validation feedback
                form.querySelectorAll('[required]').forEach(field => {
                    field.addEventListener('blur', function () {
                        if (!this.value.trim()) {
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
            
            // Ensure button starts disabled (relies on reCAPTCHA callback to enable)
            disableSubmitButton();
        });

        // Called when reCAPTCHA is successfully completed
        function enableSubmitButton() {
            const button = document.getElementById('submitReportBtn');
            if (button) {
                button.disabled = false;
            }
        }

        // Called when reCAPTCHA expires or fails
        function disableSubmitButton() {
            const button = document.getElementById('submitReportBtn');
            if (button) {
                button.disabled = true;
            }
        }

        // Dynamically Resize reCAPTCHA to stretch accurately on all screens
        function resizeRecaptcha() {
            const wrapper = document.getElementById('recaptcha-container');
            const recaptcha = document.querySelector('.g-recaptcha');
            
            if (wrapper && recaptcha) {
                const wrapperWidth = wrapper.offsetWidth;
                const scale = wrapperWidth / 304; // 304px is Google's default width
                
                // Only scale down on very small screens, never scale up
                if (scale < 1) {
                    recaptcha.style.transform = `scale(${scale})`;
                    recaptcha.style.transformOrigin = '0 0';
                    wrapper.style.height = `${78 * scale}px`; // 78px is Google's default height
                } else {
                    recaptcha.style.transform = 'scale(1)';
                    wrapper.style.height = '78px';
                }
            }
        }

        // Add event listeners to trigger resize logic reliably
        window.addEventListener('resize', resizeRecaptcha);
        window.addEventListener('load', resizeRecaptcha);
        setTimeout(resizeRecaptcha, 300);
        setTimeout(resizeRecaptcha, 1000);
    </script>
    @endcan

</x-app-layout>