@extends('layouts.app')
@section('title', $appointment->user->name . ' Appointment')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')

    <div class="row">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-lg me-3">
                            @if($appointment->user->avatar === null)
                            <img src="{{ asset('storage/' . $appointment->user->profile_picture) }}" alt="Student" class="avatar-img rounded-circle">
                            @else
                            <img src="{{ $appointment->user->avatar }}" alt="Student" class="avatar-img rounded-circle">
                            @endif
                        </div>
                        <div>
                            <h4 class="mb-0">{{ $appointment->user->name }}'s Appointment</h4>
                            <p class="text-muted mb-0">Student ID: {{ $appointment->user->reg_no . ' / ' . ($appointment->user->matric ?? 'waiting...') }}</p>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.appointment.update', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Appointment Date</label>
                                <input
                                    type="date"
                                    name="appointment_date"
                                    class="form-control"
                                    value="{{ old('appointment_date') ?? ($appointment['appointment_date'] ? $appointment['appointment_date']->format('Y-m-d') : '') }}"
                                    required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Appointment Time</label>
                                <input
                                    type="time"
                                    name="appointment_time"
                                    class="form-control"
                                    value="{{ old('appointment_time') ?? ($appointment['appointment_time'] ? $appointment['appointment_time']->format('H:i') : '') }}"
                                    required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="d-flex gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Pending" {{ $appointment->status == 'pending' ? 'checked' : '' }} required>
                                    <label class="form-check-label">Pending</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Approved" {{ $appointment->status == 'approved' ? 'checked' : '' }} required>
                                    <label class="form-check-label">Approved</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="status" value="Completed" {{ $appointment->status == 'completed' ? 'checked' : '' }} required>
                                    <label class="form-check-label">Completed</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Comment</label>
                            <textarea name="comment" class="form-control" rows="3">{{ old('comment', $appointment->comment) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prescription</label>
                            <textarea name="prescription" class="form-control" rows="3">{{ old('prescription', $appointment->prescription) }}</textarea>
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Update Appointment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header">
                    <h5 class="card-header-title mb-0">Appointment Details</h5>
                </div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-sm-5">Urgency Level:</dt>
                        <dd class="col-sm-7">{{ $appointment->appointment_urgency }}</dd>

                        <dt class="col-sm-5">Current Status:</dt>
                        <dd class="col-sm-7">
                            @php
                            $statusColor = match(strtolower($appointment->status)) {
                            'pending' => 'warning',
                            'approved' => 'success',
                            'completed' => 'success',
                            'cancelled' => 'danger',
                            default => 'secondary'
                            };
                            @endphp
                            <span class="badge bg-{{ $statusColor }}">{{ ucwords($appointment->status) }}</span>
                        </dd>

                        <dt class="col-sm-5">Requested On:</dt>
                        <dd class="col-sm-7">{{ $appointment->created_at->format('M d, Y') }}</dd>

                        <dt class="col-sm-5">Student's Reason:</dt>
                        <dd class="col-sm-7">{{ $appointment->reason }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection