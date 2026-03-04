<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Main Layout */
        .panel { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; width: 100%; box-sizing: border-box; }
        
        /* Typography */
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; }
        .title { font-size: 1.5rem; font-weight: 900; color: #111827; margin-bottom: 1.5rem; margin-top: 0; }
        
        /* Header & Actions */
        .action-container { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
        .btn-green { background-color: #10b981; color: white; border: 1px solid #059669; padding: 0.5rem 1.5rem; min-width: 160px; justify-content: center; display: inline-flex; align-items: center; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.15); transition: all 0.2s ease; border-radius: 0.375rem; cursor: pointer; }
        .btn-green:hover { background-color: #059669; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(16, 185, 129, 0.25); }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(16, 185, 129, 0.15); }
        
        /* Buttons */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 1.5rem; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; border: none; transition: background-color 0.2s, box-shadow 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .btn i { margin-right: 0.5rem; }
        .btn-green { background-color: #16a34a; color: white; padding:0.75rem 0.5rem;}
        .btn-green:hover { background-color: #15803d; }
        .btn-indigo { background-color: #4f46e5; color: white; }
        .btn-indigo:hover { background-color: #4338ca; }
        .btn-gray { background-color: #e5e7eb; color: #374151; }
        .btn-gray:hover { background-color: #d1d5db; }

        /* Action Buttons (Edit/Delete) */
        .action-cell { display: flex; justify-content: flex-start; align-items: center; gap: 0.75rem; height: 100%; }
        .btn-action { display: inline-flex; align-items: center; padding: 0.25rem 0.5rem; border-radius: 0.375rem; font-size: 0.875rem; background: transparent; cursor: pointer; border: 1px solid; transition: 0.2s; white-space: nowrap; }
        .btn-action i { margin-right: 0.25rem; }
        .btn-edit { border-color: #93c5fd; color: #2563eb; }
        .btn-edit:hover { background-color: #eff6ff; color: #1e40af; }
        .btn-delete { border-color: #fca5a5; color: #dc2626; }
        .btn-delete:hover { background-color: #fef2f2; color: #991b1b; }

        /* --- Responsive Adjustments --- */
        @media (max-width: 640px) { .action-container { flex-direction: column; align-items: stretch; } .action-btn { width: 100%; } .action-btn .form-input { min-width: 0; flex: 1; max-width: none; } }

        /* Table */
        .table-container { overflow-x: auto; background-color: #ffffff; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 0.5rem; border: 1px solid #e5e7eb; }
        .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem; min-width: 800px; }
        .data-table th { padding: 0.75rem 2.25rem; background-color: #f3f4f6; color: #374151; font-weight: 600; text-transform: uppercase; border-bottom: 1px solid #e5e7eb; }
        .data-table td { padding: 1rem 2.25rem; border-bottom: 1px solid #e5e7eb; color: #1f2937; vertical-align: middle; }
        .data-table tbody tr:hover { background-color: #f9fafb; transition: background-color 0.15s; }
        .text-center { text-align: center; }

        /* Pagination Container */
        .pagination-wrapper { margin-top: 1rem; }

        /* Modals */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.6); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 1rem; }
        .modal-overlay.hidden { display: none; }
        .modal-box { position: relative; background-color: white; border-radius: 0.75rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); width: 100%; max-width: 48rem; max-height: 90vh; overflow-y: auto; padding: 2.5rem 2rem 2rem 2rem; box-sizing: border-box; }
        
        /* Fixed Modal Close Button */
        .close-btn { position:absolute; top:1.5rem; right:2rem; color:var(--text-muted); font-size:2.5rem; background:none; border:none; cursor:pointer; transition:color 0.2s; }
        .close-btn:hover { color:var(--text-main); }
        .modal-title { font-size: 1.5rem; font-weight: 700; color: #111827; margin-top: 0; margin-bottom: 2rem; border-bottom: 2px solid #e5e7eb; padding-bottom: 1rem; padding-right: 3rem; /* Prevents text overlapping with button */ }
        
        /* Form Grid */
        .form-grid { display: grid; grid-template-columns: 1fr; gap: 1rem; }
        @media (min-width: 640px) {
            .form-grid { grid-template-columns: repeat(2, 1fr); }
            .col-span-2 { grid-column: span 2; }
        }

        /* Form Controls */
        .form-group { display: flex; flex-direction: column; }
        .form-label { font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem; }
        .form-input, .form-select { width: 100%; padding: 0.5rem 0.75rem; font-size: 0.875rem; border: 1px solid #d1d5db; border-radius: 0.375rem; background-color: white; outline: none; transition: border-color 0.2s, box-shadow 0.2s; box-sizing: border-box; }
        .form-input:focus, .form-select:focus { border-color: #4f46e5; box-shadow: 0 0 0 2px rgba(79, 70, 229, 0.2); }
        .modal-footer { display: flex; justify-content: flex-end; padding-top: 1.5rem; border-top: 1px solid #e5e7eb; margin-top: 1.5rem; gap: 0.75rem; }
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
                            <i class="fas fa-plus"></i> Add DBRT Member
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
                                        <td>
                                            {{ $team->firstname }} {{ $team->middle_initial ?? '' }} {{ $team->lastname ?? '' }}
                                        </td>
                                        <td>{{ $team->email ?? 'N/A' }}</td>
                                        <td>{{ $team->region ?? 'N/A' }}</td>
                                        
                                        @canany(['edit_dbrt', 'delete_dbrt'])
                                        <td>
                                            <div class="action-cell" @if(auth()->user()->can('edit_dbrt') && auth()->user()->can('delete_dbrt')) style="justify-content: center;" @endif>
                                                
                                                @can('edit_dbrt')
                                                <button class="btn-action btn-edit edit-btn"
                                                    data-id="{{ $team->dbrt_id }}"
                                                    data-firstname="{{ $team->firstname }}"
                                                    data-middle_initial="{{ $team->middle_initial }}"
                                                    data-lastname="{{ $team->lastname }}"
                                                    data-email="{{ $team->email }}"
                                                    data-region="{{ $team->region }}">
                                                    <i class="fas fa-edit"></i> Edit
                                                </button>
                                                @endcan

                                                @can('delete_dbrt')
                                                <form action="{{ route('databreach.team_databreach.destroy', $team->dbrt_id) }}" method="POST" class="delete-form" style="margin: 0;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="button" class="btn-action btn-delete delete-btn" title="Delete">
                                                        <i class="fas fa-trash-alt"></i> Delete
                                                    </button>
                                                </form> 
                                                @endcan 
                                            </div> 
                                        </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center" style="padding: 2rem; color: #6b7280;">No DBRT Member found.</td>
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

            <div id="addModal" class="modal-overlay hidden">
                <div class="modal-box">
                    <button id="closeAddModal" class="close-btn" aria-label="Close Modal">&times;</button>
                    <h2 class="modal-title">Add Data Breach Response Team</h2>

                    <form action="{{ route('databreach.team_databreach.store') }}" method="POST">
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
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="region" class="form-label">Region</label>
                                <select id="region" name="region" required class="form-select">
                                    <option value="">-- Select Region --</option>
                                    <option>CDA HO</option><option>CDA CAR</option><option>CDA NIR</option>
                                    <option>CDA NCR</option><option>CDA Region I</option><option>CDA Region II</option>
                                    <option>CDA Region III</option><option>CDA Region IV-A</option><option>CDA Region IV-B</option>
                                    <option>CDA Region V</option><option>CDA Region VI</option><option>CDA Region VII</option>
                                    <option>CDA Region VIII</option><option>CDA Region IX</option><option>CDA Region X</option>
                                    <option>CDA Region XI</option><option>CDA Region XII</option><option>CDA Region XIII</option>
                                </select>
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

            <div id="editModal" class="modal-overlay hidden">
                <div class="modal-box">
                    <button id="closeEditModal" class="close-btn" aria-label="Close Modal">&times;</button>
                    <h2 class="modal-title">Edit Data Breach Response Team</h2>
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-grid">
                            <div class="form-group col-span-2">
                                <label for="edit_firstname" class="form-label">First Name</label>
                                <input type="text" name="firstname" id="edit_firstname" required class="form-input">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="edit_middle_initial" class="form-label">Middle Initial</label>
                                <input type="text" name="middle_initial" id="edit_middle_initial" class="form-input">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="edit_lastname" class="form-label">Last Name</label>
                                <input type="text" name="lastname" id="edit_lastname" required class="form-input">
                            </div>
                            <div class="form-group col-span-2">
                                <label for="edit_email" class="form-label">Email</label>
                                <input type="email" name="email" id="edit_email" required class="form-input">
                            </div>
                            <div class="form-group">
                                <label for="edit_region" class="form-label">Region</label>
                                <select id="edit_region" name="region" required class="form-select">
                                    <option value="">-- Select Region --</option>
                                    <option>CDA HO</option><option>CDA CAR</option><option>CDA NIR</option>
                                    <option>CDA NCR</option><option>CDA Region I</option><option>CDA Region II</option>
                                    <option>CDA Region III</option><option>CDA Region IV-A</option><option>CDA Region IV-B</option>
                                    <option>CDA Region V</option><option>CDA Region VI</option><option>CDA Region VII</option>
                                    <option>CDA Region VIII</option><option>CDA Region IX</option><option>CDA Region X</option>
                                    <option>CDA Region XI</option><option>CDA Region XII</option><option>CDA Region XIII</option>
                                </select>
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
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // SweetAlert success message
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: @json(session('success')),
                    timer: 2000,
                    showConfirmButton: false
                });
            @endif

            const addModal = document.getElementById('addModal');
            const editModal = document.getElementById('editModal');
            const openAddModalBtn = document.getElementById('openAddModal');
            const closeAddModalBtn = document.getElementById('closeAddModal');
            const closeEditModalBtn = document.getElementById('closeEditModal');
            const editForm = document.getElementById('editForm');

            // Open Add Modal
            if(openAddModalBtn) {
                openAddModalBtn.addEventListener('click', () => addModal.classList.remove('hidden'));
            }
            if(closeAddModalBtn) {
                closeAddModalBtn.addEventListener('click', () => addModal.classList.add('hidden'));
            }

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
                    editForm.action = "{{ url('/databreach/team_databreach') }}/" + dbrtId;

                    editModal.classList.remove('hidden');
                });
            });

            // Close Edit Modal
            if(closeEditModalBtn) {
                closeEditModalBtn.addEventListener('click', () => editModal.classList.add('hidden'));
            }

            // Delete confirmation
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function () {
                    const form = this.closest('.delete-form');
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "This action will permanently delete the record.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Delete',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) form.submit();
                    });
                });
            });
        });
    </script>
</x-app-layout>