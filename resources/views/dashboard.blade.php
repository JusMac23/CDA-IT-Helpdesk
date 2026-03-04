<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @if(auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
    
    <style>
        /* Dashboard Container */
        .dashboard-panel { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; width: 100%; }
        .dashboard-title { font-size: 1.5rem; font-weight: bold; margin-bottom: 1.5rem; color: #1f2937; }
        
        /* Stats Cards */
        .stat-cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .stat-card { border-radius: 12px; padding: 1.5rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between; border-left: 4px solid; transition: transform 0.2s, box-shadow 0.2s; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .stat-left { display: flex; align-items: center; gap: 1rem; }
        .stat-icon { width: 48px; height: 48px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.25rem; }
        .stat-label { font-size: 1.125rem; font-weight: 600; margin: 0; }
        .stat-value { font-size: 1.875rem; font-weight: 700; margin: 0; text-align: right; }
        
        /* Card Themes */
        .card-indigo { background: #fff; border-left-color: #6366f1; }
        .card-indigo .stat-icon { background: #e0e7ff; color: #4338ca; }
        .card-indigo .stat-label { color: #3730a3; }
        .card-indigo .stat-value { color: #4f46e5; }
        
        .card-green { background: #f0fdf4; border-left-color: #22c55e; }
        .card-green .stat-icon { background: #dcfce7; color: #166534; }
        .card-green .stat-label { color: #166534; }
        .card-green .stat-value { color: #16a34a; }
        
        .card-blue { background: #eff6ff; border-left-color: #3b82f6; }
        .card-blue .stat-icon { background: #dbeafe; color: #1e40af; }
        .card-blue .stat-label { color: #1e40af; }
        .card-blue .stat-value { color: #2563eb; }
        
        .card-red { background: #fef2f2; border-left-color: #ef4444; }
        .card-red .stat-icon { background: #fee2e2; color: #991b1b; }
        .card-red .stat-label { color: #991b1b; }
        .card-red .stat-value { color: #dc2626; }
        
        /* Grid Tables (Middle Section) */
        .tables-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.5rem; margin-bottom: 2rem; }
        .table-card { background: white; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; border: 1px solid #f3f4f6; overflow-x: auto; }
        .table-card-title { font-size: 1.125rem; font-weight: 600; margin-bottom: 1rem; color: #374151; display: flex; align-items: center; gap: 0.5rem; }
        
        .data-table { width: 100%; border-collapse: collapse; text-align: left; }
        .data-table th, .data-table td { padding: 0.75rem 1rem; }
        .data-table thead tr { font-weight: 600; }
        .data-table tbody tr { border-bottom: 1px solid #e5e7eb; transition: background-color 0.15s; }
        .data-table tbody tr:nth-child(even) { background-color: #f9fafb; }
        .data-table tbody tr:hover { background-color: #f3f4f6; }
        .text-right { text-align: right; }
        
        /* Table Headers */
        .th-indigo { background: #e0e7ff; color: #3730a3; }
        .th-green { background: #dcfce7; color: #166534; }
        .th-yellow { background: #fef9c3; color: #854d0e; }
        .th-red { background: #fee2e2; color: #991b1b; }
        
        /* Bottom Full Table */
        .full-table-container { background: white; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 8px; border: 1px solid #e5e7eb; overflow-x: auto; margin-top: 1rem; }
        .full-table { width: 100%; border-collapse: collapse; text-align: left; white-space: nowrap; }
        .full-table th { padding: 0.75rem 1.5rem; background: #f3f4f6; color: #374151; font-weight: 600; text-transform: uppercase; font-size: 0.875rem; border-bottom: 2px solid #e5e7eb; }
        .full-table td { padding: 0.75rem 1.5rem; border-bottom: 1px solid #e5e7eb; color: #4b5563; }
        .full-table tbody tr:hover { background: #f9fafb; }
        
        /* Badges */
        .badge { padding: 0.35rem 1rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600; display: inline-block; text-align: center; }
        .badge-green { background: #dcfce7; color: #166534; }
        .badge-yellow { background: #fef9c3; color: #854d0e; }
        .badge-blue { background: #dbeafe; color: #1e40af; }
        .badge-gray { background: #f3f4f6; color: #374151; }

        /* Responsive */
        @media (max-width: 640px) {
            .stat-card { flex-direction: column; text-align: center; gap: 1rem; }
            .stat-left { flex-direction: column; }
            .stat-value { text-align: center; }
            .dashboard-panel { padding: 1rem; }
        }
    </style>

    <div id="main-content">
        <div id="dashboardContent" class="dashboard-wrapper">
            <div class="dashboard-panel">
                <h3 class="dashboard-title">Tickets Overview</h3>

                {{-- Dashboard Cards --}}
                <div class="stat-cards">
                    @php
                        $cards = [
                            ['label' => 'Total Tickets', 'icon' => 'fa-ticket', 'theme' => 'indigo', 'value' => $total],
                            ['label' => 'Pending Tickets', 'icon' => 'fa-hourglass-half', 'theme' => 'green', 'value' => $pending],
                            ['label' => 'Resolved Tickets', 'icon' => 'fa-check-circle', 'theme' => 'blue', 'value' => $resolved],
                            ['label' => 'Overdue Tickets', 'icon' => 'fa-exclamation-circle', 'theme' => 'red', 'value' => $overdue],
                        ];
                    @endphp

                    @foreach ($cards as $card)
                        <div class="stat-card card-{{ $card['theme'] }}">
                            <div class="stat-left">
                                <div class="stat-icon">
                                    <i class="fa-solid {{ $card['icon'] }}"></i>
                                </div>
                                <h4 class="stat-label">{{ $card['label'] }}</h4>
                            </div>
                            <p class="stat-value">
                                {{ $card['value'] }}
                            </p>
                        </div>
                    @endforeach
                </div>

                {{-- IT Area, Personnel, Service, Overdue --}}
                <div class="tables-grid">
                    
                    {{-- Tickets by Region --}}
                    <div class="table-card">
                        <h4 class="table-card-title">
                            <i class="fa-solid fa-network-wired" style="color: #4f46e5;"></i> Tickets by Region
                        </h4>
                        <table class="data-table">
                            <thead>
                                <tr class="th-indigo">
                                    <th>IT Area</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($byItArea as $area)
                                    <tr>
                                        <td>{{ $area->it_area }}</td>
                                        <td class="text-right" style="font-weight: bold;">{{ $area->total }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" style="text-align: center; color: #6b7280; padding: 1rem;">No data available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Tickets by Technical Personnel --}}
                    <div class="table-card">
                        <h4 class="table-card-title">
                            <i class="fa-solid fa-user-gear" style="color: #16a34a;"></i> Tickets by Technical Personnel
                        </h4>
                        <table class="data-table">
                            <thead>
                                <tr class="th-green">
                                    <th>Technical Personnel</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($byItPersonnel as $person)
                                    <tr>
                                        <td>{{ $person->it_personnel }}</td>
                                        <td class="text-right" style="font-weight: bold;">{{ $person->total }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" style="text-align: center; color: #6b7280; padding: 1rem;">No data available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Tickets by Service --}}
                    <div class="table-card">
                        <h4 class="table-card-title">
                            <i class="fa-solid fa-tools" style="color: #ca8a04;"></i> Tickets by Technical Services
                        </h4>
                        <table class="data-table">
                            <thead>
                                <tr class="th-yellow">
                                    <th>Service</th>
                                    <th class="text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($byService as $service)
                                    <tr>
                                        <td>{{ $service->service }}</td>
                                        <td class="text-right" style="font-weight: bold;">{{ $service->total }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" style="text-align: center; color: #6b7280; padding: 1rem;">No data available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Overdue Tickets --}}
                    <div class="table-card">
                        <h4 class="table-card-title">
                            <i class="fa-solid fa-clock" style="color: #dc2626;"></i> Overdue Tickets by Personnel
                        </h4>
                        <table class="data-table">
                            <thead>
                                <tr class="th-red">
                                    <th>Request Details</th>
                                    <th class="text-right">Assigned Personnel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($overdueTickets as $personnel => $tickets)
                                    @foreach ($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->request }}</td>
                                            <td class="text-right" style="font-weight: bold;">{{ $personnel }}</td>
                                        </tr>
                                    @endforeach
                                @empty
                                    <tr>
                                        <td colspan="2" style="text-align: center; color: #6b7280; padding: 1rem;">No overdue tickets.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Recently Resolved Tickets --}}
                <div style="margin-top: 3rem;">
                    <h4 class="table-card-title">
                        <i class="fa-solid fa-clock-rotate-left" style="color: #2563eb;"></i> Recently Resolved Tickets
                    </h4>

                    <div class="full-table-container">
                        <table class="full-table">
                            <thead>
                                <tr>
                                    <th>Ticket Number</th>
                                    <th>Requested By</th>
                                    <th>Division</th>
                                    <th>Service</th>
                                    <th>Assigned Personnel</th>
                                    <th>Date Created</th>
                                    <th>Date Resolved</th>
                                    <th style="text-align: center;">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentlyResolved as $ticket)
                                    <tr>
                                        <td style="font-weight: 500; color: #111827;">{{ $ticket->ticket_number }}</td>
                                        <td>{{ $ticket->firstname }} {{ $ticket->lastname }}</td>
                                        <td>{{ $ticket->division }}</td>
                                        <td>{{ $ticket->service }}</td>
                                        <td>{{ $ticket->it_personnel }}</td>
                                        <td>{{ \Carbon\Carbon::parse($ticket->date_created)->format('M d, Y h:i A') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($ticket->date_resolved)->format('M d, Y h:i A') }}</td>
                                        
                                        @php
                                            $status = trim($ticket->status);
                                            $badgeClass = match($status) {
                                                'Resolved' => 'badge-green',
                                                'Pending' => 'badge-yellow',
                                                'Pending/Re-Assigned' => 'badge-blue',
                                                default => 'badge-gray',
                                            };
                                        @endphp
                                        
                                        <td style="text-align: center;">
                                            <span class="badge {{ $badgeClass }}">
                                                {{ $ticket->status }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" style="text-align: center; padding: 2rem; color: #6b7280;">No recently resolved tickets to display.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endif
</x-app-layout>