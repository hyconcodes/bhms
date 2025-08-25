@extends('layouts.app')
@section('title', 'Update Clinical Record')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-lg avatar-circle me-3">
                            @if($record->user->avatar === null)
                            <img src="{{ $record->user->profile_picture }}" alt="User" class="avatar-img">
                            @else
                            <img src="{{ $record->user->avatar }}" alt="User" class="avatar-img">
                            @endif
                        </div>
                        <div>
                            <h4 class="mb-0">Update Clinical Record for {{ $record->user->name }}</h4>
                            <p class="mb-0">{{ $record->user->role->name }}</p>
                        </div>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <form action="{{ route('clinical.update', $record->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label for="vital_signs" class="form-label">Vital Signs</label>
                                <textarea class="form-control" id="vital_signs" name="vital_signs" rows="4" 
                                    placeholder="Enter vital signs information" 
                                    {{ (auth()->user()->role->name !== 'Nurse' && auth()->user()->role->name !== 'Super Admin') ? 'disabled' : '' }}
                                >{{ $record->vital_signs }}</textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="patient_diagnosis" class="form-label">Patient Diagnosis</label>
                                <textarea class="form-control" id="patient_diagnosis" name="patient_diagnosis" rows="4" 
                                    placeholder="Enter patient diagnosis"
                                    {{ (auth()->user()->role->name !== 'Doctor' && auth()->user()->role->name !== 'Super Admin') ? 'disabled' : '' }}
                                >{{ $record->patient_diagnosis }}</textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="lab_test" class="form-label">Laboratory Test Results</label>
                                <textarea class="form-control" id="lab_test" name="lab_test" rows="4" 
                                placeholder="Enter laboratory test results"
                                {{ (auth()->user()->role->name !== 'Lab_Technician' && auth()->user()->role->name !== 'Super Admin') ? 'disabled' : '' }}
                                >{{ $record->lab_test }}</textarea>
                            </div>

                            <div class="col-12 mb-3">
                                <label for="medication" class="form-label">Prescription</label>
                                <textarea class="form-control" id="medication" name="medication" rows="3" 
                                    placeholder="Enter prescription details"
                                    {{ (auth()->user()->role->name !== 'Doctor' && auth()->user()->role->name !== 'Super Admin') ? 'disabled' : '' }}
                                >{{ $record->medication }}</textarea>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save me-2"></i>
                                Update Clinical Record
                            </button>
                            <a href="{{ url()->previous() }}" class="btn btn-light">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection