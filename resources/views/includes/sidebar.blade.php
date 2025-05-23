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
                <li class="nav-item">
                    <a class="nav-link" href="{{url('/dashboard')}}">
                        <i class="bi bi-grid nav-link-icon" style="font-size: 18px;"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#patientCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="patientCollapse">
                        <i class="bi bi-person nav-link-icon" style="font-size: 18px;"></i>
                        <span>Patient registration</span>
                    </a>
                    <div class="collapse close" id="patientCollapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{route('admin.create.patient')}}" class="nav-link ">
                                    <span>New patient</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#emrCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="emrCollapse">
                        <i class="bi bi-file-earmark-medical nav-link-icon" style="font-size: 18px;"></i>
                        <span>Electronic Medical Records (EMR)</span>
                    </a>
                    <div class="collapse close" id="emrCollapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="index-2" class="nav-link ">
                                    <span>Default</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#staffCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="staffCollapse">
                        <i class="bi bi-people nav-link-icon" style="font-size: 18px;"></i>
                        <span>Staff management</span>
                    </a>
                    <div class="collapse close" id="staffCollapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="{{ route('admin.create') }}" class="nav-link ">
                                    <span>New Staff</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" href="#appointmentCollapse" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="appointmentCollapse">
                        <i class="bi bi-calendar-check nav-link-icon" style="font-size: 18px;"></i>
                        <span>Appointment</span>
                    </a>
                    <div class="collapse close" id="appointmentCollapse">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a href="index-2" class="nav-link ">
                                    <span>Default</span>
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