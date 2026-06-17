<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    
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

            /* Error States */
            --error-bg: #fef2f2;
            --error-border: #fecaca;
            --error-text: #991b1b;
            --error-title: #7f1d1d;
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

            /* Error States - Dark */
            --error-bg: rgba(153, 27, 27, 0.2);
            --error-border: rgba(248, 113, 113, 0.4);
            --error-text: #fca5a5;
            --error-title: #f87171;
        }

        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; transition: background-color 0.3s ease, color 0.3s ease; }

        /* Main Layout - Mobile First 100% Width & Dark Mode Outline */
        .panel { background-color: var(--card-bg); border-radius: 1rem; border: 1px solid var(--border-light); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); padding: 1.25rem; width: 100%; transition: background-color 0.3s ease, border-color 0.3s ease; }
        
        /* Typography */
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.75rem; font-weight: 800; color: var(--text-dark); margin: 0; letter-spacing: -0.025em; transition: color 0.3s ease; }
        
        /* Actions Container */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 1rem; margin-bottom: 1.5rem; }
        
        /* Buttons - Uniform Heights & Modern Colors */
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
        
        /* Modern Gray */
        .btn-gray { background-color: var(--btn-gray-bg); color: var(--btn-gray-text); border: 1px solid var(--btn-gray-border); transition: all 0.3s ease; }
        .btn-gray:hover { background-color: var(--btn-gray-hover-bg); color: var(--btn-gray-hover-text); }

        /* Action Buttons (Edit/Delete in Table) */
        .action-cell { display: flex; flex-wrap: wrap; justify-content: flex-start; align-items: center; gap: 0.5rem; }
        .action-link { display: inline-flex; align-items: center; justify-content: center; height: 34px; padding: 0 0.85rem; border-radius: 0.375rem; font-size: 0.85rem; font-weight: 600; font-family: inherit; cursor: pointer; transition: all 0.2s; text-decoration: none; background: transparent; white-space: nowrap; box-sizing: border-box; }
        .action-link i { margin-right: 0.35rem; font-size: 0.9rem; }
        
        .link-blue { color: #3b82f6; border: 1px solid #bfdbfe; } 
        .link-blue:hover { background-color: #eff6ff; color: #1d4ed8; border-color: #93c5fd; }
        
        .link-red { color: #ef4444; border: 1px solid #fecaca; } 
        .link-red:hover { background-color: #fef2f2; color: #b91c1c; border-color: #fca5a5; }

        /* Dark Mode Action Link Overrides */
        body.dark .link-blue { color: #60a5fa; border-color: #1e3a8a; }
        body.dark .link-blue:hover { background-color: rgba(30, 58, 138, 0.4); color: #93c5fd; }
        body.dark .link-red { color: #f87171; border-color: #7f1d1d; }
        body.dark .link-red:hover { background-color: rgba(127, 29, 29, 0.4); color: #fca5a5; }

        /* Table */
        .table-container { overflow-x: auto; background-color: var(--card-bg); border-radius: 0.75rem; border: 1px solid var(--border-light); box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); width: 100%; -webkit-overflow-scrolling: touch; margin-bottom: 1.5rem; transition: background-color 0.3s ease, border-color 0.3s ease; }
        .data-table { width: 100%; min-width: 800px; border-collapse: collapse; text-align: left; font-size: 0.9rem; }
        .data-table th { padding: 1rem 1.5rem; background-color: var(--bg-alt); color: var(--text-muted); font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid var(--border-light); white-space: nowrap; transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease; }
        .data-table td { padding: 1.25rem 1.5rem; border-bottom: 1px solid var(--border-subtle); color: var(--text-dark); vertical-align: middle; font-weight: 500; transition: color 0.3s ease, border-color 0.3s ease; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: var(--bg-alt); }
        .text-center { text-align: center; }
        .font-bold-name { font-weight: 700; color: var(--text-dark); transition: color 0.3s ease; }

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

        /* Modals - Smooth Scaling Transitions */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(15, 23, 42, 0.75); backdrop-filter: blur(4px); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 1rem; opacity: 1; visibility: visible; transition: all 0.3s ease; }
        .modal-overlay.hidden { opacity: 0; visibility: hidden; pointer-events: none; }
        
        .modal-box { position: relative; background-color: var(--card-bg); border-radius: 1rem; border: 1px solid var(--border-light); box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); width: 100%; max-width: 48rem; max-height: 90vh; overflow-y: auto; padding: 1.5rem; transform: scale(1); transition: transform 0.3s ease, background-color 0.3s ease, border-color 0.3s ease; }
        .modal-overlay.hidden .modal-box { transform: scale(0.95); }
        
        /* Fixed Modal Close Button */
        .close-btn { position: absolute; top: 1.25rem; right: 1.25rem; color: var(--text-muted); font-size: 2.25rem; background: none; border: none; cursor: pointer; transition: color 0.2s, background-color 0.2s; line-height: 1; border-radius: 0.25rem; padding: 0 0.5rem; }
        .close-btn:hover { color: var(--text-dark); }
        
        .modal-title { font-size: 1.5rem; font-weight: 800; color: var(--text-dark); margin-top: 0; margin-bottom: 1.5rem; border-bottom: 1px solid var(--border-light); padding-bottom: 1rem; padding-right: 2.5rem; transition: color 0.3s ease, border-color 0.3s ease; }
        
        /* Form Grid - Mobile First 100% Width */
        .form-grid { display: flex; flex-direction: column; gap: 1.25rem; width: 100%; }

        /* Form Controls - Unified 44px Heights */
        .form-group { display: flex; flex-direction: column; width: 100%; }
        .form-label { font-size: 0.875rem; font-weight: 600; color: var(--text-muted); margin-bottom: 0.5rem; width: 100%; transition: color 0.3s ease; }
        .form-input, .form-select { height: 44px; padding: 0 1rem; font-size: 0.95rem; color: var(--input-text); border: 1px solid var(--input-border); border-radius: 0.5rem; background-color: var(--input-bg); outline: none; transition: all 0.2s; font-family: inherit; width: 100%; box-sizing: border-box; }
        .form-input:focus, .form-select:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }
        
        .modal-footer { display: flex; flex-direction: column; padding-top: 1.5rem; border-top: 1px solid var(--border-light); margin-top: 1.5rem; gap: 0.75rem; width: 100%; transition: border-color 0.3s ease; }

        /* Error Box */
        .error-box { background-color: var(--error-bg); border: 1px solid var(--error-border); color: var(--error-text); padding: 1.25rem; border-radius: 0.5rem; margin-bottom: 1.5rem; transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease; }
        .error-title { margin: 0 0 0.5rem 0; font-weight: 700; font-size: 0.95rem; color: var(--error-title); transition: color 0.3s ease; }
        .error-list { margin: 0; padding-left: 1.5rem; font-size: 0.9rem; font-weight: 500; }

        /* --------------------------------------------------- */
        /* Responsive Overrides                                */
        /* --------------------------------------------------- */
        
        /* Mobile Breakpoint for Pagination */
        @media (max-width: 639px) {
            .pagination-wrapper nav .hidden { display: none !important; }
            .pagination-wrapper nav .sm\:hidden { display: flex; width: 100%; justify-content: space-between; }
        }

        /* Desktop & Tablet Overrides */
        @media (min-width: 640px) {
            .panel { padding: 2rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            .action-container { flex-direction: row; justify-content: flex-start; }
            
            /* Un-stretch main page buttons */
            .action-container .btn { width: auto; }
            
            /* Restore Grid layout for Desktop */
            .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
            .col-span-2 { grid-column: span 2; }
            
            /* Modal formatting for Desktop */
            .modal-box { padding: 2.5rem; }
            .close-btn { top: 1.5rem; right: 2rem; }
            
            /* Modal Footer Buttons */
            .modal-footer { flex-direction: row; justify-content: flex-end; }
            .modal-footer .btn { width: auto; }

            /* Pagination Layout */
            .pagination-wrapper nav { flex-direction: row; justify-content: space-between; }
            .pagination-wrapper nav > div.sm\:hidden { display: none !important; }
            .pagination-wrapper nav > div.hidden.sm\:flex-1 { display: flex !important; width: 100%; justify-content: space-between; align-items: center; }
        }
    </style>

    <div id="main-content" class="page-wrapper">
        <div id="techContent">
            <div style="width: 100%;">
                <div class="panel">
                    
                    <div class="header-flex">
                        <h3 class="title">Data Breach Response Team</h3>
                    </div>
                    
                    <div class="action-container">
                        @can('create_dbrt')
                        <button id="openAddModal" class="btn btn-green">
                            <span class="material-symbols-outlined" style="font-size: 1.25rem; margin-right: 0.2rem;">add</span>
                            Add DBRT Member
                        </button>
                        @endcan
                    </div>

                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Fullname</th>
                                    <th>Email</th>
                                    <th>Region</th>
                                    @canany(['edit_dbrt', 'delete_dbrt'])
                                        <th class="text-center">Actions</th>
                                    @endcanany
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($dbrtTeam as $team)
                                    <tr>
                                        <td class="font-bold-name">
                                            {{ $team->firstname }} {{ $team->middle_initial ?? '' }} {{ $team->lastname ?? '' }}
                                        </td>
                                        <td>{{ $team->email ?? 'N/A' }}</td>
                                        <td>{{ $team->region ?? 'N/A' }}</td>
                                        
                                        @canany(['edit_dbrt', 'delete_dbrt'])
                                        <td>
                                            <div class="action-cell" @if(auth()->user()->can('edit_dbrt') && auth()->user()->can('delete_dbrt')) style="justify-content: center;" @endif>
                                                
                                                @can('edit_dbrt')
                                                <button type="button" class="action-link link-blue edit-btn"
                                                    data-id="{{ $team->dbrt_id }}"
                                                    data-firstname="{{ $team->firstname }}"
                                                    data-middle_initial="{{ $team->middle_initial }}"
                                                    data-lastname="{{ $team->lastname }}"
                                                    data-email="{{ $team->email }}"
                                                    data-region="{{ $team->region }}">
                                                    <span class="material-symbols-outlined" style="font-size: 1.25rem; margin-right: 0.2rem;">edit</span>
                                                    Edit
                                                </button>
                                                @endcan

                                                @can('delete_dbrt')
                                                <form action="{{ route('databreach.team_databreach.destroy', $team->dbrt_id) }}" method="POST" class="delete-form" style="margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="action-link link-red delete-btn" title="Delete">
                                                        <span class="material-symbols-outlined" style="font-size: 1.25rem; margin-right: 0.2rem;">delete</span>
                                                        Delete
                                                    </button>
                                                </form> 
                                                @endcan 
                                            </div> 
                                        </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center" style="padding: 3rem; color: var(--text-muted);">
                                            No DBRT Member found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="pagination-wrapper">
                        {{ $dbrtTeam->links() }}
                    </div>
                </div>
            </div>

            {{-- Add Modal --}}
            <div id="addModal" class="modal-overlay hidden">
                <div class="modal-box">

                    <button id="closeAddModal" class="close-btn" aria-label="Close Modal">&times;</button>
                    
                    @if ($errors->any())
                        <div class="error-box">
                            <h4 class="error-title"><span class="material-symbols-outlined" style="font-size: 1.25rem; margin-right: 0.2rem;">error</span> Please fix the following error(s):</h4>
                            <ul class="error-list">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h2 class="modal-title">Add Data Breach Response Team</h2>

                    <form action="{{ route('databreach.team_databreach.store') }}" method="POST">
                        @csrf
                        <div class="form-grid">
                            <div class="form-group col-span-2">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" name="firstname" id="firstname" required class="form-input" autocomplete="off">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="middle_initial" class="form-label">Middle Initial</label>
                                <input type="text" name="middle_initial" id="middle_initial" class="form-input" autocomplete="off">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" name="lastname" id="lastname" required class="form-input" autocomplete="off">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="email" required class="form-input" autocomplete="email">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="region" class="form-label">Region Assignment</label>
                                <select id="region" name="region" required class="form-select">
                                    <option value="">-- Select Region --</option>
                                    <option value="CDA HO">CDA HO</option>
                                    <option value="CDA CAR">CDA CAR</option>
                                    <option value="CDA NIR">CDA NIR</option>
                                    <option value="CDA NCR">CDA NCR</option>
                                    <option value="CDA Region I">CDA Region I</option>
                                    <option value="CDA Region II">CDA Region II</option>
                                    <option value="CDA Region III">CDA Region III</option>
                                    <option value="CDA Region IV-A">CDA Region IV-A</option>
                                    <option value="CDA Region IV-B">CDA Region IV-B</option>
                                    <option value="CDA Region V">CDA Region V</option>
                                    <option value="CDA Region VI">CDA Region VI</option>
                                    <option value="CDA Region VII">CDA Region VII</option>
                                    <option value="CDA Region VIII">CDA Region VIII</option>
                                    <option value="CDA Region IX">CDA Region IX</option>
                                    <option value="CDA Region X">CDA Region X</option>
                                    <option value="CDA Region XI">CDA Region XI</option>
                                    <option value="CDA Region XII">CDA Region XII</option>
                                    <option value="CDA Region XIII">CDA Region XIII</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-indigo"> Submit Member</button>
                            <button type="button" class="btn btn-gray" id="cancelAddModalBtn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Edit Modal --}}
            <div id="editModal" class="modal-overlay hidden">
                <div class="modal-box">
                    <button id="closeEditModal" class="close-btn" aria-label="Close Modal">&times;</button>
                    
                    @if ($errors->any())
                        <div class="error-box">
                            <h4 class="error-title"><span class="material-symbols-outlined" style="font-size: 1.25rem; margin-right: 0.2rem;">error</span> Please fix the following error(s):</h4>
                            <ul class="error-list">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <h2 class="modal-title">Edit Data Breach Response Team</h2>
                    
                    <form id="editForm" method="POST" action="#">
                        @csrf
                        @method('PUT')
                        <div class="form-grid">
                            <div class="form-group col-span-2">
                                <label for="edit_firstname" class="form-label">First Name</label>
                                <input type="text" name="firstname" id="edit_firstname" required class="form-input" autocomplete="off">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="edit_middle_initial" class="form-label">Middle Initial</label>
                                <input type="text" name="middle_initial" id="edit_middle_initial" class="form-input" autocomplete="off">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="edit_lastname" class="form-label">Last Name</label>
                                <input type="text" name="lastname" id="edit_lastname" required class="form-input" autocomplete="off">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="edit_email" class="form-label">Email Address</label>
                                <input type="email" name="email" id="edit_email" required class="form-input" autocomplete="email">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="edit_region" class="form-label">Region Assignment</label>
                                <select id="edit_region" name="region" required class="form-select">
                                    <option value="">-- Select Region --</option>
                                    <option value="CDA HO">CDA HO</option>
                                    <option value="CDA CAR">CDA CAR</option>
                                    <option value="CDA NIR">CDA NIR</option>
                                    <option value="CDA NCR">CDA NCR</option>
                                    <option value="CDA Region I">CDA Region I</option>
                                    <option value="CDA Region II">CDA Region II</option>
                                    <option value="CDA Region III">CDA Region III</option>
                                    <option value="CDA Region IV-A">CDA Region IV-A</option>
                                    <option value="CDA Region IV-B">CDA Region IV-B</option>
                                    <option value="CDA Region V">CDA Region V</option>
                                    <option value="CDA Region VI">CDA Region VI</option>
                                    <option value="CDA Region VII">CDA Region VII</option>
                                    <option value="CDA Region VIII">CDA Region VIII</option>
                                    <option value="CDA Region IX">CDA Region IX</option>
                                    <option value="CDA Region X">CDA Region X</option>
                                    <option value="CDA Region XI">CDA Region XI</option>
                                    <option value="CDA Region XII">CDA Region XII</option>
                                    <option value="CDA Region XIII">CDA Region XIII</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-indigo">Save Changes</button>
                            <button type="button" class="btn btn-gray" id="cancelEditModalBtn">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Helper to get CSS variable colors for SweetAlert Dark Mode
            const getComputedColor = (cssVar) => getComputedStyle(document.body).getPropertyValue(cssVar).trim();

            // SweetAlert success message
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: @json(session('success')),
                    timer: 2500,
                    showConfirmButton: false,
                    background: getComputedColor('--card-bg'),
                    color: getComputedColor('--text-dark')
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Notice!',
                    text: @json(session('error')),
                    timer: 3000,
                    showConfirmButton: false,
                    background: getComputedColor('--card-bg'),
                    color: getComputedColor('--text-dark')
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    showConfirmButton: true,
                    confirmButtonColor: '#4f46e5',
                    background: getComputedColor('--card-bg'),
                    color: getComputedColor('--text-dark')
                });
            @endif

            // Modal Logic
            const addModal = document.getElementById('addModal');
            const editModal = document.getElementById('editModal');
            const openAddModalBtn = document.getElementById('openAddModal');
            const closeAddModalBtn = document.getElementById('closeAddModal');
            const cancelAddModalBtn = document.getElementById('cancelAddModalBtn');
            const closeEditModalBtn = document.getElementById('closeEditModal');
            const cancelEditModalBtn = document.getElementById('cancelEditModalBtn');
            const editForm = document.getElementById('editForm');

            function openModal(modal) {
                if(modal) {
                    modal.classList.remove('hidden');
                    document.body.classList.add('overflow-hidden');
                }
            }

            function closeModal(modal) {
                if(modal) {
                    modal.classList.add('hidden');
                    document.body.classList.remove('overflow-hidden');
                }
            }

            // Open Add Modal
            if(openAddModalBtn) openAddModalBtn.addEventListener('click', () => openModal(addModal));
            
            // Close Add Modal
            if(closeAddModalBtn) closeAddModalBtn.addEventListener('click', () => closeModal(addModal));
            if(cancelAddModalBtn) cancelAddModalBtn.addEventListener('click', () => closeModal(addModal));
            if(addModal) addModal.addEventListener('click', e => { if(e.target === addModal) closeModal(addModal); });

            // Edit button click logic
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', () => {
                    const dbrtId = button.dataset.id;
                    document.getElementById('edit_firstname').value = button.dataset.firstname;
                    document.getElementById('edit_middle_initial').value = button.dataset.middle_initial;
                    document.getElementById('edit_lastname').value = button.dataset.lastname;
                    document.getElementById('edit_email').value = button.dataset.email;
                    document.getElementById('edit_region').value = button.dataset.region;

                    // Set form action dynamically
                    editForm.action = `/databreach/team_databreach/${dbrtId}`;

                    openModal(editModal);
                });
            });

            // Close Edit Modal
            if(closeEditModalBtn) closeEditModalBtn.addEventListener('click', () => closeModal(editModal));
            if(cancelEditModalBtn) cancelEditModalBtn.addEventListener('click', () => closeModal(editModal));
            if(editModal) editModal.addEventListener('click', e => { if(e.target === editModal) closeModal(editModal); });

            // Delete confirmation
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action will permanently remove this member from the team.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Confirm',
                        cancelButtonText: 'Cancel',
                        background: getComputedColor('--card-bg'),
                        color: getComputedColor('--text-dark')
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
            
            // Allow closing modals with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === "Escape") {
                    closeModal(addModal);
                    closeModal(editModal);
                }
            });
        });
    </script>
</x-app-layout>