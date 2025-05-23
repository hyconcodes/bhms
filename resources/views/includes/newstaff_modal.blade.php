<!-- Event modal -->
<!-- Add new event Modal -->
<div class="modal fade" id="newStaffModal" tabindex="-1" role="dialog" aria-labelledby="newStaffModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="needs-validation" novalidate id="staffForm" action="{{ route('admin.store') }}" method="POST">
                @csrf
                <!-- Header -->
                <div class="modal-header pb-0">
                    <h3 id="newStaffModalTitle" class="modal-title">Add New Staff</h3>
                    <!-- Button -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="staffName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="staffName" name="name" placeholder="Full name" required>
                        <div class="invalid-feedback">Please enter the staff name</div>
                    </div>
                    <div class="mb-3">
                        <label for="staffEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="staffEmail" name="email" placeholder="Email address" required>
                        <div class="invalid-feedback">Please enter a valid email address</div>
                    </div>
                    <div class="mb-3">
                        <label for="staffPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="staffPassword" name="password" placeholder="Password" required>
                        <div class="invalid-feedback">Please enter a password</div>
                    </div>
                    <div class="mb-3">
                        <label for="staffConfirmPassword" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="staffConfirmPassword" name="password_confirmation" placeholder="Confirm password" required>
                        <div class="invalid-feedback">Passwords do not match</div>
                    </div>
                    <div class="mb-3">
                        <label for="staffRole" class="form-label">Role</label>
                        <select class="form-select" id="staffRole" name="role_id" required>
                            <option value="" disabled selected>Select role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select a role</div>
                    </div>
                </div>
                <!-- End Body -->

                <!-- Footer -->
                <div class="modal-footer pt-0">

                    <!-- Button -->
                    <button type="button" class="btn btn-outline-danger me-auto" id="btnDeleteEvent" data-bs-dismiss="modal">Delete</button>

                    <!-- Button -->
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>

                    <!-- Button -->
                    <button class="btn btn-primary" id="btnSaveEvent">Save</button>
                </div>
                <!-- End Footer -->
            </form>
        </div>
    </div>
</div>