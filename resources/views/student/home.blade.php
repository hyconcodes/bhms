@extends('layouts.app')
@section('title', 'Student Dashboard')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')
    <!-- Left side - Search and Info -->
    <div class="">

        <h1 class="display-4 mb-4">Find Your Doctor</h1>
        <p class="lead mb-4">Connect with experienced healthcare professionals and schedule your consultation with just a few clicks.</p>

        <!-- Search form -->
        <form class="bg-white rounded p-3 mb-4" action="{{ route('doctors.search') }}" method="GET">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search by doctor name..." name="query" value="{{ request('query') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        <!-- Featured Doctors -->
        <div class="tab-content pt-6" id="userTabContent">
            <div class="tab-pane fade active show" id="connections" role="tabpanel" aria-labelledby="connections-tab">
                <div class="row">
                    @foreach($users as $user)
                    <div class="col-lg-6 col-xl-4 col-xxl-3">

                        <!-- Card -->
                        <div class="card border-0">
                            <div class="card-header border-0 d-flex justify-content-end">
                                <!-- Dropdown -->
                            </div>
                            <div class="card-body text-center">
                                <div class="avatar avatar-xl avatar-circle {{ $user->status ? 'avatar-online' : 'avatar-busy' }}">
                                    @if($user->avatar === null)
                                    <img src="{{ $user->profile_picture }}" alt="..." class="avatar-img">
                                    @else
                                    <img src="{{ $user->avatar }}" alt="..." class="avatar-img">
                                    @endif
                                </div>

                                <!-- Title -->
                                <h3 class="card-title mt-3 mb-1">{{ $user->name }}</h3>
                                <p class="fs-5 mb-6 fw-bold text-uppercase text-primary">{{ $user->role->name }}</p>

                            </div>

                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <!-- <span class="fs-5 text-secondary text-truncate">3 connections</span> -->

                                <div class="form-check form-state-switch">
                                    <input class="form-state-input" type="checkbox" id="connection6">
                                    <label class="form-state-label" for="connection6">
                                        <span class="form-state">

                                            <!-- Button -->
                                            <a href="{{ route('student.book.appointment', $user->id) }}" class="btn btn-outline-primary d-flex align-items-center justify-content-center">
                                                <i class="bi bi-person-plus-fill me-2"></i>
                                                Book Appointment
                                            </a>
                                        </span>


                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div> <!-- / .row -->

                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="me-5 text-secondary small">
                            Showing: {{ $users->firstItem() }} - {{ $users->lastItem() }} of {{ $users->total() }}
                        </div>

                        <!-- Pagination -->
                        {{ $users->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection