<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    
    @can('view_databreach')
    <style>
        /* --- Theme Variables --- */
        :root {
            --card-bg: #ffffff;
            --bg-alt: #f8fafc;
            --text-dark: #0f172a;
            --text-main: #334155;
            --text-muted: #64748b;
            --border-light: #e2e8f0;
            --border-subtle: #f1f5f9;
            
            /* Badges & Status Text */
            --badge-rep-bg: #eff6ff;
            --badge-rep-text: #1e40af;
            --text-success: #166534;
            --text-danger: #991b1b;

            /* Close Button */
            --close-btn-hover: #f1f5f9;
            --close-btn-text: #94a3b8;
        }

        body.dark {
            --card-bg: #0f172a; 
            --bg-alt: #1e293b; 
            --text-dark: #f8fafc;
            --text-main: #e2e8f0;
            --text-muted: #9ca3af;
            --border-light: #334155; 
            --border-subtle: #1e293b;
            
            /* Badges & Status Text - Dark */
            --badge-rep-bg: rgba(30, 58, 138, 0.4);
            --badge-rep-text: #60a5fa;
            --text-success: #4ade80;
            --text-danger: #f87171;

            /* Close Button - Dark */
            --close-btn-hover: #1e293b;
            --close-btn-text: #64748b;
        }

        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; transition: background-color 0.3s ease, color 0.3s ease; }

        /* Action Bar */
        .action-bar { display: flex; justify-content: flex-end; align-items: center; gap: 1rem; max-width: 56rem; margin: 0 auto 1.5rem auto; padding: 0 0.5rem; }
        
        /* Main Document Wrapper */
        .view-wrapper { position: relative; max-width: 56rem; margin: 0 auto; background-color: var(--card-bg); border-radius: 1rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.05), 0 4px 6px -2px rgba(0,0,0,0.025); padding: 2rem; border: 1px solid var(--border-light); transition: background-color 0.3s ease, border-color 0.3s ease; }

        /* Close Button */
        .close-btn { position: absolute; top: 1.5rem; right: 1.5rem; color: var(--close-btn-text); font-size: 2.25rem; background: none; border: none; cursor: pointer; transition: all 0.2s; line-height: 1; border-radius: 0.25rem; padding: 0.25rem 0.5rem; }
        .close-btn:hover { color: var(--text-dark); }

        /* --- Unified Buttons --- */
        .btn { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 1.5rem; border-radius: 0.5rem; font-size: 0.95rem; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s ease; text-decoration: none; font-family: inherit; }
        .btn i { margin-right: 0.5rem; font-size: 1rem; }

        /* Modern Green */
        .btn-green { background-color: #10b981; color: white; box-shadow: 0 1px 2px rgba(16, 185, 129, 0.2); }
        .btn-green:hover { background-color: #059669; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); color: white; }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(16, 185, 129, 0.2); }

        /* Typography & Layout */
        .report-title { font-size: 1.75rem; font-weight: 800; color: var(--text-dark); text-align: center; margin-top: 0; margin-bottom: 2.5rem; letter-spacing: -0.025em; transition: color 0.3s ease; padding: 0 2.5rem; } /* Added padding to prevent close btn overlap */
        
        .section-title { font-size: 1.15rem; font-weight: 700; color: var(--text-dark); margin-bottom: 1.25rem; border-bottom: 2px solid var(--border-light); padding-bottom: 0.75rem; text-transform: uppercase; letter-spacing: 0.05em; transition: color 0.3s ease, border-color 0.3s ease; }
        
        .content-group { margin-bottom: 1.75rem; padding: 0 0.5rem; }
        .content-label { font-size: 0.85rem; font-weight: 700; color: var(--text-muted); margin-bottom: 0.5rem; display: block; text-transform: uppercase; letter-spacing: 0.05em; transition: color 0.3s ease; }
        .content-text { color: var(--text-main); font-size: 1rem; line-height: 1.6; font-weight: 500; margin: 0; background-color: var(--bg-alt); padding: 1rem 1.25rem; border-radius: 0.5rem; border: 1px solid var(--border-subtle); transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease; }
        
        .text-centered { text-align: center; }
        .text-centered .content-text { background: transparent; border: none; padding: 0; font-size: 1.05rem; }

        /* Lists */
        .list-clean { list-style: none; padding-left: 0; margin: 0; background-color: var(--bg-alt); padding: 1rem 1.25rem; border-radius: 0.5rem; border: 1px solid var(--border-subtle); transition: background-color 0.3s ease, border-color 0.3s ease; }
        .list-clean li { margin-bottom: 0.5rem; color: var(--text-main); font-weight: 500; display: flex; align-items: flex-start; gap: 0.5rem; line-height: 1.5; transition: color 0.3s ease; }
        .list-clean li:last-child { margin-bottom: 0; }
        .list-clean i { color: #4f46e5; margin-top: 0.2rem; font-size: 0.9rem; }

        /* Modern Table Styling */
        .table-responsive { overflow-x: auto; margin-bottom: 2.5rem; border-radius: 0.75rem; border: 1px solid var(--border-light); box-shadow: 0 1px 2px rgba(0,0,0,0.02); transition: border-color 0.3s ease; }
        .info-table { width: 100%; border-collapse: collapse; min-width: 500px; table-layout: fixed; }
        .info-table th, .info-table td { padding: 1rem 1.25rem; font-size: 0.95rem; border-bottom: 1px solid var(--border-light); vertical-align: top; word-break: break-word; transition: border-color 0.3s ease; }
        .info-table th { width: 35%; background-color: var(--bg-alt); font-weight: 700; color: var(--text-muted); border-right: 1px solid var(--border-light); transition: background-color 0.3s ease, color 0.3s ease; }
        .info-table td { width: 65%; color: var(--text-dark); font-weight: 500; background-color: var(--card-bg); transition: background-color 0.3s ease, color 0.3s ease; }
        .info-table tr:last-child th, .info-table tr:last-child td { border-bottom: none; }

        /* Status Badges */
        .badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.8rem; font-weight: 700; text-align: center; white-space: nowrap; letter-spacing: 0.025em; transition: background-color 0.3s ease, color 0.3s ease; }
        .status-reported { background-color: var(--badge-rep-bg); color: var(--badge-rep-text); }

        @media(min-width: 640px) {
            .report-title { font-size: 2rem; }
            .view-wrapper { padding: 3rem; }
            .close-btn { top: 1.5rem; right: 2rem; }
        }
    </style>

    <div id="main-content" class="page-wrapper">

        <div class="action-bar">
            @can('generate_databreach')
            <a href="{{ route('databreach.generatePdf', $notification->dbn_id) }}" class="btn btn-green">
                <span class="material-symbols-outlined" style="font-size: 1.25rem; margin-right: 0.2rem;">download</span> Download PDF
            </a>
            @endcan
        </div>

        <div class="view-wrapper">
            
            <button id="close" onclick="window.location.href='{{ route('databreach.index') }}'" class="close-btn" aria-label="Close form" title="Close">
                &times;
            </button>

            <h1 class="report-title">DATA BREACH INCIDENT REPORT</h1>

            <div class="content-group text-centered" style="margin-bottom: 2.5rem;">
                <span class="content-label" style="justify-content: center; display: flex;">Brief Summary / Scenario</span>
                <p class="content-text">
                    {{ $notification->brief_summary }}
                </p>
            </div>

            <div style="margin-bottom: 3rem;">
                <h2 class="section-title">A. Notification Overview</h2>

                <div class="table-responsive">
                    <table class="info-table">
                        <tbody>
                            <tr>
                                <th>DBN Number</th>
                                <td><strong>{{ $notification->dbn_number }}</strong></td>
                            </tr>
                            <tr>
                                <th>Personal Information Controller (PIC)</th>
                                <td>{{ $notification->pic }}</td>
                            </tr>
                            <tr>
                                <th>PIC Email Address</th>
                                <td>{{ $notification->email }}</td>
                            </tr>
                            <tr>
                                <th>Representative</th>
                                <td>{{ $notification->representative }}</td>
                            </tr>
                            <tr>
                                <th>Representative Email</th>
                                <td>{{ $notification->representative_email_address }}</td>
                            </tr>
                            <tr>
                                <th>Date/Time of Occurrence</th>
                                <td>{{ $notification->date_occurrence->format('F d, Y – h:i A') }}</td>
                            </tr>
                            <tr>
                                <th>Date/Time of Discovery</th>
                                <td>{{ $notification->date_discovery->format('F d, Y – h:i A') }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                @if(!empty($notification->notification_type_description))
                    @php
                        $types = json_decode($notification->notification_type_description, true);
                        if (is_null($types)) {
                            $types = explode(',', $notification->notification_type_description);
                        }
                    @endphp

                    <div class="content-group">
                        <span class="content-label">Notification Type Description</span>
                        <ul class="list-clean">
                            @foreach($types as $type)
                                <li><i class="fas fa-check-circle"></i> {{ trim($type, ' "[]') }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div style="margin-bottom: 3rem;">
                <h2 class="section-title">B. Data Breach Details</h2>

                <div class="table-responsive">
                    <table class="info-table">
                        <tbody>
                            <tr>
                                <th>Sector Name</th>
                                <td>{{ $notification->sector_name }}</td>
                            </tr>
                            <tr>
                                <th>Subsector Name</th>
                                <td>{{ $notification->subsector_name }}</td>
                            </tr>
                            <tr>
                                <th>Type of Notification</th>
                                <td>
                                    <span class="badge status-reported">
                                        {{ $notification->notification_type }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>General Cause</th>
                                <td>{{ $notification->general_cause }}</td>
                            </tr>
                            <tr>
                                <th>Specific Cause</th>
                                <td>{{ $notification->specific_cause }}</td>
                            </tr>
                            <tr>
                                <th>General Incident</th>
                                <td>{{ $notification->general_incident }}</td>
                            </tr>
                            <tr>
                                <th>With Request?</th>
                                <td>
                                    @if(strtoupper($notification->with_request) === 'YES')
                                        <span style="color: var(--text-success); font-weight: 700; transition: color 0.3s ease;"><i class="fas fa-check mr-1"></i> YES</span>
                                    @else
                                        <span style="color: var(--text-danger); font-weight: 700; transition: color 0.3s ease;"><i class="fas fa-times mr-1"></i> NO</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Justification for Request</th>
                                <td>{{ $notification->num_records_provide_details ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="content-group">
                    <span class="content-label">How the Breach Occurred & DPS Vulnerability</span>
                    <p class="content-text">{{ $notification->how_breach_occured }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Chronology of Events</span>
                    <p class="content-text" style="white-space: pre-line;">{{ $notification->chronology }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Number of Data Subjects / Records</span>
                    <div class="content-text">
                        <p style="margin: 0 0 0.5rem 0;"><strong>Count:</strong> {{ $notification->num_records }} records @if($notification->hundred_plus) (≥100) @endif</p>
                        <p style="margin: 0; padding-top: 0.5rem; border-top: 1px solid var(--border-light); transition: border-color 0.3s ease;">{{ $notification->num_records_provide_details }}</p>
                    </div>
                </div>

                <div class="content-group">
                    <span class="content-label">Description / Nature of the Personal Data Breach</span>
                    <p class="content-text">{{ $notification->description_nature }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Likely Consequences</span>
                    <p class="content-text">{{ $notification->likely_consequences }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Data Protection Officer (DPO) Details</span>
                    <p class="content-text" style="white-space: pre-line;">{{ $notification->dpo }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Types of Sensitive Personal Information Involved</span>
                    <p class="content-text">{{ $notification->spi }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Other Information That May Enable Identity Fraud</span>
                    <p class="content-text">{{ $notification->other_info }}</p>
                </div>
            </div>

            <div style="margin-bottom: 3rem;">
                <h2 class="section-title">C. Measures Taken to Address the Breach</h2>
                
                <div class="content-group">
                    <span class="content-label">Measures Taken to Address the Breach</span>
                    <p class="content-text">{{ $notification->measures_to_address }}</p>
                </div>
                
                <div class="content-group">
                    <span class="content-label">Measures to Secure / Recover Personal Data</span>
                    <p class="content-text">{{ $notification->measures_to_secure }}</p>
                </div>
                
                <div class="content-group">
                    <span class="content-label">Actions to Mitigate Harm</span>
                    <p class="content-text">{{ $notification->actions_to_mitigate }}</p>
                </div>
                
                <div class="content-group">
                    <span class="content-label">Actions to Inform Data Subjects / Assistance Provided</span>
                    <p class="content-text">{{ $notification->actions_to_inform ?? 'N/A' }}</p>
                </div>
                
                <div class="content-group">
                    <span class="content-label">Measures to Prevent Recurrence</span>
                    <p class="content-text">{{ $notification->actions_to_prevent }}</p>
                </div>
            </div>

            <div>
                <h2 class="section-title">D. Record Type & Data Subjects</h2>
                
                <div class="content-group">
                    <span class="content-label">Record Type</span>
                    <p class="content-text">{{ $notification->record_type }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Affected Data Subjects</span>
                    <ul class="list-clean">
                        @foreach(explode(',', $notification->data_subjects) as $subject)
                            <li><i class="fas fa-check-circle"></i> {{ trim($subject) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
    @endcan    
</x-app-layout>