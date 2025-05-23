<!-- HEADER -->
<header class="container-fluid d-flex py-6 mb-4">

    <!-- Search -->
    <!-- <form class="d-none d-md-inline-block me-auto">
        <div class="input-group input-group-merge">

            
            <input type="text" class="form-control bg-light-green border-light-green w-250px" placeholder="Search..." aria-label="Search for any term">

            
            <span class="input-group-text bg-light-green border-light-green p-0">

                <button class="btn btn-primary rounded-2 w-30px h-30px p-0 mx-1" type="button" aria-label="Search button">
                    <svg viewBox="0 0 24 24" height="16" width="16" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0.750 9.812 A9.063 9.063 0 1 0 18.876 9.812 A9.063 9.063 0 1 0 0.750 9.812 Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" transform="translate(-3.056 4.62) rotate(-23.025)" />
                        <path d="M16.221 16.22L23.25 23.25" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                    </svg>
                </button>
            </span>
        </div>
    </form> -->

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
        <div class="vr bg-gray-700 mx-2 mx-lg-3"></div>

        <!-- Button -->
        <a class="d-flex align-items-center justify-content-center bg-white rounded-circle shadow-sm mx-1 mx-lg-2 w-40px h-40px position-relative link-secondary" data-bs-toggle="offcanvas" href="#offcanvasNotifications" role="button" aria-controls="offcanvasNotifications">
            <svg viewBox="0 0 24 24" height="18" width="18" xmlns="http://www.w3.org/2000/svg">
                <path d="M10,21.75a2.087,2.087,0,0,0,4.005,0" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                <path d="M12 3L12 0.75" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
                <path d="M12,3a7.5,7.5,0,0,1,7.5,7.5c0,7.046,1.5,8.25,1.5,8.25H3s1.5-1.916,1.5-8.25A7.5,7.5,0,0,1,12,3Z" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" />
            </svg>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill text-bg-danger">
                20+<span class="visually-hidden">unread messages</span>
            </span>
        </a>

        <!-- Notifications offcanvas -->
        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNotifications" aria-labelledby="offcanvasNotificationsLabel">
            <div class="offcanvas-header px-5">
                <h3 class="offcanvas-title" id="offcanvasNotificationsLabel">Notifications</h3>

                <div class="d-flex align-items-start ms-auto">
                    <div class="dropdown">
                        <a href="javascript: void(0);" class="dropdown-toggle no-arrow w-20px h-20px me-2 text-body" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" height="16" width="16">
                                <g>
                                    <circle cx="3.25" cy="12" r="3.25" style="fill: currentColor" />
                                    <circle cx="12" cy="12" r="3.25" style="fill: currentColor" />
                                    <circle cx="20.75" cy="12" r="3.25" style="fill: currentColor" />
                                </g>
                            </svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="javascript: void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="me-2 text-secondary" height="14" width="14">
                                        <g>
                                            <path d="M23.22,2.06a1.49,1.49,0,0,0-2,.59l-8.5,15.43L6.46,11.29a1.5,1.5,0,1,0-2.21,2l7.64,8.34a1.52,1.52,0,0,0,2.42-.29L23.81,4.1A1.5,1.5,0,0,0,23.22,2.06Z" style="fill: currentColor" />
                                            <path d="M2.61,14.63a1.5,1.5,0,0,0-2.22,2l4.59,5a1.52,1.52,0,0,0,2.11.09,1.49,1.49,0,0,0,.1-2.12Z" style="fill: currentColor" />
                                            <path d="M10.3,13a1.41,1.41,0,0,0,2-.54L16.89,4.1a1.5,1.5,0,1,0-2.62-1.45L9.68,11A1.41,1.41,0,0,0,10.3,13Z" style="fill: currentColor" />
                                        </g>
                                    </svg>
                                    Mark as all read
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript: void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="me-2 text-secondary" height="14" width="14">
                                        <g>
                                            <path d="M21.5,2.5H2.5a2,2,0,0,0-2,2v3a1,1,0,0,0,1,1h21a1,1,0,0,0,1-1v-3A2,2,0,0,0,21.5,2.5Z" style="fill: currentColor" />
                                            <path d="M21.5,10H2.5a1,1,0,0,0-1,1v8.5a2,2,0,0,0,2,2h17a2,2,0,0,0,2-2V11A1,1,0,0,0,21.5,10Zm-6.25,3.5A1.25,1.25,0,0,1,14,14.75H10a1.25,1.25,0,0,1,0-2.5h4A1.25,1.25,0,0,1,15.25,13.5Z" style="fill: currentColor" />
                                        </g>
                                    </svg>
                                    Archive all
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript: void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="me-2 text-secondary" height="14" width="14">
                                        <g>
                                            <path d="M21,19.5a1,1,0,0,0,0-2A1.5,1.5,0,0,1,19.5,16V11.14a8.65,8.65,0,0,0-.4-2.62l-11,11Z" style="fill: currentColor" />
                                            <path d="M14.24,21H9.76a.25.25,0,0,0-.24.22,2.64,2.64,0,0,0,0,.28,2.5,2.5,0,0,0,5,0,2.64,2.64,0,0,0,0-.28A.25.25,0,0,0,14.24,21Z" style="fill: currentColor" />
                                            <path d="M1,24a1,1,0,0,0,.71-.28l22-22a1,1,0,0,0,0-1.42,1,1,0,0,0-1.42,0l-5,5A7.31,7.31,0,0,0,13,3.07V1a1,1,0,0,0-2,0V3.07a8,8,0,0,0-6.5,8.07V16A1.5,1.5,0,0,1,3,17.5a1,1,0,0,0,0,2h.09L.29,22.29a1,1,0,0,0,0,1.42A1,1,0,0,0,1,24Z" style="fill: currentColor" />
                                        </g>
                                    </svg>
                                    Disable notifications
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript: void(0);">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="me-2 text-secondary" height="14" width="14">
                                        <g>
                                            <rect x="4.25" y="4.5" width="5.75" height="7.25" rx="1.25" style="fill: currentColor" />
                                            <path d="M24,10a3,3,0,0,0-3-3H19V2.5a2,2,0,0,0-2-2H2a2,2,0,0,0-2,2V20a3.5,3.5,0,0,0,3.5,3.5h17A3.5,3.5,0,0,0,24,20ZM3.5,21.5A1.5,1.5,0,0,1,2,20V3a.5.5,0,0,1,.5-.5h14A.5.5,0,0,1,17,3V20a3.51,3.51,0,0,0,.11.87.5.5,0,0,1-.09.44.49.49,0,0,1-.39.19ZM22,20a1.5,1.5,0,0,1-3,0V9.5a.5.5,0,0,1,.5-.5H21a1,1,0,0,1,1,1Z" style="fill: currentColor" />
                                            <rect x="12" y="6.05" width="3.5" height="2" rx="0.75" style="fill: currentColor" />
                                            <rect x="12" y="10.05" width="3.5" height="2" rx="0.75" style="fill: currentColor" />
                                            <rect x="4" y="14.05" width="11.5" height="2" rx="0.75" style="fill: currentColor" />
                                            <rect x="4" y="18.05" width="9" height="2" rx="0.75" style="fill: currentColor" />
                                        </g>
                                    </svg>
                                    What's new?
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Button -->
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
            </div>

            <div class="offcanvas-body p-0">
                <div class="list-group list-group-flush">
                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-28.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Daniel</h5>
                                    <small class="text-body-secondary">10 minutes ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">RE: Email pre-population from external source</p>
                                    <small class="text-secondary">Not sure if we'll need any further instruction on how to utilise the encoded ID in links from the new email broadcast tool.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <span class="avatar-title text-bg-info-soft">M</span>
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Mochahost.com</h5>
                                    <small class="text-body-secondary">14 minutes ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Customer invoice</p>
                                    <small class="text-secondary">This is a notice that an invoice has been generated on 05/14/2022.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-26.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Harry</h5>
                                    <small class="text-body-secondary">32 minutes ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Farewell card</p>
                                    <small class="text-secondary">Hi everyone, thanks to all who have already signed and contributed to Ellie's leaving card.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-20.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Gavin</h5>
                                    <small class="text-body-secondary">55 minutes ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Weekly cath up</p>
                                    <small class="text-secondary">Let's see how your emails performed in the past week.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-24.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Pamela - HR</h5>
                                    <small class="text-body-secondary">1 hour ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">New starter</p>
                                    <small class="text-secondary">I wanted to introduce Alan to you all, who starts today in the Operations Team as our new Global Payroll & Benefits Manager.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-13.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">James</h5>
                                    <small class="text-body-secondary">2 hours ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Looking for newsletter analyst</p>
                                    <small class="text-secondary">Good morning Brian, I hope you can help with the following. I am looking for somebody who can help us create stronger newsletters.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <span class="avatar-title text-bg-primary-soft">S</span>
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">service.paypal.com</h5>
                                    <small class="text-body-secondary">3 hours ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">You have a Payout!</p>
                                    <small class="text-secondary">Please note that it may take a little while for this payment to appear in the Activity section of your account.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <span class="avatar-title text-bg-primary-soft">C</span>
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">CookieYes</h5>
                                    <small class="text-body-secondary">5 hours ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Welcome to CookieYes!</p>
                                    <small class="text-secondary">Welcome to CookieYes! Thank you for creating an account with us.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-12.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Andrew</h5>
                                    <small class="text-body-secondary">6 hours ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Congratulations! - and thank you</p>
                                    <small class="text-secondary">Thank you so much for continuing to leave no stone unturned in pursuit of new milestones of success.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-11.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Helen</h5>
                                    <small class="text-body-secondary">9 hours ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Bank Holidays season starts tomorrow</p>
                                    <small class="text-secondary">Our office will be closed on these days, as it will also be on Friday 6 May.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-09.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Tiffany</h5>
                                    <small class="text-body-secondary">1 day ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">External meetings and events</p>
                                    <small class="text-secondary">We have updated our external meeting and events protocol. Please have a look at the office board.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <span class="avatar-title text-bg-danger-soft">II</span>
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Ionos Info</h5>
                                    <small class="text-body-secondary">2 days ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Recommend us to earn attractive commissions</p>
                                    <small class="text-secondary">Happy with your product or service? Sign up for the IONOS Referral Program to recommend us to your business partners, friends or family. We'll reward you with attractive commissions when they place an order.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-12.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Edward</h5>
                                    <small class="text-body-secondary">3 days ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Website change request</p>
                                    <small class="text-secondary">Please add video overlay option to microsite header image</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <span class="avatar-title text-bg-primary">BT</span>
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Bootstrap Themes</h5>
                                    <small class="text-body-secondary">3 days ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">[Bootstrap Themes] New order (123456)!</p>
                                    <small class="text-secondary">You've received the following order from alansmith</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-08.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Greg</h5>
                                    <small class="text-body-secondary">4 days ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Greg Smith (Jira) 2</p>
                                    <small class="text-secondary">[JIRA] (WEB-1022) Add Full Width Video Content Block to microsites</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-07.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Michael</h5>
                                    <small class="text-body-secondary">5 days ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">Hard drive limit</p>
                                    <small class="text-secondary">Your hard drive is close to its storage cap. Once exceeded, you can't add new items or sync changes.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <span class="avatar-title text-bg-info">RC</span>
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">Rave Coffee</h5>
                                    <small class="text-body-secondary">6 days ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">It's Double Points - ⏰ 24 hours only</p>
                                    <small class="text-secondary">Login to your Rave account to place your order and you will automatically earn double points on every $ spent.</small>
                                </div>
                            </div>
                        </div>
                    </a>

                    <a href="javascript: void(0);" class="list-group-item list-group-item-action">
                        <div class="d-flex">
                            <div class="avatar avatar-circle avatar-xs me-2">
                                <img src="assets/images/profiles/profile-03.jpg" alt="..." class="avatar-img" width="30" height="30">
                            </div>

                            <div class="d-flex flex-column flex-grow-1">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">John</h5>
                                    <small class="text-body-secondary">7 days ago</small>
                                </div>

                                <div class="d-flex flex-column">
                                    <p class="mb-1">John Po (Jira)</p>
                                    <small class="text-secondary">Improving slide arrows and indicators on gift impact, testimonial and victories module</small>
                                </div>
                            </div>
                        </div>
                    </a>
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