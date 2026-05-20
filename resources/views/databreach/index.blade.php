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
        }

        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; transition: background-color 0.3s ease, color 0.3s ease; }

        /* Main Container - Added outline matching dark mode specs */
        .content-panel { background-color: var(--card-bg); border-radius: 1rem; border: 1px solid var(--border-light); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); padding: 1.25rem; width: 100%; transition: background-color 0.3s ease, border-color 0.3s ease; }
        
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.75rem; font-weight: 800; color: var(--text-dark); margin: 0; letter-spacing: -0.025em; transition: color 0.3s ease; }

        /* --- Action Container (Toolbar Layout) - Mobile First --- */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 1rem; margin-bottom: 1.5rem; }

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

        /* Modern Gray / Secondary */
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

        /* Data Table */
        .table-container { overflow-x: auto; background-color: var(--card-bg); border-radius: 0.75rem; border: 1px solid var(--border-light); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); margin-top: 1.5rem; width: 100%; -webkit-overflow-scrolling: touch; transition: background-color 0.3s ease, border-color 0.3s ease; }
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
        .action-group { display: flex; flex-direction: column; gap: 0.5rem; }
        .action-link { display: flex; align-items: center; font-size: 0.85rem; font-weight: 600; font-family: inherit; cursor: pointer; padding: 0.4rem 0.75rem; border-radius: 0.375rem; transition: all 0.2s; text-decoration: none; background: transparent; white-space: nowrap; width: 100%; text-align: left; box-sizing: border-box; }
        .action-link i { margin-right: 0.4rem; width: 16px; text-align: center; font-size: 0.9rem; }
        
        .link-blue { color: #3b82f6; border: 1px solid #bfdbfe; } 
        .link-blue:hover { background-color: #eff6ff; color: #1d4ed8; border-color: #93c5fd; }
        
        .link-yellow { color: #d97706; border: 1px solid #fde68a; } 
        .link-yellow:hover { background-color: #fffbeb; color: #b45309; border-color: #fcd34d; }
        
        .link-green { color: #10b981; border: 1px solid #a7f3d0; } 
        .link-green:hover { background-color: #ecfdf5; color: #047857; border-color: #6ee7b7; }
        
        .link-red { color: #ef4444; border: 1px solid #fecaca; } 
        .link-red:hover { background-color: #fef2f2; color: #b91c1c; border-color: #fca5a5; }

        /* Dark Mode Action Link Overrides */
        body.dark .link-blue { color: #60a5fa; border-color: #1e3a8a; }
        body.dark .link-blue:hover { background-color: rgba(30, 58, 138, 0.4); color: #93c5fd; }
        body.dark .link-yellow { color: #fbbf24; border-color: #78350f; }
        body.dark .link-yellow:hover { background-color: rgba(120, 53, 15, 0.4); color: #fcd34d; }
        body.dark .link-green { color: #34d399; border-color: #064e3b; }
        body.dark .link-green:hover { background-color: rgba(6, 78, 59, 0.4); color: #6ee7b7; }
        body.dark .link-red { color: #f87171; border-color: #7f1d1d; }
        body.dark .link-red:hover { background-color: rgba(127, 29, 29, 0.4); color: #fca5a5; }

        /* --- Modern UI Pagination (Laravel Structure Fix) --- */
        .pagination-wrapper { margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-light); width: 100%; transition: border-color 0.3s ease; }
        .pagination-wrapper nav { display: flex; flex-direction: column; gap: 1.25rem; width: 100%; align-items: center; }
        
        /* Pagination Sub-Text */
        .pagination-wrapper p { margin: 0; font-size: 0.875rem; color: var(--text-muted); font-weight: 500; text-align: center; transition: color 0.3s ease; }
        .pagination-wrapper p span { font-weight: 700; color: var(--text-dark); transition: color 0.3s ease; }

        /* Container for links */
        .pagination-wrapper div > span.relative.z-0.inline-flex,
        .pagination-wrapper .flex.justify-between { display: flex; flex-wrap: wrap; gap: 0.5rem; box-shadow: none !important; justify-content: center; align-items: center; }

        /* Uniform Button Styling for Page Numbers & Arrows */
        .pagination-wrapper a, 
        .pagination-wrapper span[aria-current="page"] > span,
        .pagination-wrapper span[aria-disabled="true"] > span { display: inline-flex; align-items: center; justify-content: center; min-width: 2.25rem; height: 2.25rem; padding: 0 0.5rem; border-radius: 0.375rem !important; font-size: 0.875rem; font-weight: 600; font-family: 'Inter', sans-serif; transition: all 0.2s ease; border: 1px solid transparent; margin: 0 !important; text-decoration: none; line-height: 1; }

        /* Default Inactive Links */
        .pagination-wrapper a { background-color: var(--card-bg); color: var(--text-muted); border-color: var(--border-light); }
        .pagination-wrapper a:hover { background-color: var(--bg-alt); color: var(--text-dark); border-color: var(--input-border); transform: translateY(-1px); box-shadow: 0 2px 4px rgba(0,0,0,0.05); }

        /* Active Page Link */
        .pagination-wrapper span[aria-current="page"] > span { background-color: #4f46e5; color: #ffffff; border-color: #4f46e5; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.25); z-index: 2; position: relative; }

        /* Disabled Navigation Arrows */
        .pagination-wrapper span[aria-disabled="true"] > span { background-color: var(--bg-alt); color: var(--text-muted); border-color: var(--border-light); cursor: not-allowed; opacity: 0.7; }

        /* "..." Separator Fix */
        .pagination-wrapper span[aria-disabled="true"]:not([aria-label]) > span { background: transparent; border: none; opacity: 1; color: var(--text-muted); }

        /* Standardize Arrow SVGs */
        .pagination-wrapper svg { width: 1.25rem !important; height: 1.25rem !important; display: block; }

        /* Modals - Mobile First */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(15, 23, 42, 0.75); backdrop-filter: blur(4px); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 1rem; }
        .modal-box { position: relative; background-color: var(--card-bg); border-radius: 1rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); width: 100%; max-width: 28rem; max-height: 90vh; overflow-y: auto; padding: 2rem; transition: background-color 0.3s ease; border: 1px solid var(--border-light); }
        .modal-title { font-size: 1.5rem; font-weight: 800; color: var(--text-dark); margin-top: 0; margin-bottom: 0.75rem; transition: color 0.3s ease; }
        .modal-text { margin-bottom: 2rem; color: var(--text-muted); font-size: 0.95rem; line-height: 1.5; transition: color 0.3s ease; }
        
        .modal-actions { display: flex; flex-direction: column; gap: 0.75rem; width: 100%; }
        .modal-actions button, .modal-actions .btn { width: 100%; margin: 0; }

        /* --------------------------------------------------- */
        /* Responsive Overrides                                */
        /* --------------------------------------------------- */
        
        /* Mobile Breakpoint for Pagination */
        @media (max-width: 639px) {
            .pagination-wrapper nav .hidden { display: none !important; }
            .pagination-wrapper nav .sm\:hidden { display: flex; width: 100%; justify-content: space-between; }
        }

        /* Desktop & Tablet Overrides */
        @media (min-width: 768px) {
            .content-panel { padding: 2rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            
            /* Align Add button and Checkbox inline */
            .action-container { flex-direction: row; justify-content: space-between; align-items: center; }
            .auto-reload-label { width: auto; padding: 0; justify-content: flex-end; }
            
            /* Un-stretch buttons on desktop */
            .btn { width: auto; }
            
            /* Filter Row */
            .filter-section { flex-direction: row; align-items: flex-end; width: auto; background: transparent; padding: 0; border: none; }
            .form-group { width: 250px; }
            .filter-container { width: auto; margin-top: 0; }
            
            /* Pagination Layout */
            .pagination-wrapper nav { flex-direction: row; justify-content: space-between; }
            .pagination-wrapper nav > div.sm\:hidden { display: none !important; }
            .pagination-wrapper nav > div.hidden.sm\:flex-1 { display: flex !important; width: 100%; justify-content: space-between; align-items: center; }

            /* Modal formatting */
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

                    @if (!auth()->user()->hasRole('DBRT'))
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
                    @endif
                    
                    @if (!auth()->user()->hasRole('DBRT'))
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
                    @endif

                    <div class="filter-container">
                        <button type="submit" class="btn btn-indigo">
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
                                <th>Time Period</th>
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
                                            elseif ($notification->status === 'For Reporting to NPC') $badgeClass = 'status-npc';
                                            elseif ($notification->status === 'Reported') $badgeClass = 'status-reported';
                                        @endphp
                                        <span class="badge {{ $badgeClass }}">
                                            {{ $notification->status }}
                                        </span>
                                    </td>

                                    <td>
                                        {{-- ======================================================== --}}
                                        {{-- PHASE 1: Active 24-Hour Timer (Pending / For Assessment) --}}
                                        {{-- ======================================================== --}}
                                        @if(in_array($notification->status, ['For Assessment', 'Pending']))
                                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 2px; text-transform: uppercase; font-weight: 700;">Assessment (24h)</div>
                                            @php
                                                $deadline = \Carbon\Carbon::parse($notification->created_at)->addHours(24);
                                            @endphp
                                            <span class="incident-countdown font-semibold" data-deadline="{{ $deadline->toIso8601String() }}" style="color: var(--text-muted);">
                                                <i class="fa-solid fa-spinner fa-spin"></i> Loading...
                                            </span>


                                        {{-- ======================================================== --}}
                                        {{-- PHASE 2: Frozen 24h Math + Active 48h Timer (For Eval)   --}}
                                        {{-- ======================================================== --}}
                                        @elseif($notification->status === 'For Evaluation')
                                            
                                            {{-- 1. Frozen 24-Hour Math --}}
                                            @php
                                                $rem24 = $notification->time_countdown ?? 0;
                                                $elap24 = max(0, (24 * 3600) - $rem24);
                                                
                                                $r24H = str_pad(floor($rem24 / 3600), 2, '0', STR_PAD_LEFT);
                                                $r24M = str_pad(floor(($rem24 % 3600) / 60), 2, '0', STR_PAD_LEFT);
                                                $r24S = str_pad($rem24 % 60, 2, '0', STR_PAD_LEFT);
                                                
                                                $e24H = str_pad(floor($elap24 / 3600), 2, '0', STR_PAD_LEFT);
                                                $e24M = str_pad(floor(($elap24 % 3600) / 60), 2, '0', STR_PAD_LEFT);
                                                $e24S = str_pad($elap24 % 60, 2, '0', STR_PAD_LEFT);
                                            @endphp
                                            
                                            <div style="margin-bottom: 12px; border-bottom: 1px dashed var(--border-light); padding-bottom: 8px;">
                                                <div style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 2px; text-transform: uppercase; font-weight: 700;">Assessment Elapsed</div>
                                                @if($rem24 == 0)
                                                    <span style="color: #ef4444; font-weight: 600; font-size: 0.85rem;"><i class="fa-solid fa-circle-exclamation"></i> Time Expired</span>
                                                @else
                                                    <span style="color: #10b981; font-weight: 600; font-size: 0.85rem; display: block;">
                                                        24h 00m 00s <br> - {{ $r24H }}h {{ $r24M }}m {{ $r24S }}s <br> <b>= {{ $e24H }}h {{ $e24M }}m {{ $e24S }}s</b>
                                                    </span>
                                                @endif
                                            </div>

                                            {{-- 2. Active 48-Hour Timer --}}
                                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 2px; text-transform: uppercase; font-weight: 700;">Evaluation (48h)</div>
                                            @php
                                                $deadline = \Carbon\Carbon::parse($notification->updated_at)->addHours(48);
                                            @endphp
                                            <span class="incident-countdown font-semibold" data-deadline="{{ $deadline->toIso8601String() }}" style="color: var(--text-muted);">
                                                <i class="fa-solid fa-spinner fa-spin"></i> Loading...
                                            </span>


                                        {{-- ======================================================== --}}
                                        {{-- PHASE 3: Assessment Elapsed & Evaluation Discrepancy Math--}}
                                        {{-- ======================================================== --}}
                                        @elseif($notification->status === 'For Reporting to NPC')
                                            
                                            @php
                                                // Calculate Assessment Elapsed
                                                $rem24 = $notification->time_countdown ?? 0;
                                                $elap24 = max(0, (24 * 3600) - $rem24);
                                                $e24H = str_pad(floor($elap24 / 3600), 2, '0', STR_PAD_LEFT);
                                                $e24M = str_pad(floor(($elap24 % 3600) / 60), 2, '0', STR_PAD_LEFT);
                                                $e24S = str_pad($elap24 % 60, 2, '0', STR_PAD_LEFT);

                                                // Calculate Evaluation Elapsed (Using your new column name)
                                                $remEval = $notification->evaluation_time_countdown ?? 0;
                                                $elapEval = max(0, (48 * 3600) - $remEval);
                                                $eEvalH = str_pad(floor($elapEval / 3600), 2, '0', STR_PAD_LEFT);
                                                $eEvalM = str_pad(floor(($elapEval % 3600) / 60), 2, '0', STR_PAD_LEFT);
                                                $eEvalS = str_pad($elapEval % 60, 2, '0', STR_PAD_LEFT);

                                                // Calculate Total Elapsed (Assessment + Evaluation)
                                                $totElap = $elap24 + $elapEval;
                                                $totElapH = str_pad(floor($totElap / 3600), 2, '0', STR_PAD_LEFT);
                                                $totElapM = str_pad(floor(($totElap % 3600) / 60), 2, '0', STR_PAD_LEFT);
                                                $totElapS = str_pad($totElap % 60, 2, '0', STR_PAD_LEFT);

                                                // Calculate Discrepancy (48h - Total Elapsed)
                                                $totalLimit = 48 * 3600;
                                                $totRem = max(0, $totalLimit - $totElap);
                                                $totRemH = str_pad(floor($totRem / 3600), 2, '0', STR_PAD_LEFT);
                                                $totRemM = str_pad(floor(($totRem % 3600) / 60), 2, '0', STR_PAD_LEFT);
                                                $totRemS = str_pad($totRem % 60, 2, '0', STR_PAD_LEFT);
                                            @endphp
                                            
                                            {{-- Display Assessment Elapsed --}}
                                            <div style="margin-bottom: 8px; border-bottom: 1px dashed var(--border-light); padding-bottom: 6px;">
                                                <div style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 2px; text-transform: uppercase; font-weight: 700;">Assessment Elapsed</div>
                                                <span style="color: var(--text-dark); font-weight: 600; font-size: 0.85rem;">{{ $e24H }}h {{ $e24M }}m {{ $e24S }}s</span>
                                            </div>

                                            {{-- Display Evaluation Elapsed and 48h Discrepancy Math --}}
                                            <div style="margin-bottom: 8px;">
                                                <div style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 2px; text-transform: uppercase; font-weight: 700;">Evaluation Elapsed</div>
                                                <span style="color: var(--text-dark); font-weight: 600; font-size: 0.85rem; display: block; margin-bottom: 4px;">{{ $eEvalH }}h {{ $eEvalM }}m {{ $eEvalS }}s</span>
                                                
                                                @if($totElap >= $totalLimit)
                                                    <span style="color: #ef4444; font-weight: 600; font-size: 0.85rem; display: block;">
                                                        <i class="fa-solid fa-circle-exclamation"></i> 48h Limit Exceeded
                                                    </span>
                                                @else
                                                    <span style="color: #10b981; font-weight: 600; font-size: 0.85rem; display: block;">
                                                        48h 00m 00s <br> - {{ $totElapH }}h {{ $totElapM }}m {{ $totElapS }}s <br> <b>= {{ $totRemH }}h {{ $totRemM }}m {{ $totRemS }}s</b>
                                                    </span>
                                                @endif
                                            </div>

                                            {{-- Display Action Taken (Restored per your request) --}}
                                            <span class="badge status-reported" style="margin-top: 4px;">
                                                <i class="fa-solid fa-check"></i> Action Taken
                                            </span>


                                        {{-- ======================================================== --}}
                                        {{-- PHASE 4: Completely Reported (Show Date and Action Taken)--}}
                                        {{-- ======================================================== --}}
                                        @elseif($notification->status === 'Reported')
                                            
                                            <div style="font-size: 0.75rem; color: var(--text-muted); margin-bottom: 2px; text-transform: uppercase; font-weight: 700;">Date Reported</div>
                                            <div style="font-weight: 600; font-size: 0.85rem; color: var(--text-dark); margin-bottom: 6px;">
                                                {{ \Carbon\Carbon::parse($notification->updated_at)->format('M d, Y h:i A') }}
                                            </div>
                                            
                                            <span class="badge status-reported" style="margin-top: 4px;">
                                                <i class="fa-solid fa-check"></i> Action Taken
                                            </span>

                                        @endif
                                    </td>
                                    
                                    <td>
                                        <div class="action-group">
                                            
                                            @can('view_databreach')
                                                <a href="{{ route('databreach.show', $notification->dbn_id) }}" class="action-link link-blue">
                                                    <i class="fa-solid fa-eye"></i> View
                                                </a>
                                            @endcan

                                            @can('assess_databreach')
                                                @if (!in_array($notification->status, ['Reported', 'For Evaluation', 'For Reporting to NPC']) && (auth()->user()->email === $notification->email || auth()->user()->hasRole('Super Admin')))
                                                    @php
                                                        // Ensure we have a deadline available for the JavaScript check
                                                        $hours = $notification->time_countdown ?? 24;
                                                        $deadline = \Carbon\Carbon::parse($notification->created_at)->addHours($hours);
                                                    @endphp
                                                    {{-- The href points to the route, but the onclick intercepts it --}}
                                                    <a href="{{ route('databreach.assess', $notification->dbn_id) }}" 
                                                       class="action-link link-yellow assess-btn"
                                                       data-deadline="{{ $deadline->toIso8601String() }}">
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
                                                    <button @click="open = true" type="button" class="action-link link-red">
                                                        <i class="fa-solid fa-paper-plane"></i> Report
                                                    </button>
                                                    
                                                    <div x-show="open" x-transition.opacity class="modal-overlay" x-cloak>
                                                        <div class="modal-box" @click.away="open = false" x-transition.scale.origin.bottom>
                                                            <h2 class="modal-title">Confirm Report</h2>
                                                            <p class="modal-text">Are you sure you want to report this incident to the National Privacy Commission (NPC)? This action cannot be undone.</p>
                                                            
                                                            <div class="modal-actions">
                                                                <button @click="open = false" type="button" class="btn btn-gray">
                                                                    Cancel
                                                                </button>
                                                                
                                                                <form method="POST" action="{{ route('databreach.report_to_npc', $notification->dbn_id) }}" style="margin: 0; display: inline;">
                                                                    @csrf
                                                                    @method('PATCH')
                                                                    <button type="submit" class="btn btn-green">
                                                                        Confirm Report
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
                                    <td colspan="9" class="text-center" style="padding: 3rem; color: var(--text-muted); font-size: 1rem;">
                                        No Incident Reports found.
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

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{!! addslashes(session("success")) !!}',
                    timer: 3000,
                    showConfirmButton: false,
                    background: getComputedStyle(document.body).getPropertyValue('--card-bg').trim(),
                    color: getComputedStyle(document.body).getPropertyValue('--text-dark').trim()
                });
            @endif

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

            // === COUNTDOWN TIMERS (Handles both 24h and 48h) ===
            const timers = document.querySelectorAll('.incident-countdown');

            function updateCountdowns() {
                const now = new Date().getTime();

                timers.forEach(timer => {
                    const deadlineStr = timer.getAttribute('data-deadline');
                    if (!deadlineStr) return;

                    const deadline = new Date(deadlineStr).getTime();
                    const distance = deadline - now;

                    // If the time has completely run out
                    if (distance < 0) {
                        timer.innerHTML = "<i class='fa-solid fa-circle-exclamation'></i> Time Expired";
                        timer.style.color = "#ef4444"; 
                        return;
                    }

                    // Removed the modulo 24 limit so hours can count above 24 (up to 48)
                    const hours = Math.floor(distance / (1000 * 60 * 60));
                    const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    const h = String(hours).padStart(2, '0');
                    const m = String(minutes).padStart(2, '0');
                    const s = String(seconds).padStart(2, '0');

                    timer.innerHTML = `<i class="fa-regular fa-clock"></i> ${h}h ${m}m ${s}s`;
                    
                    // Visual warnings based on time left
                    if (hours < 2) {
                        timer.style.color = "#ef4444"; // Red for < 2 hours
                    } else if (hours < 12) {
                        timer.style.color = "#f59e0b"; // Orange for < 12 hours
                    } else {
                        timer.style.color = "#10b981"; // Green otherwise
                    }
                });
            }

            if (timers.length > 0) {
                updateCountdowns();
                setInterval(updateCountdowns, 1000);
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
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        background: getComputedStyle(document.body).getPropertyValue('--card-bg').trim(),
                        color: getComputedStyle(document.body).getPropertyValue('--text-dark').trim()
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