@extends('layouts.app')
@section('title', 'Staff Account')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')
    <div class="d-flex align-items-baseline justify-content-between">
        <!-- Title -->
        <h1 class="h2">Staff</h1>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript: void(0);">Pages</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Staff</li>
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

                            <div class="d-flex">
                                <!-- Button -->
                                <!-- <button type="button" class="btn btn-primary btn-sm me-2">
                                    Ping
                                </button> -->

                                <!-- Dropdown -->

                            </div>
                        </div>

                        <div
                            class="col-12 col-md-auto ms-auto text-center mt-8 mt-md-0">
                            <div class="hstack d-inline-flex gap-4">
                                <div>
                                    <h4 class="h2 mb-0">{{ $user->appointments->count() }}</h4>
                                    <p class="text-secondary mb-0">Active Appoinment</p>
                                </div>

                                <div class="vr"></div>

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
                            <small class="text-secondary">Profile Completion</small>

                            <!-- Circular Progress Bar -->
                            @php
                            // Calculate EMR Completion percentage based on filled fields
                            $fields = [
                            'name',
                            'email',
                            'profile_picture',
                            'avatar',
                            'role_id',
                            'matric',
                            'date_of_birth',
                            'gender',
                            'phone',
                            'address',
                            'religion',
                            'nationality',
                            'marital_status',
                            'disability',
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

    </ul>

    <div class="tab-content pt-6" id="userTabContent">
        <!-- Profile -->
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
                                    {{ $user->address }}
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

                            <form action="{{ route('admin.staff.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this staff?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm w-100">
                                    <i class="bi bi-trash me-2"></i>Delete this Staff
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
                                        <th>Student</th>
                                        <th>Date & Time</th>
                                        <th>Urgency Level</th>
                                        <th>Status</th>
                                        <!-- <th>Actions</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($user->appointments) > 0)
                                        @foreach($user->appointments as $appointment)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-sm me-3">
                                                        @if($appointment->user->avatar === null)
                                                        <img src="{{ $appointment->user->profile_picture }}" alt="Student" class="avatar-img rounded-circle">
                                                        @else
                                                        <img src="{{ $appointment->user->avatar }}" alt="Student" class="avatar-img rounded-circle">
                                                        @endif
                                                    </div>
                                                    <div>
                                                        <h5 class="mb-0">{{ $appointment->user->name }}</h5>
                                                        <small class="text-muted">{{ $appointment->user->reg_no }}</small>
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
                                                <p class="text-muted">This doctor has no appointments yet.</p>
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

        <!-- change role -->
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


    </div>
</div>
@endsection