<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Main Layout - Mobile First 100% Width */
        .panel { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1rem; width: 100%; box-sizing: border-box; }
        
        /* Typography */
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.5rem; font-weight: 900; color: #111827; margin-bottom: 0; margin-top: 0; }
        
        /* --- Action Container & Search Toolbar - Mobile First --- */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 1rem; margin-bottom: 1.5rem; }
        .action-btn { display: flex; align-items: stretch; width: 100%; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        
        .action-btn .form-input { flex: 1; width: 100%; min-width: 0; max-width: none; border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; margin: 0; padding: 0.75rem 1rem; font-size: 1rem; transition: all 0.2s; position: relative; z-index: 1; border: 1px solid #d1d5db; }
        .action-btn .form-input:focus { z-index: 10; border-color: #4f46e5; box-shadow: inset 0 0 0 1px #4f46e5, 0 0 0 2px rgba(79,70,229,0.2); outline: none; }
        
        /* Stop search button from stretching to 100% */
        .action-btn .btn-indigo { width: auto; border-top-left-radius: 0; border-bottom-left-radius: 0; margin: 0; padding: 0.5rem 1.25rem; z-index: 2; border: none; }

        /* --- Buttons - Mobile First (Full Width default) --- */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 1.5rem; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; border: none; transition: background-color 0.2s, box-shadow 0.2s, transform 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05); width: 100%; box-sizing: border-box; }
        .btn i { margin-right: 0.5rem; }
        
        .btn-green { background-color: #16a34a; color: white; padding: 0.85rem 1rem; font-weight: 600; border: 1px solid #15803d; }
        .btn-green:hover { background-color: #15803d; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(22, 163, 74, 0.25); }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(22, 163, 74, 0.15); }

        /* Taller Submit/Update Buttons matching DBRT */
        .btn-indigo { background-color: #4f46e5; color: white; padding: 1rem 2rem; font-size: 1rem; font-weight: 600; }
        .btn-indigo:hover { background-color: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(79, 70, 229, 0.25); }
        .btn-indigo:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(79, 70, 229, 0.15); }
        
        .btn-gray { background-color: #e5e7eb; color: #374151; }
        .btn-gray:hover { background-color: #d1d5db; }

        /* Action Buttons (Edit/Delete in Table) */
        .action-cell { display: flex; justify-content: flex-start; align-items: center; gap: 0.75rem; height: 100%; }
        .btn-action { display: inline-flex; align-items: center; padding: 0.35rem 0.75rem; border-radius: 0.375rem; font-size: 0.875rem; background: transparent; cursor: pointer; border: 1px solid; transition: 0.2s; white-space: nowrap; }
        .btn-action i { margin-right: 0.25rem; }
        .btn-edit { border-color: #93c5fd; color: #2563eb; }
        .btn-edit:hover { background-color: #eff6ff; color: #1e40af; }
        .btn-delete { border-color: #fca5a5; color: #dc2626; }
        .btn-delete:hover { background-color: #fef2f2; color: #991b1b; }

        /* Table */
        .table-container { overflow-x: auto; background-color: #ffffff; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 0.5rem; border: 1px solid #e5e7eb; width: 100%; -webkit-overflow-scrolling: touch; }
        .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem; min-width: 800px; }
        .data-table th { padding: 0.75rem 1.5rem; background-color: #f3f4f6; color: #374151; font-weight: 600; text-transform: uppercase; border-bottom: 1px solid #e5e7eb; }
        .data-table td { padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; color: #1f2937; vertical-align: middle; }
        .data-table tbody tr:hover { background-color: #f9fafb; transition: background-color 0.15s; }
        .text-center { text-align: center; }

        /* --- Updated Pagination Fixes --- */
        .pagination-wrapper { margin-top: 1.5rem; width: 100%; overflow-x: auto; padding-bottom: 0.5rem; }
        .pagination-wrapper nav { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; }
        /* Force SVG icons to stay normal sized */
        .pagination-wrapper svg { width: 1.25rem !important; height: 1.25rem !important; display: inline-block; vertical-align: middle; }
        /* Align text properly */
        .pagination-wrapper a, .pagination-wrapper span { display: inline-flex; align-items: center; justify-content: center; }
        .pagination-wrapper p { margin: 0; font-size: 0.875rem; color: #6b7280; }

        /* Modals - Mobile First */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.6); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 1rem; box-sizing: border-box; }
        .modal-overlay.hidden { display: none; }
        .modal-box { position: relative; background-color: white; border-radius: 0.75rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); width: 100%; max-width: 48rem; max-height: 90vh; overflow-y: auto; padding: 1.5rem; box-sizing: border-box; }
        
        /* Fixed Modal Close Button */
        .close-btn { position: absolute; top: 1rem; right: 1rem; color: #94a3b8; font-size: 2rem; background: none; border: none; cursor: pointer; transition: color 0.2s; line-height: 1; }
        .close-btn:hover { color: #1f2937; }
        .modal-title { font-size: 1.25rem; font-weight: 700; color: #111827; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 2px solid #e5e7eb; padding-bottom: 1rem; padding-right: 2.5rem; }
        
        /* Form Grid - Mobile First 100% Width */
        .form-grid { display: flex; flex-direction: column; gap: 1rem; width: 100%; }

        /* Form Controls - Mobile First 100% Width */
        .form-group { display: flex; flex-direction: column; width: 100%; }
        .form-label { font-size: 0.875rem; font-weight: 600; color: #374151; margin-bottom: 0.35rem; width: 100%; }
        .form-input, .form-select { width: 100%; padding: 0.75rem 1rem; font-size: 1rem; border: 1px solid #d1d5db; border-radius: 0.5rem; background-color: white; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box; display: block; font-family: inherit; }
        .form-input:focus, .form-select:focus { border-color: #4f46e5; box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.2); }
        
        .modal-footer { display: flex; flex-direction: column; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; margin-top: 1.5rem; gap: 1rem; width: 100%; }

        /* --------------------------------------------------- */
        /* Mobile Specific Overrides (max-width: 640px)        */
        /* --------------------------------------------------- */
        @media (max-width: 640px) {
            /* Native Laravel paginator cleanup for mobile */
            .pagination-wrapper > nav > div:first-child { display: flex; width: 100%; justify-content: space-between; }
            .pagination-wrapper > nav > div:last-child { display: none; }
        }

        /* --------------------------------------------------- */
        /* Desktop & Tablet Overrides (min-width: 640px/768px) */
        /* --------------------------------------------------- */
        @media (min-width: 640px) {
            .panel { padding: 1.5rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            
            /* Align Add button and Search inline */
            .action-container { flex-direction: row; justify-content: space-between; align-items: center; }
            .action-btn { width: auto;}
            .action-btn .form-input { min-width: 250px; max-width: 350px; }
            
            /* Un-stretch buttons on desktop */
            .btn-green, .btn-indigo { width: auto; min-width: 140px; }
            
            /* Restore Grid layout for Desktop */
            .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); }
            .col-span-2 { grid-column: span 2; }
            
            /* Modal formatting for Desktop */
            .modal-box { padding: 2.5rem 2rem 2rem 2rem; }
            .close-btn { top: 1.5rem; right: 2rem; font-size: 2.5rem; }
            .modal-title { font-size: 1.5rem; margin-bottom: 2rem; }
            
            /* Modal Footer Buttons */
            .modal-footer { flex-direction: row; justify-content: flex-end; }
        }
    </style>

    <div id="main-content">
        <div class="panel">
            
            <div class="header-flex">
                <h3 class="title">All Technical Personnel</h3>
            </div>

            <div class="action-container">
                @can('create_technical_personnel')
                    <button id="openModal" class="btn btn-green">
                        <i class="fas fa-plus"></i> Add Personnel
                    </button>
                @endcan

                @can('search_technical_personnel')
                <form action="{{ route('tech_personnel.index') }}" method="GET" class="action-btn">
                    <input type="text" name="search_query" value="{{ request('search_query') }}" placeholder="Search..." class="form-input">
                    <button type="submit" class="btn btn-indigo" style="padding: 0.5rem 1.25rem;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                @endcan
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>FullName/Division</th>
                            <th>Email</th>
                            <th>Region</th>
                            @if(auth()->user()->can('edit_technical_personnel') || auth()->user()->can('delete_technical_personnel'))
                                <th class="text-center" @if(auth()->user()->can('edit_technical_personnel') && auth()->user()->can('delete_technical_personnel')) style="text-align: center;" @endif>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($technical_personnel as $tech_personnel)
                            <tr>
                                <td>{{ $tech_personnel->firstname }} {{ $tech_personnel->middle_initial }} {{ $tech_personnel->lastname }}</td>
                                <td>{{ $tech_personnel->it_email }}</td>
                                <td>{{ $tech_personnel->it_area }}</td>
                                
                                @if(auth()->user()->can('edit_technical_personnel') || auth()->user()->can('delete_technical_personnel'))
                                <td>
                                    <div class="action-cell" @if(auth()->user()->can('edit_technical_personnel') && auth()->user()->can('delete_technical_personnel')) style="justify-content: center;" @endif>
                                        {{-- Edit Button --}}
                                        @can('edit_technical_personnel')
                                            <button class="btn-action btn-edit editBtn"
                                                data-id="{{ $tech_personnel->id }}"
                                                data-firstname="{{ $tech_personnel->firstname }}"
                                                data-middle_initial="{{ $tech_personnel->middle_initial }}"
                                                data-lastname="{{ $tech_personnel->lastname }}"
                                                data-it_email="{{ $tech_personnel->it_email }}"
                                                data-it_area="{{ $tech_personnel->it_area }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                        @endcan

                                        {{-- Delete Button --}}
                                        @can('delete_technical_personnel')
                                            <form id="delete-form-{{ $tech_personnel->id }}" action="{{ route('tech_personnel.destroy', $tech_personnel->id) }}" method="POST" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-action btn-delete delete-btn" data-id="{{ $tech_personnel->id }}">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center" style="padding: 2rem; color: #6b7280;">
                                    No Technical Personnel found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $technical_personnel->links() }}
            </div>
            
        </div>
    </div>

    {{-- Modal: Add Personnel --}}
    <div id="personnelModal" class="modal-overlay hidden">
        <div id="personnelModalContent" class="modal-box">
            <button id="closeModal" class="close-btn" aria-label="Close">&times;</button>

            @if ($errors->any())
                <div style="background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1rem;">
                    <h4 style="margin:0 0 0.5rem 0; font-weight: bold;"><i class="fas fa-exclamation-triangle"></i> Please fix the following error(s):</h4>
                    <ul style="margin:0; padding-left: 1.5rem; font-size: 0.875rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2 class="modal-title">Create a Technical Personnel</h2>

            <form action="{{ route('tech_personnel.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group col-span-2">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" name="firstname" id="firstname" required class="form-input">
                    </div>

                    <div class="form-group col-span-2">
                        <label for="middle_initial" class="form-label">Middle Initial</label>
                        <input type="text" name="middle_initial" id="middle_initial" class="form-input">
                    </div>

                    <div class="form-group col-span-2">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" name="lastname" id="lastname" required class="form-input">
                    </div>

                    <div class="form-group col-span-2">
                        <label for="it_email" class="form-label">Email</label>
                        <input type="email" name="it_email" id="it_email" required class="form-input">
                    </div>

                    <div class="form-group col-span-2">
                        <label for="it_area" class="form-label">IT Area <span style="color:#ef4444;">*</span></label>
                        <select name="it_area" id="it_area" required class="form-select">
                            <option value="" disabled selected>Select Region</option>
                            @foreach ($region as $area)
                                <option value="{{ $area }}">{{ $area }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-span-2">
                        <label for="date_added" class="form-label">Date Added</label>
                        <input type="text" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}" readonly class="form-input" style="background-color: #f9fafb; cursor: not-allowed;">
                        <input type="hidden" name="date_added" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('Y-m-d') }}">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-indigo">
                        <i class="fas fa-paper-plane"></i> Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal: Edit Personnel --}}
    <div id="editModal" class="modal-overlay hidden">
        <div id="editModalContent" class="modal-box">
            <button id="closeEditModal" class="close-btn" aria-label="Close">&times;</button>

            @if ($errors->any())
                <div style="background-color: #fef2f2; border: 1px solid #fecaca; color: #991b1b; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1rem;">
                    <h4 style="margin:0 0 0.5rem 0; font-weight: bold;"><i class="fas fa-exclamation-triangle"></i> Please fix the following error(s):</h4>
                    <ul style="margin:0; padding-left: 1.5rem; font-size: 0.875rem;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <h2 class="modal-title">Edit Technical Personnel</h2>

            <form id="editForm" method="POST" action="#">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="form-group col-span-2">
                        <label for="edit_firstname" class="form-label">First Name</label>
                        <input type="text" name="firstname" id="edit_firstname" class="form-input" required>
                    </div>

                    <div class="form-group col-span-2">
                        <label for="edit_middle_initial" class="form-label">Middle Initial</label>
                        <input type="text" name="middle_initial" id="edit_middle_initial" class="form-input">
                    </div>

                    <div class="form-group col-span-2">
                        <label for="edit_lastname" class="form-label">Last Name</label>
                        <input type="text" name="lastname" id="edit_lastname" class="form-input" required>
                    </div>

                    <div class="form-group col-span-2">
                        <label for="edit_it_email" class="form-label">Email</label>
                        <input type="email" name="it_email" id="edit_it_email" class="form-input" required>
                    </div>

                    <div class="form-group col-span-2">
                        <label for="edit_it_area" class="form-label">IT Area</label>
                        <select name="it_area" id="edit_it_area" class="form-select" required>
                            <option value="" disabled>Select Region</option>
                            @foreach ($region as $area)
                                <option value="{{ $area }}">{{ $area }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-span-2">
                        <label class="form-label">Date Updated</label>
                        <input type="text" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}" readonly class="form-input" style="background-color: #f9fafb; cursor: not-allowed;">
                        <input type="hidden" name="date_updated" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('Y-m-d') }}">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-indigo">
                        <i class="fas fa-save"></i> Update
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: '{{ session('success') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Notice!',
                    text: '{{ session('error') }}',
                    timer: 3000,
                    showConfirmButton: false
                });
            @endif

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    showConfirmButton: true,
                    confirmButtonColor: '#4f46e5'
                });
            @endif

            // Add Modal Toggles
            const addModal = document.getElementById("personnelModal");
            const openAddBtn = document.getElementById("openModal");
            const closeAddBtn = document.getElementById("closeModal");

            if (openAddBtn && addModal) {
                openAddBtn.addEventListener("click", () => {
                    addModal.classList.remove("hidden");
                });
            }

            if (closeAddBtn && addModal) {
                closeAddBtn.addEventListener("click", () => {
                    addModal.classList.add("hidden");
                });
            }

            if (addModal) {
                addModal.addEventListener("click", (e) => {
                    if (e.target === addModal) closeAddBtn.click();
                });
            }

            // Edit Modal Toggles
            const editModal = document.getElementById("editModal");
            const closeEditBtn = document.getElementById("closeEditModal");
            const editButtons = document.querySelectorAll(".editBtn");
            const editForm = document.getElementById("editForm");
            
            const editFirstname = document.getElementById("edit_firstname");
            const editMiddleInitial = document.getElementById("edit_middle_initial");
            const editLastname = document.getElementById("edit_lastname");
            const editEmail = document.getElementById("edit_it_email");
            const editArea = document.getElementById("edit_it_area");

            editButtons.forEach(button => {
                button.addEventListener("click", (e) => {
                    e.preventDefault();

                    const id = button.dataset.id;
                    const firstname = button.dataset.firstname;
                    const middle_initial = button.dataset.middle_initial;
                    const lastname = button.dataset.lastname;
                    const it_email = button.dataset.it_email;
                    const it_area = button.dataset.it_area;

                    // Fill modal inputs
                    editFirstname.value = firstname;
                    editMiddleInitial.value = middle_initial;
                    editLastname.value = lastname;
                    editEmail.value = it_email;
                    editArea.value = it_area;

                    // Update form action dynamically
                    editForm.action = `/tech_personnel/${id}`;

                    // Show modal
                    editModal.classList.remove("hidden");
                });
            });

            // Close Edit Modal
            if (closeEditBtn && editModal) {
                closeEditBtn.addEventListener("click", () => {
                    editModal.classList.add("hidden");
                });
            }

            if (editModal) {
                editModal.addEventListener("click", (e) => {
                    if (e.target === editModal) closeEditBtn.click();
                });
            }

            // Delete confirmation
            document.querySelectorAll('.delete-btn').forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    const form = this.closest('form');

                    Swal.fire({
                        title: 'Delete this Personnel?',
                        text: "This action cannot be undone!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#dc2626',
                        cancelButtonColor: '#6b7280',
                        confirmButtonText: 'Delete'
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