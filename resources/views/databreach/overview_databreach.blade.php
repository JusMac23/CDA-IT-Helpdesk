<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Global Box Sizing Fix */
        *, *::before, *::after { box-sizing: border-box; }

        /* Main Container - Mobile First 100% Width */
        .panel { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1rem; width: 100%; box-sizing: border-box; }
        
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.5rem; font-weight: 900; color: #111827; margin-bottom: 0; margin-top: 0; }

        /* --- Action Container (Toolbar Layout) - Mobile First --- */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 1rem; margin-bottom: 1.5rem; }
        
        .auto-reload-label { display: flex; align-items: center; font-size: 0.875rem; color: #374151; cursor: pointer; width: 100%; padding: 0.5rem 0; }
        .auto-reload-checkbox { margin-right: 0.5rem; cursor: pointer; width: 1.25rem; height: 1.25rem; accent-color: #4f46e5; }

        /* --- Filters Section - Mobile First --- */
        .filter-form { display: flex; flex-direction: column; align-items: stretch; width: 100%; gap: 1rem; margin-bottom: 1.5rem; background: #f9fafb; padding: 1rem; border-radius: 0.5rem; border: 1px solid #e5e7eb; box-sizing: border-box; }
        .form-group { display: flex; flex-direction: column; width: 100%; }
        .form-label { font-weight: 600; margin-bottom: 0.35rem; font-size: 0.875rem; color: #374151; }
        .form-select { padding: 0.75rem 1rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 1rem; width: 100%; box-sizing: border-box; outline: none; transition: border-color 0.2s, box-shadow 0.2s; background-color: white; height: auto; }
        .form-select:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2); }
        
        .form-btn-group { display: flex; flex-direction: column; width: 100%; gap: 0.75rem; margin-top: 0.5rem; }

        /* --- Buttons - Mobile First (Full Width default) --- */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.85rem 1.5rem; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 600; cursor: pointer; border: none; transition: background-color 0.2s, box-shadow 0.2s, transform 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05); width: 100%; box-sizing: border-box; text-decoration: none; }
        .btn i { margin-right: 0.5rem; }
        
        .btn-green { background-color: #16a34a; color: white; border: 1px solid #15803d; }
        .btn-green:hover { background-color: #15803d; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(22, 163, 74, 0.25); color: white; }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(22, 163, 74, 0.15); }

        .btn-indigo { background-color: #4f46e5; color: white; border: 1px solid #4338ca; }
        .btn-indigo:hover { background-color: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(79, 70, 229, 0.25); color: white; }
        .btn-indigo:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(79, 70, 229, 0.15); }

        /* Dashboard Grid & Stat Cards */
        .overview-grid { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-top: 1.5rem; min-width: 0; width: 100%; }
        @media (min-width: 1024px) { .overview-grid { grid-template-columns: 1fr 1fr; align-items: stretch; } }
        
        .stat-list { display: grid; grid-template-columns: 1fr; gap: 1rem; align-content: start; min-width: 0; }
        @media (min-width: 640px) and (max-width: 1023px) { .stat-list { grid-template-columns: repeat(2, 1fr); } }

        .stat-card { background-color: white; border-radius: 0.75rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 1.25rem; display: flex; align-items: center; justify-content: space-between; border-left: 4px solid; border-top: 1px solid #e5e7eb; border-right: 1px solid #e5e7eb; border-bottom: 1px solid #e5e7eb; transition: transform 0.2s ease, box-shadow 0.2s ease; cursor: default; min-width: 0; max-width: 100%; word-wrap: break-word; }
        .stat-card:hover { transform: translateY(-2px); box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1); }
        .stat-info { flex: 1; min-width: 0; padding-right: 0.5rem; }
        .stat-info h4 { margin: 0; font-size: 1rem; font-weight: 600; color: #4b5563; white-space: normal; }
        .stat-info p { margin: 0.25rem 0 0 0; font-size: 1.5rem; font-weight: 700; color: #111827; }
        .stat-icon { font-size: 1.75rem; opacity: 0.9; flex-shrink: 0; }

        .border-blue { border-left-color: #2563eb; } .text-blue { color: #2563eb; }
        .border-red { border-left-color: #dc2626; } .text-red { color: #dc2626; }
        .border-yellow { border-left-color: #ca8a04; } .text-yellow { color: #ca8a04; }
        .border-gray { border-left-color: #4b5563; } .text-gray { color: #4b5563; }
        .border-green { border-left-color: #16a34a; } .text-green { color: #16a34a; }

        /* Chart Area */
        .chart-box { background-color: white; box-shadow: 0 1px 2px rgba(0,0,0,0.05); border-radius: 0.75rem; padding: 1.5rem; border: 1px solid #e5e7eb; display: flex; flex-direction: column; min-width: 0; max-width: 100%; }
        .chart-box h3 { margin-top: 0; font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 1.5rem; padding-bottom: 0.75rem; border-bottom: 1px solid #f3f4f6; }
        .chart-wrapper { position: relative; width: 100%; height: 350px; flex-grow: 1; min-width: 0; }
        @media (min-width: 1024px) { .chart-wrapper { height: 100%; min-height: 400px; } }

        /* Table Section */
        .table-header { font-size: 1.125rem; font-weight: 600; color: #374151; margin-top: 2.5rem; margin-bottom: 1rem; display: flex; align-items: center; }
        .table-header i { margin-right: 0.5rem; color: #2563eb; }
        .table-container { overflow-x: auto; background-color: #ffffff; border-radius: 0.5rem; border: 1px solid #e5e7eb; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); width: 100%; -webkit-overflow-scrolling: touch; }
        .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem; min-width: 900px; }
        .data-table th { padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #374151; font-weight: 600; text-transform: uppercase; border-bottom: 2px solid #e5e7eb; white-space: nowrap; }
        .data-table td { padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; color: #1f2937; vertical-align: top; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: #f9fafb; }

        /* Status Badges */
        .badge { display: inline-block; padding: 0.35rem 1rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-align: center; white-space: nowrap; }
        .status-eval { background-color: #dcfce7; color: #166534; } 
        .status-npc { background-color: #fef2f2; color: #991b1b; }
        .status-reported { background-color: #eff6ff; color: #1e40af; }
        .status-default { background-color: #fef9c3; color: #854d0e; }

        /* Action Links inside Table - Updated with Borders */
        .action-group { display: flex; flex-direction: column; gap: 0.5rem; }
        .action-link { display: flex; align-items: center; font-size: 0.875rem; font-weight: 500; font-family: inherit; cursor: pointer; padding: 0.35rem 0.75rem; border-radius: 0.375rem; transition: 0.2s; text-decoration: none; background: transparent; white-space: nowrap; width: 100%; text-align: left; box-sizing: border-box; }
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
        .pagination-wrapper svg { width: 1.25rem !important; height: 1.25rem !important; display: inline-block; vertical-align: middle; }
        .pagination-wrapper a, .pagination-wrapper span { display: inline-flex; align-items: center; justify-content: center; }
        .pagination-wrapper p { margin: 0; font-size: 0.875rem; color: #6b7280; }

        /* --------------------------------------------------- */
        /* Mobile Specific Overrides (max-width: 640px)        */
        /* --------------------------------------------------- */
        @media (max-width: 640px) {
            .pagination-wrapper > nav > div:first-child { display: flex; width: 100%; justify-content: space-between; }
            .pagination-wrapper > nav > div:last-child { display: none; }
        }

        /* --------------------------------------------------- */
        /* Desktop & Tablet Overrides (min-width: 768px)       */
        /* --------------------------------------------------- */
        @media (min-width: 768px) {
            .panel { padding: 1.5rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            
            /* Align Add button and Checkbox inline */
            .action-container { flex-direction: row; justify-content: space-between; align-items: center; }
            .auto-reload-label { width: auto; padding: 0; }
            
            /* Un-stretch buttons on desktop */
            .btn { width: auto; }
            
            /* Filter Row */
            .filter-form { flex-direction: row; align-items: flex-end; background: transparent; padding: 0; border: none; }
            .form-group { width: 250px; }
            .form-btn-group { flex-direction: row; width: auto; margin-top: 0; gap: 0.5rem; }
        }
    </style>

    @can('view_overview_databreach')
    <div id="main-content" class="page-wrapper">
        <div id="dashboardContent">
            <div class="panel">
                
                <div class="header-flex">
                    <h3 class="title">Data Breach Notifications Overview</h3>
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

                <form method="GET" action="{{ route('databreach.overview') }}" class="filter-form">

                    @php
                        // Safeguard in case variables aren't passed by the controller
                        $formYears = $years ?? [];
                        $formStatuses = $statuses ?? ['For Assessment', 'For Evaluation', 'For Reporting to NPC', 'Reported'];
                    @endphp

                    <div class="form-group">
                        <label for="year" class="form-label">Filter by Year:</label>
                        <select name="year" id="year" class="form-select">
                            <option value="">All Years</option>
                            @foreach($formYears as $y)
                                <option value="{{ $y }}" @if(isset($year) && $year == $y) selected @endif>
                                    {{ $y }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-btn-group">
                        <button type="submit" class="btn btn-green">
                            <i class="fa-solid fa-filter"></i> Apply Filter
                        </button>
                        
                        @can('generate_databreach')
                        <button type="submit" name="action" value="generate" class="btn btn-indigo">
                            <i class="fa-solid fa-download"></i> Generate Report
                        </button>
                        @endcan
                    </div>

                </form>

                <div class="overview-grid">
                    
                    <div class="stat-list">
                        
                        <div class="stat-card border-blue">
                            <div class="stat-info">
                                <h4>Total Security Incidents</h4>
                                <p>{{ $totalNotifications ?? 0 }}</p>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-shield-halved text-blue"></i>
                            </div>
                        </div>

                        <div class="stat-card border-red">
                            <div class="stat-info">
                                <h4>Mandatory Incidents</h4>
                                <p>{{ $totalMandatory ?? 0 }}</p>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-triangle-exclamation text-red"></i>
                            </div>
                        </div>

                        <div class="stat-card border-yellow">
                            <div class="stat-info">
                                <h4>Voluntary Incidents</h4>
                                <p>{{ $totalVoluntary ?? 0 }}</p>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-clipboard-list text-yellow"></i>
                            </div>
                        </div>

                        <div class="stat-card border-gray">
                            <div class="stat-info">
                                <h4>Others</h4>
                                <p>{{ $totalOthers ?? 0 }}</p>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-circle-question text-gray"></i>
                            </div>
                        </div>

                        <div class="stat-card border-green">
                            <div class="stat-info">
                                <h4>Total Reported</h4>
                                <p>{{ $totalReported ?? 0 }}</p>
                            </div>
                            <div class="stat-icon">
                                <i class="fa-solid fa-circle-check text-green"></i>
                            </div>
                        </div>

                    </div>

                    <div class="chart-box">
                        <h3>Incidents per Specific Cause</h3>
                        <div class="chart-wrapper">
                            <canvas id="causePieChart"></canvas>
                        </div>
                    </div>

                </div>

                @php
                    $labels = isset($causeCards) ? array_column($causeCards, 'label') : [];
                    $values = isset($causeCards) ? array_column($causeCards, 'count') : [];
                    $recentIncidents = $recentlyReported ?? collect();
                @endphp

                <h4 class="table-header">
                    <i class="fa-solid fa-clock-rotate-left"></i> Recently Reported Notifications
                </h4>
                
                <div class="table-container">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>DBN No.</th>
                                <th>Sender</th>
                                <th>PIC</th>
                                <th>Date of Occurrence</th>
                                <th>Date of Discovery</th>
                                <th>General Cause</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($recentIncidents as $dbn)
                                <tr>
                                    <td>{{ $dbn->dbn_number }}</td>
                                    <td>{{ $dbn->sender_fullname }}</td>
                                    <td>{{ $dbn->pic }}</td>
                                    <td style="color: #4b5563;">
                                        {{ !empty($dbn->date_occurrence) ? \Carbon\Carbon::parse($dbn->date_occurrence)->format('M d, Y h:i A') : 'N/A' }}
                                    </td>
                                    <td style="color: #4b5563;">
                                        {{ !empty($dbn->date_discovery) ? \Carbon\Carbon::parse($dbn->date_discovery)->format('M d, Y h:i A') : 'N/A' }}
                                    </td>
                                    <td>{{ $dbn->general_cause }}</td>
                                    <td>
                                        @php
                                            $status = trim($dbn->status ?? '');
                                            $badgeClass = 'status-default';
                                            if ($status === 'For Evaluation') $badgeClass = 'status-eval';
                                            elseif ($status === 'Reported') $badgeClass = 'status-reported';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $status !== '' ? $status : 'Unknown' }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; padding: 2rem; color: #6b7280; font-size: 1rem;">
                                        No recently reported incidents to display.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($recentIncidents, 'links'))
                    <div class="pagination-wrapper">
                        {{ $recentIncidents->links() }}
                    </div>
                @endif

            </div>
        </div>
    </div>
    @endcan

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function () {
        
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

        // === CHART LOGIC ===
        const ctxEl = document.getElementById('causePieChart');
        if(!ctxEl) return;

        const ctx = ctxEl.getContext('2d');

        const labels = @json($labels); 
        const values = @json($values); 

        const hasData = values.length && values.some(v => v > 0);

        const chartData = {
            labels: labels,
            datasets: [{
                data: hasData ? values : new Array(values.length || 1).fill(1),
                backgroundColor: hasData ? [
                    '#2563EB','#DC2626','#16A34A','#CA8A04','#7C3AED','#EA580C','#0891B2',
                    '#9D174D','#4B5563','#1D4ED8','#B91C1C','#15803D',
                    '#92400E','#6D28D9','#4338CA','#000000'
                ] : ['#E5E7EB'], 
                borderColor: '#FFFFFF',
                borderWidth: 2
            }]
        };

        const noDataPlugin = {
            id: 'noDataPlugin',
            afterDraw: (chart) => {
                if (!hasData) {
                    const { ctx, chartArea: { width, height, top, left } } = chart;
                    ctx.save();
                    ctx.font = 'bold 16px Arial';
                    ctx.fillStyle = '#6B7280';
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText('No Data', left + width / 2, top + height / 2);
                    ctx.restore();
                }
            }
        };

        const getLegendPosition = () => window.innerWidth < 768 ? 'bottom' : 'right';

        const chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: getLegendPosition(),
                    display: hasData,
                    labels: {
                        boxWidth: 12,
                        font: { size: 12 }
                    }
                },
                tooltip: {
                    enabled: hasData
                }
            }
        };

        const myPieChart = new Chart(ctx, {
            type: 'pie',
            data: chartData,
            options: chartOptions,
            plugins: [noDataPlugin]
        });

        window.addEventListener('resize', () => {
            const newPos = getLegendPosition();
            if (myPieChart.options.plugins.legend.position !== newPos) {
                myPieChart.options.plugins.legend.position = newPos;
                myPieChart.update();
            }
        });
    });
    </script>
</x-app-layout>