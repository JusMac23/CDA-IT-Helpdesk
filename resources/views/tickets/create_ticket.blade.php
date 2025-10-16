@php
    $year = now()->year;
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CDA-ITHelpdesk</title>
    <link rel="icon" href="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" type="image/png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        @keyframes fade-in-down {
            from { opacity: 0; transform: translateY(-20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down {
            animation: fade-in-down 0.9s ease-out both;
        }
        .interactive-link {
            transition: all 0.3s ease-in-out;
        }
        .interactive-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        body, button, input, select, textarea, h1, h2, h3, h4, p, a, span, li, legend, label, option {
            font-family: 'Figtree', ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji" !important;
        }
        
        .material-icons-outlined {
            font-family: 'Material Icons Outlined' !important;
        }
        
        .fa, .fas, .far, .fal, .fab {
            font-family: 'Font Awesome 6 Free' !important;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased">

<header class="bg-white shadow-lg sticky top-0 z-50 border-b border-gray-200">

    <div class="h-1 bg-gradient-to-r from-blue-600 via-indigo-500 to-purple-500"></div>
    
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo & Title -->
        <h1 class="text-2xl lg:text-3xl font-bold text-blue-800 flex items-center gap-3">
            <img src="{{ asset('images/CDA-logo-RA11364-PNG.png') }}" 
                 alt="Cooperative Development Authority Seal" 
                 class="w-12 h-12 object-contain drop-shadow-sm transition-transform duration-300 hover:scale-105"/>
            <span class="tracking-tight">CDA IT-Helpdesk System</span>
        </h1>

        <!-- Navigation -->
        <nav>
            <ul class="flex space-x-6 text-base font-medium items-center">
                @auth
                    <!-- Dashboard Link -->
                    <li>
                        <a href="{{ url('/dashboard') }}" 
                           class="text-blue-600 hover:text-blue-800 hover:bg-blue-100 px-3 py-2 rounded-full flex items-center gap-2 transition-all duration-300 ease-in-out">
                            <span class="material-icons-outlined text-lg">dashboard</span> Dashboard
                        </a>
                    </li>

                    <!-- Logout Button -->
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="text-red-500 hover:text-red-700 hover:bg-red-100 px-3 py-2 rounded-full flex items-center gap-2 transition-all duration-300 ease-in-out">
                                <span class="material-icons-outlined text-lg">logout</span> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <!-- Login Button -->
                    <li>
                        <a href="{{ route('login') }}" 
                           class="text-blue-600 hover:text-blue-800 hover:bg-blue-100 px-3 py-2 rounded-full flex items-center gap-2 font-medium transition-all duration-300 ease-in-out shadow-sm hover:shadow-md">
                            <span class="material-icons-outlined text-lg">login</span>
                            Login
                        </a>
                    </li>
                @endauth
            </ul>
        </nav>
    </div>
</header>

<section class="p-8 max-w-4xl mx-auto bg-gray-200 rounded-2xl shadow-xl mt-10 mb-16 animate-fade-in-down">
    <button id="close" onclick="window.location.href='{{ url('/') }}'" 
        class="absolute top-4 right-5 text-gray-400 hover:text-gray-700 text-3xl transition-colors duration-200 leading-none">&times;
    </button>

    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-800 px-6 py-4 mb-6 rounded-lg">
            <div class="flex">
                <i class="fas fa-exclamation-circle text-xl mt-1 mr-3"></i>
                <div>
                    <h4 class="font-semibold text-sm mb-1">Please fix the following:</h4>
                    <ul class="list-disc pl-5 space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <h2 class="text-4xl font-bold text-gray-900 mb-10 border-b-2 border-gray-300 pb-4">
        📝 Submit a Ticket
    </h2>
    <form action="{{ route('tickets.store.client') }}" method="POST" enctype="multipart/form-data" class="space-y-12">
        @csrf

        {{-- Client Info --}}
        <fieldset class="border border-gray-300 rounded-xl p-6">
            <legend class="text-lg font-semibold text-gray-800 px-2">📌 Client Information</legend>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                @foreach ([['firstname', 'First Name', 'Juan', 'text'], ['lastname', 'Last Name', 'Dela Cruz', 'text'], ['email', 'Email', 'j_delacruz@cda.gov.ph', 'email']] as [$name, $label, $placeholder, $type])
                    <div>
                        <label for="{{ $name }}" class="block text-sm font-medium text-gray-800 mb-1">{{ $label }} <span class="text-red-500">*</span></label>
                        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" placeholder="e.g., {{ $placeholder }}"
                            class="w-full rounded-lg border-gray-300 shadow-sm bg-white text-gray-800 text-sm px-4 py-2.5" required>
                    </div>
                @endforeach

                {{-- Date Created --}}
                <div>
                    <label class="block text-sm font-medium text-gray-800 mb-1">Date Created</label>
                    <input type="text" value="{{ \Carbon\Carbon::now('Asia/Manila')->format('F j, Y h:i A') }}" readonly
                        class="w-full bg-gray-100 text-gray-800 border border-gray-300 rounded-lg px-4 py-2.5 text-sm">
                    <input type="hidden" name="date_created" value="{{ \Carbon\Carbon::now('Asia/Manila')->format('Y-m-d') }}">
                </div>

                {{-- Division --}}
                <div>
                    <label for="division" class="block text-sm font-medium text-gray-800 mb-1">Division <span class="text-red-500">*</span></label>
                    <select name="division" id="division" required
                        class="w-full rounded-lg border-gray-300 shadow-sm text-sm px-4 py-2.5 bg-white text-gray-800">
                        <option value="" disabled selected>Select Division</option>
                        @foreach ($sections_divisions as $division)
                            <option value="{{ $division }}">{{ $division }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Device --}}
                <div>
                    <label for="device" class="block text-sm font-medium text-gray-800 mb-1">Device <span class="text-red-500">*</span></label>
                    <select name="device" id="device"
                        class="w-full rounded-lg border-gray-300 shadow-sm text-sm px-4 py-2.5 bg-white text-gray-800">
                        <option value="" disabled selected>Select Device</option>
                        @foreach (['Desktop PC', 'Laptop/Netbook PC', 'Tablet PC', 'All-in-1 Printer', 'Printer Only', 'Scanner Only', 'Others'] as $device)
                            <option>{{ $device }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Service --}}
                <div>
                    <label for="service" class="block text-sm font-medium text-gray-800 mb-1">Technical Service <span class="text-red-500">*</span></label>
                    <select name="service" id="service"
                        class="w-full rounded-lg border-gray-300 shadow-sm text-sm px-4 py-2.5 bg-white text-gray-800">
                        <option value="" disabled selected>Select Service</option>
                        @foreach ($technical_services as $service)
                            <option value="{{ $service }}">{{ $service }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Photo --}}
                <div>
                    <label for="photo" class="block text-sm font-medium text-gray-800 mb-1">Attach Photo (Optional)</label>
                    <input type="file" name="photo" id="photo"
                        class="w-full text-sm text-gray-700 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:bg-indigo-100 file:text-indigo-700 hover:file:bg-indigo-200 cursor-pointer bg-white border border-gray-300 rounded-lg">
                </div>

                {{-- Request --}}
                <div class="md:col-span-2">
                    <label for="request" class="block text-sm font-medium text-gray-800 mb-1">Request Details <span class="text-red-500">*</span></label>
                    <textarea name="request" id="request" rows="4"
                        class="w-full rounded-lg border-gray-300 shadow-sm text-sm px-4 py-2.5 bg-white text-gray-800"
                        placeholder="Describe the issue or request in detail..." required></textarea>
                </div>
            </div>
        </fieldset>

        {{-- IT Routing --}}
        <fieldset class="border border-gray-300 rounded-xl p-6">
            <legend class="text-lg font-semibold text-gray-800 px-2">🧭 Designated Personnel</legend>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                {{-- IT Area --}}
                <div>
                    <label for="it_area" class="block text-sm font-medium text-gray-800 mb-1">Region <span class="text-red-500">*</span></label>
                    <select name="it_area" id="it_area"
                        class="w-full rounded-lg border-gray-300 shadow-sm text-sm px-4 py-2.5 bg-white text-gray-800">
                        <option selected disabled>Select Region</option>
                        @foreach($it_area as $area)
                            <option value="{{ $area }}">{{ $area }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- IT Personnel --}}
                <div>
                    <label for="it_personnel" class="block text-sm font-medium text-gray-800 mb-1">Assigned Personnel</label>
                    <select name="it_personnel" id="it_personnel"
                        class="w-full rounded-lg border-gray-300 shadow-sm text-sm px-4 py-2.5 bg-white text-gray-800">
                        <option selected disabled>Select Personnel</option>
                    </select>
                </div>

                {{-- IT Email --}}
                <div>
                    <label for="it_email" class="block text-sm font-medium text-gray-800 mb-1">IT Email</label>
                    <input type="text" name="it_email" id="it_email" readonly
                        class="w-full rounded-lg border-gray-300 shadow-sm bg-gray-100 text-sm px-4 py-2.5 text-gray-800">
                </div>

                {{-- Status --}}
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-800 mb-1">Status</label>
                    <input type="text" name="status" id="status" value="Pending" readonly
                        class="w-full rounded-lg border-gray-300 shadow-sm bg-gray-100 text-sm px-4 py-2.5 text-gray-800">
                </div>
            </div>
        </fieldset>

        {{-- Submit --}}
        <div class="flex justify-end pt-6 border-t border-gray-300">
            <button type="submit"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl shadow-md transition ease-in-out duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                <i class="fas fa-paper-plane text-sm"></i> Submit Ticket
            </button>
        </div>
    </form>
</section>
<script>
    //Auto Populated
    const itMapping = @json($it_mapping);
    const regionSelect = document.getElementById('it_area');
    const personnelSelect = document.getElementById('it_personnel');
    const emailInput = document.getElementById('it_email');

    if (regionSelect && personnelSelect && emailInput) {
        regionSelect.addEventListener('change', function () {
            personnelSelect.innerHTML = '<option disabled selected>Select Personnel</option>';
            emailInput.value = '';
            const personnelList = itMapping[this.value] || [];

            personnelList.forEach(p => {
                const opt = document.createElement('option');
                opt.value = p.name;
                opt.textContent = p.name;
                personnelSelect.appendChild(opt);
            });
        });

        personnelSelect.addEventListener('change', function () {
            const selected = (itMapping[regionSelect.value] || []).find(p => p.name === this.value);
            emailInput.value = selected ? selected.email : '';
        });
    }
    
    // Notification
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
    @endif
</script>
</body>
</html>