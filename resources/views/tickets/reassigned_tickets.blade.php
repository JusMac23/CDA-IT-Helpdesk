<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }

        /* Main Container */
        .content-panel { background-color: #ffffff; border-radius: 1rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); padding: 1.25rem; width: 100%; }
        
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em; }

        /* --- Action Container (Toolbar Layout) --- */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 1rem; margin-bottom: 1.5rem; }

        /* Auto Reload Toggle */
        .auto-reload-label { display: flex; align-items: center; font-size: 0.9rem; font-weight: 600; color: #475569; cursor: pointer; width: 100%; justify-content: flex-start; padding: 0.5rem 0; white-space: nowrap; }
        .auto-reload-checkbox { margin-right: 0.5rem; cursor: pointer; width: 1.15rem; height: 1.15rem; accent-color: #4f46e5; border-radius: 0.25rem; }

        /* --- Search Form Group --- */
        .search-form { display: flex; align-items: stretch; width: 100%; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border-radius: 0.5rem; }
        .search-input { height: 44px; flex: 1; min-width: 0; padding: 0 1rem; font-size: 0.95rem; font-family: inherit; color: #334155; border: 1px solid #cbd5e1; border-right: none; border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem; outline: none; transition: all 0.2s; position: relative; z-index: 1; background-color: #ffffff; }
        .search-input:focus { border-color: #6366f1; box-shadow: inset 0 0 0 1px #6366f1, 0 0 0 3px rgba(99, 102, 241, 0.15); z-index: 10; }
        .search-btn { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 1.25rem; border: none; border-top-right-radius: 0.5rem; border-bottom-right-radius: 0.5rem; background-color: #4f46e5; color: white; cursor: pointer; transition: background-color 0.2s; z-index: 2; width: auto; }
        .search-btn:hover { background-color: #4338ca; }

        /* --- Buttons --- */
        .btn { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 1.5rem; border-radius: 0.5rem; font-size: 0.95rem; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s ease; width: 100%; text-decoration: none; font-family: inherit; white-space: nowrap; box-sizing: border-box; }

        /* --- Data Table --- */
        .table-container { width: 100%; overflow-x: auto; background-color: #ffffff; border-radius: 0.75rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-top: 1.5rem; -webkit-overflow-scrolling: touch; display: block; }
        .data-table { width: 100%; min-width: 1200px; border-collapse: collapse; text-align: left; font-size: 0.9rem; }
        .data-table th { padding: 1rem 1.25rem; background-color: #f8fafc; color: #64748b; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
        .data-table td { padding: 1.25rem; border-bottom: 1px solid #f1f5f9; color: #334155; vertical-align: middle; font-weight: 500; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: #f8fafc; }
        .text-center { text-align: center; }
        .font-bold { font-weight: 700; color: #0f172a; }
        .text-truncate { max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; vertical-align: bottom; }
        
        /* Status Badges */
        .badge { display: inline-block; padding: 0.4rem 0.85rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-align: center; white-space: nowrap; letter-spacing: 0.025em; }
        .status-resolved { background-color: #dcfce7; color: #166534; } 
        .status-pending { background-color: #fef9c3; color: #854d0e; }
        .status-reassigned { background-color: #eff6ff; color: #1e40af; }
        .status-default { background-color: #f1f5f9; color: #475569; }

        /* Pagination Fixes */
        .pagination-container { width: 100%; overflow-x: auto; padding-bottom: 0.5rem; margin-top: 1.5rem; }
        .pagination-container nav { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; }
        .pagination-container svg { width: 1.25rem !important; height: 1.25rem !important; display: inline-block; vertical-align: middle; } 
        .pagination-container a, .pagination-container span { display: inline-flex; align-items: center; justify-content: center; font-weight: 500; }
        .pagination-container p { margin: 0; font-size: 0.875rem; color: #64748b; font-weight: 500; }

        /* --------------------------------------------------- */
        /* Mobile Specific Overrides                           */
        /* --------------------------------------------------- */
        @media (max-width: 640px) {
            .pagination-container > nav > div:first-child { display: flex; width: 100%; justify-content: space-between; }
            .pagination-container > nav > div:last-child { display: none; }
            .page-wrapper { padding: 0.5rem; }
            .content-panel { padding: 1rem; }
        }

        /* --------------------------------------------------- */
        /* Desktop & Tablet Overrides                          */
        /* --------------------------------------------------- */
        @media (min-width: 768px) {
            .content-panel { padding: 2rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            .action-container { flex-direction: row; justify-content: space-between; align-items: center; }
            .search-form { max-width: 350px; min-width: 250px; width: auto; }
            .auto-reload-label { width: auto; padding: 0; justify-content: flex-start; }
            .btn { width: auto; }
        }
    </style>

    <div id="main-content" class="page-wrapper">
        <div id="ticketsContent">
            <div class="content-panel">

                <div class="header-flex">
                    <h3 class="title">Re-Assigned Tickets</h3>
                </div>

                <div class="action-container">
                    <div style="display: flex; gap: 1rem; align-items: center; flex-wrap: wrap;">
                        <label class="auto-reload-label">
                            <input type="checkbox" id="autoReloadCheckbox" class="auto-reload-checkbox">
                            <span>(<span id="countdown">60</span>s) Auto-Reload</span>
                        </label>
                    </div>

                    @can('search_assignedtome_tickets')
                    <form action="{{ route('assignedtome_tickets.index') }}" method="GET" class="search-form">
                        <input type="text" name="search_query" value="{{ request('search_query') }}" placeholder="Search tickets..." class="search-input" autocomplete="off">
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                    @endcan
                </div>

                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th class="text-center">Tracking ID</th>
                                <th>Requested By</th>
                                <th>Request Details</th>
                                <th>Re-Assigned By</th>
                                <th>Previous Assigned</th>
                                <th>Re-Assigned To</th>
                                <th>Notes</th>
                                <th>Date Assigned</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tickets as $ticket)
                                <tr>
                                    <td class="font-bold text-center" style="font-size: 0.95rem;">{{ $ticket->ticket_number }}</td>
                                    <td>{{ $ticket->requested_by }}</td>
                                    <td>
                                        <span class="text-truncate" title="{{ $ticket->request }}">
                                            {{ $ticket->request }}
                                        </span>
                                    </td>
                                    <td>{{ $ticket->assigned_by }}</td>
                                    <td>{{ $ticket->previous_assigned }}</td>
                                    <td>{{ $ticket->assigned_to }}</td>
                                    <td>
                                        <span class="text-truncate" title="{{ $ticket->notes }}">
                                            {{ $ticket->notes }}
                                        </span>
                                    </td>
                                    <td style="color: #64748b;">
                                        {{ \Carbon\Carbon::parse($ticket->assigned_at)->timezone('Asia/Manila')->format('M d, Y h:i A') }}
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $status = trim($ticket->status);
                                            $badgeClass = match($status) {
                                                'Resolved' => 'status-resolved',
                                                'Pending' => 'status-pending',
                                                'Pending/Re-Assigned' => 'status-reassigned',
                                                default => 'status-default',
                                            };
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $ticket->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center" style="padding: 3rem; color: #94a3b8; font-size: 1rem;">
                                        No Re-Assigned Tickets found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination-container">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Flash Messages
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{!! addslashes(session("success")) !!}',
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Notice!',
                    text: '{!! addslashes(session("error")) !!}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            // === AUTO-RELOAD & COUNTDOWN ===
            const checkbox = document.getElementById('autoReloadCheckbox');
            const countdownDisplay = document.getElementById('countdown');
            let intervalId = null;
            let countdown = 60;

            if (checkbox) {
                const isChecked = localStorage.getItem('autoReload') === 'true';
                checkbox.checked = isChecked;

                if (isChecked) startAutoReload();

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
        });
    </script>
</x-app-layout>