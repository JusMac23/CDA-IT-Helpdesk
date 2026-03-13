<x-app-layout>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <style>
        /* Global Box Sizing & Font Fix */
        *, *::before, *::after { box-sizing: border-box; }
        body { font-family: 'Inter', system-ui, -apple-system, sans-serif; }

        /* Main Layout - Mobile First 100% Width */
        .panel { background-color: #ffffff; border-radius: 1rem; border: 1px solid #f1f5f9; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05), 0 2px 4px -1px rgba(0,0,0,0.03); padding: 1.25rem; width: 100%; }
        
        /* Typography */
        .header-flex { display: flex; flex-direction: column; align-items: flex-start; margin-bottom: 1.5rem; gap: 1rem; width: 100%; }
        .title { font-size: 1.75rem; font-weight: 800; color: #0f172a; margin: 0; letter-spacing: -0.025em; }
        
        /* --- Action Container - Mobile First --- */
        .action-container { display: flex; flex-direction: column; width: 100%; gap: 1rem; margin-bottom: 1.5rem; }

        /* --- Buttons - Uniform Heights --- */
        .btn { display: inline-flex; align-items: center; justify-content: center; height: 44px; padding: 0 1.5rem; border-radius: 0.5rem; font-size: 0.95rem; font-weight: 600; cursor: pointer; border: none; transition: all 0.2s ease; width: 100%; text-decoration: none; font-family: inherit; }
        .btn i { margin-right: 0.5rem; font-size: 1rem; }
        
        /* Modern Green */
        .btn-green { background-color: #10b981; color: white; box-shadow: 0 1px 2px rgba(16, 185, 129, 0.2); }
        .btn-green:hover { background-color: #059669; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(16, 185, 129, 0.2); }

        /* Modern Indigo */
        .btn-indigo { background-color: #4f46e5; color: white; box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }
        .btn-indigo:hover { background-color: #4338ca; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3); }
        .btn-indigo:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(79, 70, 229, 0.2); }

        /* Modern Gray */
        .btn-gray { background-color: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }
        .btn-gray:hover { background-color: #e2e8f0; color: #0f172a; }

        /* Table & Badges */
        .table-container { overflow-x: auto; background-color: #ffffff; border-radius: 0.75rem; border: 1px solid #e2e8f0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05); width: 100%; -webkit-overflow-scrolling: touch; margin-bottom: 1.5rem; }
        .data-table { width: 100%; min-width: 600px; border-collapse: collapse; text-align: left; font-size: 0.9rem; }
        .data-table th { padding: 1rem 1.5rem; background-color: #f8fafc; color: #64748b; font-weight: 700; font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.05em; border-bottom: 2px solid #e2e8f0; white-space: nowrap; }
        .data-table td { padding: 1.25rem 1.5rem; border-bottom: 1px solid #f1f5f9; color: #334155; vertical-align: middle; font-weight: 500; }
        .data-table tbody tr { transition: background-color 0.15s; }
        .data-table tbody tr:hover { background-color: #f8fafc; }
        .text-center { text-align: center; }

        /* Clean Role Badges */
        .badge-indigo { display: inline-flex; align-items: center; white-space: nowrap; padding: 0.25rem 0.75rem; background-color: #eef2ff; color: #4f46e5; border: 1px solid #c7d2fe; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; letter-spacing: 0.025em; margin-bottom: 0.25rem; }
        .permission-container { display: flex; flex-wrap: wrap; gap: 0.4rem; justify-content: center; }

        /* Action Buttons inside Table */
        .action-cell { display: flex; flex-wrap: wrap; justify-content: center; align-items: center; gap: 0.5rem; }
        .action-link { display: inline-flex; align-items: center; justify-content: center; height: 34px; padding: 0 0.85rem; border-radius: 0.375rem; font-size: 0.85rem; font-weight: 600; font-family: inherit; cursor: pointer; transition: all 0.2s; text-decoration: none; background: transparent; white-space: nowrap; box-sizing: border-box; }
        .action-link i { margin-right: 0.35rem; font-size: 0.9rem; }
        
        .link-blue { color: #3b82f6; border: 1px solid #bfdbfe; } 
        .link-blue:hover { background-color: #eff6ff; color: #1d4ed8; border-color: #93c5fd; }
        
        .link-red { color: #ef4444; border: 1px solid #fecaca; } 
        .link-red:hover { background-color: #fef2f2; color: #b91c1c; border-color: #fca5a5; }

        /* Pagination Fixes */
        .pagination-wrapper { width: 100%; overflow-x: auto; padding-bottom: 0.5rem; }
        .pagination-wrapper nav { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; }
        .pagination-wrapper svg { width: 1.25rem !important; height: 1.25rem !important; display: inline-block; vertical-align: middle; }
        .pagination-wrapper a, .pagination-wrapper span { display: inline-flex; align-items: center; justify-content: center; font-weight: 500; }
        .pagination-wrapper p { margin: 0; font-size: 0.875rem; color: #64748b; font-weight: 500; }

        /* Modals - Mobile First */
        .modal-overlay { position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(15, 23, 42, 0.75); backdrop-filter: blur(4px); z-index: 50; display: flex; align-items: center; justify-content: center; padding: 1rem; }
        .modal-overlay.hidden { display: none; }
        .modal-box { position: relative; background-color: white; border-radius: 1rem; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.25); width: 100%; max-width: 48rem; max-height: 90vh; overflow-y: auto; padding: 1.5rem; }
        
        /* Fixed Modal Close Button */
        .close-btn { position: absolute; top: 1.25rem; right: 1.25rem; color: #94a3b8; font-size: 2rem; background: none; border: none; cursor: pointer; transition: color 0.2s; line-height: 1; border-radius: 0.25rem; padding: 0 0.5rem; }
        .close-btn:hover { color: #0f172a; background-color: #f1f5f9; }
        
        .modal-title { font-size: 1.5rem; font-weight: 800; color: #0f172a; margin-top: 0; margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; padding-right: 2.5rem; }
        
        /* Form Grid - Mobile First 100% Width */
        .form-grid { display: flex; flex-direction: column; gap: 1.25rem; width: 100%; }

        /* Form Controls - Unified Heights */
        .form-group { display: flex; flex-direction: column; width: 100%; }
        .form-label { font-size: 0.875rem; font-weight: 600; color: #475569; margin-bottom: 0.5rem; width: 100%; }
        .form-input { height: 44px; padding: 0 1rem; font-size: 0.95rem; color: #334155; border: 1px solid #cbd5e1; border-radius: 0.5rem; background-color: white; outline: none; transition: all 0.2s; font-family: inherit; width: 100%; box-sizing: border-box; }
        .form-input:focus { border-color: #6366f1; box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.15); }

        /* Custom Checkbox Grid for Permissions */
        .checkbox-grid { display: flex; flex-direction: column; gap: 0.85rem; margin-top: 0.5rem; width: 100%; }
        .checkbox-label { display: flex; align-items: flex-start; gap: 0.75rem; font-size: 0.95rem; font-weight: 500; color: #334155; cursor: pointer; line-height: 1.4; word-break: break-word; }
        .checkbox-input { margin-top: 0.15rem; width: 1.15rem; height: 1.15rem; accent-color: #4f46e5; cursor: pointer; border-radius: 0.25rem; flex-shrink: 0; }
        
        .modal-footer { display: flex; flex-direction: column; padding-top: 1.5rem; border-top: 1px solid #e2e8f0; margin-top: 1.5rem; gap: 0.75rem; width: 100%; }

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
            .panel { padding: 2rem; }
            .header-flex { flex-direction: row; justify-content: space-between; align-items: center; }
            
            /* Align Add button inline */
            .action-container { flex-direction: row; justify-content: flex-end; align-items: center; }
            
            /* Un-stretch main page buttons */
            .action-container .btn { width: auto; min-width: 140px; }
            
            /* Restore Grid layout for Desktop */
            .form-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
            .col-span-2 { grid-column: span 2; }
            
            /* Checkbox grid for Desktop */
            .checkbox-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); }
            .checkbox-label { align-items: center; }
            .checkbox-input { margin-top: 0; }
            
            /* Modal formatting for Desktop */
            .modal-box { padding: 2.5rem; }
            .close-btn { top: 1.5rem; right: 2rem; }
            
            /* Modal Footer Buttons */
            .modal-footer { flex-direction: row; justify-content: flex-end; }
            .modal-footer .btn { width: auto; } /* Fixes the submit/cancel width issue */
        }
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
                            <th class="text-center">Permissions</th>
                            @if(auth()->user()->can('edit_roles') || auth()->user()->can('delete_roles'))
                                <th class="text-center">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                            <tr>
                                <td class="text-center font-bold-name" style="font-size: 1rem;">{{ $role->name }}</td>
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
                                        <div class="text-center">
                                            <span style="font-size: 0.8rem; color: #94a3b8; font-style: italic; font-weight: 500;">No permissions assigned</span>
                                        </div>
                                    @endif
                                </td>

                                @if(auth()->user()->can('edit_roles') || auth()->user()->can('delete_roles'))
                                <td>
                                    <div class="action-cell">
                                        {{-- Edit Button --}}
                                        @can('edit_roles')
                                            <button type="button" class="action-link link-blue editBtn"
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
                                                <button type="button" class="action-link link-red delete-btn" data-id="{{ $role->id }}">
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
                                <td colspan="3" class="text-center" style="padding: 3rem; color: #94a3b8; font-size: 1rem;">
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
            <button id="closeModal" class="close-btn" aria-label="Close Modal">&times;</button>
            <h2 class="modal-title">Create New Role</h2>

            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group col-span-2">
                        <label for="name" class="form-label">Role Name</label>
                        <input type="text" name="name" id="name" required class="form-input" autocomplete="off" placeholder="e.g., Administrator">
                    </div>

                    <div class="form-group col-span-2">
                        <span class="form-label">Assign Permissions</span>
                        <div class="checkbox-grid">
                            @foreach ($permissions as $permission)
                            <label class="checkbox-label" for="add_perm_{{ $permission->id }}">
                                <input type="checkbox" 
                                    name="permissions[]" 
                                    value="{{ $permission->id }}" 
                                    id="add_perm_{{ $permission->id }}" 
                                    class="checkbox-input">
                                <span>{{ $permission->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" id="cancelAddModal">Cancel</button>
                    <button type="submit" class="btn btn-indigo">
                        <i class="fas fa-paper-plane"></i> Save Role
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal: Edit Role --}}
    <div id="editModal" class="modal-overlay hidden">
        <div id="editModalContent" class="modal-box">
            <button id="closeEditModal" class="close-btn" aria-label="Close Modal">&times;</button>
            <h2 class="modal-title">Edit Role Details</h2>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="form-group col-span-2">
                        <label for="edit_name" class="form-label">Role Name</label>
                        <input type="text" name="name" id="edit_name" required class="form-input" autocomplete="off">
                    </div>

                    <div class="form-group col-span-2">
                        <span class="form-label">Update Permissions</span>
                        <div class="checkbox-grid">
                            @foreach ($permissions as $permission)
                            <label class="checkbox-label" for="edit_perm_{{ $permission->id }}">
                                <input type="checkbox" 
                                    name="permissions[]" 
                                    value="{{ $permission->id }}" 
                                    id="edit_perm_{{ $permission->id }}" 
                                    class="edit-permission checkbox-input">
                                <span>{{ $permission->name }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-gray" id="cancelEditModal">Cancel</button>
                    <button type="submit" class="btn btn-indigo">
                        <i class="fas fa-save"></i> Save Changes
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
                    text: '{!! addslashes(session("success")) !!}',
                    timer: 2500,
                    showConfirmButton: false
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Notice!',
                    text: '{!! addslashes(session("error")) !!}',
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

            // Add Role Modal Toggles
            const addModal = document.getElementById("permissionModal");
            const openAddBtn = document.getElementById("openModal");
            const closeAddBtn = document.getElementById("closeModal");
            const cancelAddBtn = document.getElementById("cancelAddModal");

            if (openAddBtn && addModal) {
                openAddBtn.addEventListener("click", () => addModal.classList.remove("hidden"));
            }

            const closeAddModalFunc = () => { if(addModal) addModal.classList.add("hidden"); };
            if (closeAddBtn) closeAddBtn.addEventListener("click", closeAddModalFunc);
            if (cancelAddBtn) cancelAddBtn.addEventListener("click", closeAddModalFunc);

            if (addModal) {
                addModal.addEventListener("click", (e) => {
                    if (e.target === addModal) closeAddModalFunc();
                });
            }

            // Edit Role Modal Toggles
            const editModal = document.getElementById("editModal");
            const closeEditBtn = document.getElementById("closeEditModal");
            const cancelEditBtn = document.getElementById("cancelEditModal");
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

            const closeEditModalFunc = () => { if(editModal) editModal.classList.add("hidden"); };
            if (closeEditBtn) closeEditBtn.addEventListener("click", closeEditModalFunc);
            if (cancelEditBtn) cancelEditBtn.addEventListener("click", closeEditModalFunc);

            if (editModal) {
                editModal.addEventListener("click", (e) => {
                    if (e.target === editModal) closeEditModalFunc();
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
                        confirmButtonColor: '#ef4444',
                        cancelButtonColor: '#64748b',
                        confirmButtonText: 'Yes, delete',
                        cancelButtonText: 'Cancel'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });

            // Allow closing modals with Escape key
            document.addEventListener('keydown', function(event) {
                if (event.key === "Escape") {
                    closeAddModalFunc();
                    closeEditModalFunc();
                }
            });
        });
    </script>
</x-app-layout>