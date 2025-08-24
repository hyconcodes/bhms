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
                                    src="{{ $user->profile_picture }}"
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
                id="clinical-record-tab"
                data-bs-toggle="tab"
                data-bs-target="#clinical-record"
                role="tab"
                aria-controls="clinical-record"
                aria-selected="true">
                Clinical Records
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
                id="vital-signs-tab"
                data-bs-toggle="tab"
                data-bs-target="#vital-signs"
                role="tab"
                aria-controls="vital-signs"
                aria-selected="true">
                Vital Signs
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a
                href="javascript: void(0);"
                class="nav-link"
                id="patient-diagnosis-tab"
                data-bs-toggle="tab"
                data-bs-target="#patient-diagnosis"
                role="tab"
                aria-controls="patient-diagnosis"
                aria-selected="true">
                Patient Diagnosis
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a
                href="javascript: void(0);"
                class="nav-link"
                id="lab-test-tab"
                data-bs-toggle="tab"
                data-bs-target="#lab-test"
                role="tab"
                aria-controls="lab-test"
                aria-selected="true">
                Lab Test
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
            id="clinical-record"
            role="tabpanel"
            aria-labelledby="clinical-record-tab">
            <div class="row">
                

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
                                                        <img src="{{ $appointment->doctor->profile_picture }}" alt="Doctor" class="avatar-img rounded-circle">
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

        <!-- vital-signs -->
        <div
            class="tab-pane fade"
            id="vital-signs"
            role="tabpanel"
            aria-labelledby="vital-signs-tab">
            <div class="row mb-6">
                <form action="{{ route('clinical.updateVitalSigns', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="vital_signs" class="form-label">Vital Signs</label>
                            <textarea class="form-control" id="vital_signs" name="vital_signs" rows="4">{{ $user->vital_signs }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Vital Signs</button>
                </form>
            </div>
            <!-- / .row -->
        </div>

        <!-- mh-data -->
        <div
            class="tab-pane fade"
            id="patient-diagnosis"
            role="tabpanel"
            aria-labelledby="patient-diagnosis-tab">
            <div class="row mb-6">
                <form action="{{ route('admin.patient.updateMedicalHistory', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="patient_diagnosis" class="form-label">Patient Diagnosis</label>
                            <textarea class="form-control" id="patient_diagnosis" name="patient_diagnosis" rows="4">{{ $user->patient_diagnosis }}</textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="medication" class="form-label">Prescription</label>
                            <textarea class="form-control" id="medication" name="medication" rows="3">{{ $user->medication }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
            <!-- / .row -->
        </div>

        <!-- ir-data -->
        <div
            class="tab-pane fade"
            id="lab-test"
            role="tabpanel"
            aria-labelledby="lab-test-tab">
            <div class="row mb-6">
                <form action="{{ route('admin.patient.updateInvestigationResults', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                        <div class="col-12 mb-3">
                            <label for="lab_test" class="form-label">Laboratory Test Results</label>
                            <textarea class="form-control" id="lab_test" name="lab_test" rows="10">{{ $user->lab_test }}</textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Laboratory Results</button>
                </form>
            </div>
            <!-- / .row -->
        </div>

    </div>
</div>
@endsection