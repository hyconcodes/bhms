<!-- HEADER -->
<header class="container-fluid d-flex py-6 mb-4">
    @php
    use App\Models\Appointment;
    $approveAppointments = Appointment::where('user_id', Auth::id())
    ->whereDate('updated_at', today())
    ->where('status', 'approved')
    ->get();
    @endphp

    <!-- Top buttons -->
    <div class="d-flex align-items-center ms-auto me-n1 me-lg-n2">

        <!-- Dropdown -->
        <div class="dropdown" id="themeSwitcher">
            <a href="javascript: void(0);" class="dropdown-toggle no-arrow d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mx-1 mx-lg-2 w-40px h-40px link-secondary" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,0">
                <i class="bi bi-brightness-high fs-5"></i>
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <button type="button" class="dropdown-item active" data-theme-value="light">
                        <i class="bi bi-brightness-high me-2 fs-5"></i>
                        Light mode
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item" data-theme-value="dark">
                        <i class="bi bi-moon-stars me-2 fs-5"></i>
                        Dark mode
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item" data-theme-value="auto">
                        <i class="bi bi-circle-half me-2 fs-5"></i>
                        Auto
                    </button>
                </li>
            </ul>
        </div>

        <!-- Separator -->
        <div class="vr bg-gray-700 mx-2 mx-lg-3"></div>

        <!-- Dropdown -->
        <div class="dropdown">
            <a href="javascript: void(0);" class="dropdown-toggle no-arrow d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mx-1 mx-lg-2 w-40px h-40px" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,0">
                <span class="avatar avatar-circle avatar-xxs"><img class="avatar-img" src="{{ asset('assets/images/flags/1x1/us.svg') }}" alt="..." width="18" height="18"></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <h6 class="dropdown-header text-uppercase">Select language</h6>
                </li>
                <li>
                    <a href="javascript: void(0);" class="dropdown-item active">
                        <span class="avatar avatar-circle avatar-xxs"><img class="avatar-img" src="{{ asset('assets/images/flags/1x1/us.svg') }}" alt="..." width="18" height="18"></span><span class="text-truncate ms-2">English (US)</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Separator -->

        <!-- Button -->
        @if(Auth::user()->role->name === 'Student')
        <div class="vr bg-gray-700 mx-2 mx-lg-3"></div>

        <a class="d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mx-1 mx-lg-2 w-40px h-40px position-relative link-secondary" data-bs-toggle="offcanvas" href="#offcanvasNotifications" role="button" aria-controls="offcanvasNotifications">
            <i class="bi bi-bell fs-5"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-danger">
                {{ App\Models\Appointment::where('user_id', Auth::id())->whereDate('created_at', today())->where('status', 'approved')->count() }}<span class="visually-hidden">approved appointments today</span>
            </span>
        </a>
        @endif

        <!-- Notifications offcanvas FOR STUDENTS -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNotifications" aria-labelledby="offcanvasNotificationsLabel">
            <div class="offcanvas-header px-5">
                <h3 class="offcanvas-title" id="offcanvasNotificationsLabel">Notifications</h3>

                <div class="d-flex align-items-start ms-auto">
                    <!-- Button -->
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            </div>

            <div class="offcanvas-body p-0">
                <div class="list-group list-group-flush">
                    @foreach($approveAppointments as $appointment)
                    <a href="{{ route('appointment.view', $appointment->id) }}" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="{{ $appointment->doctor->profile_picture ? asset('storage/' . $appointment->doctor->profile_picture) : $appointment->doctor->avatar }}" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Dr. {{ $appointment->doctor->name }}</h5>
                                    <small class="text-body-secondary">{{ $appointment->updated_at->diffForHumans() }}</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Appointment Approved</p>
                                    <small class="text-secondary">Your appointment has been approve and schedule on {{ $appointment->appointment_date->format('F j, Y') }} at {{ $appointment->appointment_time }}.</small>
                                </div>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Dropdown -->

        <!-- Separator -->
        <div class="vr bg-gray-700 mx-2 mx-lg-3"></div>

        <!-- Dropdown -->
        <div class="dropdown">
            <a href="javascript: void(0);" class="dropdown-toggle no-arrow d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mx-1 mx-lg-2 w-40px h-40px" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,0">
                <div class="avatar avatar-circle avatar-sm avatar-online">
                    <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : Auth::user()->avatar }}" alt="..." class="avatar-img" width="40" height="40">
                </div>
            </a>

            <div class="dropdown-menu">
                <div class="dropdown-item-text">
                    <div class="d-flex align-items-center">
                        <div class="avatar avatar-sm avatar-circle">
                            <img src="{{ Auth::user()->profile_picture ? asset('storage/' . Auth::user()->profile_picture) : Auth::user()->avatar }}" alt="..." class="avatar-img" width="40" height="40">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h4 class="mb-0">{{ Auth::user()->role->name }} {{ Auth::user()->name }}</h4>
                            <p class="card-text">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </div>

                <hr class="dropdown-divider">

                <!-- Dropdown -->
                <div class="dropdown dropend">
                    <a class="dropdown-item dropdown-toggle" href="javascript: void(0);" id="statusDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="-16,10">
                        Set status
                    </a>

                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-sub-menu" aria-labelledby="statusDropdown">
                        <a class="dropdown-item" href="javascript: void(0);">
                            <span class="legend-circle bg-success me-2"></span>Available
                        </a>
                        <a class="dropdown-item" href="javascript: void(0);">
                            <span class="legend-circle bg-danger me-2"></span>Busy
                        </a>
                        <a class="dropdown-item" href="javascript: void(0);">
                            <span class="legend-circle bg-warning me-2"></span>Away
                        </a>
                        <a class="dropdown-item" href="javascript: void(0);">
                            <span class="legend-circle bg-gray-500 me-2"></span>Appear offline
                        </a>
                        <hr class="dropdown-divider">
                        <a class="dropdown-item" href="javascript: void(0);">
                            Reset status
                        </a>
                    </div>
                </div>
                <!-- End Dropdown -->

                <a class="dropdown-item" href="{{route('admin.profile')}}">Profile & account</a>
                <!-- <a class="dropdown-item" href="javascript: void(0);">Settings</a> -->

                <hr class="dropdown-divider">

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign out</a>
            </div>
        </div>
    </div>
</header>