@php
    $year = now()->year;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CDA-DBRS</title>
    <link rel="icon" href="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" type="image/png">

    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script src="/assets/js/sweetalert2.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <style>
        /* CSS Variables for consistent theming */
        :root { 
            --accent-blue: #3b82f6; 
            --alert-red: #ef4444; 
            --text-muted: #94a3b8; 
            --glass-bg: rgba(15, 23, 42, 0.9); 
            --glass-border: rgba(255, 255, 255, 0.1); 
            --primary-indigo: #4f46e5; 
            --indigo-hover: #4338ca; 
            --bg-body: #f9fafb; 
            --text-body: #1f2937; 
            --border-color: #d1d5db; 
            --error-bg: #fee2e2; 
            --error-text: #991b1b; 
            --error-border: #ef4444; 
        }

        /* Base Resets & Typography */
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { background-color: var(--bg-body); color: var(--text-body); font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, sans-serif; -webkit-font-smoothing: antialiased; line-height: 1.5; }
        a { text-decoration: none; }
        ul { list-style: none; }

        /* Animations */
        @keyframes fade-in-down { from { opacity: 0; transform: translateY(-20px); } to { opacity: 1; transform: translateY(0); } }
        .animate-fade-in-down { animation: fade-in-down 0.7s ease-out both; }

        /* Header Styles */
        .app-header { background-color: var(--glass-bg); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); position: sticky; top: 0; z-index: 50; border-bottom: 1px solid var(--glass-border); }
        .header-gradient { height: 3px; background: linear-gradient(90deg, var(--accent-blue), var(--alert-red)); width: 100%; }
        .container { max-width: 1280px; margin: 0 auto; padding: 1rem 1.5rem; display: flex; justify-content: space-between; align-items: center; width: 100%; }
        
        /* Branding */
        .brand { font-size: 1.5rem; font-weight: 800; color: #ffffff; display: flex; align-items: center; gap: 0.75rem; letter-spacing: -0.025em; }
        .brand img { width: 44px; height: 44px; object-fit: contain; transition: transform 0.3s ease; }
        .brand:hover img { transform: scale(1.1) rotate(-5deg); }

        /* Navigation */
        .nav-links { display: flex; gap: 1rem; align-items: center; font-weight: 600; font-size: 0.95rem; }
        .nav-link { color: #e2e8f0; padding: 0.6rem 1.25rem; border-radius: 8px; display: flex; align-items: center; gap: 0.5rem; transition: all 0.3s ease; border: 1px solid transparent; }
        .nav-link:hover { color: #ffffff; background-color: rgba(59, 130, 246, 0.1); border-color: rgba(59, 130, 246, 0.3); }
        
        /* Hide nav icons on mobile to save space */
        .nav-link .material-icons-outlined { display: none; }

        /* Logout Link Specifics */
        .nav-link.nav-link-logout { color: #f87171; background: transparent; border: none; font: inherit; cursor: pointer; }
        .nav-link.nav-link-logout:hover { color: #ffffff; background-color: rgba(239, 68, 68, 0.15); border-color: rgba(239, 68, 68, 0.3); }

        /* Form Container Section */
        .incident-section { padding: 1.5rem; width: calc(100% - 2rem); max-width: 1152px; margin: 1.5rem auto 4rem; background-color: #ffffff; border-radius: 1rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); position: relative; }
        .section-title { font-size: 1.5rem; font-weight: 700; margin-bottom: 2rem; border-bottom: 2px solid #e5e7eb; padding-bottom: 1rem; color: var(--text-body); width: 100%; }
        .form-section-title { font-size: 1.125rem; font-weight: 600; color: #1f2937; margin: 1.5rem 0 1rem; padding-bottom: 0.5rem; width: 100%; }
        .close-btn { position: absolute; top: 1.5rem; right: 1.5rem; color: var(--text-muted); font-size: 1.875rem; background: none; border: none; cursor: pointer; transition: color 0.2s; }
        .close-btn:hover { color: var(--text-body); }

        /* Alerts */
        .alert-error { width: 100%; background-color: var(--error-bg); border-left: 4px solid var(--error-border); color: var(--error-text); padding: 1rem 1.5rem; margin-bottom: 1.5rem; border-radius: 0.5rem; display: flex; gap: 0.75rem; }
        .alert-error h4 { margin-bottom: 0.25rem; font-size: 0.875rem; }
        .alert-error ul { padding-left: 1.25rem; list-style-type: disc; font-size: 0.875rem; }
        
        /* Universal Form Elements - Mobile First (100% width) */
        form { width: 100%; }
        .form-group { width: 100%; margin-bottom: 1.5rem; }
        .form-group label { display: block; font-size: 0.875rem; font-weight: 600; margin-bottom: 0.5rem; color: var(--text-body); width: 100%; }
        .text-required { color: var(--error-border); }
        .form-control { width: 100%; border: 1px solid var(--border-color); border-radius: 0.75rem; padding: 0.75rem 1rem; font-family: inherit; font-size: 1rem; color: var(--text-body); transition: all 0.2s; box-sizing: border-box; display: block; }
        .form-control:focus { outline: none; border-color: var(--primary-indigo); box-shadow: 0 0 0 3px rgba(79,70,229,0.2); }
        .form-control.is-invalid { border-color: var(--error-border); background-color: #fef2f2; }
        select.form-control { appearance: auto; background-color: white; }
        textarea.form-control { resize: vertical; min-height: 100px; width: 100%; }

        /* Grids - Default to 1 column (100% width) for Mobile */
        .grid-2-col, .grid-3-col { display: flex; flex-direction: column; width: 100%; gap: 0; }
        
        /* Footer & Buttons - Mobile First (100% width) */
        .form-footer { display: flex; flex-direction: column; width: 100%; gap: 1.5rem; align-items: stretch; margin-top: 1.5rem; padding-top: 2rem; border-top: 1px solid #e5e7eb; }
        .btn-submit { width: 100%; display: flex; align-items: center; justify-content: center; gap: 0.75rem; padding: 0.85rem; background-color: var(--primary-indigo); color: #ffffff; font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, sans-serif; font-weight: 600; font-size: 1rem; border: none; border-radius: 0.75rem; cursor: pointer; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); transition: all 0.3s ease; }
        .btn-submit:hover:not(:disabled) { background-color: var(--indigo-hover); transform: scale(1.02); }
        .btn-submit:disabled { opacity: 0.6; cursor: not-allowed; pointer-events: none; }
        
        /* reCAPTCHA wrapper - Mobile First (100% width scaling) */
        .recaptcha-wrapper { width: 100%; margin: 0; overflow: hidden; position: relative; }

        /* --------------------------------------------------- */
        /* Desktop & Tablet Overrides (min-width: 768px)       */
        /* --------------------------------------------------- */
        @media (min-width: 768px) {
            .incident-section { padding: 2rem; margin: 2.5rem auto 4rem; }
            .close-btn { right: 2rem; }
            
            /* Show Nav Icons on Desktop/Tablet */
            .nav-link .material-icons-outlined { display: inline-block; }

            /* Activate Grids */
            .grid-2-col { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-top: 1.5rem; }
            .grid-3-col { display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-top: 1.5rem; }
            
            /* Reset gap zeroing from mobile */
            .grid-2-col .form-group, .grid-3-col .form-group { margin-bottom: 0; }
            
            /* Horizontal Footer */
            .form-footer { flex-direction: row; justify-content: space-between; align-items: flex-start; }
            .btn-submit { width: auto; padding: 0.75rem 2rem; }
            .recaptcha-wrapper { max-width: 304px; margin: 1rem 0; }
        }
    </style>
</head>

<body>

<header class="app-header">
    <div class="header-gradient"></div>
    <div class="container">
        <h1 class="brand">
            <img src="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" alt="CDA Seal" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Cooperative_Development_Authority_%28CDA%29.svg/1200px-Cooperative_Development_Authority_%28CDA%29.svg.png'" />
            <span>CDA-DBRS</span>
        </h1>

        <nav>
            <ul class="nav-links">
                @auth
                    <li>
                        <a href="{{ url('/dashboard') }}" class="nav-link">
                            <span class="material-icons-outlined text-lg">dashboard</span> Dashboard
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                            @csrf
                            <button type="submit" class="nav-link nav-link-logout">
                                <span class="material-icons-outlined text-lg">logout</span> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li>
                        <a href="{{ route('login') }}" class="nav-link">
                            <span class="material-icons-outlined text-lg">login</span> Login
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

<section class="incident-section animate-fade-in-down">
    <button id="close" onclick="window.location.href='{{ url('/') }}'" class="close-btn" aria-label="Close">
        &times;
    </button>

    @if ($errors->any())
        <div class="alert-error">
            <i class="fas fa-exclamation-circle" style="margin-top: 0.25rem;"></i>
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

    <h2 class="section-title">Incident Report Form</h2>

    <form action="{{ route('incident.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <h3 class="form-section-title">Please provide the incident information.</h3>

        <div class="grid-2-col">
            <div class="form-group">
                <label for="sender_fullname">Full Name <span class="text-required">*</span></label>
                <input type="text" id="sender_fullname" name="sender_fullname" placeholder="e.g., Juan A. Dela Cruz" required class="form-control">
            </div>
            <div class="form-group">
                <label for="sender_email">Email Address <span class="text-required">*</span></label>
                <input type="email" id="sender_email" name="sender_email" placeholder="e.g., j_delacruz@cda.gov.ph" required class="form-control">
            </div>
        </div>

        <div class="grid-3-col">
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
                <input type="datetime-local" id="date_notification" name="date_notification" required readonly class="form-control"
                    value="{{ \Carbon\Carbon::now('Asia/Manila')->format('Y-m-d\TH:i') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="pic">Personal Information Controller <span class="text-required">*</span></label>
            <select id="pic" name="pic" required class="form-control">
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

        <div class="form-group">
            <label for="brief_summary">Brief Summary of the Incident <span class="text-required">*</span></label>
            <textarea id="brief_summary" name="brief_summary" required rows="4" placeholder="Write a brief summary of the incident here..." class="form-control"></textarea>
        </div>

        <div class="form-footer">
            <div class="recaptcha-wrapper" id="recaptcha-container">
                <div class="g-recaptcha"
                    data-sitekey="{{ config('services.recaptcha.site_key') }}"
                    data-callback="enableSubmitButton"
                    data-expired-callback="disableSubmitButton"
                    data-error-callback="disableSubmitButton"></div>

                @if ($errors->has('g-recaptcha-response'))
                    <span style="color: var(--error-border); font-size: 0.875rem; display: block; margin-top: 0.5rem; width: 100%;">
                        {{ $errors->first('g-recaptcha-response') }}
                    </span>
                @endif
            </div>

            <button type="submit" id="submitReportBtn" class="btn-submit" disabled>
                <i class="fas fa-paper-plane"></i> Submit Report
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
            text: '{{ session('success') }}',
            timer: 4000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif

    // Form validation enhancement
    document.querySelector('form').addEventListener('submit', function(e) {
        let isValid = true;
        const requiredFields = this.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
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
                text: 'Please fill in all required fields marked with *.',
                confirmButtonColor: '#3085d6'
            });
        }
    });

    // Real-time validation
    document.querySelectorAll('[required]').forEach(field => {
        field.addEventListener('blur', function() {
            if (!this.value.trim()) {
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

    // Always start disabled when page loads
    document.addEventListener('DOMContentLoaded', function () {
        disableSubmitButton();
    });

    // Dynamically Resize reCAPTCHA to stretch accurately on all screens
    function resizeRecaptcha() {
        const wrapper = document.getElementById('recaptcha-container');
        const recaptcha = document.querySelector('.g-recaptcha');
        
        if (wrapper && recaptcha) {
            // Measure actual container width
            const wrapperWidth = wrapper.offsetWidth;
            
            // Standard reCAPTCHA size is 304px
            const scale = wrapperWidth / 304;
            
            // Apply scale and fix dimensions
            recaptcha.style.transform = `scale(${scale})`;
            recaptcha.style.transformOrigin = '0 0';
            wrapper.style.height = `${78 * scale}px`;
        }
    }

    // Re-run the scaling function heavily to ensure it catches Google API load times
    window.addEventListener('resize', resizeRecaptcha);
    window.addEventListener('load', resizeRecaptcha);
    setTimeout(resizeRecaptcha, 300);
    setTimeout(resizeRecaptcha, 1000);
    setTimeout(resizeRecaptcha, 2000); 
</script>
</body>
</html>