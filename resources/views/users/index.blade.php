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

        /* --- Search Form Group (Joined Input & Button) --- */
        .action-btn { display: flex; align-items: stretch; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }

        /* --- Search Input Enhancements --- */
        .action-btn .form-input { border-top-right-radius: 0; border-bottom-right-radius: 0; border-right: none; margin: 0; width: 100%; min-width: 250px; max-width: 350px; transition: all 0.2s; position: relative; z-index: 1; }
        .action-btn .form-input:focus { z-index: 10; border-color: #4f46e5; box-shadow: inset 0 0 0 1px #4f46e5, 0 0 0 2px rgba(79,70,229,0.2); }

        /* --- Search Button Enhancements --- */
        .action-btn .btn-indigo { border-top-left-radius: 0; border-bottom-left-radius: 0; margin: 0; padding: 0.5rem 1.25rem; z-index: 2; transition: background-color 0.2s; }

        /* --- Add User Button Enhancements --- */
        .btn-green { background-color: #10b981; color: white; border: 1px solid #059669; padding: 0.5rem 1.5rem; min-width: 120px; justify-content: center; display: inline-flex; align-items: center; box-shadow: 0 2px 4px rgba(16, 185, 129, 0.15); transition: all 0.2s ease; border-radius: 0.375rem; cursor: pointer; }
        .btn-green:hover { background-color: #059669; transform: translateY(-1px); box-shadow: 0 4px 6px rgba(16, 185, 129, 0.25); }
        .btn-green:active { transform: translateY(0); box-shadow: 0 1px 2px rgba(16, 185, 129, 0.15); }

        /* --- Responsive Adjustments --- */
        @media (max-width: 640px) { .action-container { flex-direction: column; align-items: stretch; } .action-btn { width: 100%; } .action-btn .form-input { min-width: 0; flex: 1; max-width: none; } }
                
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
    </style>

    <div id="main-content">
        <div class="panel">
            
            <div class="header-flex">
                <h3 class="title">All Users</h3>
            </div>

            <div class="action-container">
                @can('create_tech_users')
                    <button id="openModal" class="btn btn-green">
                        <i class="fas fa-plus"></i> Add User
                    </button>
                @endcan

                <form action="{{ route('users.index') }}" method="GET" class="action-btn">
                    <input type="text" name="search_query" value="{{ request('search_query') }}" placeholder="Search..." class="form-input" style="width: 250px; height: 2.5rem;">
                    <button type="submit" class="btn btn-indigo">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>

            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>FullName</th>
                            <th>Email</th>
                            <th>Region</th>
                            <th>Contact Number</th>
                            <th>Role</th>
                            @can('delete_tech_users')<th class="text-center">Actions</th>@endcan
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->region }}</td>
                                <td>{{ $user->contact_number }}</td>

                                <td>
                                    @if($user->roles->isNotEmpty())
                                        @foreach($user->roles as $role)
                                            <span style="display: inline-flex; align-items: center; white-space: nowrap; padding: 0.125rem 1.5rem; background-color: #eef2ff; color: #4338ca; border: 1px solid #c7d2fe; border-radius: 9999px; font-size: 0.875rem; font-weight: 600; letter-spacing: 0.025em; text-transform: capitalize; margin: 0.125rem 0.25rem 0.125rem 0; box-shadow: 0 1px 2px rgba(0,0,0,0.02);">
                                                {{ $role->name }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span style="font-size: 0.75rem; color: #dc2626; font-style: italic;">
                                            No Role Assigned
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <div class="action-cell">
                                        {{-- Edit Button --}}
                                        @can('edit_tech_users')
                                            <button class="btn-action btn-edit editBtn"
                                                data-id="{{ $user->id }}"
                                                data-name="{{ $user->name }}"
                                                data-email="{{ $user->email }}"
                                                data-region="{{ $user->region }}"
                                                data-contact-number="{{ $user->contact_number }}"
                                                data-role-id="{{ optional($user->roles->first())->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                        @endcan

                                        {{-- Delete Button --}}
                                        @can('delete_tech_users')
                                            <form id="delete-form-{{ $user->id }}" action="{{ route('users.destroy', $user->id) }}" method="POST" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn-action btn-delete delete-btn" data-id="{{ $user->id }}">
                                                    <i class="fas fa-trash-alt"></i> Delete
                                                </button>
                                            </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center" style="padding: 2rem; color: #6b7280;">
                                    No User found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrapper">
                {{ $users->links() }}
            </div>
            
        </div>
    </div>

    {{-- Modal: Add User --}}
    <div id="userModal" class="modal-overlay hidden">
        <div id="userModalContent" class="modal-box">
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

            @error('role')
                <p style="color: #dc2626; font-size: 0.875rem; margin-bottom: 1rem;">{{ $message }}</p>
            @enderror

            <h2 class="modal-title">Add New User</h2>

            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="form-grid">
                    <div class="form-group col-span-2">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" required placeholder="John A. Doe" class="form-input">
                    </div>

                    <div class="form-group col-span-2">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" required placeholder="j_doe@cda.gov.ph" class="form-input">
                    </div>

                    <div class="form-group col-span-2">
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

                    <div class="form-group col-span-2">
                        <label for="contact_number" class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" required placeholder="09123456789" class="form-input">
                    </div>

                    <div class="form-group">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" required class="form-input">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" required class="form-input">
                    </div>

                    <div class="form-group col-span-2">
                        <span class="form-label">Select Role</span>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.25rem;">
                            @foreach ($roles as $role)
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; cursor: pointer;">
                                    <input type="radio" name="role" id="add_role_{{ $loop->index }}" value="{{ $role->id }}" {{ old('role') == $role->id ? 'checked' : '' }}>
                                    {{ $role->name }}
                                </label>
                            @endforeach
                        </div>
                        @error('role')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-span-2">
                        <label for="created_at" class="form-label">Date Added</label>
                        <input type="text" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}" readonly class="form-input" style="background-color: #f9fafb; cursor: not-allowed;">
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

    {{-- Modal: Edit User --}}
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

            <h2 class="modal-title">Edit User</h2>

            <form id="editForm" method="POST" action="#">
                @csrf
                @method('PUT')
                <div class="form-grid">
                    <div class="form-group col-span-2">
                        <label for="edit_name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="edit_name" value="" required class="form-input">
                    </div>

                    <div class="form-group col-span-2">
                        <label for="edit_email" class="form-label">Email</label>
                        <input type="email" name="email" id="edit_email" value="" required class="form-input">
                    </div>

                    <div class="form-group col-span-2">
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

                    <div class="form-group col-span-2">
                        <label for="edit_contact_number" class="form-label">Contact Number</label>
                        <input type="text" name="contact_number" id="edit_contact_number" value="" required class="form-input">
                    </div>

                    <div class="form-group col-span-2">
                        <span class="form-label">Select Role</span>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem; margin-top: 0.25rem;">
                            @foreach ($roles as $role)
                                <label style="display: flex; align-items: center; gap: 0.5rem; font-size: 0.875rem; cursor: pointer;">
                                    <input type="radio" name="role" id="edit_role_{{ $loop->index }}" value="{{ $role->id }}">
                                    {{ $role->name }}
                                </label>
                            @endforeach
                        </div>
                        @error('role')
                            <p style="color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem;">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-group col-span-2">
                        <label class="form-label">Last Updated</label>
                        <input type="text" value="{{ \Carbon\Carbon::now()->setTimezone('Asia/Manila')->format('F j, Y h:i A') }}" readonly class="form-input" style="background-color: #f9fafb; cursor: not-allowed;">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-indigo">
                        <i class="fas fa-paper-plane"></i> Update
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

            @if ($errors->any())
                Swal.fire({
                    icon: 'error',
                    title: 'Validation Error',
                    html: `{!! implode('<br>', $errors->all()) !!}`,
                    showConfirmButton: true
                });
            @endif

            // Add Modal Toggles
            const addModal = document.getElementById("userModal");
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
            const editName = document.getElementById("edit_name");
            const editRegion = document.getElementById("edit_region");
            const editEmail = document.getElementById("edit_email");
            const editContactNumber = document.getElementById("edit_contact_number");

            editButtons.forEach(button => {
                button.addEventListener("click", (e) => {
                    e.preventDefault();

                    const id = button.dataset.id;
                    const name = button.dataset.name;
                    const email = button.dataset.email;
                    const region = button.dataset.region;
                    const contactNumber = button.dataset.contactNumber;
                    const roleId = button.dataset.roleId;

                    // Fill modal inputs
                    editName.value = name;
                    editEmail.value = email;
                    editRegion.value = region;
                    editContactNumber.value = contactNumber;

                    // Update form action dynamically
                    editForm.action = `/users/${id}`;

                    // Preselect role radio
                    document.querySelectorAll('input[name="role"][id^="edit_role_"]').forEach(r => {
                        r.checked = (String(r.value) === String(roleId));
                    });

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
                        title: 'Delete this User?',
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