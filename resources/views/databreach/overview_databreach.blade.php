<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Global Box Sizing Fix for Mobile Overflow */
        *, *::before, *::after {
            box-sizing: border-box;
        }

        /* Mobile-First Layout Basics */
        .panel { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.25rem; width: 100%; }

        /* Header & Actions */
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; }
        .title { font-size: 1.5rem; font-weight: 900; color: #111827; margin-bottom: 1.5rem; margin-top: 0; }

        /* Filter Form Container */
        .filter-form { display:flex; flex-direction:column; gap:1rem; margin-bottom:2rem; background:#f9fafb; padding:1rem; border-radius:0.5rem; border:1px solid #e5e7eb; width:100%; box-sizing:border-box; }

        /* Form Group & Label */
        .form-group { display:flex; flex-direction:column; width:100%; }
        .form-label { font-size:0.875rem; font-weight:600; color:#374151; margin-bottom:0.5rem; }

        /* Select Dropdown */
        .form-select { padding:0 1rem; font-size:0.875rem; border:1px solid #d1d5db; border-radius:0.375rem; background-color:#fff; outline:none; transition:border-color 0.2s, box-shadow 0.2s; width:100%; height:42px; box-sizing:border-box; }
        .form-select:focus { border-color:#4f46e5; box-shadow:0 0 0 3px rgba(79,70,229,0.2); }

        /* Button Group Container */
        .form-btn-group { display:flex; flex-direction:column; gap:0.75rem; width:100%; }

        /* Base Button Styles (Included for perfect alignment) */
        .btn { display:inline-flex; align-items:center; justify-content:center; gap:0.5rem; padding:0 1.25rem; font-size:0.875rem; font-weight:500; border-radius:0.375rem; border:1px solid transparent; cursor:pointer; transition:all 0.2s ease-in-out; height:42px; box-sizing:border-box; }

        /* Desktop & Tablet View */
        @media (min-width:768px) {
        .filter-form { flex-direction:row; align-items:flex-end; background:transparent; padding:0; border:none; }
        .form-group { flex:1; max-width:250px; }
        .form-btn-group { flex-direction:row; width:auto; }
        .form-btn-group .btn { width:auto; }
        }

        /* Buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 1rem; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; border: none; color: white; transition: all 0.2s ease; box-shadow: 0 1px 2px rgba(0,0,0,0.05); text-decoration: none; width: 100%; }
        @media (min-width: 768px) { .btn { width: auto; } }
        .btn i { margin-right: 0.5rem; }
        .btn-green { background-color: #16a34a; } .btn-green:hover { background-color: #15803d; }
        .btn-indigo { background-color: #4f46e5; } .btn-indigo:hover { background-color: #4338ca; }

        /* Dashboard Grid */
        .overview-grid { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-top: 1.5rem; min-width: 0; width: 100%; }
        @media (min-width: 1024px) {
            .overview-grid { grid-template-columns: 1fr 1fr; align-items: stretch; }
        }

        /* Stat Cards */
        .stat-list { display: grid; grid-template-columns: 1fr; gap: 1rem; align-content: start; min-width: 0; }
        @media (min-width: 640px) and (max-width: 1023px) {
            .stat-list { grid-template-columns: repeat(2, 1fr); }
        }

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
        @media (min-width: 1024px) {
            .chart-wrapper { height: 100%; min-height: 400px; }
        }

        /* Table Section */
        .table-header { font-size: 1.125rem; font-weight: 600; color: #374151; margin-top: 2.5rem; margin-bottom: 1rem; display: flex; align-items: center; }
        .table-header i { margin-right: 0.5rem; color: #2563eb; }
        .table-container { overflow-x: auto; background-color: #ffffff; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 0.5rem; border: 1px solid #e5e7eb; width: 100%; }
        .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem; min-width: 900px; }
        .data-table th { padding: 0.75rem 1rem; background-color: #f3f4f6; color: #374151; font-weight: 600; text-transform: uppercase; border-bottom: 1px solid #e5e7eb; white-space: nowrap; }
        .data-table td { padding: 1rem; border-bottom: 1px solid #e5e7eb; color: #1f2937; }
        .data-table tbody tr:hover { background-color: #f9fafb; }

        /* Status Badges */
        .badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; text-align: center; white-space: nowrap; }
        .status-eval { background-color: #dcfce7; color: #1d4ed8; }
        .status-reported { background-color: #dbeafe; color: #1d4ed8; }
        .status-default { background-color: #fef9c3; color: #a16207; }

        /* Pagination Fixes */
        .pagination-container { margin-top: 1.5rem; font-size: 0.875rem; color: #374151; width: 100%; overflow-x: auto; }
        .pagination-container nav { display: flex; flex-direction: column; gap: 1rem; align-items: center; }
        @media (min-width: 640px) { .pagination-container nav { flex-direction: row; justify-content: space-between; } }
        .pagination-container svg { width: 1.25rem !important; height: 1.25rem !important; display: inline-block; } 
        .pagination-container p { margin: 0; color: #4b5563; }
        .pagination-container span.relative.inline-flex, 
        .pagination-container a.relative.inline-flex {
            display: inline-flex; align-items: center; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; text-decoration: none; color: #374151; background: #fff; margin-left: -1px;
        }
        .pagination-container a.relative.inline-flex:hover { background-color: #f3f4f6; }
        .pagination-container span[aria-current="page"] > span { background-color: #eff6ff; color: #4f46e5; border-color: #4f46e5; z-index: 1; }
        .pagination-container span[aria-disabled="true"] > span { opacity: 0.5; cursor: not-allowed; }

        @media (max-width: 640px) {
            .pagination-container > nav > div:first-child { display: flex; width: 100%; justify-content: space-between; margin-bottom: 1rem; }
            .pagination-container > nav > div:last-child { display: none; }
        }
    </style>

    @can('view_overview_databreach')
    <div id="main-content" class="page-wrapper">
        <div id="dashboardContent">
            <div class="panel">
                
                <div class="header-flex">
                    <h3 class="title">Data Breach Notifications Overview</h3>
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
                                    <td colspan="7" style="text-align: center; padding: 2rem; color: #6b7280; font-size: 1rem;">
                                        No recently reported incidents to display.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if(method_exists($recentIncidents, 'links'))
                    <div class="pagination-container">
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