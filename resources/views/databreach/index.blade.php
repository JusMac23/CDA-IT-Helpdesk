<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Main Container */
        .content-panel { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; width: 100%; }
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; }
        .title { font-size: 1.5rem; font-weight: 900; color: #111827; margin-bottom: 1.5rem; margin-top: 0; }

        /* --- Action Container (Toolbar Layout) --- */
        .action-container { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }

        /* --- Search Form Group (Joined Input & Button) --- */
        .action-btn { display: flex; align-items: stretch; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }

        /* --- Search Input Enhancements --- */
        .action-btn .form-input { border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; margin: 0; width: 100%; min-width: 250px; max-width: 350px; transition: all 0.2s; position: relative; z-index: 1; }
        .action-btn .form-input:focus { z-index: 10; border-color: #4f46e5; box-shadow: inset 0 0 0 1px #4f46e5, 0 0 0 2px rgba(79,70,229,0.2); }

        /* --- Search Button Enhancements --- */
        .action-btn .btn-indigo { border-top-left-radius: 0; border-bottom-left-radius: 0; margin: 0; padding: 0.5rem 1.25rem; z-index: 2; transition: background-color 0.2s; }

        /* --- Add User Button Enhancements --- */
        .btn-green { background-color: #10b981; color: white; border: 1px solid #059669; padding: 0.5rem 1.5rem; min-width: 120px; justify-content: center; display: inline-flex; align-items: center; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.15); transition: all 0.2s ease; border-radius: 0.375rem; cursor: pointer; }
        .btn-green:hover { background-color: #059669; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(16, 185, 129, 0.25); }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(16, 185, 129, 0.15); }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 1rem; border: 1px solid transparent; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: background-color 0.2s, box-shadow 0.2s; text-decoration: none; }
        .btn i { margin-right: 0.5rem; }
        .btn-green { background-color: #16a34a; color: #ffffff; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .btn-green:hover { background-color: #15803d; }
        .btn-gray { background-color: #e5e7eb; color: #374151; }
        .btn-gray:hover { background-color: #d1d5db; }

        /* Auto Reload Toggle */
        .auto-reload-label { display: flex; align-items: center; font-size: 0.875rem; color: #374151; cursor: pointer; }
        .auto-reload-checkbox { margin-right: 0.5rem; cursor: pointer; width: 1rem; height: 1rem; accent-color: #4f46e5; }

        /* Filters Section – layout and styling for filter controls and action buttons */
        .filter-section { display: flex; flex-direction: row; align-items: flex-end; width: 50%; gap: 16px; margin: 0 0 24px 0; padding: 16px 0; }
        .form-group { display: flex; flex-direction: column; flex: 1; }
        .form-label { font-weight: 600; margin-bottom: 8px; font-size: 0.9rem; color: #333; }
        .form-select { padding: 10px 12px; border: 1px solid #ccc; border-radius: 6px; font-size: 1rem; width: 100%; box-sizing: border-box; }

        /* Container for the Apply and Clear buttons */
        .filter-container { display: flex; gap: 8px; }

        /* Base Button Styles */
        .btn { padding: 10px 16px; border: none; border-radius: 6px; cursor: pointer; font-size: 1rem; display: inline-flex; align-items: center; justify-content: center; gap: 6px; text-decoration: none; box-sizing: border-box; }
        .btn-green { background-color: #198754; color: white; }
        .btn-green:hover { background-color: #157347; }
        .btn-outline { background-color: transparent; border: 1px solid #6c757d; color: #6c757d; }
        .btn-outline:hover { background-color: #6c757d; color: white; }

        /* --- Mobile Responsive (Up to 600px) --- */
        @media (max-width: 600px) {
        .filter-section { flex-direction: column; align-items: stretch; gap: 16px; }
        .filter-container { flex-direction: column; margin-top: 8px; }
        .btn { width: 100%; padding: 12px 0; }
        }

        /* Data Table */
        .table-container { overflow-x: auto; background-color: #ffffff; border-radius: 0.5rem; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-top: 1.5rem; }
        .data-table { width: 100%; min-width: 1000px; border-collapse: collapse; text-align: left; font-size: 0.875rem; }
        .data-table th { padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #374151; font-weight: 600; text-transform: uppercase; border-bottom: 2px solid #e5e7eb; }
        .data-table td { padding: 0.75rem 1.5rem; border-bottom: 1px solid #e5e7eb; color: #1f2937; vertical-align: top; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: #f9fafb; }
        .text-center { text-align: center; }

        /* Status Badges */
        .badge { display: inline-block; padding: 0.35rem 1rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-align: center; white-space: nowrap; }
        .status-eval { background-color: #dcfce7; color: #1d4ed8; } 
        .status-npc { background-color: #fef2f2; color: #1d4ed8; }
        .status-reported { background-color: #dbeafe; color: #1d4ed8; }
        .status-default { background-color: #fef9c3; color: #1d4ed8; }

        /* Action Links inside Table */
        .action-group { display: flex; flex-direction: column; gap: 0.5rem; }
        .action-link { display: flex; align-items: center; font-size: 0.875rem; font-family: inherit; cursor: pointer; padding: 0.25rem 0.5rem; border-radius: 0.25rem; transition: 0.2s; text-decoration: none; border: none; background: transparent; white-space: nowrap; width: 100%; text-align: left; }
        .action-link i { margin-right: 0.5rem; width: 16px; text-align: center; }
        
        .link-blue { color: #2563eb; } .link-blue:hover { background-color: #eff6ff; color: #1e40af; }
        .link-yellow { color: #ca8a04; } .link-yellow:hover { background-color: #fef9c3; color: #854d0e; }
        .link-green { color: #16a34a; } .link-green:hover { background-color: #f0fdf4; color: #166534; }
        .link-red { color: #dc2626; } .link-red:hover { background-color: #fef2f2; color: #991b1b; }

        /* --- Responsive Adjustments --- */
        @media (max-width: 640px) { .action-container { flex-direction: column; align-items: stretch; } .action-btn { width: 100%; } .action-btn .form-input { min-width: 0; flex: 1; max-width: none; } }

        /* Modal */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.6); display: flex; align-items: center; justify-content: center; z-index: 50; }
        .modal-box { background-color: white; border-radius: 0.5rem; box-shadow: 0 10px 25px rgba(0,0,0,0.2); padding: 1.5rem; width: 100%; max-width: 24rem; }
        .modal-title { font-size: 1.125rem; font-weight: 600; margin-top: 0; margin-bottom: 1rem; color: #111827; }
        .modal-text { margin-bottom: 1.5rem; color: #4b5563; font-size: 0.875rem; }
        .modal-actions { display: flex; justify-content: flex-end; gap: 0.5rem; }

        /* Pagination Fixes */
        .pagination-container { margin-top: 1.5rem; font-size: 0.875rem; color: #374151; }
        .pagination-container nav { display: flex; flex-direction: column; gap: 1rem; align-items: center; }
        @media (min-width: 640px) { .pagination-container nav { flex-direction: row; justify-content: space-between; } }
        /* Fix the massive SVG arrows */
        .pagination-container svg { width: 1.25rem; height: 1.25rem; display: inline-block; } 
        .pagination-container p { margin: 0; color: #4b5563; }
        /* Style the pagination links */
        .pagination-container span.relative.inline-flex, 
        .pagination-container a.relative.inline-flex {
            display: inline-flex; align-items: center; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; text-decoration: none; color: #374151; background: #fff; margin-left: -1px;
        }
        .pagination-container a.relative.inline-flex:hover { background-color: #f3f4f6; }
        /* Active page indicator */
        .pagination-container span[aria-current="page"] span { background-color: #eff6ff; color: #4f46e5; border-color: #4f46e5; z-index: 1; }
        /* Disabled arrows */
        .pagination-container span[aria-disabled="true"] span { opacity: 0.5; cursor: not-allowed; }

        /* Responsive */
        @media (max-width: 640px) {
            .content-panel { padding: 1rem; }
            .filter-section { width: 100%; }
            .form-group { max-width: 100%; }
            .action-bar { flex-direction: column; align-items: flex-start; }
            .action-right { width: 100%; justify-content: flex-start; }
            .pagination-container > nav > div:first-child { display: flex; width: 100%; justify-content: space-between; }
            .pagination-container > nav > div:last-child { display: none; }
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
                                                    
                                                    <div x-show="open" x-transition style="display: none;" class="modal-overlay" x-cloak>
                                                        <div class="modal-box" @click.away="open = false">
                                                            <h2 class="modal-title">Confirm Report</h2>
                                                            <p class="modal-text">Are you sure you want to report this incident to the NPC?</p>
                                                            
                                                            <div class="modal-actions">
                                                                <button @click="open = false" type="button" class="btn btn-gray">
                                                                    Cancel
                                                                </button>
                                                                
                                                                <form method="POST" action="{{ route('databreach.report_to_npc', $notification->dbn_id) }}" style="margin: 0;">
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

                <div class="pagination-container">
                    {{ $notifications->links() }}
                </div>

            </div>
        </div>
    </div>

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