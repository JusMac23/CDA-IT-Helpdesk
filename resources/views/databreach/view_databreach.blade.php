<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    @can('view_databreach')
    <style>
        /* Action Bar & Container */
        .action-bar { 
            display: flex; 
            justify-content: flex-end; /* Aligns contents to the right */
            align-items: end; 
            gap: 1rem; /* Adds space between the buttons */
            max-width: 48rem; 
            margin: 0 auto 1rem auto; 
        }
        .view-wrapper { max-width: 48rem; margin: 0 auto; background: #ffffff; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); padding: 2rem; border: 1px solid var(--border-color, #e5e7eb); }

        /* Buttons */
        .btn-download { display: inline-flex; align-items: center; padding: 0.5rem 1rem; border-radius: 0.375rem; background-color: #16a34a; color: white; font-size: 0.875rem; font-weight: 500; transition: background-color 0.2s; border: none; text-decoration: none; }
        .btn-download:hover { background-color: #15803d; }
        .btn-download i { margin-right: 0.5rem; font-size: 1rem; }

        /* Typography & Layout */
        .report-title { font-size: 1.5rem; font-weight: 800; color: var(--text-main, #1f2937); text-align: center; margin-top: 0; margin-bottom: 2rem; }
        .section-title { font-size: 1.125rem; font-weight: 700; color: var(--text-main, #1f2937); margin-bottom: 1rem; text-align: center; }
        .content-group { margin-bottom: 1.5rem; padding: 0 1rem; text-align: left; }
        .content-label { font-weight: 600; color: #374151; margin-bottom: 0.5rem; display: block; }
        .content-text { color: var(--text-main, #1f2937); line-height: 1.5; margin: 0; }
        
        .list-clean { list-style: none; padding-left: 0; margin: 0; }
        .list-clean li { margin-bottom: 0.25rem; color: var(--text-main, #1f2937); }

        /* Table Styling */
        .table-responsive { overflow-x: auto; padding: 0 1rem; margin-bottom: 1.5rem; }
        .table-fixed-force { table-layout: fixed; width: 100%; border-collapse: collapse; border-spacing: 0; border: 1px solid #d1d5db; min-width: 500px; }
        .table-fixed-force col { width: 50%; }
        .table-fixed-force th, .table-fixed-force td { width: 50%; border: 1px solid #d1d5db; white-space: normal; overflow-wrap: anywhere; word-break: break-word; box-sizing: border-box; padding: 0.75rem 1rem; font-size: 0.875rem; }
        .table-fixed-force th { background: #f9fafb; font-weight: 600; color: #374151; }
        .table-fixed-force td { color: #1f2937; background-color: #ffffff; }

        @media(min-width: 640px) {
            .report-title { font-size: 1.875rem; }
            .view-wrapper { padding: 3rem; }
        }
    </style>

    <div id="main-content" style="transition: all 0.3s ease-in-out;">

        <div class="action-bar">
            @can('generate_databreach')
            <a href="{{ route('databreach.generatePdf', $notification->dbn_id) }}" class="btn-download">
                <i class="fas fa-download"></i> Download
            </a>
            @endcan
        </div>

        <div class="view-wrapper">
            <h1 class="report-title">DATA BREACH INCIDENT REPORT</h1>

            <div style="text-align: center; margin-bottom: 2rem;">
                <h2 class="section-title">Facts / Scenario:</h2>
                <p class="content-text" style="padding: 0 0.5rem;">
                    {{ $notification->brief_summary }}
                </p>
            </div>

            <div style="margin-bottom: 2.5rem;">
                <h2 class="section-title">NOTIFICATION TYPE</h2>

                <div class="table-responsive">
                    <table class="table-fixed-force">
                        <tbody>
                            <tr>
                                <th>PIC</th>
                                <td>{{ $notification->pic }}</td>
                            </tr>
                            <tr>
                                <th>Email Address</th>
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

                <div class="content-group">
                    <span class="content-label">Assistance Provided to Data Subject:</span>
                    <p class="content-text">{{ $notification->actions_to_inform ?? 'N/A' }}</p>
                </div>

                @if(!empty($notification->notification_type_description))
                    @php
                        $types = json_decode($notification->notification_type_description, true);
                        if (is_null($types)) {
                            $types = explode(',', $notification->notification_type_description);
                        }
                    @endphp

                    <div class="content-group">
                        <span class="content-label">Notification Type Description:</span>
                        <ul class="list-clean">
                            @foreach($types as $type)
                                <li>☑ {{ trim($type, ' "[]') }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>

            <div style="margin-bottom: 2.5rem;">
                <h2 class="section-title">DATA BREACH NOTIFICATION DETAILS</h2>

                <div class="table-responsive">
                    <table class="table-fixed-force">
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
                                <td>{{ $notification->notification_type }}</td>
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
                                <th>With Request (YES/NO)</th>
                                <td>{{ $notification->with_request }}</td>
                            </tr>
                            <tr>
                                <th>Justification for Request</th>
                                <td>{{ $notification->num_records_provide_details ?? 'N/A' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="content-group">
                    <span class="content-label">How the Breach Occurred + DPS Vulnerability:</span>
                    <p class="content-text">{{ $notification->how_breach_occured }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Chronology of the Events:</span>
                    <p class="content-text" style="white-space: pre-line;">{{ $notification->chronology }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Number of Data Subjects / Records:</span>
                    <p class="content-text">{{ $notification->num_records }} records @if($notification->hundred_plus) (≥100) @endif</p>
                    <p class="content-text">{{ $notification->num_records_provide_details }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Description / Nature of the Personal Data Breach:</span>
                    <p class="content-text">{{ $notification->description_nature }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Likely Consequences:</span>
                    <p class="content-text">{{ $notification->likely_consequences }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">DPO Details:</span>
                    <p class="content-text">{{ $notification->dpo }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Types of Sensitive Personal Information Involved:</span>
                    <p class="content-text">{{ $notification->spi }}</p>
                </div>

                <div class="content-group">
                    <span class="content-label">Other Information That May Enable Identity Fraud:</span>
                    <p class="content-text">{{ $notification->other_info }}</p>
                </div>
            </div>

            <div style="margin-bottom: 2.5rem;">
                <h2 class="section-title">MEASURES TAKEN TO ADDRESS THE BREACH</h2>
                
                <div class="content-group">
                    <span class="content-label">Measures to address breach:</span>
                    <p class="content-text">{{ $notification->measures_to_address }}</p>
                </div>
                
                <div class="content-group">
                    <span class="content-label">Measures to secure / recover personal data:</span>
                    <p class="content-text">{{ $notification->measures_to_secure }}</p>
                </div>
                
                <div class="content-group">
                    <span class="content-label">Actions to mitigate harm:</span>
                    <p class="content-text">{{ $notification->actions_to_mitigate }}</p>
                </div>
                
                <div class="content-group">
                    <span class="content-label">Actions to inform data subjects:</span>
                    <p class="content-text">{{ $notification->actions_to_inform }}</p>
                </div>
                
                <div class="content-group">
                    <span class="content-label">Measures to prevent recurrence:</span>
                    <p class="content-text">{{ $notification->actions_to_prevent }}</p>
                </div>
            </div>

            <div>
                <h2 class="section-title">RECORD TYPE & DATA SUBJECTS</h2>
                
                <div class="content-group">
                    <span class="content-label">Record Type:</span>
                    <p class="content-text">{{ $notification->record_type }}</p>
                    
                    <span class="content-label" style="margin-top: 1rem;">Data Subjects:</span>
                    <ul class="list-clean">
                        @foreach(explode(',', $notification->data_subjects) as $subject)
                            <li>☑ {{ trim($subject) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>
    </div>
    @endcan    
</x-app-layout>