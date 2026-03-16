<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* --- Theme Variables --- */
        :root {
            --card-bg: #ffffff;
            --bg-alt: #f8fafc;
            --text-dark: #0f172a;
            --text-muted: #64748b;
            --border-light: #e2e8f0;
            --border-subtle: #f1f5f9;
            --input-bg: #ffffff;
            --input-border: #cbd5e1;
            --input-text: #334155;

            /* Action Buttons (Gray) */
            --btn-gray-bg: #f1f5f9;
            --btn-gray-text: #475569;
            --btn-gray-border: #e2e8f0;
            --btn-gray-hover-bg: #e2e8f0;
            --btn-gray-hover-text: #0f172a;
            
            /* Status Badges - Light */
            --badge-eval-bg: #dcfce7; --badge-eval-text: #166534;
            --badge-npc-bg: #fef2f2; --badge-npc-text: #991b1b;
            --badge-rep-bg: #eff6ff; --badge-rep-text: #1e40af;
            --badge-def-bg: #fef9c3; --badge-def-text: #854d0e;
            
            /* Disabled Action Links */
            --disabled-link-text: #94a3b8;
            --disabled-link-border: #e2e8f0;
            --disabled-link-bg: #f8fafc;
        }

        body.dark {
            --card-bg: #0f172a; 
            --bg-alt: #1e293b; 
            --text-dark: #f8fafc;
            --text-muted: #9ca3af;
            --border-light: #334155; 
            --border-subtle: #1e293b;
            --input-bg: #0f172a;
            --input-border: #4b5563;
            --input-text: #f1f5f9;

            /* Action Buttons (Gray) - Dark */
            --btn-gray-bg: #1e293b;
            --btn-gray-text: #9ca3af;
            --btn-gray-border: #334155;
            --btn-gray-hover-bg: #334155;
            --btn-gray-hover-text: #f8fafc;

            /* Status Badges - Dark */
            --badge-eval-bg: rgba(22, 101, 52, 0.4); --badge-eval-text: #4ade80;
            --badge-npc-bg: rgba(153, 27, 27, 0.4); --badge-npc-text: #f87171;
            --badge-rep-bg: rgba(30, 58, 138, 0.4); --badge-rep-text: #60a5fa;
            --badge-def-bg: rgba(133, 77, 14, 0.4); --badge-def-text: #facc15;
            
            /* Disabled Action Links - Dark */
            --disabled-link-text: #64748b;
            --disabled-link-border: #334155;
            --disabled-link-bg: #1e293b;
        }

        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; transition: background-color 0.3s ease, color 0.3s ease; }

        /* Main Layout - Mobile First 100% Width & Dark Mode Outline */
        .panel { background-color: var(--card-bg); border-radius: 1rem; border: 1px solid var(--border-light); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); padding: 1.25rem; width: 100%; transition: background-color 0.3s ease, border-color 0.3s ease; }
        
        /* Typography */
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.75rem; font-weight: 800; color: var(--text-dark); margin: 0; letter-spacing: -0.025em; transition: color 0.3s ease; }
        
        /* --- Action Container & Search Toolbar - Mobile First --- */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 1rem; margin-bottom: 1.5rem; }
        .button-group { display: flex; flex-direction: column; gap: 0.75rem; width: 100%; }
        
        /* --- Buttons - Uniform Heights --- */
        .btn { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 1.5rem; border-radius: 0.5rem; font-size: 0.95rem; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s ease; width: 100%; text-decoration: none; font-family: inherit; }
        .btn i { margin-right: 0.5rem; font-size: 1rem; }
        
        /* Modern Green */
        .btn-green { background-color: #10b981; color: white; box-shadow: 0 1px 2px rgba(16, 185, 129, 0.2); }
        .btn-green:hover { background-color: #059669; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(16, 185, 129, 0.2); }

        /* Modern Indigo */
        .btn-indigo { background-color: #4f46e5; color: white; box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }
        .btn-indigo:hover { background-color: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
        .btn-indigo:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }

        /* Modern Gray */
        .btn-gray { background-color: var(--btn-gray-bg); color: var(--btn-gray-text); border: 1px solid var(--btn-gray-border); transition: all 0.3s ease; }
        .btn-gray:hover { background-color: var(--btn-gray-hover-bg); color: var(--btn-gray-hover-text); }

        /* Auto Reload Toggle */
        .auto-reload-label { display: flex; align-items: center; font-size: 0.9rem; font-weight: 500; color: var(--text-muted); cursor: pointer; width: 100%; justify-content: flex-start; padding: 0.5rem 0; transition: color 0.3s ease; }
        .auto-reload-checkbox { margin-right: 0.5rem; cursor: pointer; width: 1.25rem; height: 1.25rem; accent-color: #4f46e5; border-radius: 0.25rem; }

        /* --- Filters Section - Mobile First --- */
        .filter-section { display: flex; flex-direction: column; align-items: stretch; width: 100%; gap: 1rem; margin-bottom: 2rem; background: var(--bg-alt); padding: 1.25rem; border-radius: 0.75rem; border: 1px solid var(--border-light); transition: background-color 0.3s ease, border-color 0.3s ease; }
        .form-group { display: flex; flex-direction: column; width: 100%; }
        .form-label { font-weight: 600; margin-bottom: 0.5rem; font-size: 0.875rem; color: var(--text-muted); transition: color 0.3s ease; }
        
        /* Unified Input Heights */
        .form-select { height: 44px; padding: 0 1rem; border: 1px solid var(--input-border); border-radius: 0.5rem; font-size: 0.95rem; color: var(--input-text); width: 100%; outline: none; transition: all 0.2s; background-color: var(--input-bg); font-family: inherit; }
        .form-select:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }
        .filter-container { display: flex; flex-direction: column; width: 100%; margin-top: 0.25rem; }

        /* Table & Badges */
        .table-container { overflow-x: auto; background-color: var(--card-bg); border-radius: 0.75rem; border: 1px solid var(--border-light); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); width: 100%; -webkit-overflow-scrolling: touch; margin-bottom: 1.5rem; transition: background-color 0.3s ease, border-color 0.3s ease; }
        .data-table { width: 100%; min-width: 1000px; border-collapse: collapse; text-align: left; font-size: 0.9rem; }
        .data-table th { padding: 1rem 1.5rem; background-color: var(--bg-alt); color: var(--text-muted); font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid var(--border-light); white-space: nowrap; transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease; }
        .data-table td { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border-subtle); color: var(--text-dark); vertical-align: middle; font-weight: 500; transition: color 0.3s ease, border-color 0.3s ease; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: var(--bg-alt); }
        .text-center { text-align: center; }

        /* Emphasized Numbers */
        .dbn-number { font-weight: 700; color: var(--text-dark); font-size: 0.95rem; transition: color 0.3s ease; }

        /* Status Badges */
        .badge { display: inline-block; padding: 0.4rem 1rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-align: center; white-space: nowrap; letter-spacing: 0.025em; transition: background-color 0.3s ease, color 0.3s ease; }
        .status-eval { background-color: var(--badge-eval-bg); color: var(--badge-eval-text); } 
        .status-npc { background-color: var(--badge-npc-bg); color: var(--badge-npc-text); }
        .status-reported { background-color: var(--badge-rep-bg); color: var(--badge-rep-text); }
        .status-default { background-color: var(--badge-def-bg); color: var(--badge-def-text); }

        /* Action Links inside Table */
        .action-cell { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 0.5rem; }
        .action-link { display: inline-flex; align-items: center; justify-content: center; height: 34px; padding: 0 0.85rem; border-radius: 0.375rem; font-size: 0.85rem; font-weight: 600; font-family: inherit; cursor: pointer; transition: all 0.2s; text-decoration: none; background: transparent; white-space: nowrap; box-sizing: border-box; }
        .action-link i { margin-right: 0.35rem; width: 16px; text-align: center; font-size: 0.9rem; }
        
        .link-blue { color: #3b82f6; border: 1px solid #bfdbfe; } 
        .link-blue:hover { background-color: #eff6ff; color: #1d4ed8; border-color: #93c5fd; }
        
        .link-yellow { color: #d97706; border: 1px solid #fde68a; } 
        .link-yellow:hover { background-color: #fffbeb; color: #b45309; border-color: #fcd34d; }
        
        .link-red { color: #ef4444; border: 1px solid #fecaca; } 
        .link-red:hover { background-color: #fef2f2; color: #b91c1c; border-color: #fca5a5; }

        .link-disabled { color: var(--disabled-link-text); border: 1px solid var(--disabled-link-border); background-color: var(--disabled-link-bg); cursor: not-allowed; transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease; }

        /* Dark Mode Action Link Overrides */
        body.dark .link-blue { color: #60a5fa; border-color: #1e3a8a; }
        body.dark .link-blue:hover { background-color: rgba(30, 58, 138, 0.4); color: #93c5fd; }
        body.dark .link-yellow { color: #fbbf24; border-color: #78350f; }
        body.dark .link-yellow:hover { background-color: rgba(120, 53, 15, 0.4); color: #fcd34d; }
        body.dark .link-red { color: #f87171; border-color: #7f1d1d; }
        body.dark .link-red:hover { background-color: rgba(127, 29, 29, 0.4); color: #fca5a5; }

        /* --- Modern UI Pagination (Laravel Structure Fix) --- */
        .pagination-wrapper { margin-top: 1.5rem; width: 100%; overflow-x: auto; padding-bottom: 0.5rem; }
        .pagination-wrapper nav { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; }
        .pagination-wrapper svg { width: 1.25rem !important; height: 1.25rem !important; display: inline-block; vertical-align: middle; }
        .pagination-wrapper a, .pagination-wrapper span { display: inline-flex; align-items: center; justify-content: center; font-weight: 500; }
        .pagination-wrapper p { margin: 0; font-size: 0.875rem; color: var(--text-muted); font-weight: 500; transition: color 0.3s ease; }

        /* Container for links */
        .pagination-wrapper div > span.relative.z-0.inline-flex,
        .pagination-wrapper .flex.justify-between { display: flex; flex-wrap: wrap; gap: 0.5rem; box-shadow: none !important; justify-content: center; align-items: center; }

        /* Uniform Button Styling for Page Numbers & Arrows */
        .pagination-wrapper a, 
        .pagination-wrapper span[aria-current="page"] > span,
        .pagination-wrapper span[aria-disabled="true"] > span { 
            display: inline-flex; align-items: center; justify-content: center; 
            min-width: 2.25rem; height: 2.25rem; padding: 0 0.5rem; 
            border-radius: 0.375rem !important; 
            font-size: 0.875rem; font-weight: 600; font-family: 'Inter', sans-serif;
            transition: all 0.2s ease; border: 1px solid transparent; 
            margin: 0 !important; 
            text-decoration: none; line-height: 1;
        }

        /* Default Inactive Links */
        .pagination-wrapper a { background-color: var(--card-bg); color: var(--text-muted); border-color: var(--border-light); }
        .pagination-wrapper a:hover { background-color: var(--bg-alt); color: var(--text-dark); border-color: var(--input-border); transform: translateY(-1px); box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

        /* Active Page Link */
        .pagination-wrapper span[aria-current="page"] > span { background-color: #4f46e5; color: #ffffff; border-color: #4f46e5; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.25); z-index: 2; position: relative; }

        /* Disabled Navigation Arrows */
        .pagination-wrapper span[aria-disabled="true"] > span { background-color: var(--bg-alt); color: var(--text-muted); border-color: var(--border-light); cursor: not-allowed; opacity: 0.7; }

        /* "..." Separator Fix */
        .pagination-wrapper span[aria-disabled="true"]:not([aria-label]) > span { background: transparent; border: none; opacity: 1; color: var(--text-muted); }

        /* --------------------------------------------------- */
        /* Responsive Overrides                                */
        /* --------------------------------------------------- */
        
        /* Mobile Breakpoint for Pagination */
        @media (max-width: 639px) {
            .pagination-wrapper > nav > div:first-child { display: flex; width: 100%; justify-content: space-between; }
            .pagination-wrapper > nav > div:last-child { display: none; }
        }

        /* Desktop & Tablet Overrides */
        @media (min-width: 768px) {
            .panel { padding: 2rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            
            /* Align Add button and Checkbox inline */
            .action-container { flex-direction: row; justify-content: space-between; align-items: center; }
            .button-group { flex-direction: row; width: auto; }
            .auto-reload-label { width: auto; padding: 0; justify-content: flex-end; }
            
            /* Un-stretch buttons on desktop */
            .btn { width: auto; }
            
            /* Filter Row */
            .filter-section { flex-direction: row; align-items: flex-end; width: auto; background: transparent; padding: 0; border: none; margin-bottom: 2rem; }
            .form-group { width: 250px; }
            .filter-container { width: auto; margin-top: 0; }
        }
    </style>

    <div id="main-content" class="page-wrapper">
        <div id="techContent">
            <div class="panel">

                <div class="header-flex">
                    <h3 class="title">Data Breach Notifications Regional Reports</h3>
                </div>

                <div class="action-container">
                    <div class="button-group">
                        <a href="{{ route('databreach.create') }}" class="btn btn-green">
                            <i class="fas fa-plus"></i> Add Report
                        </a>

                        <a href="{{ route('databreach.overview') }}" class="btn btn-indigo">
                            <i class="fas fa-chart-bar"></i> Overview
                        </a>
                    </div>

                    <label class="auto-reload-label">
                        <input type="checkbox" id="autoReloadCheckbox" class="auto-reload-checkbox">
                        <span>(<span id="countdown">60</span>s) Auto-Reload</span>
                    </label>
                </div>
                
                <form method="GET" action="{{ route('databreach.index') }}" class="filter-section">
                    <div class="form-group">
                        <label for="statusFilter" class="form-label">Filter by Status</label>
                        <select name="status" id="statusFilter" class="form-select">
                            <option value="">All Status</option>
                            <option value="For Assessment" {{ request('status') == 'For Assessment' ? 'selected' : '' }}>For Assessment</option>
                            <option value="For Evaluation" {{ request('status') == 'For Evaluation' ? 'selected' : '' }}>For Evaluation</option>
                            <option value="Reported" {{ request('status') == 'Reported' ? 'selected' : '' }}>Reported</option>
                        </select>
                    </div>

                    <div class="filter-container">
                        <button type="submit" class="btn btn-green">
                            <i class="fas fa-filter"></i> Apply Filter
                        </button>
                    </div>
                </form>

                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>DBN No.</th>
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
                                    <td style="color: var(--text-muted);">
                                        {{ $notification->date_occurrence ? \Carbon\Carbon::parse($notification->date_occurrence)->format('M d, Y h:i A') : 'N/A' }}
                                    </td>
                                    <td style="color: var(--text-muted);">
                                        {{ $notification->date_notification ? \Carbon\Carbon::parse($notification->date_notification)->format('M d, Y h:i A') : 'N/A' }}
                                    </td>
                                    <td>{{ $notification->general_cause ?? 'N/A' }}</td>
                                    <td>
                                        @php
                                            $badgeClass = 'status-default';
                                            if ($notification->status === 'For Evaluation') $badgeClass = 'status-eval';
                                            elseif ($notification->status === 'Reported') $badgeClass = 'status-reported';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $notification->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-cell">
                                            
                                            <a href="{{ route('databreach.show', $notification->dbn_id) }}" class="action-link link-blue" title="View">
                                                <i class="fas fa-eye"></i> View
                                            </a>

                                            @if($notification->status !== 'Reported')
                                                <a href="{{ route('databreach.edit', $notification->dbn_id) }}" class="action-link link-yellow" title="Edit">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                
                                                <form action="{{ route('databreach.destroy', $notification->dbn_id) }}" method="POST" class="inline delete-form" style="margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="action-link link-red delete-btn" title="Delete">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form>
                                            @else
                                                <button type="button" class="action-link link-disabled" disabled title="Editing disabled">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                <button type="button" class="action-link link-disabled" disabled title="Deletion disabled">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            @endif
                                            
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center" style="padding: 3rem; color: var(--text-muted); font-size: 1rem;">
                                        No Notification Reports found.
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            
            // Helper to get CSS variable colors for SweetAlert Dark Mode
            const getComputedColor = (cssVar) => getComputedStyle(document.body).getPropertyValue(cssVar).trim();

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{!! addslashes(session("success")) !!}',
                    timer: 2500,
                    showConfirmButton: false,
                    background: getComputedColor('--card-bg'),
                    color: getComputedColor('--text-dark')
                });
            @endif

            // === AUTO-RELOAD & COUNTDOWN ===
            const checkbox = document.getElementById('autoReloadCheckbox');
            const countdownDisplay = document.getElementById('countdown');
            let intervalId = null;
            let countdown = 60;

            const isChecked = localStorage.getItem('autoReload') === 'true';
            if(checkbox) checkbox.checked = isChecked;
            if (isChecked) startAutoReload();

            if(checkbox) {
                checkbox.addEventListener('change', function () {
                    localStorage.setItem('autoReload', checkbox.checked);
                    if(checkbox.checked) {
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
                    if (countdown <= 0) location.reload();
                }, 1000);
            }

            function stopAutoReload() {
                clearInterval(intervalId);
                countdown = 60;
                updateCountdown();
            }

            function updateCountdown() {
                if(countdownDisplay) countdownDisplay.textContent = countdown;
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
                        cancelButtonText: 'Cancel',
                        background: getComputedColor('--card-bg'),
                        color: getComputedColor('--text-dark')
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });
    </script>
</x-app-layout>