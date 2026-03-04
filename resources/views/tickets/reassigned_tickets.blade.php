<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Main Container */
        .content-panel { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; width: 100%; box-sizing: border-box; }
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; }
        .title { font-size: 1.5rem; font-weight: 900; color: #111827; margin-bottom: 0; margin-top: 0; }

        /* --- Action Container (Toolbar Layout) --- */
        .action-container { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }

        /* Action button wrapper */ 
        .action-btn { display:flex; align-items:stretch; border-radius:0.375rem; box-shadow:0 1px 2px rgba(0,0,0,0.05); overflow:hidden; }
        .action-btn .form-input { border-top-right-radius:0; border-bottom-right-radius:0; border-right:none; margin:0; width:100%; min-width:250px; max-width:350px; transition:all 0.2s; position:relative; z-index:1; }
        .action-btn .form-input:focus { z-index:10; border-color:#4f46e5; box-shadow:inset 0 0 0 1px #4f46e5; }
        .action-btn .btn { border-top-left-radius:0; border-bottom-left-radius:0; margin:0; padding:0.5rem 1.25rem; z-index:2; box-shadow:none; }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 1rem; border: 1px solid transparent; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; transition: all 0.2s; text-decoration: none; box-sizing: border-box; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .btn i { margin-right: 0.5rem; }
        .btn-green { background-color: #16a34a; color: #ffffff; }
        .btn-green:hover { background-color: #15803d; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(22, 163, 74, 0.25); }
        .btn-indigo { background-color: #4f46e5; color: white; }
        .btn-indigo:hover { background-color: #4338ca; }

        /* Auto Reload Toggle */
        .auto-reload-label { display: flex; align-items: center; font-size: 0.875rem; color: #374151; cursor: pointer; font-weight: 500; }
        .auto-reload-checkbox { margin-right: 0.5rem; cursor: pointer; width: 1rem; height: 1rem; accent-color: #4f46e5; }

        /* General Form Inputs */
        .form-input, .form-select { padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem; width: 100%; box-sizing: border-box; background-color: white; outline: none; transition: border-color 0.2s, box-shadow 0.2s; }
        .form-input:focus, .form-select:focus { border-color: #4f46e5; box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2); }

        /* Data Table */
        .table-container { overflow-x: auto; background-color: #ffffff; border-radius: 0.5rem; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); margin-top: 1.5rem; }
        .data-table { width: 100%; min-width: 1200px; border-collapse: collapse; text-align: left; font-size: 0.875rem; }
        .data-table th { padding: 0.75rem 1rem; background-color: #f3f4f6; color: #374151; font-weight: 600; text-transform: uppercase; border-bottom: 2px solid #e5e7eb; white-space: nowrap; }
        .data-table td { padding: 0.75rem 1rem; border-bottom: 1px solid #e5e7eb; color: #1f2937; vertical-align: top; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: #f9fafb; }
        .text-center { text-align: center; }
        .text-truncate { max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; display: inline-block; vertical-align: bottom; }
        
        /* Status Badges */
        .badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-align: center; white-space: nowrap; }
        .status-resolved { background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; } 
        .status-pending { background-color: #fef9c3; color: #854d0e; border: 1px solid #fef08a; }
        .status-reassigned { background-color: #dbeafe; color: #1e40af; border: 1px solid #bfdbfe; }
        .status-default { background-color: #f3f4f6; color: #374151; border: 1px solid #e5e7eb; }

        /* Pagination Fixes */
        .pagination-container { margin-top: 1.5rem; font-size: 0.875rem; color: #374151; }
        .pagination-container nav { display: flex; flex-direction: column; gap: 1rem; align-items: center; }
        @media (min-width: 640px) { .pagination-container nav { flex-direction: row; justify-content: space-between; } }
        .pagination-container svg { width: 1.25rem; height: 1.25rem; display: inline-block; } 
        .pagination-container p { margin: 0; color: #4b5563; }
        .pagination-container span.relative.inline-flex, 
        .pagination-container a.relative.inline-flex { display: inline-flex; align-items: center; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; text-decoration: none; color: #374151; background: #fff; margin-left: -1px; }
        .pagination-container a.relative.inline-flex:hover { background-color: #f3f4f6; }
        .pagination-container span[aria-current="page"] span { background-color: #eff6ff; color: #4f46e5; border-color: #4f46e5; z-index: 1; }
        .pagination-container span[aria-disabled="true"] span { opacity: 0.5; cursor: not-allowed; }

        /* Responsive Adjustments */
        @media (max-width: 640px) {
            .content-panel { padding: 1rem; }
            .action-container { flex-direction: column; align-items: stretch; }
            .action-btn { width: 100%; }
            .action-btn .form-input { min-width: 0; flex: 1; max-width: none; }
            .btn { width: 100%; justify-content: center; }
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
                    <form action="{{ route('assignedtome_tickets.index') }}" method="GET" class="action-btn">
                        <input type="text" name="search_query" value="{{ request('search_query') }}" placeholder="Search..." class="form-input">
                        <button type="submit" class="btn btn-indigo">
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
                                    <td class="font-bold text-center">{{ $ticket->ticket_number }}</td>
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
                                    <td style="font-size: 0.8rem; color: #4b5563;">
                                        {{ \Carbon\Carbon::parse($ticket->assigned_at)->timezone('Asia/Manila')->format('M d, Y h:i A') }}
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $status = trim($ticket->status);
                                            $badgeClass = 'status-default';
                                            if ($status === 'Resolved') $badgeClass = 'status-resolved';
                                            elseif ($status === 'Pending') $badgeClass = 'status-pending';
                                            elseif ($status === 'Pending/Re-Assigned') $badgeClass = 'status-reassigned';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $ticket->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" class="text-center" style="padding: 2rem; color: #6b7280;">
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

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Flash Messages
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{!! addslashes(session("success")) !!}',
                    timer: 2000,
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