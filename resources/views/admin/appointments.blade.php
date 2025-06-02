@extends('layouts.app')
@section('title', 'Student Appointments')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Student Appointments</h1>
        <div class="d-flex gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="bi bi-filter me-1"></i>Filter Status: {{ request('status', 'All') }}
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ request('status') == null ? 'active' : '' }}" href="{{ route('admin.appointments') }}">All</a></li>
                    <li><a class="dropdown-item {{ request('status') == 'pending' ? 'active' : '' }}" href="{{ route('admin.appointments', ['status' => 'pending']) }}">Pending</a></li>
                    <li><a class="dropdown-item {{ request('status') == 'approved' ? 'active' : '' }}" href="{{ route('admin.appointments', ['status' => 'approved']) }}">Approved</a></li>
                    <li><a class="dropdown-item {{ request('status') == 'completed' ? 'active' : '' }}" href="{{ route('admin.appointments', ['status' => 'completed']) }}">Completed</a></li>
                    <li><a class="dropdown-item {{ request('status') == 'cancelled' ? 'active' : '' }}" href="{{ route('admin.appointments', ['status' => 'cancelled']) }}">Cancelled</a></li>
                </ul>
            </div>
            <form action="{{ route('admin.appointments') }}" method="GET" class="input-group" style="width: 300px;">
                <input type="text" name="search" class="form-control" placeholder="Search student name..." value="{{ request('search') }}">
                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i></button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    @if(count($appointments) > 0)
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Student</th>
                                    <th>Date & Time</th>
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
                                                @if($appointment->user->avatar === null)
                                                <img src="{{ asset('storage/' . $appointment->user->profile_picture) }}" alt="Student" class="avatar-img rounded-circle">
                                                @else
                                                <img src="{{ $appointment->user->avatar }}" alt="Student" class="avatar-img rounded-circle">
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $appointment->user->name }}</h6>
                                                <!-- <small class="text-muted">{{ $appointment->user->id }}</small> -->
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <div class="fw-bold">{!! $appointment->appointment_date ? \Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y') : '<i class="text-muted">Waiting to be assigned</i>' !!}</div>
                                            <small class="text-muted">{!! $appointment->appointment_time ? \Carbon\Carbon::parse($appointment->appointment_time)->format('h:i A') : '<i class="text-muted">Waiting to be assigned</i>' !!}</small>
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                        $urgencyColor = match($appointment->appointment_urgency) {
                                            'Not Urgent - Routine checkup' => 'success',
                                            'Mild - Minor discomfort' => 'info',
                                            'Moderate - Noticeable symptoms' => 'primary',
                                            'Urgent - Significant pain/symptoms' => 'warning',
                                            'Very Urgent - Severe condition' => 'danger',
                                            'Emergency - Immediate attention needed' => 'dark',
                                            default => 'secondary'
                                        };
                                        @endphp
                                        <span class="badge bg-{{ $urgencyColor }}-subtle">
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
                                        <span class="badge bg-{{ $statusColor }}-subtle">
                                            {{ ucwords($appointment->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <a href="{{ route('admin.appointment.view', $appointment->id) }}" class="btn btn-sm btn-outline-primary" data-bs-toggle="tooltip" title="View Details">
                                                <i class="bi bi-eye"></i>
                                            </a>
                                            @if($appointment->status !== 'approved' && $appointment->status !== 'completed')
                                            <a href="{{ route('admin.appointment.view', $appointment->id) }}" class="btn btn-sm btn-outline-success" data-bs-toggle="tooltip" title="Approve">
                                                <i class="bi bi-check-lg"></i>
                                            </a>
                                            @endif
                                            <form action="{{ route('appointment.cancel', $appointment->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" data-bs-toggle="tooltip" title="Cancel">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @else
                    <div class="text-center py-5">
                        <i class="bi bi-calendar-check display-1 text-muted mb-4"></i>
                        <h3>No Appointments</h3>
                        <p class="text-muted">There are no appointments scheduled at the moment.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection