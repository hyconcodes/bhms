@extends('layouts.app')
@section('title', 'Student Dashboard')
@section('content')
    <div class="container-fluid">
        @include('includes.error_or_success_message')

        <!-- Appointment Statistics -->
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Appointment Status Distribution</h5>
                    </div>
                    <div class="card-body" style="height: 300px;">
                        <canvas id="appointmentPieChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Monthly Appointments</h5>
                    </div>
                    <div class="card-body" style="height: 300px;">
                        <canvas id="appointmentBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Search and Doctors Section -->
        <div class="">
            <h1 class="display-4 mb-4">Find Your Doctor</h1>
            <p class="lead mb-4">Connect with experienced healthcare professionals and schedule your consultation with just
                a few clicks.</p>

            <!-- Search form -->
            <form class="bg-white rounded p-3 mb-4" action="{{ route('doctors.search') }}" method="GET">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search by doctor name..." name="query"
                        value="{{ request('query') }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>

            <!-- Featured Doctors -->
            <div class="tab-content pt-6" id="userTabContent">
                <div class="tab-pane fade active show" id="connections" role="tabpanel" aria-labelledby="connections-tab">
                    <div class="row">
                        @foreach ($users as $user)
                            <div class="col-lg-6 col-xl-4 col-xxl-3">
                                <div class="card border-0">
                                    <div class="card-header border-0 d-flex justify-content-end">
                                    </div>
                                    <div class="card-body text-center">
                                        <div
                                            class="avatar avatar-xl avatar-circle {{ $user->status ? 'avatar-online' : 'avatar-busy' }}">
                                            @if ($user->avatar === null)
                                                <img src="{{ $user->profile_picture }}" alt="..." class="avatar-img">
                                            @else
                                                <img src="{{ $user->avatar }}" alt="..." class="avatar-img">
                                            @endif
                                        </div>

                                        <h3 class="card-title mt-3 mb-1">{{ $user->name }}</h3>
                                        <p class="fs-5 mb-6 fw-bold text-uppercase text-primary">{{ $user->role->name }}</p>
                                    </div>

                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <div class="form-check form-state-switch">
                                            <input class="form-state-input" type="checkbox" id="connection6">
                                            <label class="form-state-label" for="connection6">
                                                <span class="form-state">
                                                    <a href="{{ route('student.book.appointment', $user->id) }}"
                                                        class="btn btn-outline-primary d-flex align-items-center justify-content-center">
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
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="me-5 text-secondary small">
                                Showing: {{ $users->firstItem() }} - {{ $users->lastItem() }} of {{ $users->total() }}
                            </div>
                            {{ $users->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            // Check if appointments exist
            const appointmentCount = {{ $appointments->count() }};

            if (appointmentCount === 0) {
                // Handle empty data case
                document.getElementById('appointmentPieChart').parentElement.innerHTML =
                    '<p class="text-center text-muted">No appointment data available</p>';
                document.getElementById('appointmentBarChart').parentElement.innerHTML =
                    '<p class="text-center text-muted">No appointment data available</p>';
                return;
            }

            // Pie Chart - Appointment Status Distribution
            const pieCtx = document.getElementById('appointmentPieChart');
            if (pieCtx) {
                const statusCounts = {
                    pending: {{ $appointments->where('status', 'pending')->count() }},
                    approved: {{ $appointments->where('status', 'approved')->count() }},
                    completed: {{ $appointments->where('status', 'completed')->count() }},
                    cancelled: {{ $appointments->where('status', 'cancelled')->count() }}
                };

                // Filter out zero values for better visualization
                const filteredLabels = [];
                const filteredData = [];
                const filteredColors = [];
                const colors = {
                    'Pending': '#ffc107',
                    'Approved': '#28a745',
                    'Completed': '#17a2b8',
                    'Cancelled': '#dc3545'
                };

                Object.keys(statusCounts).forEach((key, index) => {
                    if (statusCounts[key] > 0) {
                        const label = key.charAt(0).toUpperCase() + key.slice(1);
                        filteredLabels.push(label);
                        filteredData.push(statusCounts[key]);
                        filteredColors.push(colors[label]);
                    }
                });

                if (filteredData.length > 0) {
                    new Chart(pieCtx, {
                        type: 'pie',
                        data: {
                            labels: filteredLabels,
                            datasets: [{
                                data: filteredData,
                                backgroundColor: filteredColors,
                                borderWidth: 1,
                                borderColor: '#fff'
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        padding: 15,
                                        usePointStyle: true
                                    }
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.raw || 0;
                                            const total = filteredData.reduce((a, b) => a + b, 0);
                                            const percentage = ((value / total) * 100).toFixed(1);
                                            return `${label}: ${value} (${percentage}%)`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }

            // Bar Chart - Monthly Appointments
            const barCtx = document.getElementById('appointmentBarChart');
            if (barCtx) {
                // Safely prepare monthly data
                const monthlyDataRaw = {!! json_encode(
                    $appointments->groupBy(function ($appointment) {
                            return \Carbon\Carbon::parse($appointment->appointment_date)->format('M Y');
                        })->map->count(),
                ) !!};

                const monthlyLabels = Object.keys(monthlyDataRaw);
                const monthlyValues = Object.values(monthlyDataRaw);

                if (monthlyLabels.length > 0) {
                    new Chart(barCtx, {
                        type: 'bar',
                        data: {
                            labels: monthlyLabels,
                            datasets: [{
                                label: 'Appointments per Month',
                                data: monthlyValues,
                                backgroundColor: 'rgba(78, 115, 223, 0.8)',
                                borderColor: 'rgba(78, 115, 223, 1)',
                                borderWidth: 1,
                                borderRadius: 4,
                                borderSkipped: false,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1,
                                        callback: function(value) {
                                            if (Math.floor(value) === value) {
                                                return value;
                                            }
                                        }
                                    },
                                    title: {
                                        display: true,
                                        text: 'Number of Appointments'
                                    },
                                    grid: {
                                        color: 'rgba(0,0,0,0.1)'
                                    }
                                },
                                x: {
                                    title: {
                                        display: true,
                                        text: 'Month and Year'
                                    },
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: false
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            return `Appointments: ${context.raw}`;
                                        }
                                    }
                                }
                            }
                        }
                    });
                }
            }
        });
    </script>
@endsection
