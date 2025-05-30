@extends('layouts.app')
@section('title', 'Student Dashboard')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')

    <div class="row">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Edit Appointment</h4>
                </div>
                <div class="card-body">
                    @if(strtolower($appointment->status) === 'pending')
                        <form action="{{ route('appointment.update', $appointment->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label class="form-label">Urgency Level</label>
                                <select class="form-select" name="appointment_urgency" required>
                                    <option value="Not Urgent - Routine checkup" {{ $appointment->appointment_urgency == 'Not Urgent - Routine checkup' ? 'selected' : '' }}>Not Urgent - Routine checkup</option>
                                    <option value="Mild - Minor discomfort" {{ $appointment->appointment_urgency == 'Mild - Minor discomfort' ? 'selected' : '' }}>Mild - Minor discomfort</option>
                                    <option value="Moderate - Noticeable symptoms" {{ $appointment->appointment_urgency == 'Moderate - Noticeable symptoms' ? 'selected' : '' }}>Moderate - Noticeable symptoms</option>
                                    <option value="Urgent - Significant pain/symptoms" {{ $appointment->appointment_urgency == 'Urgent - Significant pain/symptoms' ? 'selected' : '' }}>Urgent - Significant pain/symptoms</option>
                                    <option value="Very Urgent - Severe condition" {{ $appointment->appointment_urgency == 'Very Urgent - Severe condition' ? 'selected' : '' }}>Very Urgent - Severe condition</option>
                                    <option value="Emergency - Immediate attention needed" {{ $appointment->appointment_urgency == 'Emergency - Immediate attention needed' ? 'selected' : '' }}>Emergency - Immediate attention needed</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Reason</label>
                                <textarea class="form-control" name="reason" rows="3" required>{{ $appointment->reason }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Notes</label>
                                <textarea class="form-control" name="notes" rows="3">{{ $appointment->notes }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Appointment</button>
                        </form>
                    @else
                        <div class="alert alert-info">
                            This appointment cannot be edited as it is no longer pending.
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Urgency Level</label>
                            <input type="text" class="form-control" value="{{ $appointment->appointment_urgency }}" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Reason</label>
                            <textarea class="form-control" rows="3" disabled>{{ $appointment->reason }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" rows="3" disabled>{{ $appointment->notes }}</textarea>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Appointment Info</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-4">
                        <div class="avatar avatar-lg me-3">
                            @if($appointment->doctor->avatar === null)
                            <img src="{{ asset('storage/' . $appointment->doctor->profile_picture) }}" alt="Doctor" class="avatar-img rounded-circle">
                            @else
                            <img src="{{ $appointment->doctor->avatar }}" alt="Doctor" class="avatar-img rounded-circle">
                            @endif
                        </div>
                        <div>
                            <h5 class="mb-0">
                                @if($appointment->doctor->role->name === 'Doctor')
                                    Dr.
                                @elseif($appointment->doctor->role->name === 'Nurse')
                                    Nurse
                                @elseif($appointment->doctor->role->name === 'Lab Technician')
                                    Lab Tech.
                                @endif
                                {{ $appointment->doctor->name }}
                            </h5>
                            <p class="text-muted mb-0">{{ $appointment->doctor->role->name }}</p>
                        </div>
                    </div>

                    <dl class="row">
                        <dt class="col-sm-4">Urgency Level</dt>
                        <dd class="col-sm-8">{{ $appointment->appointment_urgency }}</dd>

                        <dt class="col-sm-4">Date</dt>
                        <dd class="col-sm-8">{{ $appointment->appointment_date ?? 'Date not assigned' }}</dd>

                        <dt class="col-sm-4">Time</dt>
                        <dd class="col-sm-8">{{ $appointment->appointment_time ?? 'Time not assigned' }}</dd>

                        <dt class="col-sm-4">Reason</dt>
                        <dd class="col-sm-8">{{ $appointment->reason }}</dd>

                        <dt class="col-sm-4">Notes</dt>
                        <dd class="col-sm-8">{{ $appointment->notes ?? 'No notes' }}</dd>

                        <dt class="col-sm-4">Status</dt>
                        <dd class="col-sm-8">
                            @php
                                $statusColor = match(strtolower($appointment->status)) {
                                    'pending' => 'warning',
                                    'approved' => 'info',
                                    'completed' => 'success',
                                    'cancelled' => 'danger',
                                    default => 'secondary'
                                };
                            @endphp
                            <span class="badge bg-{{ $statusColor }}">{{ $appointment->status }}</span>
                        </dd>

                        <dt class="col-sm-4">Doctor's Comment</dt>
                        <dd class="col-sm-8">{{ $appointment->comment ?? 'No comment yet from doctor' }}</dd>

                        <dt class="col-sm-4">Prescription</dt>
                        <dd class="col-sm-8">{{ $appointment->prescription ?? 'Awaiting prescription' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection