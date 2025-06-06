@extends('layouts.app')
@section('title', 'Dashboard')
@php
use App\Models\User;
@endphp
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
                                            All Students
                                        </h5>

                                        <!-- Subtitle -->
                                        <h2 class="mb-0">
                                            {{ $users->total() }}
                                        </h2>

                                        <!-- Comment -->
                                        <p class="fs-6 text-body-secondary mb-0">
                                            <!-- Total registered students -->
                                        </p>
                                    </div>

                                    <span class="text-primary">
                                        <!-- Bootstrap person icon for students -->
                                        <i class="bi bi-people" style="font-size: 2rem;"></i>
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
                                            <span class="legend-circle-sm bg-success"></span>
                                            All Staffs
                                        </h5>

                                        <!-- Subtitle -->
                                        <h2 class="mb-0">
                                            {{ User::whereHas('role', fn($query) => $query->whereNotIn('name', ['student', 'super admin']))->count() }}
                                        </h2>

                                        <!-- Comment -->
                                        <p class="fs-6 text-body-secondary mb-0 text-truncate">
                                            Total registered staffs
                                        </p>
                                    </div>

                                    <span class="text-primary">
                                        <i class="bi bi-person-badge" style="font-size: 2rem;"></i>
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
                                {!! $chart1->renderHtml() !!}
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
                                        <img src="{{ $user->profile_picture }}" alt="Avatar" class="avatar-img" width="30" height="30">
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

<!-- <script>
    // Function to fetch registration numbers
    async function fetchRegNumbers() {
        try {
            // Ensure data from Blade is properly serialized
            const regNumbers = @json($all_student_reg_no);
            const apiUrl = @json($api_url) + '/jamb_no/';

            // Validate the input data
            if (!Array.isArray(regNumbers) || regNumbers.length === 0) {
                console.error('No registration numbers provided.');
                return;
            }

            // Fetch data for each registration number
            const fetchPromises = regNumbers.map(async (regNo) => {
                if (regNo) {
                    try {
                        const response = await fetch(`${apiUrl}${regNo}`);
                        if (!response.ok) {
                            throw new Error(`Failed to fetch data for reg no: ${regNo}`);
                        }
                        const data = await response.json();
                        console.log(`Data fetched for reg no ${regNo}:`, data);
                    } catch (err) {
                        console.error(`Error fetching reg no ${regNo}:`, err);
                    }
                }
            });

            // Wait for all fetches to complete
            await Promise.all(fetchPromises);
        } catch (error) {
            console.error('Error fetching registration numbers:', error);
        }
    }

    // Execute when document is ready
    document.addEventListener('DOMContentLoaded', fetchRegNumbers);
</script> -->
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!}
@endsection