@extends('layouts.app')
@section('title', 'Student Dashboard')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-lg avatar-circle me-3">
                            @if($doctor->avatar === null)
                            <img src="{{ asset('storage/' . $doctor->profile_picture) }}" alt="Doctor" class="avatar-img">
                            @else
                            <img src="{{ $doctor->avatar }}" alt="Doctor" class="avatar-img">
                            @endif
                        </div>
                        <div>
                            <h4 class="mb-0">Book Appointment with 
                                @if($doctor->role->name === 'Doctor')
                                    Dr.
                                @elseif($doctor->role->name === 'Nurse')
                                    Nurse
                                @elseif($doctor->role->name === 'Lab Technician')
                                    Lab Tech.
                                @endif
                                {{ $doctor->name }}
                            </h4>
                            <p class="mb-0">{{ $doctor->role->name }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('student.store.appointment', $doctor->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="form-label">Urgency Level</label>
                            <div class="d-flex flex-wrap gap-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="appointment_urgency" id="Not Urgent - Routine checkup" value="Not Urgent - Routine checkup" required>
                                    <label class="form-check-label" for="Not Urgent - Routine checkup">Not Urgent - Routine checkup</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="appointment_urgency" id="Mild - Minor discomfort" value="Mild - Minor discomfort">
                                    <label class="form-check-label" for="Mild - Minor discomfort">Mild - Minor discomfort</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="appointment_urgency" id="Moderate - Noticeable symptoms" value="Moderate - Noticeable symptoms">
                                    <label class="form-check-label" for="Moderate - Noticeable symptoms">Moderate - Noticeable symptoms</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="appointment_urgency" id="Urgent - Significant pain/symptoms" value="Urgent - Significant pain/symptoms">
                                    <label class="form-check-label" for="Urgent - Significant pain/symptoms">Urgent - Significant pain/symptoms</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="appointment_urgency" id="Very Urgent - Severe condition" value="Very Urgent - Severe condition">
                                    <label class="form-check-label" for="Very Urgent - Severe condition">Very Urgent - Severe condition</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="appointment_urgency" id="Emergency - Immediate attention needed" value="Emergency - Immediate attention needed">
                                    <label class="form-check-label" for="Emergency - Immediate attention needed">Emergency - Immediate attention needed</label>
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Reason for Visit</label>
                            <textarea class="form-control" name="reason" rows="4" required placeholder="Please describe your symptoms or reason for consultation"></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Additional Notes</label>
                            <textarea class="form-control" name="notes" rows="3" placeholder="Any additional information you'd like to share"></textarea>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-calendar-check me-2"></i>
                                Confirm Appointment
                            </button>
                            <a href="{{ url('student') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection