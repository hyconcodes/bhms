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
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="18" width="18">
                    <g>
                        <path d="M12,4.64A7.36,7.36,0,1,0,19.36,12,7.37,7.37,0,0,0,12,4.64Zm0,12.72A5.36,5.36,0,1,1,17.36,12,5.37,5.37,0,0,1,12,17.36Z" style="fill: currentColor" />
                        <path d="M12,3.47a1,1,0,0,0,1-1V1a1,1,0,0,0-2,0V2.47A1,1,0,0,0,12,3.47Z" style="fill: currentColor" />
                        <path d="M4.55,6a1,1,0,0,0,.71.29A1,1,0,0,0,6,6,1,1,0,0,0,6,4.55l-1-1A1,1,0,0,0,3.51,4.93Z" style="fill: currentColor" />
                        <path d="M2.47,11H1a1,1,0,0,0,0,2H2.47a1,1,0,1,0,0-2Z" style="fill: currentColor" />
                        <path d="M4.55,18l-1,1a1,1,0,0,0,0,1.42,1,1,0,0,0,.71.29,1,1,0,0,0,.71-.29l1-1A1,1,0,0,0,4.55,18Z" style="fill: currentColor" />
                        <path d="M12,20.53a1,1,0,0,0-1,1V23a1,1,0,0,0,2,0V21.53A1,1,0,0,0,12,20.53Z" style="fill: currentColor" />
                        <path d="M19.45,18A1,1,0,0,0,18,19.45l1,1a1,1,0,0,0,.71.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.42Z" style="fill: currentColor" />
                        <path d="M23,11H21.53a1,1,0,0,0,0,2H23a1,1,0,0,0,0-2Z" style="fill: currentColor" />
                        <path d="M18.74,6.26A1,1,0,0,0,19.45,6l1-1a1,1,0,1,0-1.42-1.42l-1,1A1,1,0,0,0,18,6,1,1,0,0,0,18.74,6.26Z" style="fill: currentColor" />
                    </g>
                </svg>
            </a>

            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <button type="button" class="dropdown-item active" data-theme-value="light">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="me-2" height="18" width="18">
                            <g>
                                <path d="M12,4.64A7.36,7.36,0,1,0,19.36,12,7.37,7.37,0,0,0,12,4.64Zm0,12.72A5.36,5.36,0,1,1,17.36,12,5.37,5.37,0,0,1,12,17.36Z" style="fill: currentColor" />
                                <path d="M12,3.47a1,1,0,0,0,1-1V1a1,1,0,0,0-2,0V2.47A1,1,0,0,0,12,3.47Z" style="fill: currentColor" />
                                <path d="M4.55,6a1,1,0,0,0,.71.29A1,1,0,0,0,6,6,1,1,0,0,0,6,4.55l-1-1A1,1,0,0,0,3.51,4.93Z" style="fill: currentColor" />
                                <path d="M2.47,11H1a1,1,0,0,0,0,2H2.47a1,1,0,1,0,0-2Z" style="fill: currentColor" />
                                <path d="M4.55,18l-1,1a1,1,0,0,0,0,1.42,1,1,0,0,0,.71.29,1,1,0,0,0,.71-.29l1-1A1,1,0,0,0,4.55,18Z" style="fill: currentColor" />
                                <path d="M12,20.53a1,1,0,0,0-1,1V23a1,1,0,0,0,2,0V21.53A1,1,0,0,0,12,20.53Z" style="fill: currentColor" />
                                <path d="M19.45,18A1,1,0,0,0,18,19.45l1,1a1,1,0,0,0,.71.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.42Z" style="fill: currentColor" />
                                <path d="M23,11H21.53a1,1,0,0,0,0,2H23a1,1,0,0,0,0-2Z" style="fill: currentColor" />
                                <path d="M18.74,6.26A1,1,0,0,0,19.45,6l1-1a1,1,0,1,0-1.42-1.42l-1,1A1,1,0,0,0,18,6,1,1,0,0,0,18.74,6.26Z" style="fill: currentColor" />
                            </g>
                        </svg>
                        Light mode
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item" data-theme-value="dark">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="me-2" height="18" width="18">
                            <path d="M19.57,23.34a1,1,0,0,0,0-1.9,9.94,9.94,0,0,1,0-18.88,1,1,0,0,0,.68-.94,1,1,0,0,0-.68-.95A11.58,11.58,0,0,0,8.88,2.18,12.33,12.33,0,0,0,3.75,12a12.31,12.31,0,0,0,5.11,9.79A11.49,11.49,0,0,0,15.61,24,12.55,12.55,0,0,0,19.57,23.34ZM10,20.17A10.29,10.29,0,0,1,5.75,12a10.32,10.32,0,0,1,4.3-8.19A9.34,9.34,0,0,1,15.59,2a.17.17,0,0,1,.17.13.18.18,0,0,1-.07.2,11.94,11.94,0,0,0-.18,19.21.25.25,0,0,1-.16.45A9.5,9.5,0,0,1,10,20.17Z" style="fill: currentColor" />
                        </svg>
                        Dark mode
                    </button>
                </li>
                <li>
                    <button type="button" class="dropdown-item" data-theme-value="auto">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="me-2" height="18" width="18">
                            <path d="M24,12a1,1,0,0,0-1-1H19.09a.51.51,0,0,1-.49-.4,6.83,6.83,0,0,0-.94-2.28.5.5,0,0,1,.06-.63l2.77-2.76a1,1,0,1,0-1.42-1.42L16.31,6.28a.5.5,0,0,1-.63.06A6.83,6.83,0,0,0,13.4,5.4a.5.5,0,0,1-.4-.49V1a1,1,0,0,0-2,0V4.91a.51.51,0,0,1-.4.49,6.83,6.83,0,0,0-2.28.94.5.5,0,0,1-.63-.06L4.93,3.51A1,1,0,0,0,3.51,4.93L6.28,7.69a.5.5,0,0,1,.06.63A6.83,6.83,0,0,0,5.4,10.6a.5.5,0,0,1-.49.4H1a1,1,0,0,0,0,2H4.91a.51.51,0,0,1,.49.4,6.83,6.83,0,0,0,.94,2.28.5.5,0,0,1-.06.63L3.51,19.07a1,1,0,1,0,1.42,1.42l2.76-2.77a.5.5,0,0,1,.63-.06,6.83,6.83,0,0,0,2.28.94.5.5,0,0,1,.4.49V23a1,1,0,0,0,2,0V19.09a.51.51,0,0,1,.4-.49,6.83,6.83,0,0,0,2.28-.94.5.5,0,0,1,.63.06l2.76,2.77a1,1,0,1,0,1.42-1.42l-2.77-2.76a.5.5,0,0,1-.06-.63,6.83,6.83,0,0,0,.94-2.28.5.5,0,0,1,.49-.4H23A1,1,0,0,0,24,12Zm-8.74,2.5A5.76,5.76,0,0,1,9.5,8.74a5.66,5.66,0,0,1,.16-1.31A.49.49,0,0,1,10,7.07a5.36,5.36,0,0,1,1.8-.31,5.47,5.47,0,0,1,5.46,5.46,5.36,5.36,0,0,1-.31,1.8.49.49,0,0,1-.35.32A5.53,5.53,0,0,1,15.26,14.5Z" style="fill: currentColor" />
                        </svg>
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