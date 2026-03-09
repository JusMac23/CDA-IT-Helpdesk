<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Main Container - Mobile First 100% Width */
        .content-panel { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1rem; width: 100%; box-sizing: border-box; }
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.5rem; font-weight: 900; color: #111827; margin-bottom: 0; margin-top: 0; }

        /* --- Action Container (Toolbar Layout) - Mobile First --- */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 1rem; margin-bottom: 1.5rem; }

        /* Buttons - Mobile First (Full Width default) */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.85rem 1.5rem; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 600; cursor: pointer; border: none; transition: background-color 0.2s, box-shadow 0.2s, transform 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05); width: 100%; box-sizing: border-box; text-decoration: none; }
        .btn i { margin-right: 0.5rem; }

        .btn-green { background-color: #16a34a; color: white; border: 1px solid #15803d; }
        .btn-green:hover { background-color: #15803d; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(22, 163, 74, 0.25); color: white; }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(22, 163, 74, 0.15); }

        .btn-gray { background-color: #e5e7eb; color: #374151; padding: 0.85rem 1.5rem; font-weight: 600; border-radius: 0.375rem; }
        .btn-gray:hover { background-color: #d1d5db; }

        /* Auto Reload Toggle */
        .auto-reload-label { display: flex; align-items: center; font-size: 0.875rem; color: #374151; cursor: pointer; width: 100%; justify-content: flex-start; padding: 0.5rem 0; }
        .auto-reload-checkbox { margin-right: 0.5rem; cursor: pointer; width: 1.25rem; height: 1.25rem; accent-color: #4f46e5; }

        /* --- Filters Section - Mobile First --- */
        .filter-section { display: flex; flex-direction: column; align-items: stretch; width: 100%; gap: 1rem; margin-bottom: 1.5rem; background: #f9fafb; padding: 1rem; border-radius: 0.5rem; border: 1px solid #e5e7eb; box-sizing: border-box; }
        .form-group { display: flex; flex-direction: column; width: 100%; }
        .form-label { font-weight: 600; margin-bottom: 0.35rem; font-size: 0.875rem; color: #374151; }
        .form-select { padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 1rem; width: 100%; box-sizing: border-box; outline: none; transition: border-color 0.2s, box-shadow 0.2s; background-color: white; }
        .form-select:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2); }
        .filter-container { display: flex; flex-direction: column; width: 100%; margin-top: 0.5rem; }

        /* Data Table */
        .table-container { overflow-x: auto; background-color: #ffffff; border-radius: 0.5rem; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-top: 1.5rem; width: 100%; -webkit-overflow-scrolling: touch; }
        .data-table { width: 100%; min-width: 1000px; border-collapse: collapse; text-align: left; font-size: 0.875rem; }
        .data-table th { padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #374151; font-weight: 600; text-transform: uppercase; border-bottom: 2px solid #e5e7eb; }
        .data-table td { padding: 0.75rem 1.5rem; border-bottom: 1px solid #e5e7eb; color: #1f2937; vertical-align: top; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: #f9fafb; }
        .text-center { text-align: center; }

        /* Status Badges */
        .badge { display: inline-block; padding: 0.35rem 1rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-align: center; white-space: nowrap; }
        .status-eval { background-color: #dcfce7; color: #166534; } 
        .status-npc { background-color: #fef2f2; color: #991b1b; }
        .status-reported { background-color: #eff6ff; color: #1e40af; }
        .status-default { background-color: #fef9c3; color: #854d0e; }

        /* Action Links inside Table - Updated with Borders */
        .action-group { display: flex; flex-direction: column; gap: 0.5rem; }
        .action-link { display: flex; align-items: center; font-size: 0.75rem; font-weight: 500; font-family: inherit; cursor: pointer; padding: 0.35rem 0.75rem; border-radius: 0.375rem; transition: 0.2s; text-decoration: none; background: transparent; white-space: nowrap; width: 100%; text-align: left; box-sizing: border-box; }
        .action-link i { margin-right: 0.35rem; width: 16px; text-align: center; }
        
        .link-blue { color: #2563eb; border: 1px solid #93c5fd; } 
        .link-blue:hover { background-color: #eff6ff; color: #1e40af; border-color: #60a5fa; }
        
        .link-yellow { color: #ca8a04; border: 1px solid #fde047; } 
        .link-yellow:hover { background-color: #fef9c3; color: #a16207; border-color: #facc15; }
        
        .link-green { color: #16a34a; border: 1px solid #86efac; } 
        .link-green:hover { background-color: #f0fdf4; color: #15803d; border-color: #4ade80; }
        
        .link-red { color: #dc2626; border: 1px solid #fca5a5; } 
        .link-red:hover { background-color: #fef2f2; color: #b91c1c; border-color: #f87171; }

        /* --- Updated Pagination Fixes --- */
        .pagination-wrapper { margin-top: 1.5rem; width: 100%; overflow-x: auto; padding-bottom: 0.5rem; }
        .pagination-wrapper nav { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; }
        /* Force SVG icons to stay normal sized */
        .pagination-wrapper svg { width: 1.25rem !important; height: 1.25rem !important; display: inline-block; vertical-align: middle; }
        /* Align text properly */
        .pagination-wrapper a, .pagination-wrapper span { display: inline-flex; align-items: center; justify-content: center; }
        .pagination-wrapper p { margin: 0; font-size: 0.875rem; color: #6b7280; }

        /* Modals - Mobile First */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.6); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 1rem; box-sizing: border-box; }
        .modal-box { position: relative; background-color: white; border-radius: 0.75rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); width: 100%; max-width: 28rem; max-height: 90vh; overflow-y: auto; padding: 1.5rem; box-sizing: border-box; }
        .modal-title { font-size: 1.25rem; font-weight: 700; color: #111827; margin-top: 0; margin-bottom: 1rem; }
        .modal-text { margin-bottom: 1.5rem; color: #4b5563; font-size: 0.875rem; line-height: 1.5; }
        
        .modal-actions { display: flex; flex-direction: column; gap: 0.75rem; width: 100%; margin-top: 1.5rem; }
        .modal-actions button, .modal-actions .btn { width: 100%; }

        /* --------------------------------------------------- */
        /* Mobile Specific Overrides (max-width: 640px)        */
        /* --------------------------------------------------- */
        @media (max-width: 640px) {
            /* Native Laravel paginator cleanup for mobile */
            .pagination-wrapper > nav > div:first-child { display: flex; width: 100%; justify-content: space-between; }
            .pagination-wrapper > nav > div:last-child { display: none; }
        }

        /* --------------------------------------------------- */
        /* Desktop & Tablet Overrides (min-width: 640px/768px) */
        /* --------------------------------------------------- */
        @media (min-width: 640px) {
            .content-panel { padding: 1.5rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            
            /* Align Add button and Checkbox inline */
            .action-container { flex-direction: row; justify-content: space-between; align-items: center; }
            .auto-reload-label { width: auto; padding: 0; justify-content: flex-end; }
            
            /* Un-stretch buttons on desktop */
            .btn { width: auto; padding: 0.75rem 1.5rem; }
            
            /* Filter Row */
            .filter-section { flex-direction: row; align-items: flex-end; width: auto; background: transparent; padding: 0; border: none; }
            .form-group { width: 250px; }
            .filter-container { width: auto; margin-top: 0; }
            
            /* Modal formatting */
            .modal-box { padding: 2rem; }
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
                        <button type="submit" class="btn btn-green">
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
                                    <td>{{ $notification->dbn_number ?? 'N/A' }}</td>
                                    <td>{{ $notification->sender_fullname ?? 'N/A' }}</td>
                                    <td>{{ $notification->pic ?? 'N/A' }}</td>
                                    <td>
                                        {{ $notification->date_occurrence ? \Carbon\Carbon::parse($notification->date_occurrence)->format('M d, Y h:i A') : 'N/A' }}
                                    </td>
                                    <td>
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
                                                    <button @click="open = true" class="action-link link-red">
                                                        <i class="fa-solid fa-paper-plane"></i> Report
                                                    </button>
                                                    
                                                    <div x-show="open" x-transition class="modal-overlay" x-cloak>
                                                        <div class="modal-box" @click.away="open = false">
                                                            <h2 class="modal-title">Confirm Report</h2>
                                                            <p class="modal-text">Are you sure you want to report this incident to the NPC?</p>
                                                            
                                                            <div class="modal-actions">
                                                                <button @click="open = false" type="button" class="btn btn-gray">
                                                                    Cancel
                                                                </button>
                                                                
                                                                <form method="POST" action="{{ route('databreach.report_to_npc', $notification->dbn_id) }}" style="margin: 0; display: inline;">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="btn btn-green">
                                                                        Confirm
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
                                    <td colspan="8" class="text-center" style="padding: 2rem; color: #6b7280;">
                                        No Incident Report found.
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

            // Fix: Addslashes to ensure single quotes in the session message don't break JS
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

            // Load checkbox state
            const isChecked = localStorage.getItem('autoReload') === 'true';
            if (checkbox) checkbox.checked = isChecked;

            // Start if checkbox already checked
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
                        text: "This action will permanently delete the records.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Delete',
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