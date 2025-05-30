@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')
    <!-- Title -->
    <h1 class="h2">
        Dashboard
    </h1>

    <div class="row">
        <div class="col-xxl-5">
            <div class="row">
                <div class="col-md-6">

                    <!-- Card -->
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col d-flex justify-content-between">

                                    <div>
                                        <!-- Title -->
                                        <h5 class="d-flex align-items-center text-uppercase text-body-secondary fw-semibold mb-2">
                                            <span class="legend-circle-sm bg-success"></span>
                                            Active Appointmment
                                        </h5>

                                        <!-- Subtitle -->
                                        <h2 class="mb-0">
                                            3,240
                                        </h2>

                                        <!-- Comment -->
                                        <p class="fs-6 text-body-secondary mb-0">
                                            <!-- No additional income -->
                                        </p>
                                    </div>

                                    <span class="text-primary">
                                        <!-- Bootstrap person icon for patient -->
                                        <i class="bi bi-calendar-check" style="font-size: 2rem;"></i>
                                    </span>
                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <!-- Card -->
                    <div class="card border-0">
                        <div class="card-body">
                            <div class="row">
                                <div class="col d-flex justify-content-between">

                                    <div>
                                        <!-- Title -->
                                        <h5 class="d-flex align-items-center text-uppercase text-body-secondary fw-semibold mb-2">
                                            <span class="legend-circle-sm bg-danger"></span>
                                            Patient
                                        </h5>

                                        <!-- Subtitle -->
                                        <h2 class="mb-0">
                                            $1,500
                                        </h2>

                                        <!-- Comment -->
                                        <p class="fs-6 text-body-secondary mb-0 text-truncate">
                                            + $6.50 bank charges fee
                                        </p>
                                    </div>

                                    <span class="text-primary">
                                        <svg viewBox="0 0 24 24" height="32" width="32" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.75,14.25H16.717a1.342,1.342,0,0,0-.5,2.587l2.064.826a1.342,1.342,0,0,1-.5,2.587H15.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                            <path d="M17.25 14.25L17.25 13.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                            <path d="M17.25 21L17.25 20.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                            <path d="M11.250 17.250 A6.000 6.000 0 1 0 23.250 17.250 A6.000 6.000 0 1 0 11.250 17.250 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                            <path d="M3.75 14.25L8.25 14.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                            <path d="M8.25 14.25L8.25 6.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                            <path d="M11.25 9.75L11.25 8.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                            <path d="M5.25 14.25L5.25 9.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                            <path d="M7.5,20.25H2.25a1.43,1.43,0,0,1-1.5-1.415V2.335A1.575,1.575,0,0,1,2.25.75H12.879a1.5,1.5,0,0,1,1.06.439l2.872,2.872a1.5,1.5,0,0,1,.439,1.06V7.5" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                                        </svg>
                                    </span>
                                </div>
                            </div> <!-- / .row -->
                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div>

        <div class="col-xxl-7">
            <div class="row">
                <div class="col-12">
                    <!-- Card -->
                    <div class="card border-0">
                        <div class="card-body">
                            <h5 class="text-uppercase text-body-secondary fw-semibold mb-2">
                                Student Registration Trend
                            </h5>
                            <div>
                                Render chart here
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- / .row -->
        </div>
    </div> <!-- / .row -->

    <div class="row">
        <div class="col">

            <!-- Card -->
            <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["name", "email", "id", {"name": "date", "attr": "data-signed"}, "status"], "page": 8}' id="users">
                <div class="card-header border-0 card-header-space-between">

                    <!-- Title -->
                    <h2 class="card-header-title h4 text-uppercase">
                        Recent student record
                    </h2>

                    <!-- Dropdown -->
                    <div class="dropdown ms-4">
                        <a href="javascript: void(0);" class="dropdown-toggle no-arrow text-secondary" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </a>
                    </div>
                </div>

                <!-- Table -->
                <div class="table-responsive">
                    <table class="table align-middle table-edge table-hover table-nowrap mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="w-60px">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" value="" id="checkAllCheckboxes">
                                    </div>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-body-secondary list-sort" data-sort="name">
                                        Full name
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-body-secondary list-sort" data-sort="email">
                                        Email
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-body-secondary list-sort" data-sort="ids">
                                        Reg No/Matric
                                    </a>
                                </th>
                                <th>
                                    <a href="javascript: void(0);" class="text-body-secondary list-sort text-center" data-sort="id">
                                        Joined
                                    </a>
                                </th>
                                <th class="w-150px min-w-150px text-center">
                                    Actions
                                </th>
                            </tr>
                        </thead>

                        <tbody class="list">
                            @foreach($users as $user)
                            <tr>
                                <td>
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" value="{{ $user->id }}">
                                    </div>
                                </td>
                                <td>
                                    <div class="avatar avatar-circle avatar-xs me-2">
                                        @if($user->profile_picture)
                                        <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Avatar" class="avatar-img" width="30" height="30">
                                        @else
                                        <img src="{{ $user->avatar }}" alt="Avatar" class="avatar-img" width="30" height="30">
                                        @endif
                                    </div>
                                    <span class="name fw-bold">{{ $user->name }}</span>
                                </td>
                                <td class="email">{{ $user->email }}</td>
                                <td class="ids">
                                    <span class="badge bg-light text-primary">
                                        {{ $user->reg_no }} / {{ $user->matric }}
                                    </span>
                                </td>
                                <td class="id">
                                    <span class="badge bg-light text-dark">
                                        <!-- {{ $user->created_at->diffForHumans() }} -->
                                        <!-- {{ $user->created_at->diffInDays() }} days ago -->
                                        <!-- {{ $user->created_at->diffInMinutes() }} minutes ago -->
                                        {{ $user->created_at->format('d M Y') }} <!-- {{ $user->created_at->diffInHours() }} hours ago -->

                                    </span>
                                </td>

                                <td class="text-center">
                                    <a href="{{ route('admin.patient.view', $user->id) }}#bio-data-tab" class="btn btn-sm btn-info me-1" title="Access patient record">
                                        <i class="bi bi-eye"></i> Access patient record
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> <!-- / .table-responsive -->

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
    </div> <!-- / .row -->
</div> <!-- / .container-fluid -->
@endsection