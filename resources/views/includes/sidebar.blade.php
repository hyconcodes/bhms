<!-- NAVIGATION -->
<nav id="mainNavbar" class="navbar navbar-vertical navbar-expand-lg scrollbar bg-dark navbar-dark">

    <!-- Theme configuration (navbar) -->
    <script>
        let navigationColor = localStorage.getItem('navigationColor'),
            navbar = document.getElementById('mainNavbar');

        if (navigationColor != null && navbar != null) {
            if (navigationColor == 'inverted') {
                navbar.classList.add('bg-dark', 'navbar-dark');
                navbar.classList.remove('bg-white', 'navbar-light');
            } else {
                navbar.classList.add('bg-white', 'navbar-light');
                navbar.classList.remove('bg-dark', 'navbar-dark');
            }
        }
    </script>
    <div class="container-fluid">

        <!-- Brand -->
        <a class="navbar-brand" href="">
            <img src="{{ asset('assets/bhms/bouestilogo.png') }}" class="navbar-brand-img logo-light logo-small" alt="..." width="19" height="50">
            <img src="{{ asset('assets/bhms/bouestilogo.png') }}" class="navbar-brand-img logo-light logo-large" alt="..." width="125" height="50">

            <img src="{{ asset('assets/bhms/bouestilogo.png') }}" class="navbar-brand-img logo-dark logo-small" alt="..." width="19" height="50">
            <img src="{{ asset('assets/bhms/bouestilogo.png') }}" class="navbar-brand-img logo-dark logo-large" alt="..." width="125" height="50">
        </a>

        <!-- Navbar toggler -->
        <a href="javascript: void(0);" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#sidenavCollapse" aria-controls="sidenavCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </a>

        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenavCollapse">

            <!-- Navigation -->
            <ul class="navbar-nav mb-lg-7">
                @if(Auth::user()->role->name != 'Student')
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/dashboard')}}">
                        <i class="bi bi-grid nav-link-icon" style="font-size: 18px;"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('admin.create.patient')}}">
                        <i class="bi bi-person nav-link-icon" style="font-size: 18px;"></i>
                        <span>Patient</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{route('admin.emr.index')}}" id="emrCollapse">
                        <i class="bi bi-file-earmark-medical nav-link-icon" style="font-size: 18px;"></i>
                        <span>Electronic Medical Records (EMR)</span>
                    </a>
                </li>
                @if(Auth::user()->role->name === 'Super Admin')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.create') }}">
                        <i class="bi bi-people nav-link-icon" style="font-size: 18px;"></i>
                        <span>Staff management</span>
                    </a>
                </li>
                @endif
                @endif
                <!-- Admins ends -->
                <!-- Student start -->
                @if(Auth::user()->role->name === 'Student')
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/student')}}">
                        <i class="bi bi-grid nav-link-icon" style="font-size: 18px;"></i>
                        <span>Home</span>
                    </a>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#appointmentCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="appointmentCollapse">
                        <i class="bi bi-calendar-check nav-link-icon" style="font-size: 18px;"></i>
                        <span>Appointment</span>
                    </a>
                    <div class="collapse close" id="appointmentCollapse">
                        <ul class="nav flex-column">
                            <!-- For Admins -->
                            @if(Auth::user()->role->name != 'Student')
                            <li class="nav-item">
                                <a href="{{ route('admin.appointments') }}" class="nav-link ">
                                    <span>My Appointments</span>
                                </a>
                            </li>
                            @endif
                            <!-- For Students -->
                            @if(Auth::user()->role->name === 'Student')
                            <li class="nav-item">
                                <a href="{{ route('student.appointments') }}" class="nav-link ">
                                    <span>Appointments</span>
                                </a>
                            </li>
                            @endif
                            <!-- For all roles -->
                            <li class="nav-item">
                                <a href="{{ route('calendar') }}" class="nav-link ">
                                    <span>Calendar</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
            <!-- End of Navigation -->

            <!-- Info box -->
            <div class="help-box rounded-3 py-5 px-4 text-center mt-auto">
                <img src="{{ asset('assets/images/illustrations/upgrade-illustration.svg') }}" alt="..." class="img-fluid mb-4" width="160" height="160">
                <h6>{{ Auth::user()->role->name }} {{ Auth::user()->name }}</h6>

                <!-- Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn w-100 btn-sm btn-danger">Logout</button>
                </form>
            </div>
        </div>
        <!-- End of Collapse -->
    </div>
</nav>