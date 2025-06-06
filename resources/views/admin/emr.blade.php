@extends('layouts.app')
@section('title', 'Electronic Medical Records (EMR)')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4">
        <h3>Electronic Medical Records (EMR)</h3>

        <div class="d-flex flex-row justify-content-between align-items-center">

            <form class="d-md-inline-block me-4" id="searchForm" action="{{ route('emr.patient.search') }}" method="GET">
                <div class="input-group input-group-merge">
                    <input type="text" name="query" class="form-control bg-light-green border-light-green w-250px" placeholder="Search..." aria-label="Search for any term" value="{{ request('query') }}">
                    <span class="input-group-text bg-light-green border-light-green p-0">
                        <button class="btn btn-primary rounded-2 w-30px h-30px p-0 mx-1" type="submit" aria-label="Search button">
                            <i class="bi bi-search"></i>
                        </button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <!-- Search -->

    <div class="row">
        <div class="col">

            <!-- Card -->
            <div class="card border-0 flex-fill w-100" data-list='{"valueNames": ["name", "email", "id", {"name": "date", "attr": "data-signed"}, "status"], "page": 8}' id="users">
                <div class="card-header border-0 card-header-space-between">

                    <!-- Title -->
                    <h2 class="card-header-title h4 text-uppercase">
                        All Students
                    </h2>

                    <!-- Dropdown -->
                    <div class="dropdown ms-4">
                        <a href="javascript: void(0);" class="dropdown-toggle no-arrow text-secondary" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-three-dots-vertical"></i>
                        </a>
                        <!-- <div class="dropdown-menu">
                            <a href="javascript: void(0);" class="dropdown-item">
                                Export report
                            </a>
                            <a href="javascript: void(0);" class="dropdown-item">
                                Share
                            </a>
                            <a href="javascript: void(0);" class="dropdown-item">
                                Action
                            </a>
                        </div> -->
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
                                        {{ $user->created_at->format('d M Y') }}                                        <!-- {{ $user->created_at->diffInHours() }} hours ago -->

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
</div>
@endsection