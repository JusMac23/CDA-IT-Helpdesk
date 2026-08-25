@php
    $year = now()->year;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CDA-ICT Helpdesk</title>
    <link rel="icon" href="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>

    <script src="/assets/js/sweetalert2.min.js"></script>

    <style>
        /* CSS Variables for consistent theming */
        :root { 
            --accent-blue: #3b82f6; 
            --alert-red: #ef4444; 
            --text-muted: #64748b; 
            --glass-bg: rgba(15, 23, 42, 0.9); 
            --glass-border: rgba(255, 255, 255, 0.1); 
            --primary-indigo: #4f46e5; 
            --indigo-hover: #4338ca; 
            --bg-body: #f8fafc; 
            --text-body: #334155; 
            --border-color: #cbd5e1; 
            --error-bg: #fef2f2; 
            --error-text: #991b1b; 
            --error-border: #ef4444; 
            --close-btn-hover: #f1f5f9;
            --close-btn-text: #94a3b8;
        }

        /* Base Resets & Typography */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: var(--bg-body); color: var(--text-body); font-family: 'Inter', system-ui, -apple-system, sans-serif; -webkit-font-smoothing: antialiased; line-height: 1.5; }
        a { text-decoration: none; }
        ul { list-style: none; }

        /* Animations */
        @keyframes fade-in-down { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-down { animation: fade-in-down 0.5s ease-out forwards; }

        /* Header Styles */
        .app-header { background-color: var(--glass-bg); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); position: sticky; top: 0; z-index: 50; border-bottom: 1px solid var(--glass-border); }
        .header-gradient { height: 3px; background: linear-gradient(90deg, var(--accent-blue), var(--alert-red)); }
        .container { max-width: 1280px; margin: 0 auto; padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; }
        
        /* Branding */
        .brand { font-size: 1.5rem; font-weight: 800; color: #ffffff; display: flex; align-items: center; gap: 0.75rem; letter-spacing: -0.025em; }
        .brand img { width: 44px; height: 44px; object-fit: contain; transition: transform 0.3s ease; }
        .brand:hover img { transform: scale(1.1) rotate(-5deg); }

        /* Navigation */
        .nav-links { display: flex; gap: 1rem; align-items: center; font-weight: 600; font-size: 0.95rem; }
        .nav-link { color: #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 8px; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease; border: 1px solid transparent; }
        .nav-link:hover { color: #ffffff; background-color: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.3); }

        /* Logout Link Specifics */
        .nav-link.nav-link-logout { color: #fca5a5; background: none; cursor: pointer; font: inherit; border: none; }
        .nav-link.nav-link-logout:hover { color: #ffffff; background-color: rgba(239, 68, 68, 0.15); border-color: rgba(239, 68, 68, 0.3); }

        /* Navigation Mobile Overrides */
        @media (max-width: 768px) {
            .nav-text { display: none !important; }
            .nav-link { 
                padding: 0.6rem 0.8rem; 
                margin: 0 !important; 
                justify-content: center;
            }
        }

        /* Form Container Section */
        .incident-section { padding: 1.5rem; width: calc(100% - 2rem); max-width: 1152px; margin: 2rem auto 4rem; background-color: #ffffff; border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.025); border: 1px solid #f1f5f9; position: relative; }
        @media (max-width: 640px) { 
            .incident-section { padding: 1.5rem; margin: 2.0rem auto 1rem; width: calc(100% - 2.5rem); } 
        }
        .section-title { font-size: 1.75rem; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 2rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1.5rem; letter-spacing: -0.025em; width: 100%; }
        .form-section-title { font-size: 1.15rem; font-weight: 700; color: #0f172a; margin: 1.5rem 0 1.25rem; padding-bottom: 0.5rem; width: 100%; }
        
        /* Close Button */
        .close-btn { position: absolute; top: 1.25rem; right: 1.25rem; color: var(--text-muted); font-size: 2.25rem; background: none; border: none; cursor: pointer; transition: color 0.2s, background-color 0.2s; line-height: 1; border-radius: 0.25rem; padding: 0 0.5rem; }
        .close-btn:hover { color: var(--text-body); }

        /* Alerts */
        .alert-error { width: 100%; background-color: var(--error-bg); border-left: 4px solid var(--error-border); color: var(--error-text); padding: 1.25rem 1.5rem; margin-bottom: 2rem; border-radius: 0.5rem; display: flex; gap: 0.75rem; }
        .alert-error h4 { margin-bottom: 0.5rem; font-size: 0.95rem; font-weight: 700; color: #7f1d1d; }
        .alert-error ul { padding-left: 1.5rem; list-style-type: disc; font-size: 0.9rem; font-weight: 500; }
        
        /* Universal Form Elements - Mobile First (100% width) */
        form { width: 100%; }
        .form-group { width: 100%; margin-bottom: 1.5rem; }
        .form-group label { display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem; color: #475569; width: 100%; }
        .text-required { color: var(--error-border); margin-left: 0.125rem; }
        
        /* Unified Input Heights */
        .form-control { height: 44px; width: 100%; border: 1px solid var(--border-color); border-radius: 0.5rem; padding: 0 1rem; font-family: inherit; font-size: 0.95rem; color: var(--text-body); transition: all 0.2s; box-sizing: border-box; display: block; background-color: #ffffff; }
        .form-control:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }
        .form-control.is-invalid { border-color: var(--error-border); background-color: var(--error-bg); }
        .form-control.is-invalid:focus { box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.15) !important; }
        .form-control::placeholder { color: #94a3b8; }
        
        /* Readonly specific styling */
        .form-control[readonly] { background-color: #f8fafc; color: #64748b; cursor: not-allowed; border-color: #e2e8f0; }
        
        /* Textarea Override */
        textarea.form-control { height: auto; padding: 0.75rem 1rem; resize: vertical; min-height: 120px; width: 100%; }

        /* Grids - Default to 1 column (100% width) for Mobile */
        .grid-2-col, .grid-3-col { display: flex; flex-direction: column; width: 100%; gap: 0; }
        
        /* Terms and Conditions Checkbox */
        .terms-wrapper { margin-top: 1.5rem; margin-bottom: 1.5rem; width: 100%; }
        .terms-label { display: flex; align-items: flex-start; gap: 0.75rem; cursor: pointer; font-size: 0.9rem; color: #475569; line-height: 1.6; }
        .terms-checkbox { margin-top: 0.25rem; width: 1.125rem; height: 1.125rem; accent-color: var(--primary-indigo); cursor: pointer; flex-shrink: 0; }
        .terms-link { color: var(--primary-indigo); text-decoration: none; font-weight: 600; transition: color 0.2s; }
        .terms-link:hover { color: var(--indigo-hover); text-decoration: underline; }

        /* Footer & Buttons - Mobile First (100% width) */
        .form-footer { display: flex; flex-direction: column; width: 100%; align-items: stretch; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; }
        
        .btn-submit { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 2rem; background-color: var(--primary-indigo); color: white; font-size: 0.95rem; font-weight: 600; border: none; border-radius: 0.5rem; cursor: pointer; transition: all 0.2s ease; width: 100%; font-family: inherit; box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }
        .btn-submit:hover:not(:disabled) { background-color: var(--indigo-hover); transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
        .btn-submit:active:not(:disabled) { transform: translateY(0); box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }
        .btn-submit:disabled { background-color: #cbd5e1; color: #f8fafc; cursor: not-allowed; box-shadow: none; transform: none; }
        
        /* Desktop & Tablet Overrides */
        @media (min-width: 768px) {
            .incident-section { padding: 2.5rem; margin: 3rem auto 4rem; }
            .close-btn { top: 1.5rem; right: 2rem; }

            /* Activate Grids */
            .grid-2-col { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
            .grid-3-col { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; }
            
            /* Reset gap zeroing from mobile */
            .grid-2-col .form-group, .grid-3-col .form-group { margin-bottom: 0; }
            
            /* Horizontal Footer */
            .form-footer { flex-direction: row; justify-content: flex-end; }
            .btn-submit { width: auto; }
        }
    </style>
</head>

<body>

<header class="app-header">
    <div class="header-gradient"></div>
    <div class="container">
        <h1 class="brand">
            <img src="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" alt="CDA Seal">
            <span>CDA-DBRS</span>
        </h1>

        <nav>
            <ul class="nav-links">
                @auth
                    <li>
                        <a href="{{ url('/tickets/overview_tickets') }}" class="nav-link">
                            <span class="material-symbols-outlined" style="font-size: 1.25rem;">table_chart_view</span> 
                            <span class="nav-text">Tickets Overview</span>
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="nav-link nav-link-logout">
                            <span class="material-symbols-outlined" style="font-size: 1.25rem;">logout</span> 
                            <span class="nav-text">Logout</span>
                            </button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="nav-link">
                            <span class="material-symbols-outlined" style="font-size: 1.25rem;">login</span> 
                            <span class="nav-text">Login</span>
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

<section class="incident-section animate-fade-in-down">

    <button id="close" onclick="window.location.href='{{ url('/') }}'" class="close-btn" aria-label="Close form" title="Close">
        &times;
    </button>

    @if ($errors->any())
        <div class="alert-error">
            <span class="material-symbols-outlined" style="font-size: 1.25rem; margin-right: 0.2rem;">error</span>
            <div>
                <h4>Please fix the following errors:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <h2 class="section-title">Incident Report Form</h2>

    <form action="{{ route('incident.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h3 class="form-section-title">Please provide the incident information</h3>

        <div class="grid-2-col">
            <div class="form-group">
                <label for="sender_fullname">Full Name <span class="text-required">*</span></label>
                <input type="text" id="sender_fullname" name="sender_fullname" placeholder="e.g., Juan A. Dela Cruz" required class="form-control" autocomplete="name">
            </div>
            <div class="form-group">
                <label for="sender_email">Email Address <span class="text-required">*</span></label>
                <input type="email" id="sender_email" name="sender_email" placeholder="e.g., j_delacruz@cda.gov.ph" required class="form-control" autocomplete="email">
            </div>
        </div>

        <div class="grid-3-col" style="margin-top: 1.5rem;">
            <div class="form-group">
                <label for="date_occurrence">Date of Occurrence <span class="text-required">*</span></label>
                <input type="datetime-local" id="date_occurrence" name="date_occurrence" required class="form-control">
            </div>
            <div class="form-group">
                <label for="date_discovery">Date of Discovery <span class="text-required">*</span></label>
                <input type="datetime-local" id="date_discovery" name="date_discovery" required class="form-control">
            </div>
            <div class="form-group">
                <label for="date_notification">Date of Notification <span class="text-required">*</span></label>
                <input type="datetime-local" id="date_notification" name="date_notification" required readonly class="form-control">
            </div>
        </div>

        <div class="form-group" style="margin-top: 1.5rem;">
            <label for="pic">Personal Information Controller <span class="text-required">*</span></label>
            <select id="pic" name="pic" required class="form-control">
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
            <label for="brief_summary">Brief Summary of the Incident <span class="text-required">*</span></label>
            <textarea id="brief_summary" name="brief_summary" required placeholder="Provide a clear and concise description of the incident..." class="form-control"></textarea>
        </div>

        <div class="terms-wrapper">
            <label class="terms-label" for="terms_agree">
                <input type="checkbox" id="terms_agree" name="terms_agree" required class="terms-checkbox">
                <span>I have read and agree to the <a href="https://cda.gov.ph/cda-privacy-policy/" class="terms-link" target="_blank">Terms and Conditions</a> and the <a href="https://cda.gov.ph/cda-privacy-policy/" class="terms-link" target="_blank">Privacy Policy</a>, and I confirm that the information provided is accurate and true to the best of my knowledge. <span class="text-required">*</span></span>
            </label>
        </div>

        <div class="form-footer">
            <button type="submit" id="submitReportBtn" class="btn-submit" disabled>
                <span>Submit Report</span>
            </button>
        </div>
    </form>
</section>

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

    document.addEventListener('DOMContentLoaded', function () {
        // Fix: Sync exact device/laptop time to prevent 4-minute server delay
        const dateNotificationInput = document.getElementById('date_notification');
        if (dateNotificationInput) {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            
            // Format: YYYY-MM-DDThh:mm
            dateNotificationInput.value = `${year}-${month}-${day}T${hours}:${minutes}`;
        }

        const form = document.querySelector('form');
        const termsCheckbox = document.getElementById('terms_agree');
        const submitBtn = document.getElementById('submitReportBtn');

        // Form validation enhancement
        if (form) {
            form.addEventListener('submit', function(e) {
                let isValid = true;
                const requiredFields = this.querySelectorAll('[required]');
                
                requiredFields.forEach(field => {
                    if (field.type === 'checkbox') {
                        if (!field.checked) isValid = false;
                    } else if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');
                    } else {
                        field.classList.remove('is-invalid');
                    }
                });

                if (!isValid) {
                    e.preventDefault();
                    Swal.fire({
                        icon: 'error',
                        title: 'Missing Information',
                        text: 'Please fill in all required fields marked with an asterisk (*), and agree to the CDA Terms and Conditions and Privacy Policy.',
                        confirmButtonColor: '#4f46e5'
                    });
                }
            });

            // Real-time validation
            form.querySelectorAll('input[type="text"], input[type="email"], input[type="datetime-local"], select, textarea').forEach(field => {
                field.addEventListener('blur', function() {
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.classList.add('is-invalid');
                    } else {
                        this.classList.remove('is-invalid');
                    }
                });

                field.addEventListener('input', function() {
                    if (this.value.trim()) {
                        this.classList.remove('is-invalid');
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
</body>
</html>