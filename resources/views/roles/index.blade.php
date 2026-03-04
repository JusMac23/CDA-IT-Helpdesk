<x-app-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        /* Main Layout */
        .panel { background-color: #ffffff; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); padding: 1.5rem; width: 100%; box-sizing: border-box; }
        
        /* Typography */
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem; flex-wrap: wrap; gap: 1rem; }
        .title { font-size: 1.5rem; font-weight: 900; color: #111827; margin-bottom: 1.5rem; margin-top: 0; }
        
        /* --- Action Container (Toolbar Layout) --- */
        .action-container { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1.5rem; }
        
        /* --- Add User Button Enhancements --- */
        .btn-green { background-color: #10b981; color: white; border: 1px solid #059669; padding: 0.5rem 1.5rem; min-width: 120px; justify-content: center; display: inline-flex; align-items: center; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.15); transition: all 0.2s ease; border-radius: 0.375rem; cursor: pointer; }
        .btn-green:hover { background-color: #059669; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(16, 185, 129, 0.25); }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(16, 185, 129, 0.15); }

        /* --- Buttons --- */
        .btn { display: inline-flex; align-items: center; justify-content: center; padding: 0.5rem 1.5rem; border-radius: 0.375rem; font-size: 0.875rem; font-weight: 500; cursor: pointer; border: none; transition: background-color 0.2s, box-shadow 0.2s; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
        .btn i { margin-right: 0.5rem; }
        .btn-green { background-color: #16a34a; color: white; padding:0.75rem 0.5rem;}
        .btn-green:hover { background-color: #15803d; }
        .btn-indigo { background-color: #4f46e5; color: white; }
        .btn-indigo:hover { background-color: #4338ca; }
        .btn-gray { background-color: #e5e7eb; color: #374151; }
        .btn-gray:hover { background-color: #d1d5db; }

        /* --- Responsive Adjustments --- */
        @media (max-width: 640px) { .action-container { flex-direction: column; align-items: stretch; } .action-btn { width: 100%; } .action-btn .form-input { min-width: 0; flex: 1; max-width: none; } }

        /* Action Buttons (Edit/Delete) */
        .action-cell { display: flex; justify-content: center; align-items: center; gap: 0.75rem; height: 100%; }
        .btn-action { display: inline-flex; align-items: center; padding: 0.25rem 0.5rem; border-radius: 0.375rem; font-size: 0.875rem; background: transparent; cursor: pointer; border: 1px solid; transition: 0.2s; white-space: nowrap; }
        .btn-action i { margin-right: 0.25rem; }
        .btn-edit { border-color: #93c5fd; color: #2563eb; }
        .btn-edit:hover { background-color: #eff6ff; color: #1e40af; }
        .btn-delete { border-color: #fca5a5; color: #dc2626; }
        .btn-delete:hover { background-color: #fef2f2; color: #991b1b; }

        /* Table */
        .table-container { overflow-x: auto; background-color: #ffffff; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1); border-radius: 0.5rem; border: 1px solid #e5e7eb; }
        .data-table { width: 100%; border-collapse: collapse; text-align: left; font-size: 0.875rem; min-width: 800px; }
        .data-table th { padding: 0.75rem 2.25rem; background-color: #f3f4f6; color: #374151; font-weight: 600; text-transform: uppercase; border-bottom: 1px solid #e5e7eb; }
        .data-table td { padding: 1rem 2.25rem; border-bottom: 1px solid #e5e7eb; color: #1f2937; vertical-align: middle; }
        .data-table tbody tr:hover { background-color: #f9fafb; transition: background-color 0.15s; }
        .text-center { text-align: center; }

        /* Badges for Permissions */
        .badge-indigo { display: inline-flex; align-items: center; white-space: nowrap; padding: 0.125rem 0.75rem; background-color: #eef2ff; color: #4338ca; border: 1px solid #c7d2fe; border-radius: 9999px; font-size: 0.75rem; font-weight: 600; letter-spacing: 0.025em; text-transform: capitalize; box-shadow: 0 1px 2px rgba(0,0,0,0.02); }
        .permission-container { display: flex; flex-wrap: wrap; gap: 0.5rem; }

        /* Pagination Container */
        .pagination-wrapper { margin-top: 1rem; }

        /* Modals */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.6); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 1rem; }
        .modal-overlay.hidden { display: none; }
        .modal-box { position: relative; background-color: white; border-radius: 0.75rem; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04); width: 100%; max-width: 48rem; max-height: 90vh; overflow-y: auto; padding: 2.5rem 2rem 2rem 2rem; box-sizing: border-box; }
        
        /* Fixed Modal Close Button */
        .close-btn { position:absolute; top:1.5rem; right:2rem; color:#6b7280; font-size:2.5rem; background:none; border:none; cursor:pointer; transition:color 0.2s; line-height: 1; }
        .close-btn:hover { color:#111827; }
        .modal-title { font-size: 1.5rem; font-weight: 700; color: #111827; margin-top: 0; margin-bottom: 2rem; border-bottom: 2px solid #e5e7eb; padding-bottom: 1rem; padding-right: 3rem; }
        
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
        
        /* Custom Checkbox Grid for Permissions */
        .checkbox-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 0.75rem; margin-top: 0.5rem; }
        .checkbox-label { display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; cursor: pointer; color: #374151; }
        .checkbox-input { height: 1rem; width: 1rem; color: #4f46e5; border: 1px solid #d1d5db; border-radius: 0.25rem; cursor: pointer; }
    </style>

    <div id="main-content">
        <div class="panel">
            
            <div class="header-flex">
                <h3 class="title">All Roles</h3>
            </div>

            <div class="action-container">
                @can('create_roles')
                    <button id="openModal" class="btn btn-green">
                        <i class="fas fa-plus"></i> Add Role
                    </button>
                @endcan
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th class="text-center">Role Name</th>
                            <th>Permissions</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td class="text-center" style="font-weight: 600;">{{ $role->name }}</td>
                                <td>
                                    @if($role->permissions->isNotEmpty())
                                        <div class="permission-container">
                                            @foreach($role->permissions as $permission)
                                                <span class="badge-indigo">
                                                    {{ $permission->name }}
                                                </span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span style="font-size: 0.75rem; color: #6b7280; font-style: italic;">No permissions assigned</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-cell">
                                        {{-- Edit Button --}}
                                        @can('edit_roles')
                                            <button class="btn-action btn-edit editBtn"
                                                data-id="{{ $role->id }}"
                                                data-name="{{ $role->name }}"
                                                data-permissions='@json($role->permissions->pluck("id"))'>
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                        @endcan

                                        {{-- Delete Button --}}
                                        @can('delete_roles')
                                            <form id="delete-form-{{ $role->id }}" action="{{ route('roles.destroy', $role->id) }}" method="POST" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-action btn-delete delete-btn" data-id="{{ $role->id }}">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center" style="padding: 2rem; color: #6b7280;">
                                    No Roles found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $roles->links() }}
            </div>
            
        </div>
    </div>

    {{-- Modal: Add Role --}}
    <div id="permissionModal" class="modal-overlay hidden">
        <div id="permissionModalContent" class="modal-box">
            <button id="closeModal" class="close-btn" aria-label="Close">&times;</button>
            <h2 class="modal-title">Add Role</h2>

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group col-span-2">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" name="name" id="name" required class="form-input">
                    </div>

                    <div class="form-group col-span-2">
                        <span class="form-label">Permissions</span>
                        <div class="checkbox-grid">
                            @foreach ($permissions as $permission)
                            <label class="checkbox-label" for="add_perm_{{ $permission->id }}">
                                <input type="checkbox" 
                                    name="permissions[]" 
                                    value="{{ $permission->id }}" 
                                    id="add_perm_{{ $permission->id }}" 
                                    class="checkbox-input">
                                {{ $permission->name }}
                            </label>
                            @endforeach
                        </div>
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

    {{-- Modal: Edit Role --}}
    <div id="editModal" class="modal-overlay hidden">
        <div id="editModalContent" class="modal-box">
            <button id="closeEditModal" class="close-btn" aria-label="Close">&times;</button>
            <h2 class="modal-title">Edit Role</h2>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="form-group col-span-2">
                        <label for="edit_name" class="form-label">Role Name</label>
                        <input type="text" name="name" id="edit_name" required class="form-input">
                    </div>

                    <div class="form-group col-span-2">
                        <span class="form-label">Permissions</span>
                        <div class="checkbox-grid">
                            @foreach ($permissions as $permission)
                            <label class="checkbox-label" for="edit_perm_{{ $permission->id }}">
                                <input type="checkbox" 
                                    name="permissions[]" 
                                    value="{{ $permission->id }}" 
                                    id="edit_perm_{{ $permission->id }}" 
                                    class="edit-permission checkbox-input">
                                {{ $permission->name }}
                            </label>
                            @endforeach
                        </div>
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

            // Add Role Modal Toggles
            const addModal = document.getElementById("permissionModal");
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

            // Edit Role Modal Toggles
            const editModal = document.getElementById("editModal");
            const closeEditBtn = document.getElementById("closeEditModal");
            const editButtons = document.querySelectorAll(".editBtn");
            const editForm = document.getElementById("editForm");
            const editName = document.getElementById("edit_name");

            editButtons.forEach(button => {
                button.addEventListener("click", (e) => {
                    e.preventDefault();

                    const id = button.dataset.id;
                    const name = button.dataset.name;
                    const permissions = JSON.parse(button.dataset.permissions || "[]");

                    // Fill modal inputs
                    editName.value = name;
                    
                    // Update form action dynamically
                    editForm.action = `/roles/${id}`;

                    // Reset all checkboxes first
                    document.querySelectorAll(".edit-permission").forEach(cb => cb.checked = false);
                    
                    // Check the correct permissions
                    permissions.forEach(pid => {
                        const cb = document.getElementById("edit_perm_" + pid);
                        if(cb) cb.checked = true;
                    });

                    // Show modal
                    editModal.classList.remove("hidden");
                });
            });

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
                        title: 'Delete this Role?',
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