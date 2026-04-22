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
            
            /* Status Badges - Light */
            --badge-eval-bg: #dcfce7; --badge-eval-text: #166534;
            --badge-npc-bg: #fef2f2; --badge-npc-text: #991b1b;
            --badge-rep-bg: #eff6ff; --badge-rep-text: #1e40af;
            --badge-def-bg: #fef9c3; --badge-def-text: #854d0e;
        }

        body.dark {
            --card-bg: #0f172a; /* Matched to sidebar, header, and footer */
            --bg-alt: #1e293b; /* Slightly lighter for contrast in table headers/filters */
            --text-dark: #f8fafc;
            --text-muted: #9ca3af;
            --border-light: #334155; /* Used for explicit outlines */
            --border-subtle: #1e293b;
            --input-bg: #0f172a; /* Matched to main background */

            /* Status Badges - Dark */
            --badge-eval-bg: rgba(22, 101, 52, 0.4); --badge-eval-text: #4ade80;
            --badge-npc-bg: rgba(153, 27, 27, 0.4); --badge-npc-text: #f87171;
            --badge-rep-bg: rgba(30, 58, 138, 0.4); --badge-rep-text: #60a5fa;
            --badge-def-bg: rgba(133, 77, 14, 0.4); --badge-def-text: #facc15;
        }

        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }

        /* Main Container - Added border for definition */
        .panel { background-color: var(--card-bg); border-radius: 1rem; border: 1px solid var(--border-light); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); padding: 1.25rem; width: 100%; transition: background-color 0.3s ease, border-color 0.3s ease; }
        
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.75rem; font-weight: 800; color: var(--text-dark); margin: 0; letter-spacing: -0.025em; transition: color 0.3s ease; }

        /* --- Action Container (Toolbar Layout) - Mobile First --- */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 1rem; margin-bottom: 1.5rem; }

        /* --- Filters Section - Mobile First --- */
        .filter-form { display: flex; flex-direction: column; align-items: stretch; width: 100%; gap: 1rem; margin-bottom: 2rem; background: var(--bg-alt); padding: 1.25rem; border-radius: 0.75rem; border: 1px solid var(--border-light); transition: background-color 0.3s ease, border-color 0.3s ease; }
        .form-group { display: flex; flex-direction: column; width: 100%; }
        .form-label { font-weight: 600; margin-bottom: 0.5rem; font-size: 0.875rem; color: var(--text-muted); transition: color 0.3s ease; }
        
        /* Unified Input/Button Heights */
        .form-select { height: 44px; padding: 0 1rem; border: 1px solid var(--border-light); border-radius: 0.5rem; font-size: 0.95rem; color: var(--text-dark); width: 100%; outline: none; transition: all 0.2s; background-color: var(--input-bg); font-family: inherit; }
        .form-select:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }
        
        .form-btn-group { display: flex; flex-direction: column; width: 100%; gap: 0.75rem; margin-top: 0.25rem; }

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

        /* Dashboard Grid & Stat Cards */
        .overview-grid { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-top: 1.5rem; width: 100%; }
        @media (min-width: 1024px) { .overview-grid { grid-template-columns: 1fr 1.25fr; align-items: stretch; } }
        
        .stat-list { display: grid; grid-template-columns: 1fr; gap: 1.25rem; align-content: start; min-width: 0; width: 100%; }
        @media (min-width: 640px) and (max-width: 1023px) { .stat-list { grid-template-columns: repeat(2, 1fr); } }

        /* Enhanced Stat Cards - Mobile adjustments - Added explicit var(--border-light) */
        .stat-card { background-color: var(--card-bg); border-radius: 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.05); padding: 1.25rem; display: flex; align-items: center; justify-content: space-between; border-left: 5px solid; border-top: 1px solid var(--border-light); border-right: 1px solid var(--border-light); border-bottom: 1px solid var(--border-light); transition: all 0.2s ease; cursor: default; overflow: hidden; }
        .stat-card:hover { transform: translateY(-3px); box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1); }
        
        .stat-info { flex: 1; padding-right: 0.5rem; }
        .stat-info h4 { margin: 0; font-size: 0.8rem; font-weight: 700; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.05em; transition: color 0.3s ease; }
        .stat-info p { margin: 0.25rem 0 0 0; font-size: 1.75rem; font-weight: 800; color: var(--text-dark); line-height: 1; word-wrap: break-word; transition: color 0.3s ease; }
        
        .stat-icon { font-size: 2rem; opacity: 0.85; flex-shrink: 0; transition: transform 0.2s; }
        .stat-card:hover .stat-icon { transform: scale(1.1); opacity: 1; }

        .border-blue { border-left-color: #3b82f6; } .text-blue { color: #3b82f6; }
        .border-red { border-left-color: #ef4444; } .text-red { color: #ef4444; }
        .border-yellow { border-left-color: #eab308; } .text-yellow { color: #eab308; }
        .border-gray { border-left-color: #64748b; } .text-gray { color: #64748b; }
        .border-green { border-left-color: #22c55e; } .text-green { color: #22c55e; }

        /* Chart Area - Mobile adjustments - Changed to var(--border-light) */
        .chart-box { background-color: var(--card-bg); box-shadow: 0 1px 3px rgba(0,0,0,0.05); border-radius: 1rem; padding: 1.25rem; border: 1px solid var(--border-light); display: flex; flex-direction: column; min-width: 0; width: 100%; overflow: hidden; transition: background-color 0.3s ease, border-color 0.3s ease; }
        .chart-box h3 { margin-top: 0; font-size: 1.1rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1.25rem; padding-bottom: 1rem; border-bottom: 1px solid var(--border-light); transition: color 0.3s ease, border-color 0.3s ease; }
        .chart-wrapper { position: relative; width: 100%; height: 300px; flex-grow: 1; }
        @media (min-width: 1024px) { .chart-wrapper { height: 100%; min-height: 400px; } }

        /* --- Table Section (Mobile First) --- */
        .table-header { font-size: 1.1rem; font-weight: 700; color: var(--text-dark); margin-top: 2rem; margin-bottom: 1rem; display: flex; align-items: center; transition: color 0.3s ease; }
        .table-header i { margin-right: 0.5rem; color: #4f46e5; }
        
        .table-container { width: 100%; overflow-x: auto; -webkit-overflow-scrolling: touch; background-color: var(--card-bg); border-radius: 0.75rem; border: 1px solid var(--border-light); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); transition: background-color 0.3s ease, border-color 0.3s ease; }
        .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.85rem; min-width: 800px; }
        .data-table th { padding: 0.75rem 1rem; background-color: var(--bg-alt); color: var(--text-muted); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid var(--border-light); white-space: nowrap; transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease; }
        .data-table td { padding: 1rem; border-bottom: 1px solid var(--border-subtle); color: var(--text-dark); vertical-align: middle; font-weight: 500; transition: color 0.3s ease, border-color 0.3s ease; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: var(--bg-alt); }

        /* Status Badges */
        .badge { display: inline-block; padding: 0.4rem 1rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-align: center; white-space: nowrap; letter-spacing: 0.025em; transition: background-color 0.3s ease, color 0.3s ease; }
        .status-eval { background-color: var(--badge-eval-bg); color: var(--badge-eval-text); } 
        .status-npc { background-color: var(--badge-npc-bg); color: var(--badge-npc-text); }
        .status-reported { background-color: var(--badge-rep-bg); color: var(--badge-rep-text); }
        .status-default { background-color: var(--badge-def-bg); color: var(--badge-def-text); }

        /* Pagination Fixes */
        .pagination-wrapper { margin-top: 1.5rem; width: 100%; overflow-x: auto; padding-bottom: 0.5rem; }
        .pagination-wrapper nav { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; }
        .pagination-wrapper svg { width: 1.25rem !important; height: 1.25rem !important; display: inline-block; vertical-align: middle; }
        .pagination-wrapper a, .pagination-wrapper span { display: inline-flex; align-items: center; justify-content: center; font-weight: 500; }
        .pagination-wrapper p { margin: 0; font-size: 0.875rem; color: var(--text-muted); font-weight: 500; transition: color 0.3s ease; }

        /* --------------------------------------------------- */
        /* Mobile Specific Overrides                           */
        /* --------------------------------------------------- */
        @media (max-width: 640px) {
            .pagination-wrapper > nav > div:first-child { display: flex; width: 100%; justify-content: space-between; }
            .pagination-wrapper > nav > div:last-child { display: none; }
        }

        /* --------------------------------------------------- */
        /* Desktop & Tablet Overrides                          */
        /* --------------------------------------------------- */
        @media (min-width: 640px) {
            .stat-card { padding: 1.5rem; }
            .stat-info p { font-size: 2.25rem; }
            .stat-icon { font-size: 2.25rem; }
            
            .chart-box { padding: 1.75rem; }
            .chart-box h3 { font-size: 1.25rem; margin-bottom: 1.5rem; }
            .chart-wrapper { height: 350px; }

            .table-header { font-size: 1.25rem; margin-top: 3rem; margin-bottom: 1.25rem; }
            .table-header i { margin-right: 0.75rem; }
            .data-table { font-size: 0.9rem; min-width: 900px; }
            .data-table th { padding: 1rem 1.5rem; font-size: 0.8rem; }
            .data-table td { padding: 1.25rem 1.5rem; }
        }

        @media (min-width: 768px) {
            .panel { padding: 2rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            
            .action-container { flex-direction: row; justify-content: space-between; align-items: center; }
            
            .btn { width: auto; }
            
            .filter-form { flex-direction: row; align-items: flex-end; background: transparent; padding: 0; border: none; margin-bottom: 2rem; }
            .form-group { width: 280px; }
            .form-btn-group { flex-direction: row; width: auto; margin-top: 0; gap: 0.75rem; }
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
                        $formYears = $years ?? [];
                        $formStatuses = $statuses ?? ['For Assessment', 'For Evaluation', 'For Reporting to NPC', 'Reported'];
                    @endphp

                    <div class="form-group">
                        <label for="year" class="form-label">Filter by Year</label>
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
                                    <td><strong>{{ $dbn->dbn_number }}</strong></td>
                                    <td>{{ $dbn->sender_fullname }}</td>
                                    <td>{{ $dbn->pic }}</td>
                                    <td style="color: var(--text-muted);">
                                        {{ !empty($dbn->date_occurrence) ? \Carbon\Carbon::parse($dbn->date_occurrence)->format('M d, Y h:i A') : 'N/A' }}
                                    </td>
                                    <td style="color: var(--text-muted);">
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
                                    <td colspan="7" style="text-align: center; padding: 3rem; color: var(--text-muted); font-size: 1rem;">
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

        // === CHART LOGIC ===
        const ctxEl = document.getElementById('causePieChart');
        if(!ctxEl) return;

        const ctx = ctxEl.getContext('2d');
        const labels = @json($labels); 
        const values = @json($values); 
        const hasData = values.length && values.some(v => v > 0);

        // Helper to get CSS variable color
        function getComputedColor(cssVar) {
            return getComputedStyle(document.body).getPropertyValue(cssVar).trim() || '#64748b';
        }

        const chartData = {
            labels: labels,
            datasets: [{
                data: hasData ? values : new Array(values.length || 1).fill(1),
                backgroundColor: hasData ? [
                    '#4f46e5','#ef4444','#10b981','#eab308','#8b5cf6','#f97316','#06b6d4',
                    '#be185d','#64748b','#1d4ed8','#b91c1c','#15803d',
                    '#92400e','#6d28d9','#4338ca','#cbd5e1'
                ] : ['#f1f5f9'], 
                borderColor: 'transparent',
                borderWidth: 2,
                hoverOffset: 4
            }]
        };

        const noDataPlugin = {
            id: 'noDataPlugin',
            afterDraw: (chart) => {
                if (!hasData) {
                    const { ctx, chartArea: { width, height, top, left } } = chart;
                    ctx.save();
                    ctx.font = 'bold 16px Inter, sans-serif';
                    ctx.fillStyle = getComputedColor('--text-muted');
                    ctx.textAlign = 'center';
                    ctx.textBaseline = 'middle';
                    ctx.fillText('No Data Available', left + width / 2, top + height / 2);
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
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: { size: 13, family: "'Inter', sans-serif" },
                        color: getComputedColor('--text-muted'),
                        padding: 20
                    }
                },
                tooltip: {
                    enabled: hasData,
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleFont: { family: "'Inter', sans-serif", size: 13 },
                    bodyFont: { family: "'Inter', sans-serif", size: 14, weight: 'bold' },
                    padding: 12,
                    cornerRadius: 8
                }
            }
        };

        const myPieChart = new Chart(ctx, {
            type: 'doughnut',
            data: chartData,
            options: chartOptions,
            plugins: [noDataPlugin]
        });

        // Resize observer for Chart layout
        window.addEventListener('resize', () => {
            const newPos = getLegendPosition();
            if (myPieChart.options.plugins.legend.position !== newPos) {
                myPieChart.options.plugins.legend.position = newPos;
                myPieChart.update();
            }
        });

        // MutationObserver to detect dark mode toggle and update Chart colors
        const observer = new MutationObserver(() => {
            const newTextColor = getComputedColor('--text-muted');
            myPieChart.options.plugins.legend.labels.color = newTextColor;
            myPieChart.update();
        });

        observer.observe(document.body, { attributes: true, attributeFilter: ['class'] });
    });
    </script>
</x-app-layout>