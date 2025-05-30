<!-- FOR STUDENT -->
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
            @endforeach
        </div>
    </div>
</div>