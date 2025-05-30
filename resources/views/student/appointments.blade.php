@extends('layouts.app')
@section('title', 'Student Dashboard')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">My Appointments</h4>
                </div>
                <div class="card-body">
                    @if(count($appointments) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Doctor</th>
                                    <th>Urgency Level</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($appointments as $appointment)
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
                                                {{ $appointment->doctor->name }}
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="">
                                            {{ $appointment->appointment_urgency }}
                                        </span>
                                    </td>
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
                                            {{ $appointment->status }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('appointment.view', $appointment->id) }}" class="btn btn-sm btn-outline-primary">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($appointment->status === 'Pending')
                                            <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#cancelAppointment{{ $appointment->id }}">
                                                <i class="bi bi-x-circle"></i>
                                            </button>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <img src="{{ asset('images/no-appointments.svg') }}" alt="No Appointments" class="img-fluid mb-4" style="max-width: 200px;">
                        <h3>No Appointments Yet</h3>
                        <p class="text-muted">You haven't scheduled any appointments. Would you like to book one now?</p>
                        <a href="{{ url('student') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Book New Appointment
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        
    </div>
</div>
@endsection