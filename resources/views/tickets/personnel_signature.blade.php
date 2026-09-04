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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <script src="/assets/js/sweetalert2.min.js"></script>

    <style>
        /* variables */
        :root{--primary-dark:#0f172a;--secondary-dark:#1e293b;--accent-blue:#3b82f6;--accent-blue-hover:#2563eb;--alert-red:#ef4444;--alert-red-hover:#dc2626;--text-main:#f8fafc;--text-muted:#94a3b8;--glass-bg:rgba(15,23,42,.9);--glass-border:rgba(255,255,255,.1);--primary-blue:#1e40af;--primary-indigo:#4f46e5;--indigo-hover:#4338ca;--bg-body:#f9fafb;--text-body:#1f2937;--border-color:#d1d5db;--error-bg:#fee2e2;--error-text:#991b1b;--error-border:#ef4444;}

        /* base */
        body{margin:0;font-family: 'Inter', system-ui, -apple-system, sans-serif;color:var(--text-body);background-color:var(--bg-body);-webkit-font-smoothing:antialiased;}
        *{box-sizing:border-box;}

        /* animations */
        @keyframes fade-in-down{from{opacity:0;transform:translateY(-20px);}to{opacity:1;transform:translateY(0);}}
        .animate-fade-in-down{animation:fade-in-down .9s ease-out both;}

        /* header */
        .app-header{background-color:var(--glass-bg);backdrop-filter:blur(12px);-webkit-backdrop-filter:blur(12px);position:sticky;top:0;z-index:50;border-bottom:1px solid var(--glass-border);}
        .header-gradient{height:3px;background:linear-gradient(90deg,var(--accent-blue),var(--alert-red));}
        .container{max-width:1280px;margin:0 auto;padding:1rem 1.5rem;display:flex;justify-content:space-between;align-items:center;}

        /* branding */
        .brand{font-size:1.5rem;font-weight:800;color:#fff;display:flex;align-items:center;gap:.75rem;letter-spacing:-.025em;margin:0;}
        .brand img{width:44px;height:44px;object-fit:contain;transition:transform .3s ease;}
        .brand:hover img{transform:scale(1.1) rotate(-5deg);}

        /* main section */
        .main-section{max-width:72rem;margin:2.5rem auto 4rem;padding:2rem;background-color:#e5e7eb;border-radius:1rem;box-shadow:0 20px 25px -5px rgba(0,0,0,.1),0 10px 10px -5px rgba(0,0,0,.04);}

        /* upload card */
        .upload-card{max-width:32rem;margin:0 auto;background:#fff;padding:1.5rem;border-radius:.5rem;box-shadow:0 4px 6px -1px rgba(0,0,0,.1),0 2px 4px -1px rgba(0,0,0,.06);}
        .upload-card-title{font-size:1.25rem;font-weight:700;margin:0 0 1rem;}
        .upload-card-desc{margin:0 0 1rem;color:#374151;}

        /* buttons */
        .btn{display:inline-flex;align-items:center;gap:.5rem;padding:.5rem 1rem;border-radius:.5rem;font-weight:500;font-family:inherit;text-decoration:none;cursor:pointer;border:none;box-shadow:0 4px 6px -1px rgba(0,0,0,.1);transition:all .3s ease;font-size:1rem;}
        .btn-danger{background:#ef4444;color:#fff;margin-bottom:1.5rem;}
        .btn-danger:hover{background:#dc2626;box-shadow:0 10px 15px -3px rgba(0,0,0,.1);}
        .btn-primary{background:#3b82f6;color:#fff;border-radius:.25rem;}
        .btn-primary:hover{background:#2563eb;box-shadow:0 10px 15px -3px rgba(0,0,0,.1);}

        /* inputs */
        .file-input{width:100%;padding:.5rem;border:1px solid #e5e7eb;border-radius:.25rem;margin-bottom:1rem;font-family:inherit;background:#fff;}

        /* alerts */
        .alert{padding:1rem 1.5rem;margin-bottom:1.5rem;border-radius:.5rem;border-left:4px solid;display:flex;align-items:flex-start;gap:.75rem;}
        .alert-success{background:#d1fae5;border-left-color:#10b981;color:#065f46;}
        .alert-success p{margin:0;font-weight:600;}
        .alert-success i{font-size:1.25rem;margin-top:.125rem;}
        .alert-error{background:#fee2e2;border-left-color:#ef4444;color:#991b1b;}
        .alert-error i{font-size:1.25rem;margin-top:.25rem;}
        .alert-error h4{margin:0 0 .25rem 0;font-size:.875rem;font-weight:600;}
        .alert-error ul{margin:0;padding-left:1.25rem;font-size:.875rem;}
        .alert-error li{margin-bottom:.25rem;}
    </style>
</head>
<body>

<header class="app-header">
    <div class="header-gradient"></div> <div class="container"> <h1 class="brand">
            <img src="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" alt="CDA Seal" onerror="this.src='https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Cooperative_Development_Authority_%28CDA%29.svg/1200px-Cooperative_Development_Authority_%28CDA%29.svg.png'" />
            <span>CDA-ICT Helpdesk</span>
        </h1>
    </div>
</header>

<section class="main-section animate-fade-in-down">

    {{-- Back Button --}}
    <a href="{{ route('tickets.index') }}" class="btn btn-danger">
        <i class="fas fa-arrow-left"></i> Back to Tickets
    </a>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i>
            <p>{{ session('success') }}</p>
        </div>
    @endif

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i>
            <div>
                <h4>Please fix the following:</h4>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Upload Form Container --}}
    <div class="upload-card">
        <h2 class="upload-card-title">Upload Your Signature</h2>
        <p class="upload-card-desc">Please upload your e-signature for ticket confirmation.</p>

        <form action="{{ route('tickets.savePersonnelSignature', $ticket->ticket_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <input type="file" name="personnel_signature" accept="image/*" required class="file-input">

            <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload"></i> Upload Signature
            </button>
        </form>
    </div>
    
</section>

</body>
</html>