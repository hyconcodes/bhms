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

        <li class="nav-item ms-auto" role="presentation">
            <button type="button" 
                    class="btn btn-sm btn-primary d-flex align-items-center" 
                    data-bs-toggle="modal" 
                    data-bs-target="#newVitalSignsModal"
                    style="margin-top: 4px;">
                <i class="bi bi-plus me-2"></i>
                New Vital Signs
            </button>
        </li>
    </ul>

    <!-- New Vital Signs Modal -->
    <div class="modal fade" id="newVitalSignsModal" tabindex="-1" aria-labelledby="newVitalSignsModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newVitalSignsModalLabel">Record New Vital Signs</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('clinical.store', $user->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="vital_signs" class="form-label">Vital Signs</label>
                            <textarea class="form-control" id="vital_signs" name="vital_signs" rows="4" required placeholder="Enter vital signs details (BP, RR, PR etc.)"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Vital Signs</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="tab-content pt-6" id="userTabContent">
        {{-- Clinical records --}}
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
                                Clinical Records
                            </h2>
                        </div>

                        <!-- Table -->
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Date</th>
                                        <th>Vital Signs</th>
                                        <th>Lab Tests</th>
                                        <th>Medication</th>
                                        <th>Diagnosis</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($records) > 0)
                                        @foreach($records as $record)
                                        <tr style="cursor: pointer;" onclick="window.location='{{ route('clinical.edit', $record->id) }}'">
                                            <td>
                                                <div class="fw-bold">
                                                    {{ \Carbon\Carbon::parse($record->created_at)->format('M d, Y') }}
                                                </div>
                                                <small class="text-muted">
                                                    {{ \Carbon\Carbon::parse($record->created_at)->format('h:i A') }}
                                                </small>
                                            </td>
                                            <td>
                                                <div class="text-wrap" style="max-width: 200px;">
                                                    {{ $record->vital_signs ?? 'Not recorded' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-wrap" style="max-width: 200px;">
                                                    {{ $record->lab_test ?? 'No lab tests' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-wrap" style="max-width: 200px;">
                                                    {{ $record->medication ?? 'No medication prescribed' }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-wrap" style="max-width: 200px;">
                                                    {{ $record->patient_diagnosis ?? 'No diagnosis' }}
                                                </div>
                                            </td>
                                            <td onclick="event.stopPropagation();">
                                                <a href="{{ route('clinical.edit', $record->id) }}" class="btn btn-sm btn-primary">
                                                    <i class="bi bi-pencil-square"></i> Edit
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="6" class="text-center py-5">
                                                <i class="bi bi-journal-medical display-1 text-muted mb-4"></i>
                                                <h4>No Clinical Records Found</h4>
                                                <p class="text-muted">This student has no clinical records yet.</p>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <!-- / .table-responsive -->
                    </div>
                </div>
            </div>
            <!-- / .row -->
        </div>

    </div>
</div>
@endsection