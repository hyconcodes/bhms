<!-- Patient modal -->
<!-- Add new patient Modal -->
<div class="modal fade" id="newPatientModal" tabindex="-1" role="dialog" aria-labelledby="newPatientModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="needs-validation" novalidate id="patientForm" action="{{ route('patient.store') }}" method="POST">
                @csrf
                <!-- Header -->
                <div class="modal-header pb-0">
                    <h3 id="newPatientModalTitle" class="modal-title">Add New Patient</h3>
                    <!-- Button -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <!-- End Header -->

                <!-- Body -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="patientName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="patientName" name="name" placeholder="Full name" required>
                        <div class="invalid-feedback">Please enter the patient's name</div>
                    </div>
                    <div class="mb-3">
                        <label for="patientEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="patientEmail" name="email" placeholder="Email address" required>
                        <div class="invalid-feedback">Please enter a valid email address</div>
                    </div>
                    <div class="mb-3">
                        <label for="patientPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="patientPassword" name="password" placeholder="Password" required>
                        <div class="invalid-feedback">Please enter a password</div>
                    </div>
                    <div class="mb-3">
                        <label for="patientPasswordConfirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="patientPasswordConfirmation" name="password_confirmation" placeholder="Confirm password" required>
                        <div class="invalid-feedback">Please confirm the password</div>
                    </div>
                    <div class="mb-3">
                        <label for="patientRole" class="form-label">Role</label>
                        <select class="form-select" id="patientRole" name="role_id" required>
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
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <!-- Button -->
                    <button class="btn btn-primary" id="btnSavePatient">Save</button>
                </div>
                <!-- End Footer -->
            </form>
        </div>
    </div>
</div>
