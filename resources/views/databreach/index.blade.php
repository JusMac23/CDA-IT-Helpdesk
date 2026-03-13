<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }

        /* Main Container - Mobile First 100% Width */
        .content-panel { background-color: #ffffff; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); padding: 1.25rem; width: 100%; }
        
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em; }

        /* --- Action Container (Toolbar Layout) - Mobile First --- */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 1rem; margin-bottom: 1.5rem; }

        /* --- Buttons - Uniform Heights & Modern Colors --- */
        .btn { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 1.5rem; border-radius: 0.5rem; font-size: 0.95rem; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s ease; width: 100%; text-decoration: none; font-family: inherit; }
        .btn i { margin-right: 0.5rem; font-size: 1rem; }

        /* Modern Green */
        .btn-green { background-color: #10b981; color: white; box-shadow: 0 1px 2px rgba(16, 185, 129, 0.2); }
        .btn-green:hover { background-color: #059669; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); color: white; }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(16, 185, 129, 0.2); }

        /* Modern Indigo */
        .btn-indigo { background-color: #4f46e5; color: white; box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }
        .btn-indigo:hover { background-color: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); color: white; }
        .btn-indigo:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }

        /* Modern Gray / Secondary */
        .btn-gray { background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
        .btn-gray:hover { background-color: #e2e8f0; color: #0f172a; }

        /* Auto Reload Toggle */
        .auto-reload-label { display: flex; align-items: center; font-size: 0.9rem; font-weight: 500; color: #475569; cursor: pointer; width: 100%; justify-content: flex-start; padding: 0.5rem 0; }
        .auto-reload-checkbox { margin-right: 0.5rem; cursor: pointer; width: 1.25rem; height: 1.25rem; accent-color: #4f46e5; border-radius: 0.25rem; }

        /* --- Filters Section - Mobile First --- */
        .filter-section { display: flex; flex-direction: column; align-items: stretch; width: 100%; gap: 1rem; margin-bottom: 2rem; background: #f8fafc; padding: 1.25rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; }
        .form-group { display: flex; flex-direction: column; width: 100%; }
        .form-label { font-weight: 600; margin-bottom: 0.5rem; font-size: 0.875rem; color: #475569; }
        
        /* Unified Input Heights */
        .form-select { height: 44px; padding: 0 1rem; border: 1px solid #cbd5e1; border-radius: 0.5rem; font-size: 0.95rem; color: #334155; width: 100%; outline: none; transition: all 0.2s; background-color: white; font-family: inherit; }
        .form-select:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }
        .filter-container { display: flex; flex-direction: column; width: 100%; margin-top: 0.25rem; }

        /* Data Table */
        .table-container { overflow-x: auto; background-color: #ffffff; border-radius: 0.75rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-top: 1.5rem; width: 100%; -webkit-overflow-scrolling: touch; }
        .data-table { width: 100%; min-width: 1000px; border-collapse: collapse; text-align: left; font-size: 0.9rem; }
        .data-table th { padding: 1rem 1.5rem; background-color: #f8fafc; color: #64748b; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
        .data-table td { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; color: #334155; vertical-align: middle; font-weight: 500; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: #f8fafc; }
        .text-center { text-align: center; }

        /* Emphasized Numbers */
        .dbn-number { font-weight: 700; color: #0f172a; font-size: 0.95rem; }

        /* Status Badges */
        .badge { display: inline-block; padding: 0.4rem 1rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-align: center; white-space: nowrap; letter-spacing: 0.025em; }
        .status-eval { background-color: #dcfce7; color: #166534; } 
        .status-npc { background-color: #fef2f2; color: #991b1b; }
        .status-reported { background-color: #eff6ff; color: #1e40af; }
        .status-default { background-color: #fef9c3; color: #854d0e; }

        /* Action Links inside Table */
        .action-group { display: flex; flex-direction: column; gap: 0.5rem; }
        .action-link { display: flex; align-items: center; font-size: 0.85rem; font-weight: 600; font-family: inherit; cursor: pointer; padding: 0.4rem 0.75rem; border-radius: 0.375rem; transition: all 0.2s; text-decoration: none; background: transparent; white-space: nowrap; width: 100%; text-align: left; box-sizing: border-box; }
        .action-link i { margin-right: 0.4rem; width: 16px; text-align: center; font-size: 0.9rem; }
        
        .link-blue { color: #3b82f6; border: 1px solid #bfdbfe; } 
        .link-blue:hover { background-color: #eff6ff; color: #1d4ed8; border-color: #93c5fd; }
        
        .link-yellow { color: #d97706; border: 1px solid #fde68a; } 
        .link-yellow:hover { background-color: #fffbeb; color: #b45309; border-color: #fcd34d; }
        
        .link-green { color: #10b981; border: 1px solid #a7f3d0; } 
        .link-green:hover { background-color: #ecfdf5; color: #047857; border-color: #6ee7b7; }
        
        .link-red { color: #ef4444; border: 1px solid #fecaca; } 
        .link-red:hover { background-color: #fef2f2; color: #b91c1c; border-color: #fca5a5; }

        /* --- Modern UI Pagination (Laravel Structure Fix) --- */
        .pagination-wrapper { margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; width: 100%; }
        .pagination-wrapper nav { display: flex; flex-direction: column; gap: 1.25rem; width: 100%; align-items: center; }
        
        /* Pagination Sub-Text ("Showing 1 to 10 of...") */
        .pagination-wrapper p { margin: 0; font-size: 0.875rem; color: #64748b; font-weight: 500; text-align: center; }
        .pagination-wrapper p span { font-weight: 700; color: #0f172a; }

        /* Container for links (Overrides Laravel's grouped flex) */
        .pagination-wrapper div > span.relative.z-0.inline-flex,
        .pagination-wrapper .flex.justify-between { display: flex; flex-wrap: wrap; gap: 0.5rem; box-shadow: none !important; justify-content: center; align-items: center; }

        /* Uniform Button Styling for Page Numbers & Arrows */
        .pagination-wrapper a, 
        .pagination-wrapper span[aria-current="page"] > span,
        .pagination-wrapper span[aria-disabled="true"] > span { 
            display: inline-flex; align-items: center; justify-content: center; 
            min-width: 2.25rem; height: 2.25rem; padding: 0 0.5rem; 
            border-radius: 0.375rem !important; /* Detached Rounded Look */
            font-size: 0.875rem; font-weight: 600; font-family: 'Inter', sans-serif;
            transition: all 0.2s ease; border: 1px solid transparent; 
            margin: 0 !important; /* Strips Laravel's -ml-px */
            text-decoration: none; line-height: 1;
        }

        /* Default Inactive Links */
        .pagination-wrapper a { background-color: #ffffff; color: #475569; border-color: #e2e8f0; }
        .pagination-wrapper a:hover { background-color: #f8fafc; color: #0f172a; border-color: #cbd5e1; transform: translateY(-1px); box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

        /* Active Page Link */
        .pagination-wrapper span[aria-current="page"] > span { background-color: #4f46e5; color: #ffffff; border-color: #4f46e5; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.25); z-index: 2; position: relative; }

        /* Disabled Navigation Arrows */
        .pagination-wrapper span[aria-disabled="true"] > span { background-color: #f8fafc; color: #94a3b8; border-color: #e2e8f0; cursor: not-allowed; opacity: 0.7; }

        /* "..." Separator Fix */
        .pagination-wrapper span[aria-disabled="true"]:not([aria-label]) > span { background: transparent; border: none; opacity: 1; color: #64748b; }

        /* Standardize Arrow SVGs */
        .pagination-wrapper svg { width: 1.25rem !important; height: 1.25rem !important; display: block; }

        /* Modals - Mobile First */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(15, 23, 42, 0.75); backdrop-filter: blur(4px); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 1rem; }
        .modal-box { position: relative; background-color: white; border-radius: 1rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); width: 100%; max-width: 28rem; max-height: 90vh; overflow-y: auto; padding: 2rem; }
        .modal-title { font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 0.75rem; }
        .modal-text { margin-bottom: 2rem; color: #475569; font-size: 0.95rem; line-height: 1.5; }
        
        .modal-actions { display: flex; flex-direction: column; gap: 0.75rem; width: 100%; }
        .modal-actions button, .modal-actions .btn { width: 100%; margin: 0; }

        /* --------------------------------------------------- */
        /* Responsive Overrides                                */
        /* --------------------------------------------------- */
        
        /* Mobile Breakpoint for Pagination */
        @media (max-width: 639px) {
            .pagination-wrapper nav .hidden { display: none !important; }
            .pagination-wrapper nav .sm\:hidden { display: flex; width: 100%; justify-content: space-between; }
        }

        /* Desktop & Tablet Overrides */
        @media (min-width: 768px) {
            .content-panel { padding: 2rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            
            /* Align Add button and Checkbox inline */
            .action-container { flex-direction: row; justify-content: space-between; align-items: center; }
            .auto-reload-label { width: auto; padding: 0; justify-content: flex-end; }
            
            /* Un-stretch buttons on desktop */
            .btn { width: auto; }
            
            /* Filter Row */
            .filter-section { flex-direction: row; align-items: flex-end; width: auto; background: transparent; padding: 0; border: none; }
            .form-group { width: 250px; }
            .filter-container { width: auto; margin-top: 0; }
            
            /* Pagination Layout */
            .pagination-wrapper nav { flex-direction: row; justify-content: space-between; }
            .pagination-wrapper nav > div.sm\:hidden { display: none !important; }
            .pagination-wrapper nav > div.hidden.sm\:flex-1 { display: flex !important; width: 100%; justify-content: space-between; align-items: center; }

            /* Modal formatting */
            .modal-actions { flex-direction: row; justify-content: flex-end; }
            .modal-actions button, .modal-actions .btn { width: auto; }
        }
    </style>

    <div id="main-content" class="page-wrapper">
        <div id="techContent">
            <div class="content-panel">

                <div class="header-flex">
                    <h3 class="title">All Incident Reports</h3>
                </div>

                <div class="action-container">
                    @can('create_databreach')
                        <a href="{{ route('databreach.create') }}" class="btn btn-green">
                            <i class="fa-solid fa-plus"></i> Add Incident Report
                        </a>
                    @endcan

                    <label class="auto-reload-label">
                        <input type="checkbox" id="autoReloadCheckbox" class="auto-reload-checkbox">
                        <span>(<span id="countdown">60</span>s) Auto-Reload</span>
                    </label>
                </div>
                
                @can('filter_databreach')
                <form method="GET" action="{{ route('databreach.index') }}" class="filter-section">
                    <div class="form-group">
                        <label for="picFilter" class="form-label">Filter by Region</label>
                        <select name="pic" id="picFilter" class="form-select">
                            <option value="">All Regions</option>
                            @foreach($pic as $region)
                                <option value="{{ $region }}" {{ request('pic') == $region ? 'selected' : '' }}>
                                    {{ $region }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="statusFilter" class="form-label">Filter by Status</label>
                        <select name="status" id="statusFilter" class="form-select">
                            <option value="">All Status</option>
                            <option value="For Assessment" {{ request('status') == 'For Assessment' ? 'selected' : '' }}>For Assessment</option>
                            <option value="For Evaluation" {{ request('status') == 'For Evaluation' ? 'selected' : '' }}>For Evaluation</option>
                            <option value="For Reporting to NPC" {{ request('status') == 'For Reporting to NPC' ? 'selected' : '' }}>For Reporting to NPC</option>
                            <option value="Reported" {{ request('status') == 'Reported' ? 'selected' : '' }}>Reported</option>
                        </select>
                    </div>

                    <div class="filter-container">
                        <button type="submit" class="btn btn-indigo">
                            <i class="fa-solid fa-filter"></i> Apply Filter
                        </button>
                    </div>

                </form>
                @endcan

                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>DBN Number</th>
                                <th>Sender</th>
                                <th>PIC</th>
                                <th>Date of Occurrence</th>
                                <th>Date of Notification</th>
                                <th>General Cause</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($notifications as $notification)
                                <tr>
                                    <td class="dbn-number">{{ $notification->dbn_number ?? 'N/A' }}</td>
                                    <td>{{ $notification->sender_fullname ?? 'N/A' }}</td>
                                    <td>{{ $notification->pic ?? 'N/A' }}</td>
                                    <td style="color: #64748b;">
                                        {{ $notification->date_occurrence ? \Carbon\Carbon::parse($notification->date_occurrence)->format('M d, Y h:i A') : 'N/A' }}
                                    </td>
                                    <td style="color: #64748b;">
                                        {{ $notification->date_notification ? \Carbon\Carbon::parse($notification->date_notification)->format('M d, Y h:i A') : 'N/A' }}
                                    </td>
                                    <td>{{ $notification->general_cause ?? 'N/A' }}</td>
                                    
                                    <td>
                                        @php
                                            $badgeClass = 'status-default';
                                            if ($notification->status === 'For Evaluation') $badgeClass = 'status-eval';
                                            elseif ($notification->status === 'For Reporting to NPC') $badgeClass = 'status-npc';
                                            elseif ($notification->status === 'Reported') $badgeClass = 'status-reported';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $notification->status }}
                                        </span>
                                    </td>

                                    <td>
                                        <div class="action-group">
                                            
                                            @can('view_databreach')
                                                <a href="{{ route('databreach.show', $notification->dbn_id) }}" class="action-link link-blue">
                                                    <i class="fa-solid fa-eye"></i> View
                                                </a>
                                            @endcan

                                            @can('assess_databreach')
                                                @if (!in_array($notification->status, ['Reported', 'For Evaluation']))
                                                    <a href="{{ route('databreach.assess', $notification->dbn_id) }}" class="action-link link-yellow">
                                                        <i class="fa-solid fa-magnifying-glass-plus"></i> Assess
                                                    </a>
                                                @endif
                                            @endcan

                                            @can('evaluate_databreach')
                                                @if (!in_array($notification->status, ['Reported', 'For Assessment' , 'For Reporting to NPC']))
                                                    <a href="{{ route('databreach.evaluate', $notification->dbn_id) }}" class="action-link link-green">
                                                        <i class="fa-solid fa-check"></i> Evaluate
                                                    </a>
                                                @endif
                                            @endcan

                                            @can('report_databreach')
                                                @if ($notification->status === 'For Reporting to NPC')
                                                <div x-data="{ open: false }">
                                                    <button @click="open = true" type="button" class="action-link link-red">
                                                        <i class="fa-solid fa-paper-plane"></i> Report
                                                    </button>
                                                    
                                                    <div x-show="open" x-transition.opacity class="modal-overlay" x-cloak>
                                                        <div class="modal-box" @click.away="open = false" x-transition.scale.origin.bottom>
                                                            <h2 class="modal-title">Confirm Report</h2>
                                                            <p class="modal-text">Are you sure you want to report this incident to the National Privacy Commission (NPC)? This action cannot be undone.</p>
                                                            
                                                            <div class="modal-actions">
                                                                <button @click="open = false" type="button" class="btn btn-gray">
                                                                    Cancel
                                                                </button>
                                                                
                                                                <form method="POST" action="{{ route('databreach.report_to_npc', $notification->dbn_id) }}" style="margin: 0; display: inline;">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="btn btn-green">
                                                                        Confirm Report
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endcan

                                            @can('delete_databreach')
                                                @if ($notification->status !== 'Reported')
                                                    <form action="{{ route('databreach.destroy', $notification->dbn_id) }}" method="POST" class="delete-form" style="margin: 0;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="action-link link-red delete-btn">
                                                            <i class="fa-solid fa-trash-can"></i> Delete
                                                        </button>
                                                    </form>
                                                @endif
                                            @endcan

                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center" style="padding: 3rem; color: #94a3b8; font-size: 1rem;">
                                        No Incident Reports found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrapper">
                    {{ $notifications->links() }}
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{!! addslashes(session("success")) !!}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            // === AUTO-RELOAD & COUNTDOWN ===
            const checkbox = document.getElementById('autoReloadCheckbox');
            const countdownDisplay = document.getElementById('countdown');
            let intervalId = null;
            let countdown = 60;

            const isChecked = localStorage.getItem('autoReload') === 'true';
            if (checkbox) checkbox.checked = isChecked;

            if (isChecked) startAutoReload();

            if (checkbox) {
                checkbox.addEventListener('change', function () {
                    localStorage.setItem('autoReload', checkbox.checked);
                    if (checkbox.checked) {
                        startAutoReload();
                    } else {
                        stopAutoReload();
                    }
                });
            }

            function startAutoReload() {
                countdown = 60;
                updateCountdown();
                intervalId = setInterval(() => {
                    countdown--;
                    updateCountdown();
                    if (countdown <= 0) {
                        location.reload();
                    }
                }, 1000);
            }

            function stopAutoReload() {
                clearInterval(intervalId);
                countdown = 60;
                updateCountdown();
            }

            function updateCountdown() {
                if (countdownDisplay) countdownDisplay.textContent = countdown;
            }

            // === DELETE CONFIRMATION ALERT ===
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function (e) {
                    e.preventDefault();
                    const form = this.closest('.delete-form');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action will permanently delete the record.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
</x-app-layout>