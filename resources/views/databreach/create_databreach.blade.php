<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Main Layout */
        .container { max-width: 80rem; margin: 0 auto; padding: 0 2rem; }
        @media (max-width: 640px) { .container { padding: 0.5rem; } }

        /* Form Card */
        .form-card { background-color: #ffffff; border-radius: 1rem; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 2rem; position: relative; transition: all 0.3s ease; }
        @media (max-width: 640px) { .form-card { padding: 1.5rem; border-radius: 0.75rem; } }

        /* Header */
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .section-title { font-size:1.5rem; font-weight:700; margin-bottom:2.5rem; border-bottom:2px solid #e5e7eb; padding-bottom:1rem; }
        .form-section-title { font-size:1.125rem; font-weight:600; color:#1f2937; margin:1.5rem 0 1rem; padding-bottom:0.5rem; }
        .close-btn { position:absolute; top:1.5rem; right:2rem; color:var(--text-muted); font-size:1.5rem; background:none; border:none; cursor:pointer; transition:color 0.2s; }
        .close-btn:hover { color:var(--text-main); }

        /* Error Box */
        .error-box { background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 1rem 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem; display: flex; gap: 0.75rem; align-items: flex-start; }
        .error-icon { font-size: 1.5rem; margin-top: 0.125rem; }
        .error-title { font-weight: 600; font-size: 0.875rem; margin: 0 0 0.5rem 0; }
        .error-list { list-style-type: disc; padding-left: 1.25rem; margin: 0; font-size: 0.875rem; line-height: 1.5; }

        /* Grid Layouts */
        .grid-2 { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-top: 1.5rem; }
        .grid-3 { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-top: 1.5rem; }
        
        @media (min-width: 768px) {
            .grid-2 { grid-template-columns: repeat(2, 1fr); }
            .grid-3 { grid-template-columns: repeat(3, 1fr); }
        }

        /* Form Controls */
        .form-group { display: flex; flex-direction: column; margin-top: 1.5rem; }
        .grid-2 .form-group, .grid-3 .form-group { margin-top: 0; } /* Reset margin when inside grid */
        .form-label { font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem; }
        .required-mark { color: #ef4444; }
        
        .form-input, .form-select, .form-textarea { width: 100%; border: 1px solid #d1d5db; border-radius: 0.75rem; padding: 0.75rem 1rem; font-size: 1rem; box-sizing: border-box; background-color: #ffffff; transition: border-color 0.2s, box-shadow 0.2s; font-family: inherit; }
        .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2); }
        .form-textarea { resize: none; }
        
        /* Validation Error State */
        .input-error { border-color: #ef4444 !important; }

        /* reCAPTCHA & Submit */
        .recaptcha-wrapper { margin-top: 1.5rem; width: 100%; max-width: 24rem; }
        @media (max-width: 640px) { .recaptcha-wrapper { margin-left: auto; margin-right: auto; } }
        
        .submit-wrapper { display: flex; justify-content: flex-end; padding-top: 2rem; border-top: 1px solid #e5e7eb; margin-top: 1.5rem; }
        .btn-submit { display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 1.5rem; background-color: #4f46e5; color: white; font-size: 0.875rem; font-weight: 600; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .btn-submit i { margin-right: 0.5rem; font-size: 1rem; }
        .btn-submit:hover:not(:disabled) { background-color: #4338ca; transform: translateY(-2px); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .btn-submit:disabled { opacity: 0.6; cursor: not-allowed; pointer-events: none; }

        /* Responsive reCAPTCHA scaling */
        @media (max-width: 500px) {
            #recaptcha { transform: scale(0.85); transform-origin: top left; }
        }
        @media (max-width: 450px) {
            #recaptcha { transform: scale(0.77); transform-origin: top left; }
        }
    </style>

    @can('create_databreach')
    <div id="main-content" class="page-wrapper">
        <div class="container">
            <div class="form-card">

                <button id="close" onclick="window.location.href='{{ route('databreach.index') }}'" class="close-btn" title="Close">
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

                    <h3 class="form-section-title">Please provide the incident information.</h3>

                    <div class="grid-2">
                        <div class="form-group">
                            <label for="sender_fullname" class="form-label">
                                Full Name <span class="required-mark">*</span>
                            </label>
                            <input type="text" id="sender_fullname" name="sender_fullname" placeholder="e.g., Juan A. Dela Cruz" required class="form-input">
                        </div>

                        <div class="form-group">
                            <label for="sender_email" class="form-label">
                                Email Address <span class="required-mark">*</span>
                            </label>
                            <input type="email" id="sender_email" name="sender_email" placeholder="e.g., j_delacruz@cda.gov.ph" required class="form-input">
                        </div>
                    </div>

                    <div class="grid-3">
                        <div class="form-group">
                            <label for="date_occurrence" class="form-label">
                                Date of Occurrence <span class="required-mark">*</span>
                            </label>
                            <input type="datetime-local" id="date_occurrence" name="date_occurrence" required class="form-input">
                        </div>

                        <div class="form-group">
                            <label for="date_discovery" class="form-label">
                                Date of Discovery <span class="required-mark">*</span>
                            </label>
                            <input type="datetime-local" id="date_discovery" name="date_discovery" required class="form-input">
                        </div>

                        <div class="form-group">
                            <label for="date_notification" class="form-label">
                                Date of Notification <span class="required-mark">*</span>
                            </label>
                            <input type="datetime-local" id="date_notification" name="date_notification" required readonly
                                class="form-input" value="{{ \Carbon\Carbon::now('Asia/Manila')->format('Y-m-d\TH:i') }}">
                        </div>
                    </div>

                    <div class="form-group" style="margin-top: 1.5rem;">
                        <label for="pic" class="form-label">
                            Personal Information Controller <span class="required-mark">*</span>
                        </label>
                        <select id="pic" name="pic" required class="form-select">
                            <option value="">-- Select Region --</option>
                            <option>CDA HO</option>
                            <option>CDA CAR</option>
                            <option>CDA NIR</option>
                            <option>CDA NCR</option>
                            <option>CDA Region I</option>
                            <option>CDA Region II</option>
                            <option>CDA Region III</option>
                            <option>CDA Region IV-A</option>
                            <option>CDA Region IV-B</option>
                            <option>CDA Region V</option>
                            <option>CDA Region VI</option>
                            <option>CDA Region VII</option>
                            <option>CDA Region VIII</option>
                            <option>CDA Region IX</option>
                            <option>CDA Region X</option>
                            <option>CDA Region XI</option>
                            <option>CDA Region XII</option>
                            <option>CDA Region XIII</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-top: 1.5rem;">
                        <label for="brief_summary" class="form-label">
                            Brief Summary of the Incident <span class="required-mark">*</span>
                        </label>
                        <textarea id="brief_summary" name="brief_summary" required rows="4"
                            placeholder="Write a brief summary of the incident here..."
                            class="form-textarea"></textarea>
                    </div>

                    <div class="recaptcha-wrapper">
                        <div class="g-recaptcha" id="recaptcha"
                            data-sitekey="{{ config('services.recaptcha.site_key') }}"
                            data-callback="enableSubmitButton"
                            data-expired-callback="disableSubmitButton"
                            data-error-callback="disableSubmitButton"></div>

                        @if ($errors->has('g-recaptcha-response'))
                            <div style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;">
                                {{ $errors->first('g-recaptcha-response') }}
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
                            text: 'Please fill in all required fields marked with *.',
                            confirmButtonColor: '#3085d6'
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
                });
            }
            
            // Ensure button starts disabled
            disableSubmitButton();
        });

        // Called when reCAPTCHA is successfully completed
        function enableSubmitButton() {
            const button = document.getElementById('submitReportBtn');
            if (button) {
                button.disabled = false;
                // Removed inline styles; relies on pure CSS rules now
            }
        }

        // Called when reCAPTCHA expires or fails
        function disableSubmitButton() {
            const button = document.getElementById('submitReportBtn');
            if (button) {
                button.disabled = true;
                // Removed inline styles; relies on pure CSS rules now
            }
        }
    </script>
    @endcan

</x-app-layout>