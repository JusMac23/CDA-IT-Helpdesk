<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @if(auth()->user()->hasAnyRole(['Super Admin', 'Admin']))
    <style>
        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }

        /* Dashboard Container */
        .dashboard-panel { background-color: #ffffff; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); padding: 2rem; width: 100%; border: 1px solid #f1f5f9; }
        .dashboard-title { font-size: 1.75rem; font-weight: 800; margin-top: 0; margin-bottom: 2rem; color: #0f172a; letter-spacing: -0.025em; }
        
        /* Stats Cards */
        .stat-cards { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 240px), 1fr)); 
            gap: 1.5rem; 
            margin-bottom: 2.5rem; 
        }
        .stat-card { border-radius: 1rem; padding: 1.5rem; background: #ffffff; border: 1px solid #f1f5f9; box-shadow: 0 1px 3px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: space-between; border-left: 5px solid; transition: all 0.3s ease; }
        .stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); }
        
        .stat-left { display: flex; align-items: center; gap: 1.25rem; }
        .stat-icon { width: 56px; height: 56px; border-radius: 1rem; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; flex-shrink: 0; }
        .stat-label { font-size: 0.85rem; font-weight: 700; margin: 0; text-transform: uppercase; letter-spacing: 0.05em; color: #64748b; }
        .stat-value { font-size: 2.25rem; font-weight: 800; margin: 0.25rem 0 0 0; text-align: left; line-height: 1; }
        
        /* Card Themes */
        .card-indigo { border-left-color: #6366f1; }
        .card-indigo .stat-icon { background: #e0e7ff; color: #4f46e5; }
        .card-indigo .stat-value { color: #0f172a; }
        
        .card-green { border-left-color: #10b981; }
        .card-green .stat-icon { background: #dcfce7; color: #10b981; }
        .card-green .stat-value { color: #0f172a; }
        
        .card-blue { border-left-color: #3b82f6; }
        .card-blue .stat-icon { background: #dbeafe; color: #3b82f6; }
        .card-blue .stat-value { color: #0f172a; }
        
        .card-red { border-left-color: #ef4444; }
        .card-red .stat-icon { background: #fee2e2; color: #ef4444; }
        .card-red .stat-value { color: #0f172a; }
        
        /* Grid Tables (Middle Section) */
        .tables-grid { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(min(100%, 300px), 1fr)); 
            gap: 1.5rem; 
            margin-bottom: 3rem; 
        }
        
        .table-card { background: white; border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); padding: 1.5rem; border: 1px solid #e2e8f0; border-top: 4px solid #cbd5e1; overflow: hidden; display: flex; flex-direction: column; }
        .table-card-title { font-size: 1.15rem; font-weight: 700; margin-top: 0; margin-bottom: 1.25rem; color: #0f172a; display: flex; align-items: center; gap: 0.75rem; }
        
        /* Accent Colors for Table Cards */
        .tc-indigo { border-top-color: #4f46e5; }
        .tc-green { border-top-color: #10b981; }
        .tc-yellow { border-top-color: #eab308; }
        .tc-red { border-top-color: #ef4444; }
        
        .table-responsive { width: 100%; overflow-x: auto; flex-grow: 1; -webkit-overflow-scrolling: touch; }
        
        /* Small Grid Tables */
        .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.95rem; }
        .data-table th, .data-table td { padding: 0.85rem 1rem; white-space: nowrap; border-bottom: 1px solid #f1f5f9; }
        .data-table th { background: #f8fafc; color: #64748b; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; }
        .data-table td { color: #334155; font-weight: 500; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: #f8fafc; }
        .text-right { text-align: right; }
        
        /* Bottom Full Table */
        .full-table-container { background: white; box-shadow: 0 1px 3px rgba(0,0,0,0.05); border-radius: 1rem; border: 1px solid #e2e8f0; overflow-x: auto; margin-top: 1.5rem; -webkit-overflow-scrolling: touch; }
        .full-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.9rem; min-width: 1000px; }
        .full-table th { padding: 1.25rem 1.5rem; background: #f8fafc; color: #64748b; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
        .full-table td { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; color: #334155; font-weight: 500; vertical-align: middle; } 
        .full-table tbody tr { transition: background-color 0.15s; }
        .full-table tbody tr:hover { background: #f8fafc; }
        
        /* Badges */
        .badge { padding: 0.4rem 1rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; display: inline-block; text-align: center; white-space: nowrap; letter-spacing: 0.025em; }
        .badge-green { background: #dcfce7; color: #166534; }
        .badge-yellow { background: #fef9c3; color: #854d0e; }
        .badge-blue { background: #eff6ff; color: #1e40af; }
        .badge-gray { background: #f1f5f9; color: #475569; }

        /* General Mobile Responsiveness */
        @media (max-width: 640px) {
            .dashboard-panel { padding: 1.25rem; }
            .stat-card { padding: 1.25rem; }
            .stat-icon { width: 48px; height: 48px; font-size: 1.25rem; }
            .stat-value { font-size: 1.75rem; }
            .dashboard-wrapper { padding: 0.5rem; }
            .table-card { padding: 1.25rem; }
        }
    </style>

    <div id="main-content" class="page-wrapper">
        <div id="dashboardContent" class="dashboard-wrapper">
            <div class="dashboard-panel">
                
                <h3 class="dashboard-title">Tickets Overview</h3>

                {{-- Dashboard Cards --}}
                <div class="stat-cards">
                    @php
                        $cards = [
                            ['label' => 'Total Tickets', 'icon' => 'fa-ticket', 'theme' => 'indigo', 'value' => $total ?? 0],
                            ['label' => 'Pending Tickets', 'icon' => 'fa-hourglass-half', 'theme' => 'green', 'value' => $pending ?? 0],
                            ['label' => 'Resolved Tickets', 'icon' => 'fa-check-circle', 'theme' => 'blue', 'value' => $resolved ?? 0],
                            ['label' => 'Overdue Tickets', 'icon' => 'fa-exclamation-circle', 'theme' => 'red', 'value' => $overdue ?? 0],
                        ];
                    @endphp

                    @foreach ($cards as $card)
                        <div class="stat-card card-{{ $card['theme'] }}">
                            <div class="stat-left">
                                <div class="stat-icon">
                                    <i class="fa-solid {{ $card['icon'] }}"></i>
                                </div>
                                <div>
                                    <h4 class="stat-label">{{ $card['label'] }}</h4>
                                    <p class="stat-value">{{ $card['value'] }}</p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- IT Area, Personnel, Service, Overdue --}}
                <div class="tables-grid">
                    
                    {{-- Tickets by Region --}}
                    <div class="table-card tc-indigo">
                        <h4 class="table-card-title text-indigo-600">
                            <i class="fa-solid fa-network-wired"></i> Tickets by Region
                        </h4>
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>IT Area</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($byItArea ?? [] as $area)
                                        <tr>
                                            <td>{{ $area->it_area }}</td>
                                            <td class="text-right" style="font-weight: 700; color: #0f172a;">{{ $area->total }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" style="text-align: center; color: #94a3b8; padding: 2rem;">No data available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Tickets by Technical Personnel --}}
                    <div class="table-card tc-green">
                        <h4 class="table-card-title text-emerald-600">
                            <i class="fa-solid fa-user-gear"></i> By Personnel
                        </h4>
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Technical Personnel</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($byItPersonnel ?? [] as $person)
                                        <tr>
                                            <td>{{ $person->it_personnel }}</td>
                                            <td class="text-right" style="font-weight: 700; color: #0f172a;">{{ $person->total }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" style="text-align: center; color: #94a3b8; padding: 2rem;">No data available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Tickets by Service --}}
                    <div class="table-card tc-yellow">
                        <h4 class="table-card-title text-yellow-600">
                            <i class="fa-solid fa-tools"></i> By Service
                        </h4>
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Service Category</th>
                                        <th class="text-right">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($byService ?? [] as $service)
                                        <tr>
                                            <td>{{ $service->service }}</td>
                                            <td class="text-right" style="font-weight: 700; color: #0f172a;">{{ $service->total }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" style="text-align: center; color: #94a3b8; padding: 2rem;">No data available.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- Overdue Tickets --}}
                    <div class="table-card tc-red">
                        <h4 class="table-card-title text-red-600">
                            <i class="fa-solid fa-clock"></i> Overdue Tickets
                        </h4>
                        <div class="table-responsive">
                            <table class="data-table">
                                <thead>
                                    <tr>
                                        <th>Request Details</th>
                                        <th class="text-right">Assigned To</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($overdueTickets ?? [] as $personnel => $tickets)
                                        @foreach ($tickets as $ticket)
                                            <tr>
                                                <td style="white-space: normal; min-width: 150px;">{{ $ticket->request }}</td>
                                                <td class="text-right" style="font-weight: 700; color: #0f172a;">{{ $personnel }}</td>
                                            </tr>
                                        @endforeach
                                    @empty
                                        <tr>
                                            <td colspan="2" style="text-align: center; color: #94a3b8; padding: 2rem;">No overdue tickets.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Recently Resolved Tickets --}}
                <div style="margin-top: 1rem;">
                    <h4 class="table-card-title" style="color: #0f172a;">
                        <i class="fa-solid fa-clock-rotate-left text-blue-600"></i> Recently Resolved Tickets
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
                                @forelse ($recentlyResolved ?? [] as $ticket)
                                    <tr>
                                        <td style="font-weight: 700; color: #0f172a;">{{ $ticket->ticket_number }}</td>
                                        <td>{{ $ticket->firstname }} {{ $ticket->lastname }}</td>
                                        <td>{{ $ticket->division }}</td>
                                        <td>{{ $ticket->service }}</td>
                                        <td>{{ $ticket->it_personnel }}</td>
                                        <td style="color: #64748b;">{{ \Carbon\Carbon::parse($ticket->date_created)->format('M d, Y h:i A') }}</td>
                                        <td style="color: #64748b;">{{ \Carbon\Carbon::parse($ticket->date_resolved)->format('M d, Y h:i A') }}</td>
                                        
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
                                        <td colspan="8" style="text-align: center; padding: 3rem; color: #94a3b8; font-size: 1rem;">No recently resolved tickets to display.</td>
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