<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Main Layout */
        .container { max-width: 80rem; margin: 0 auto; padding: 0 2rem; }
        @media (max-width: 640px) { .container { padding: 0.5rem; } }

        /* Form Card */
        .form-card { background-color: #ffffff; border-radius: 1rem; border: 1px solid #e5e7eb; box-shadow: 0 1px 2px rgba(0,0,0,0.05); padding: 2rem; position: relative; transition: all 0.3s ease; }
        @media (max-width: 640px) { .form-card { padding: 1.5rem; border-radius: 0.75rem; } }

        /* Header */
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem; }
        .form-title { font-size:1.5rem; font-weight:700; margin-bottom:2.5rem; border-bottom:2px solid #e5e7eb; padding-bottom:1rem; }
        .close-btn { position:absolute; top:1.5rem; right:2rem; color:var(--text-muted); font-size:1.5rem; background:none; border:none; cursor:pointer; transition:color 0.2s; }
        .close-btn:hover { color:var(--text-main); }

        /* Error Box */
        .error-box { background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 1rem 1.5rem; border-radius: 0.75rem; margin-bottom: 2rem; display: flex; gap: 0.75rem; align-items: flex-start; }
        .error-icon { font-size: 1.5rem; margin-top: 0.125rem; }
        .error-title { font-weight: 600; font-size: 0.875rem; margin: 0 0 0.5rem 0; }
        .error-list { list-style-type: disc; padding-left: 1.25rem; margin: 0; font-size: 0.875rem; line-height: 1.5; }

        /* Grid Layouts */
        .grid-2 { display: grid; grid-template-columns: 1fr; gap: 1.5rem; margin-top: 1.5rem; }
        @media (min-width: 768px) { .grid-2 { grid-template-columns: repeat(2, 1fr); } }

        /* Form Controls */
        .form-group { display: flex; flex-direction: column; margin-top: 1.5rem; }
        .grid-2 .form-group { margin-top: 0; }
        .form-label { font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.25rem; }
        .form-label-lg { font-size: 1.125rem; font-weight: 600; color: #1f2937; margin-bottom: 0.5rem; display: block; }
        .required-mark { color: #ef4444; }
        
        .form-input, .form-select, .form-textarea { width: 100%; border: 1px solid #d1d5db; border-radius: 0.75rem; padding: 0.75rem 1rem; font-size: 1rem; box-sizing: border-box; background-color: #ffffff; transition: border-color 0.2s, box-shadow 0.2s; font-family: inherit; }
        .form-input:focus, .form-select:focus, .form-textarea:focus { outline: none; border-color: #6366f1; box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2); }
        .form-textarea { resize: none; min-height: 100px; }
        .form-input[readonly], .readonly-box { background-color: #f3f4f6; color: #4b5563; cursor: not-allowed; }
        .form-input[readonly]:focus { border-color: #d1d5db; box-shadow: none; }
        
        .readonly-box { border: 1px solid #d1d5db; border-radius: 0.75rem; padding: 0.75rem 1rem; width: 100%; box-sizing: border-box; }
        .readonly-box p { margin: 0 0 0.25rem 0; }
        .readonly-box p:last-child { margin: 0; }

        /* Validation Error State */
        .input-error { border-color: #ef4444 !important; }

        /* Checkboxes and Radios */
        .checkbox-group { display: flex; flex-direction: column; gap: 0.75rem; }
        .checkbox-label { display: flex; align-items: flex-start; gap: 0.75rem; font-size: 1rem; color: #374151; cursor: pointer; }
        .checkbox-input { margin-top: 0.25rem; width: 1rem; height: 1rem; accent-color: #4f46e5; cursor: pointer; }
        
        .radio-group { display: flex; align-items: center; gap: 1.5rem; }
        .radio-label { display: flex; align-items: center; gap: 0.5rem; font-size: 1rem; color: #374151; cursor: pointer; }
        .radio-input { width: 1rem; height: 1rem; accent-color: #4f46e5; cursor: pointer; }

        /* Buttons & Footer */
        .page-footer { display: flex; border-top: 1px solid #e5e7eb; margin-top: 2rem; padding-top: 1.5rem; }
        .page-footer.right { justify-content: flex-end; }
        .page-footer.between { justify-content: space-between; align-items: center; gap: 1rem; }
        
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 1.5rem; font-size: 1rem; font-weight: 600; border-radius: 0.75rem; cursor: pointer; border: none; color: white; transition: all 0.3s ease; min-width: 160px; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .btn:hover { transform: scale(1.05); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); }
        .btn-indigo { background-color: #4f46e5; } .btn-indigo:hover { background-color: #4338ca; }
        .btn-red { background-color: #dc2626; } .btn-red:hover { background-color: #b91c1c; }
        
        /* Utility */
        .hidden-page { display: none !important; }
        @media (max-width: 600px) {
            .form-title { font-size: 1.25rem; }
            .form-label-lg { font-size: 1rem; }
             .btn { width: 100%; justify-content: center; }
             .page-footer.between { flex-direction: column; gap: 1rem; }
        }
    </style>

    @can('evaluate_databreach')
    <div id="main-content" class="page-wrapper">
        <div class="container">
            <div class="form-card">

                <button id="close" onclick="window.location.href='{{ route('databreach.index') }}'" class="close-btn" title="Close">
                    <i class="fas fa-times"></i>
                </button>

                <h2 class="form-title">Incident Report Evaluation</h2>

                @if ($errors->any())
                    <div class="error-box">
                        <i class="fas fa-exclamation-circle error-icon"></i>
                        <div>
                            <h4 class="error-title">Please fix the following errors:</h4>
                            <ul class="error-list">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <form action="{{ route('databreach.update_evaluation', $notification->dbn_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div id="page1">

                             <h3 class="form-section-title"></i> A. Notification Type</h3>

                            <div class="form-group" style="margin-top: 0.75rem;">
                                <label for="dbn_number" class="form-label">
                                    DBN Number <span class="required-mark">*</span>
                                </label>
                                <input type="text" id="dbn_number" name="dbn_number"
                                    value="{{ old('dbn_number', $notification->dbn_number) }}"
                                    placeholder="e.g., CDA-DBN-2025-01" required readonly class="form-input">
                            </div>

                            <div class="grid-2">
                                <div class="form-group">
                                    <label for="pic" class="form-label">
                                        Personal Information Controller <span class="required-mark">*</span>
                                    </label>
                                    <select id="pic" name="pic" required class="form-select">
                                        <option value="">-- Select Personal Information Controller --</option>
                                        <option value="CDA HO" {{ old('pic', $notification->pic) == 'CDA HO' ? 'selected' : '' }}>CDA HO</option>
                                        <option value="CDA CAR" {{ old('pic', $notification->pic) == 'CDA CAR' ? 'selected' : '' }}>CDA CAR</option>
                                        <option value="CDA NIR" {{ old('pic', $notification->pic) == 'CDA NIR' ? 'selected' : '' }}>CDA NIR</option>
                                        <option value="CDA NCR" {{ old('pic', $notification->pic) == 'CDA NCR' ? 'selected' : '' }}>CDA NCR</option>
                                        <option value="CDA Region I" {{ old('pic', $notification->pic) == 'CDA Region I' ? 'selected' : '' }}>CDA Region I</option>
                                        <option value="CDA Region II" {{ old('pic', $notification->pic) == 'CDA Region II' ? 'selected' : '' }}>CDA Region II</option>
                                        <option value="CDA Region III" {{ old('pic', $notification->pic) == 'CDA Region III' ? 'selected' : '' }}>CDA Region III</option>
                                        <option value="CDA Region IV-A" {{ old('pic', $notification->pic) == 'CDA Region IV-A' ? 'selected' : '' }}>CDA Region IV-A</option>
                                        <option value="CDA Region IV-B" {{ old('pic', $notification->pic) == 'CDA Region IV-B' ? 'selected' : '' }}>CDA Region IV-B</option>
                                        <option value="CDA Region V" {{ old('pic', $notification->pic) == 'CDA Region V' ? 'selected' : '' }}>CDA Region V</option>
                                        <option value="CDA Region VI" {{ old('pic', $notification->pic) == 'CDA Region VI' ? 'selected' : '' }}>CDA Region VI</option>
                                        <option value="CDA Region VII" {{ old('pic', $notification->pic) == 'CDA Region VII' ? 'selected' : '' }}>CDA Region VII</option>
                                        <option value="CDA Region VIII" {{ old('pic', $notification->pic) == 'CDA Region VIII' ? 'selected' : '' }}>CDA Region VIII</option>
                                        <option value="CDA Region IX" {{ old('pic', $notification->pic) == 'CDA Region IX' ? 'selected' : '' }}>CDA Region IX</option>
                                        <option value="CDA Region X" {{ old('pic', $notification->pic) == 'CDA Region X' ? 'selected' : '' }}>CDA Region X</option>
                                        <option value="CDA Region XI" {{ old('pic', $notification->pic) == 'CDA Region XI' ? 'selected' : '' }}>CDA Region XI</option>
                                        <option value="CDA Region XII" {{ old('pic', $notification->pic) == 'CDA Region XII' ? 'selected' : '' }}>CDA Region XII</option>
                                        <option value="CDA Region XIII" {{ old('pic', $notification->pic) == 'CDA Region XIII' ? 'selected' : '' }}>CDA Region XIII</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="form-label">
                                        Email Address <span class="required-mark">*</span>
                                    </label>
                                    <input type="text" id="email" name="email" value="{{ old('email', $notification->team_email ?? $notification->email) }}" required readonly class="form-input">
                                </div>
                            </div>

                            <div class="grid-2">
                                <div class="form-group">
                                    <label for="representative" class="form-label">
                                        Representative <span class="required-mark">*</span>
                                    </label>
                                    <input type="text" id="representative" name="representative" value="{{ old('representative', $notification->representative) }}" readonly class="form-input">
                                </div>

                                <div class="form-group">
                                    <label for="representative_email_address" class="form-label">
                                        Email Address <span class="required-mark">*</span>
                                    </label>
                                    <input type="text" id="representative_email_address" name="representative_email_address" value="{{ old('representative_email_address', $notification->representative_email_address) }}" readonly class="form-input">
                                </div>
                            </div>

                            <div class="grid-2" style="grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));">
                                <div class="form-group">
                                    <label for="date_occurrence" class="form-label">
                                        Date of Occurrence <span class="required-mark">*</span>
                                    </label>
                                    <input type="datetime-local" id="date_occurrence" name="date_occurrence"
                                        value="{{ old('date_occurrence', $notification->date_occurrence) }}" required class="form-input">
                                </div>
                                <div class="form-group">
                                    <label for="date_discovery" class="form-label">
                                        Date of Discovery <span class="required-mark">*</span>
                                    </label>
                                    <input type="datetime-local" id="date_discovery" name="date_discovery"
                                        value="{{ old('date_discovery', $notification->date_discovery) }}" required class="form-input">
                                </div>
                                <div class="form-group">
                                    <label for="date_notification" class="form-label">
                                        Date of Notification <span class="required-mark">*</span>
                                    </label>
                                    <input type="datetime-local" id="date_notification" name="date_notification"
                                        value="{{ old('date_notification', $notification->date_notification) }}" required readonly class="form-input">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="brief_summary" class="form-label">
                                    Brief Summary of the Incident <span class="required-mark">*</span>
                                </label>
                                <textarea id="brief_summary" name="brief_summary" required rows="4" class="form-textarea">{{ old('brief_summary', $notification->brief_summary) }}</textarea>
                            </div>

                            <div class="form-group">
                                <label class="form-label-lg">Notification Type</label>
                                <div class="checkbox-group">
                                    @php
                                        // Decode JSON manually if still stored as string
                                        $notifTypes = $notification->notification_type_description;
                                        if (is_string($notifTypes)) {
                                            $notifTypes = json_decode($notifTypes, true);
                                        }
                                        $notifTypes = old('notification_type_description', $notifTypes ?? []);
                                    @endphp

                                    @foreach ([
                                        'Involves SPI or Data that may enable identity fraud',
                                        'Acquired by an unauthorized person',
                                        'Likely to give rise to harm to data subjects'
                                    ] as $option)
                                        <label class="checkbox-label">
                                            <input type="checkbox" name="notification_type_description[]" value="{{ $option }}"
                                                {{ is_array($notifTypes) && in_array($option, $notifTypes) ? 'checked' : '' }}
                                                class="checkbox-input">
                                            <span>{{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                        <div class="page-footer right">
                            <button type="button" id="next-page" class="btn btn-indigo">
                                Continue <i class="fas fa-arrow-right" style="margin-left: 0.25rem; margin-right: 0;"></i>
                            </button>
                        </div>
                    </div>

                    <div id="page2" class="hidden-page">

                            <h3 class="form-section-title">B. Data Breach Notification Details</h3>

                            <div style="margin-top: 1rem;">
                                <div class="grid-2">
                                    <div class="form-group">
                                        <label for="sector_name" class="form-label">
                                            Sector Name <span class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="sector_name" name="sector_name" value="{{ old('sector_name', $notification->sector_name) }}" required class="form-input">
                                    </div>

                                    <div class="form-group">
                                        <label for="subsector_name" class="form-label">
                                            Subsector Name <span class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="subsector_name" name="subsector_name" value="{{ old('subsector_name', $notification->subsector_name) }}" required class="form-input">
                                    </div>
                                </div>

                                <div class="grid-2">
                                    <div class="form-group">
                                        <label for="notification_type" class="form-label">
                                            Notification Type <span class="required-mark">*</span>
                                        </label>
                                        <select id="notification_type" name="notification_type" required class="form-select">
                                            <option value="">-- Select Notification Type --</option>
                                            <option value="Mandatory" {{ old('notification_type', $notification->notification_type) == 'Mandatory' ? 'selected' : '' }}>Mandatory</option>
                                            <option value="Voluntary" {{ old('notification_type', $notification->notification_type) == 'Voluntary' ? 'selected' : '' }}>Voluntary</option>
                                            <option value="Others" {{ old('notification_type', $notification->notification_type) == 'Others' ? 'selected' : '' }}>Others</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="timeliness" class="form-label">
                                            Timeliness <span class="required-mark">*</span>
                                        </label>
                                        <input type="text" id="timeliness" name="timeliness" value="{{ old('timeliness', $notification->timeliness) }}" required class="form-input">
                                    </div>
                                </div>

                                <div class="grid-2">
                                    <div class="form-group">
                                        <label for="general_cause" class="form-label">
                                            General Cause <span class="required-mark">*</span>
                                        </label>
                                        <select id="general_cause" name="general_cause" required class="form-select">
                                            <option value="">-- Select General Cause --</option>
                                            @foreach (['Malicious Attack', 'Malicious Attack/Human Error', 'Human Error', 'System Glitch', 'Malicious Attack/System Glitch', 'System Glitch/Human Error', 'Others'] as $cause)
                                                <option value="{{ $cause }}" {{ old('general_cause', $notification->general_cause) == $cause ? 'selected' : '' }}>
                                                    {{ $cause }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="specific_cause" class="form-label">
                                            Specific Cause <span class="required-mark">*</span>
                                        </label>
                                        <select id="specific_cause" name="specific_cause" required class="form-select">
                                            <option value="{{ old('specific_cause', $notification->specific_cause) }}">{{ old('specific_cause', $notification->specific_cause) }}</option>
                                        </select>

                                        <label for="general_incident" class="form-label" style="margin-top: 1rem;">
                                            General Incident <span class="required-mark">*</span>
                                        </label>
                                        <input type="text" name="general_incident" id="general_incident" required readonly
                                            value="{{ old('general_incident', $notification->general_incident) }}" class="form-input">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label">
                                        With Request? <span class="required-mark">*</span>
                                    </label>
                                    <div class="radio-group">
                                        <label class="radio-label">
                                            <input type="radio" name="with_request" value="Yes" class="radio-input" {{ old('with_request', $notification->with_request) == 'Yes' ? 'checked' : '' }}>
                                            <span>Yes</span>
                                        </label>
                                        <label class="radio-label">
                                            <input type="radio" name="with_request" value="No" class="radio-input" {{ old('with_request', $notification->with_request) == 'No' ? 'checked' : '' }}>
                                            <span>No</span>
                                        </label>
                                    </div>
                                </div>

                                @php
                                    $fields = [
                                        'how_breach_occured' => '1.A How Breach Occurred + DPS Vulnerability',
                                        'chronology' => '1.B Chronology',
                                        'num_records' => '1.C Number of Data Subject / Records',
                                        'description_nature' => '1.D Description / Nature',
                                        'likely_consequences' => '1.E Likely Consequences',
                                        'dpo' => '1.F Data Protection Officer (DPO)',
                                        'spi' => '2.A SPI',
                                        'other_info' => '2.B Other Information',
                                        'measures_to_address' => '3.A Measures to Address the Breach',
                                        'measures_to_secure' => '3.B Measures to Secure/Recover Personal Data',
                                        'actions_to_mitigate' => '3.C Actions to Mitigate Harm',
                                        'actions_to_inform' => '3.D Actions to Inform Data Subjects',
                                        'actions_to_prevent' => '3.E Measures to Prevent Recurrence of Incidence',
                                    ];
                                @endphp

                                @foreach ($fields as $name => $label)
                                    <div class="form-group">
                                        <label for="{{ $name }}" class="form-label">
                                            {{ $label }} <span class="required-mark">*</span>
                                        </label>

                                        @if ($name === 'dpo')
                                            {{-- Display DPO name and email as readonly --}}
                                            <div id="{{ $name }}" name="{{ $name }}" class="readonly-box">
                                                <p>{{ $dpoDetails->name }}</p>
                                                <p>{{ $dpoDetails->email }}</p>
                                                <p>{{ $dpoDetails->contact_number }}</p>
                                            </div>
                                        @else
                                            <textarea id="{{ $name }}" name="{{ $name }}" class="form-textarea">{{ old($name, $notification->$name ?? '') }}</textarea>
                                        @endif
                                    </div>

                                    {{-- Insert the extra "Provide Details" field right after 1.C --}}
                                    @if ($name === 'num_records')
                                        <div class="form-group">
                                            <label for="num_records_provide_details" class="form-label">
                                                Number of Records – Provide Details <span class="required-mark">*</span>
                                            </label>
                                            <textarea name="num_records_provide_details" id="num_records_provide_details" rows="3"
                                                class="form-textarea" required>{{ old('num_records_provide_details', $notification->num_records_provide_details ?? '') }}</textarea>
                                            
                                            @error('num_records_provide_details')
                                                <span style="color: #ef4444; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    @endif
                                @endforeach

                                <div class="grid-2">
                                    <div class="form-group">
                                        <label for="record_type" class="form-label">
                                            Record Type <span class="required-mark">*</span>
                                        </label>
                                        <select id="record_type" name="record_type" required class="form-select">
                                            <option value="">-- Select Record Type --</option>
                                            @foreach ([
                                                'Digital Records in Electronic Systems',
                                                'Digital Records in Email',
                                                'Digital Records in Removable Media or Portable Device',
                                                'Physical Records'
                                            ] as $type)
                                                <option value="{{ $type }}" {{ old('record_type', $notification->record_type) == $type ? 'selected' : '' }}>
                                                    {{ $type }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="data_subjects" class="form-label">
                                            Data Subjects <span class="required-mark">*</span>
                                        </label>
                                        <select id="data_subjects" name="data_subjects" required class="form-select">
                                            <option value="">-- Select Data Subjects --</option>
                                            @foreach ([
                                                'Own Employees',
                                                'Customers',
                                                'Personal Data of Vulnerable Groups',
                                                'Others'
                                            ] as $subject)
                                                <option value="{{ $subject }}" {{ old('data_subjects', $notification->data_subjects) == $subject ? 'selected' : '' }}>
                                                    {{ $subject }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        <div class="page-footer between">
                            <button type="button" id="prev-page" class="btn btn-red">
                                <i class="fas fa-arrow-left" style="margin-right: 0.25rem;"></i> Back
                            </button>

                            <button type="submit" class="btn btn-indigo">
                                <i class="fas fa-save" style="margin-right: 0.25rem;"></i> Update
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const nextPageBtn = document.getElementById('next-page');
            const prevPageBtn = document.getElementById('prev-page');
            const page1 = document.getElementById('page1');
            const page2 = document.getElementById('page2');

            if (nextPageBtn && prevPageBtn && page1 && page2) {
                nextPageBtn.addEventListener('click', () => {
                    page1.classList.add('hidden-page');
                    page2.classList.remove('hidden-page');
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });

                prevPageBtn.addEventListener('click', () => {
                    page2.classList.add('hidden-page');
                    page1.classList.remove('hidden-page');
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
            }

            // AUTO-FILL CURRENT DATE/TIME (Asia/Manila)
            const now = new Date();
            const options = {
                timeZone: 'Asia/Manila',
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
                hour12: false
            };
            const formatter = new Intl.DateTimeFormat('en-CA', options);
            const parts = formatter.formatToParts(now);

            const year = parts.find(p => p.type === 'year').value;
            const month = parts.find(p => p.type === 'month').value;
            const day = parts.find(p => p.type === 'day').value;
            const hour = parts.find(p => p.type === 'hour').value;
            const minute = parts.find(p => p.type === 'minute').value;
            const manilaDateTime = `${year}-${month}-${day}T${hour}:${minute}`;

            const dateTimeFields = ['date_time_of_containment', 'incident_verified_date'];
            dateTimeFields.forEach(id => {
                const el = document.getElementById(id);
                if (el) el.value = manilaDateTime;
            });

            // INCIDENT CATEGORY AUTO-POPULATION
            const incidentTypeEl = document.getElementById("general_cause");
            const incidentCategory = document.getElementById("specific_cause");

            const categoryOptions = {
                "Malicious Attack": [
                    "Hacking-Cloud", "Hacking-Database", "Hacking-Email Account", "Hacking-Infrastructure",
                    "Hacking-Server", "Hacking-Website", "Hacking-Others", "Theft", "Social Engineering",
                    "Malware-Ransomware", "Malware-Trojan Horse", "Hacking-SQL Injection", "Phishing",
                    "Smishing", "Hacking-Phishing", "Malware-Virus", "Hacking-Man-In-The-Middle", "Identity Fraud", 
                    "Malicious Code", "Hacking", "Others (Specify)"
                ],
                "Malicious Attack/Human Error": [
                    "Misuse of Resources", "Phishing", "Smishing", "Social Engineering", "Undertrained Staff",
                    "Insider Threat", "Negligence", "Stolen Device", "Hacking-Database", "Unauthorized Disclosure", 
                    "Sabotage / Physical Damage", "Others (Specify)"
                ],
                "Human Error": [
                    "Undertrained Staff", "Loss of Equipment", "Loss of Documents", "Misdelivered Documents",
                    "Negligence", "Accidental Email", "Misuse of Resources", "User Error", "Others (Specify)"
                ],
                "System Glitch": [
                    "System Error", "Connection Error", "Hardware Failure", "System Misconfiguration", "Software Failure", "Others (Specify)"
                ],
                "Malicious Attack/System Glitch": [
                    "Misconfiguration", "System Error", "Connection Error", "Hardware Failure", "Others (Specify)"
                ],
                "System Glitch/Human Error": [
                    "System Misconfiguration", "Software Maintenance Error", "Communication Failure", "Operation Error", 
                    "Design Error", "Others (Specify)"
                ],
                "Others": [
                    "Natural Disaster", "Third Party / Service Provider"
                ]
            };

            if (incidentTypeEl && incidentCategory) {
                incidentTypeEl.addEventListener("change", function () {
                    const selectedType = this.value;
                    incidentCategory.innerHTML = '<option value="">-- Select Specific Cause --</option>';

                    if (categoryOptions[selectedType]) {
                        categoryOptions[selectedType].forEach(category => {
                            const option = document.createElement("option");
                            option.value = category;
                            option.textContent = category;
                            incidentCategory.appendChild(option);
                        });
                    }
                });
            }

            // GENERAL INCIDENT AUTO-TYPE
            const specificCauseEl = document.getElementById("specific_cause");
            const generalIncidentEl = document.getElementById("general_incident");

            const categoryOptionsIncident = {
                "Identity Fraud": "Identity Fraud",
                "Social Engineering": "Identity Fraud",
                "Phishing": "Identity Fraud",
                "Smishing": "Identity Fraud",
                "Hacking-Phishing": "Identity Fraud",
                "Unauthorized Disclosure": "Identity Fraud",

                "Malicious Code": "Malicious Code",
                "Malware-Trojan Horse": "Malicious Code",
                "Malware-Ransomware": "Malicious Code",
                "Malware-Virus": "Malicious Code",

                "Hacking-Cloud": "Hacking",
                "Hacking-Database": "Hacking",
                "Hacking-Email Account": "Hacking",
                "Hacking-Infrastructure": "Hacking",
                "Hacking-Server": "Hacking",
                "Hacking-Website": "Hacking",
                "Hacking-SQL Injection": "Hacking",
                "Hacking-Man-In-The-Middle": "Hacking",
                "Hacking-Others": "Hacking",

                "Theft": "Theft",
                "Stolen Device": "Theft",
                "Loss of Equipment": "Theft",
                "Loss of Documents": "Theft",

                "Hardware Failure": "Hardware Failure",
                "System Error": "Software Failure",
                "Software Failure": "Software Failure",

                "User Error": "User Error",
                "Accidental Email": "User Error",
                "Misdelivered Documents": "User Error",
                "Undertrained Staff": "User Error",
                "Negligence": "User Error",

                "Misconfiguration": "Software Maintenance Error",
                "System Misconfiguration": "Software Maintenance Error",
                "Software Maintenance Error": "Software Maintenance Error",

                "Sabotage / Physical Damage": "Sabotage / Physical Damage",
                "Insider Threat": "Insider Threat",
                "Misuse of Resources": "Misuse of Resources",

                "Communication Failure": "Communication Failure",
                "Connection Error": "Communication Failure",
                "Operation Error": "Operation Error",
                "Design Error": "Design Error",

                "Natural Disaster": "Natural Disaster",
                "Third Party / Service Provider": "Third Party / Service Provider",

                "Others": "Others",
                "Others (Specify)": "Others"
            };

            if(specificCauseEl && generalIncidentEl) {
                specificCauseEl.addEventListener("change", function () {
                    const selectedCause = this.value;
                    generalIncidentEl.value = categoryOptionsIncident[selectedCause] || "Others";
                });
            }

            // EMAIL AUTO-FILL BASED ON PIC REGION
            const picSelect = document.getElementById('pic');
            const emailField = document.getElementById('email');

            if (picSelect && emailField) {
                picSelect.addEventListener('change', function () {
                    const region = this.value;

                    if (!region) {
                        emailField.value = '';
                        return;
                    }

                    fetch(`/get-dbrt-email/${encodeURIComponent(region)}`)
                        .then(response => response.json())
                        .then(data => {
                            emailField.value = data.email ?? '';
                        })
                        .catch(() => {
                            emailField.value = '';
                        });
                });
            }

            // FORM VALIDATION ENHANCEMENT
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function (e) {
                    let isValid = true;
                    const requiredFields = this.querySelectorAll('[required]');

                    requiredFields.forEach(field => {
                        if (!field.value.trim()) {
                            isValid = false;
                            field.classList.add('input-error');
                        } else {
                            field.classList.remove('input-error');
                        }
                    });

                    if (!isValid) {
                        e.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Missing Information',
                            text: 'Please fill in all required fields marked with *.',
                            confirmButtonColor: '#3085d6'
                        });
                        
                        // Force back to page 1 if errors are there
                        if(page1 && page2) {
                             page2.classList.add('hidden-page');
                             page1.classList.remove('hidden-page');
                             window.scrollTo({ top: 0, behavior: 'smooth' });
                        }
                    }
                });

                // Real-time validation feedback
                form.querySelectorAll('[required]').forEach(field => {
                    field.addEventListener('blur', function () {
                        if (!this.value.trim()) {
                            this.classList.add('input-error');
                        } else {
                            this.classList.remove('input-error');
                        }
                    });
                });
            }
        });
    </script>
    @endcan
</x-app-layout>