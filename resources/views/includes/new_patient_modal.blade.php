<!-- Patient modal -->
<div class="modal fade" id="newPatientModal" tabindex="-1" role="dialog" aria-labelledby="newPatientModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form class="needs-validation" novalidate id="patientForm" action="{{ route('patient.store') }}" method="POST">
                @csrf
                <!-- Header -->
                <div class="modal-header pb-0">
                    <h3 id="newPatientModalTitle" class="modal-title">Add New Patient</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <!-- Body -->
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="patientRegNo" class="form-label">JAMB Reg No</label>
                        <input type="text" class="form-control" id="patientRegNo" name="reg_no" placeholder="e.g. 12345678AB" pattern="[0-9]{8}[A-Za-z]{2}" required>
                        <div class="invalid-feedback">Please enter a valid JAMB registration number</div>
                    </div>
                    <div class="mb-3">
                        <label for="patientName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="patientName" name="name" placeholder="Full name" required readonly>
                        <div class="invalid-feedback">Please enter the patient's name</div>
                    </div>
                    <div class="mb-3">
                        <label for="patientEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="patientEmail" name="email" placeholder="Email address" required readonly>
                        <div class="invalid-feedback">Please enter a valid email address</div>
                    </div>
                    <div class="mb-3">
                        <label for="patientPassword" class="form-label">Password</label>
                        <input type="password" class="form-control" id="patientPassword" name="password" placeholder="Password" required readonly>
                        <div class="invalid-feedback">Please enter a password</div>
                    </div>
                    <div class="mb-3">
                        <label for="patientPasswordConfirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="patientPasswordConfirmation" name="password_confirmation" placeholder="Confirm password" required readonly>
                        <div class="invalid-feedback">Please confirm the password</div>
                    </div>
                    <div class="mb-3">
                        <label for="patientRole" class="form-label">Role</label>
                        <select class="form-select" id="patientRole" name="role_id" required>
                            <option value="" disabled>Select role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ strtolower($role->name) === 'student' ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">Please select a role</div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" id="btnSavePatient">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('patientRegNo').addEventListener('input', function(e) {
        const regNo = e.target.value;
        const regNoInput = document.getElementById('patientRegNo');
        const feedbackDiv = regNoInput.nextElementSibling;

        feedbackDiv.textContent = 'Please enter a valid JAMB registration number';
        regNoInput.classList.remove('is-invalid');
        let existingSpinner = regNoInput.parentNode.querySelector('.spinner-border');
        if (existingSpinner) existingSpinner.remove();

        if (regNo.length === 10) {
            const loadingIndicator = document.createElement('div');
            loadingIndicator.className = 'spinner-border text-primary spinner-border-sm ms-2';
            loadingIndicator.setAttribute('role', 'status');
            regNoInput.parentNode.appendChild(loadingIndicator);

            fetch('{{ $api_url }}/jamb_no/' + regNo)
                .then((response) => response.json())
                .then((data) => {
                    if (data.error || !data.data) {
                        regNoInput.classList.add('is-invalid');
                        feedbackDiv.textContent = data.message || 'Invalid JAMB registration number';
                        enableManualInput(); // Enable manual input
                        clearFormFields();
                    } else {
                        const details = data.data;
                        regNoInput.classList.remove('is-invalid');

                        // Populate fields with fetched data
                        document.getElementById('patientName').removeAttribute('readonly');
                        document.getElementById('patientEmail').removeAttribute('readonly');
                        document.getElementById('patientName').value = details.name || '';
                        document.getElementById('patientEmail').value = details.email || '';
                        document.getElementById('patientName').setAttribute('readonly', 'readonly');
                        document.getElementById('patientEmail').setAttribute('readonly', 'readonly');

                        // Generate and populate a random password
                        const randomPassword = generateRandomPassword(8);
                        document.getElementById('patientPassword').value = randomPassword;
                        document.getElementById('patientPasswordConfirmation').value = randomPassword;
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    alert('Unable to fetch data. You can now input details manually.');
                    enableManualInput(); // Enable manual input on error
                    clearFormFields();
                })
                .finally(() => {
                    loadingIndicator.remove();
                });
        } else {
            clearFormFields();
            enableManualInput(); // Allow manual input for invalid reg_no length
        }
    });

    function clearFormFields() {
        document.getElementById('patientName').value = '';
        document.getElementById('patientEmail').value = '';
        document.getElementById('patientPassword').value = '';
        document.getElementById('patientPasswordConfirmation').value = '';
    }

    function enableManualInput() {
        document.getElementById('patientName').removeAttribute('readonly');
        document.getElementById('patientEmail').removeAttribute('readonly');
        document.getElementById('patientPassword').removeAttribute('readonly');
        document.getElementById('patientPasswordConfirmation').removeAttribute('readonly');
    }

    function generateRandomPassword(length) {
        const charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        let password = '';
        for (let i = 0; i < length; i++) {
            password += charset.charAt(Math.floor(Math.random() * charset.length));
        }
        return password;
    }
</script>