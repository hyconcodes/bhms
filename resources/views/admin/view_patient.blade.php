@extends('layouts.app')
@section('title', 'Student Account')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Student</h1>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Patient</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-xl-9 d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100">
                <div class="card-body p-7">
                    <div class="row align-items-center h-100">
                        <div class="col-auto d-flex ms-auto ms-md-0">
                            <div class="avatar avatar-circle avatar-xxl">
                                @if($user->profile_picture)
                                <img
                                    src="{{ asset('storage/' . $user->profile_picture) }}"
                                    alt="..."
                                    class="avatar-img"
                                    width="112"
                                    height="112" />
                                @else
                                <img
                                    src="{{ asset($user->avatar) }}"
                                    alt="..."
                                    class="avatar-img"
                                    width="112"
                                    height="112" />
                                @endif
                            </div>
                        </div>

                        <div class="col-auto me-auto d-flex flex-column">
                            <h3 class="mb-0">{{ $user->name }}</h3>
                            <span class="small text-secondary fw-bold d-block mb-4">{{ $user->role->name }}</span>
                            <span class="small text-secondary fw-bold d-block">Jamb Reg No: {{ $user->reg_no }}</span>
                            <span class="small text-secondary fw-bold d-block">Matric: {{ $user->matric }}</span>
                            <!-- Dropdown -->

                            <!-- </div> -->
                        </div>

                        <div
                            class="col-12 col-md-auto ms-auto text-center mt-8 mt-md-0">
                            <div class="hstack d-inline-flex gap-4">
                                <div class="vr"></div>
                                <!-- <div>
                                    <h4 class="h2 mb-0">42</h4>
                                    <p class="text-secondary mb-0">Active Appoinment</p>
                                </div> -->


                                <div>
                                    @if($user->status)
                                    <h4 class="h3 mb-0 text-success">Active</h4>
                                    @else
                                    <h4 class="h3 mb-0 text-danger">Suspended</h4>
                                    @endif
                                    <p class="text-secondary mb-0">Status</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / .row -->
                </div>
            </div>
        </div>
        <div class="col-xl-3 d-flex">
            <!-- Card -->
            <div class="card border-0 flex-fill w-100">
                <div class="card-body text-center">
                    <div class="row align-items-center h-100">
                        <div class="col">
                            <small class="text-secondary">EMR Completion</small>

                            <!-- Circular Progress Bar -->
                            @php
                            // Calculate EMR Completion percentage based on filled fields
                            $fields = [
                            'name',
                            'email',
                            'age',
                            'no_of_children',
                            'role_id',
                            'avatar',
                            'profile_picture',
                            'matric',
                            'date_of_birth',
                            'gender',
                            'phone',
                            'address',
                            'department',
                            'level',
                            'year_of_study',
                            'guardian_name',
                            'guardian_address',
                            'guardian_contact',
                            'allergies',
                            'medical_conditions',
                            'medications',
                            'religion',
                            'nationality',
                            'marital_status',
                            'disability',
                            'reg_no',
                            'state_of_origin',
                            'state_of_domicile',
                            'faculty',
                            'heart_disease',
                            'respiratory_disease',
                            'tuberculosis',
                            'stomach_disorder',
                            'mental_disorder',
                            'gonorrhea',
                            'syphilis',
                            'epilepsy',
                            'sickle_cell',
                            'previous_operations',
                            'other_illnesses',
                            'vital_signs_bp',
                            'vital_signs_rr',
                            'vital_signs_pr',
                            'chest_xray',
                            'urine_analysis',
                            'other_lab_tests',
                            'eye_test',
                            'ent_test',
                            'reflex_test',
                            'pregnancy_status',
                            'general_fitness',
                            'hb_genotype',
                            'blood_group',
                            ];
                            $filled = 0;
                            foreach ($fields as $field) {
                            if (!empty($user->$field)) {
                            $filled++;
                            }
                            }
                            $completion = round(($filled / count($fields)) * 100);
                            $radius = 45;
                            $circumference = 2 * pi() * $radius;
                            $offset = $circumference - ($completion / 100) * $circumference;
                            @endphp
                            <div class="position-relative w-100px h-100px mx-auto mt-3">
                                <svg width="100" height="100" class="d-block mx-auto">
                                    <circle
                                        cx="50"
                                        cy="50"
                                        r="{{ $radius }}"
                                        fill="none"
                                        stroke="#e9ecef"
                                        stroke-width="10" />
                                    <circle
                                        cx="50"
                                        cy="50"
                                        r="{{ $radius }}"
                                        fill="none"
                                        stroke="#00bac7"
                                        stroke-width="10"
                                        stroke-dasharray="{{ $circumference }}"
                                        stroke-dashoffset="{{ $offset }}"
                                        stroke-linecap="round"
                                        style="transition: stroke-dashoffset 0.6s;" />
                                </svg>
                                <div class="position-absolute top-50 start-50 translate-middle text-center">
                                    <h3 class="mb-0">
                                        {{ $completion }}%
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- / .row -->
                </div>
            </div>
        </div>
    </div>
    <!-- / .row -->

    <ul class="nav nav-tabs" id="userTab">
        <li class="nav-item" role="presentation">
            <a
                href="javascript: void(0);"
                class="nav-link active"
                id="profile-tab"
                data-bs-toggle="tab"
                data-bs-target="#profile"
                role="tab"
                aria-controls="profile"
                aria-selected="true">
                Profile
            </a>
        </li>
        @if(auth()->user()->role->name === 'Super Admin')
        <li class="nav-item" role="presentation">
            <a
                href="javascript: void(0);"
                class="nav-link"
                id="position-tab"
                data-bs-toggle="tab"
                data-bs-target="#position"
                role="tab"
                aria-controls="position"
                aria-selected="true">
                Change Role
            </a>
        </li>
        @endif
        <li class="nav-item" role="presentation">
            <a
                href="javascript: void(0);"
                class="nav-link"
                id="bio-data-tab"
                data-bs-toggle="tab"
                data-bs-target="#bio-data"
                role="tab"
                aria-controls="bio-data"
                aria-selected="true">
                BIO DATA
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a
                href="javascript: void(0);"
                class="nav-link"
                id="mh-tab"
                data-bs-toggle="tab"
                data-bs-target="#mh"
                role="tab"
                aria-controls="mh"
                aria-selected="true">
                Medical History
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a
                href="javascript: void(0);"
                class="nav-link"
                id="ir-tab"
                data-bs-toggle="tab"
                data-bs-target="#ir"
                role="tab"
                aria-controls="ir"
                aria-selected="true">
                Investigation Results
            </a>
        </li>

        <li class="nav-item ms-auto" role="presentation">
            <a href="{{ route('admin.patient.downloadPDF', $user->id) }}" 
               class="btn btn-sm btn-primary d-flex align-items-center" 
               style="margin-top: 4px;">
                <i class="bi bi-download me-2"></i>
                Download Patient Data
            </a>
        </li>
    </ul>

    <div class="tab-content pt-6" id="userTabContent">
        <div
            class="tab-pane fade show active"
            id="profile"
            role="tabpanel"
            aria-labelledby="profile-tab">
            <div class="row">
                <div class="col-xl-4 col-xxl-3">
                    <!-- Card -->
                    <div class="card border-0">
                        <div class="card-header border-0">
                            <!-- Title -->
                            <h2 class="card-header-title h4 text-uppercase mb-3">
                                Profile
                            </h2>
                        </div>

                        <div class="card-body pt-0">
                            <h3 class="h6 small text-secondary text-uppercase mb-3">
                                About
                            </h3>

                            <ul class="list-unstyled mb-7">
                                <li class="py-2">
                                    <i class="bi bi-person-fill me-2"></i>
                                    {{$user->name}}
                                </li>
                                <li class="py-2">
                                    <i class="bi bi-geo-alt-fill me-2"></i>
                                    {{ $user->nationality }}
                                </li>
                                <li class="py-2">
                                    <i class="bi bi-heart-fill me-2"></i>
                                    {{ $user->marital_status }}
                                </li>
                            </ul>

                            <h3 class="h6 small text-secondary text-uppercase mb-3">
                                Contacts
                            </h3>

                            <ul class="list-unstyled mb-7">
                                <li class="py-2">
                                    <i class="bi bi-telephone-fill me-2"></i>
                                    {{ $user->phone }}
                                </li>
                                <li class="py-2">
                                    <i class="bi bi-envelope-fill me-2"></i>
                                    {{ $user->email }}
                                </li>
                            </ul>

                            <form action="{{ route('admin.patient.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    <i class="bi bi-trash me-2"></i>Delete this Student
                                </button>
                            </form>

                        </div>
                    </div>
                </div>

                <div class="col">
                    <!-- Card -->
                    <div class="card border-0">
                        <div class="card-header border-0 card-header-space-between">
                            <!-- Title -->
                            <h2 class="card-header-title h4 text-uppercase">
                                Appointment
                            </h2>

                            <a
                                href="#projects"
                                data-toggle="tabLink"
                                class="small fw-bold">
                                <!-- View all -->
                            </a>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Doctor</th>
                                        <th>Date & Time</th>
                                        <th>Urgency Level</th>
                                        <th>Status</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($user->patientAppointments) > 0)
                                        @foreach($user->patientAppointments as $appointment)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-3">
                                                        @if($appointment->doctor->avatar === null)
                                                        <img src="{{ asset('storage/' . $appointment->doctor->profile_picture) }}" alt="Doctor" class="avatar-img rounded-circle">
                                                        @else
                                                        <img src="{{ $appointment->doctor->avatar }}" alt="Doctor" class="avatar-img rounded-circle">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">{{ $appointment->doctor->name }}</h6>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div>
                                                    <div class="fw-bold">{!! $appointment->appointment_date ? \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') : '<i class="text-muted">Waiting to be assigned</i>' !!}</div>
                                                    <small class="text-muted">{!! $appointment->appointment_time ? \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') : '<i class="text-muted">Waiting to be assigned</i>' !!}</small>
                                                </div>
                                            </td>
                                            <td>{{ $appointment->appointment_urgency }}</td>
                                            <td>
                                                @php
                                                    $statusColor = match(strtolower($appointment->status)) {
                                                        'pending' => 'warning',
                                                        'approved' => 'info',
                                                        'completed' => 'success',
                                                        'cancelled' => 'danger',
                                                        default => 'secondary'
                                                    };
                                                @endphp
                                                <span class="badge bg-{{ $statusColor }}">
                                                    {{ ucwords($appointment->status) }}
                                                </span>
                                            </td>
                                            <!-- <td>
                                                <a href="{{ route('appointment.view', $appointment->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </td> -->
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <i class="bi bi-calendar-x display-1 text-muted mb-4"></i>
                                                <h4>No Appointments Found</h4>
                                                <p class="text-muted">This student has not made any appointments yet.</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- / .table-responsive -->
                    </div>

                    <!-- <div class="row">
                        
                    </div> -->
                    <!-- / .row -->
                </div>
            </div>
            <!-- / .row -->
        </div>

        @if(auth()->user()->role->name === 'Super Admin')
        <div
            class="tab-pane fade"
            id="position"
            role="tabpanel"
            aria-labelledby="position-tab">
            <div class="row mb-6">
                <form action="{{ route('admin.users.updateRole', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="role_id" class="form-label">Select New Role</label>
                        <select class="form-select" id="role_id" name="role_id" required>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Role</button>
                </form>
            </div>
            <!-- / .row -->
        </div>
        @endif

        <!-- bio-data -->
        <div
            class="tab-pane fade"
            id="bio-data"
            role="tabpanel"
            aria-labelledby="bio-data-tab">
            <div class="row mb-6">
                <form action="{{ route('admin.patient.updateBioData', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="reg_no" class="form-label">Jamb Registration Number</label>
                            <input type="text" class="form-control" id="reg_no" name="reg_no" value="{{ $user->reg_no }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="{{ $user->age }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="male" {{ $user->gender == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ $user->gender == 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" value="{{ $user->phone }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="department" class="form-label">Department</label>
                            <input type="text" class="form-control" id="department" name="department" value="{{ $user->department }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input type="text" class="form-control" id="nationality" name="nationality" value="{{ $user->nationality }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="state_of_origin" class="form-label">State of Origin</label>
                            <input type="text" class="form-control" id="state_of_origin" name="state_of_origin" value="{{ $user->state_of_origin }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="state_of_domicile" class="form-label">State of Domicile</label>
                            <input type="text" class="form-control" id="state_of_domicile" name="state_of_domicile" value="{{ $user->state_of_domicile }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="faculty" class="form-label">Faculty</label>
                            <input type="text" class="form-control" id="faculty" name="faculty" value="{{ $user->faculty }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="no_of_children" class="form-label">Number of Children</label>
                            <input type="number" class="form-control" id="no_of_children" name="no_of_children" value="{{ $user->no_of_children }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="marital_status" class="form-label">Marital Status</label>
                            <select class="form-select" id="marital_status" name="marital_status">
                                <option value="single" {{ $user->marital_status == 'single' ? 'selected' : '' }}>Single</option>
                                <option value="married" {{ $user->marital_status == 'married' ? 'selected' : '' }}>Married</option>
                                <option value="divorced" {{ $user->marital_status == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                <option value="widowed" {{ $user->marital_status == 'widowed' ? 'selected' : '' }}>Widowed</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Bio Data</button>
                </form>
            </div>
            <!-- / .row -->
        </div>

        <!-- mh-data -->
        <div
            class="tab-pane fade"
            id="mh"
            role="tabpanel"
            aria-labelledby="mh-data-tab">
            <div class="row mb-6">
                <form action="{{ route('admin.patient.updateMedicalHistory', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="heart_disease" class="form-label">Heart Disease</label>
                            <select class="form-select" id="heart_disease" name="heart_disease">
                                <option value="yes" {{ $user->heart_disease == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->heart_disease == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="respiratory_disease" class="form-label">Respiratory Disease</label>
                            <select class="form-select" id="respiratory_disease" name="respiratory_disease">
                                <option value="yes" {{ $user->respiratory_disease == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->respiratory_disease == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="tuberculosis" class="form-label">Tuberculosis</label>
                            <select class="form-select" id="tuberculosis" name="tuberculosis">
                                <option value="yes" {{ $user->tuberculosis == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->tuberculosis == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="stomach_disorder" class="form-label">Stomach Disorder</label>
                            <select class="form-select" id="stomach_disorder" name="stomach_disorder">
                                <option value="yes" {{ $user->stomach_disorder == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->stomach_disorder == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="mental_disorder" class="form-label">Mental Disorder</label>
                            <select class="form-select" id="mental_disorder" name="mental_disorder">
                                <option value="yes" {{ $user->mental_disorder == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->mental_disorder == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="gonorrhea" class="form-label">Gonorrhea</label>
                            <select class="form-select" id="gonorrhea" name="gonorrhea">
                                <option value="yes" {{ $user->gonorrhea == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->gonorrhea == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="syphilis" class="form-label">Syphilis</label>
                            <select class="form-select" id="syphilis" name="syphilis">
                                <option value="yes" {{ $user->syphilis == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->syphilis == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="epilepsy" class="form-label">Epilepsy</label>
                            <select class="form-select" id="epilepsy" name="epilepsy">
                                <option value="yes" {{ $user->epilepsy == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->epilepsy == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="sickle_cell" class="form-label">Sickle Cell</label>
                            <select class="form-select" id="sickle_cell" name="sickle_cell">
                                <option value="yes" {{ $user->sickle_cell == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->sickle_cell == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="previous_operations" class="form-label">Previous Operations</label>
                            <textarea class="form-control" id="previous_operations" name="previous_operations" rows="3">{{ $user->previous_operations }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="other_illnesses" class="form-label">Other Illnesses</label>
                            <textarea class="form-control" id="other_illnesses" name="other_illnesses" rows="3">{{ $user->other_illnesses }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Medical History</button>
                </form>
            </div>
            <!-- / .row -->
        </div>

        <!-- ir-data -->
        <div
            class="tab-pane fade"
            id="ir"
            role="tabpanel"
            aria-labelledby="ir-data-tab">
            <div class="row mb-6">
                <form action="{{ route('admin.patient.updateInvestigationResults', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="vital_signs_bp" class="form-label">Blood Pressure</label>
                            <input type="number" class="form-control" id="vital_signs_bp" name="vital_signs_bp" value="{{ $user->vital_signs_bp }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="vital_signs_rr" class="form-label">Respiratory Rate</label>
                            <input type="number" class="form-control" id="vital_signs_rr" name="vital_signs_rr" value="{{ $user->vital_signs_rr }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="vital_signs_pr" class="form-label">Pulse Rate</label>
                            <input type="number" class="form-control" id="vital_signs_pr" name="vital_signs_pr" value="{{ $user->vital_signs_pr }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="chest_xray" class="form-label">Chest X-Ray Results</label>
                            <textarea class="form-control" id="chest_xray" name="chest_xray" rows="3">{{ $user->chest_xray }}</textarea>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="urine_analysis" class="form-label">Urine Analysis Results</label>
                            <textarea class="form-control" id="urine_analysis" name="urine_analysis" rows="3">{{ $user->urine_analysis }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="other_lab_tests" class="form-label">Other Laboratory Tests</label>
                            <textarea class="form-control" id="other_lab_tests" name="other_lab_tests" rows="3">{{ $user->other_lab_tests }}</textarea>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="ent_test" class="form-label">(ENT) Ear Nose Throat</label>
                            <textarea class="form-control" id="ent_test" name="ent_test" rows="3">{{ $user->ent_test }}</textarea>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="eye_test" class="form-label">Eye Test Results</label>
                            <input type="text" class="form-control" id="eye_test" name="eye_test" value="{{ $user->eye_test }}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="reflex_test" class="form-label">Reflex Test Results</label>
                            <input type="text" class="form-control" id="reflex_test" name="reflex_test" value="{{ $user->reflex_test }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="pregnancy_status" class="form-label">Pregnancy Status</label>
                            <select class="form-select" id="pregnancy_status" name="pregnancy_status">
                                <option value="yes" {{ $user->pregnancy_status == 'yes' ? 'selected' : '' }}>Yes</option>
                                <option value="no" {{ $user->pregnancy_status == 'no' ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="general_fitness" class="form-label">General Fitness</label>
                            <select class="form-select" id="general_fitness" name="general_fitness">
                                <option value="fit" {{ $user->general_fitness == 'fit' ? 'selected' : '' }}>Fit</option>
                                <option value="unfit" {{ $user->general_fitness == 'unfit' ? 'selected' : '' }}>Unfit</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="hb_genotype" class="form-label">HB Genotype</label>
                            <select class="form-select" id="hb_genotype" name="hb_genotype">
                                <option value="AA" {{ $user->hb_genotype == 'AA' ? 'selected' : '' }}>AA</option>
                                <option value="AS" {{ $user->hb_genotype == 'AS' ? 'selected' : '' }}>AS</option>
                                <option value="SS" {{ $user->hb_genotype == 'SS' ? 'selected' : '' }}>SS</option>
                                <option value="AC" {{ $user->hb_genotype == 'AC' ? 'selected' : '' }}>AC</option>
                            </select>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="blood_group" class="form-label">Blood Group</label>
                            <select class="form-select" id="blood_group" name="blood_group">
                                <option value="A+" {{ $user->blood_group == 'A+' ? 'selected' : '' }}>A+</option>
                                <option value="A-" {{ $user->blood_group == 'A-' ? 'selected' : '' }}>A-</option>
                                <option value="B+" {{ $user->blood_group == 'B+' ? 'selected' : '' }}>B+</option>
                                <option value="B-" {{ $user->blood_group == 'B-' ? 'selected' : '' }}>B-</option>
                                <option value="O+" {{ $user->blood_group == 'O+' ? 'selected' : '' }}>O+</option>
                                <option value="O-" {{ $user->blood_group == 'O-' ? 'selected' : '' }}>O-</option>
                                <option value="AB+" {{ $user->blood_group == 'AB+' ? 'selected' : '' }}>AB+</option>
                                <option value="AB-" {{ $user->blood_group == 'AB-' ? 'selected' : '' }}>AB-</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Investigation Results</button>
                </form>
            </div>
            <!-- / .row -->
        </div>

    </div>
</div>
@endsection