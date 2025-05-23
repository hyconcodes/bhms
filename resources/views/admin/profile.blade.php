@extends('layouts.app')
@section('title', 'Staff Account')
@section('content')
<div class="container-fluid">
    @include('includes.error_or_success_message')
    <div class="d-flex align-items-baseline justify-content-between">

        <!-- Title -->
        <h1 class="h2">
            Account
        </h1>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Account</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        <div class="col-md-4 col-xxl-3">

            <!-- Card -->
            <div class="card border-0 sticky-md-top top-10px">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <form action="{{ route('admin.profile.upload_picture') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="avatar avatar-xxl avatar-circle mb-5">
                                <label class="d-block cursor-pointer">
                                    <span class="position-absolute bottom-0 end-0 m-0 text-bg-primary w-30px h-30px rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-pencil" style="font-size: 1rem;"></i>
                                    </span>
                                    <input type="file" name="profile_picture" class="d-none" onchange="this.form.submit()">
                                </label>
                                @if($user->profile_picture)
                                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="Profile picture" class="avatar-img" width="112" height="112">
                                @else
                                <img src="{{ Auth::user()->avatar }}" alt="Profile picture" class="avatar-img" width="112" height="112">
                                @endif
                            </div>
                        </form>

                        <h3 class="mb-0">{{ Auth::user()->name }}</h3>
                        <span class="small text-secondary fw-semibold">{{ Auth::user()->role->name }}</span>
                    </div>

                    <!-- Divider -->
                    <hr class="mb-0">
                </div>

                <ul class="scrollspy mb-5" id="account" data-scrollspy='{"offset": "30"}'>
                    <li class="active">
                        <a href="#basicInformationSection" class="d-flex align-items-center py-3">
                            <i class="bi bi-person me-3" style="font-size: 1.1em;"></i>
                            Basic information
                        </a>
                    </li>

                    <li>
                        <a href="#passwordSection" class="d-flex align-items-center py-3">
                            <i class="bi bi-shield-lock me-3" style="font-size: 1.1em;"></i>
                            Password
                        </a>
                    </li>

                    <li>
                        <a href="#deleteAccountSection" class="d-flex align-items-center py-3">
                            <i class="bi bi-trash me-3" style="font-size: 1.1em;"></i>
                            Delete account
                        </a>
                    </li>
                </ul>

                <!-- <div class="card-footer text-center">
                    <a href="user.html" class="btn btn-secondary">View Public Profile</a>
                </div> -->
            </div>
        </div>

        <div class="col">
            <!-- Card -->
            <div class="card border-0 scroll-mt-3" id="basicInformationSection">
                <form action="{{ route('admin.profile.update') }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h2 class="h3 mb-0">Basic information</h2>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="fullName" class="col-form-label">Full Name</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" class="form-control" id="fullName" name="name" value="{{ old('name', $user->name) }}">
                                <div class="invalid-feedback">Please add your full name</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="date_of_birth" class="col-form-label">Date of Birth</label>
                            </div>
                            <div class="col-lg">
                                <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth', $user->date_of_birth) }}">
                                <div class="invalid-feedback">Please add your date of birth</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="gender" class="col-form-label">Gender</label>
                            </div>
                            <div class="col-lg">
                                <select class="form-select" id="gender" name="gender">
                                    <option value="">Select gender</option>
                                    <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                    <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <div class="invalid-feedback">Please select your gender</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="phone" class="col-form-label">Phone</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                <div class="invalid-feedback">Please add your phone number</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="address" class="col-form-label">Address</label>
                            </div>
                            <div class="col-lg">
                                <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}">
                                <div class="invalid-feedback">Please add your address</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="religion" class="col-form-label">Religion</label>
                            </div>
                            <div class="col-lg">
                                <select class="form-select" id="religion" name="religion">
                                    <option value="">Select religion</option>
                                    <option value="christianity" {{ old('religion', $user->religion) == 'christianity' ? 'selected' : '' }}>Christianity</option>
                                    <option value="islam" {{ old('religion', $user->religion) == 'islam' ? 'selected' : '' }}>Islam</option>
                                    <option value="hinduism" {{ old('religion', $user->religion) == 'hinduism' ? 'selected' : '' }}>Hinduism</option>
                                    <option value="buddhism" {{ old('religion', $user->religion) == 'buddhism' ? 'selected' : '' }}>Buddhism</option>
                                    <option value="other" {{ old('religion', $user->religion) == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <div class="invalid-feedback">Please select your religion</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="nationality" class="col-form-label">Nationality</label>
                            </div>
                            <div class="col-lg">
                                <select class="form-select" id="nationality" name="nationality">
                                    <option value="">Select nationality</option>
                                    @foreach($countries as $code => $name)
                                    <option value="{{ $code }}" {{ old('nationality', $user->nationality) == $code ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">Please select your nationality</div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="marital_status" class="col-form-label">Marital Status</label>
                            </div>
                            <div class="col-lg">
                                <select class="form-select" id="marital_status" name="marital_status">
                                    <option value="">Select marital status</option>
                                    <option value="single" {{ old('marital_status', $user->marital_status) == 'single' ? 'selected' : '' }}>Single</option>
                                    <option value="married" {{ old('marital_status', $user->marital_status) == 'married' ? 'selected' : '' }}>Married</option>
                                    <option value="divorced" {{ old('marital_status', $user->marital_status) == 'divorced' ? 'selected' : '' }}>Divorced</option>
                                    <option value="widowed" {{ old('marital_status', $user->marital_status) == 'widowed' ? 'selected' : '' }}>Widowed</option>
                                </select>
                                <div class="invalid-feedback">Please select your marital status</div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-5">
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Card -->
            <div class="card border-0 scroll-mt-3" id="passwordSection">
                <form action="{{ route('admin.profile.update_password') }}" method="POST" novalidate>
                    @csrf
                    @method('PUT')
                    <div class="card-header">
                        <h2 class="h3 mb-0">Password</h2>
                    </div>

                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="currentPassword" class="col-form-label">Current password</label>
                            </div>

                            <div class="col-lg">
                                <input type="password" class="form-control" id="currentPassword" name="current_password">
                                <div class="invalid-feedback">Please add your current password</div>
                            </div>
                        </div> <!-- / .row -->

                        <div class="row mb-4">
                            <div class="col-lg-3">
                                <label for="newPassword" class="col-form-label">New password</label>
                            </div>

                            <div class="col-lg">
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="newPassword" name="password" autocomplete="off" data-toggle-password-input placeholder="Your new password">

                                    <button type="button" class="input-group-text px-4 text-secondary link-primary" data-toggle-password></button>
                                </div>

                                <div class="invalid-feedback">Please add a new password</div>

                                <div class="d-flex justify-content-between align-items-center mt-3 h-15px">
                                    <div class="progress d-flex flex-grow-1 h-7px">
                                        <div data-zxcvbn='{"input": "#newPassword", "text": "#progressText"}' class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <span class="text-body-secondary fs-6" id="progressText"></span>
                                </div>
                            </div>

                            <div class="col-lg">
                                <div class="input-group input-group-merge">
                                    <input type="password" class="form-control" id="newPasswordAgain" name="password_confirmation" autocomplete="off" data-toggle-password-input placeholder="Confirm your new password">

                                    <button type="button" class="input-group-text px-4 text-secondary link-primary" data-toggle-password></button>
                                </div>

                                <div class="invalid-feedback">Please confirm your new password again</div>
                            </div>
                        </div> <!-- / .row -->

                        <div class="row">
                            <div class="col-lg offset-lg-3">
                                <div class="alert alert-light mw-450px" role="alert">
                                    <h4 class="mb-3">Password requirements:</h4>
                                    <ul class="p-3 mb-0">
                                        <li>Minimum 8 characters long - the more, the better</li>
                                        <li>At least one lowercase character</li>
                                        <li>At least one uppercase character</li>
                                        <li>At least one number, symbol, or whitespace character</li>
                                    </ul>
                                </div>
                            </div>
                        </div> <!-- / .row -->

                        <div class="d-flex justify-content-end mt-5">

                            <!-- Button -->
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Card -->
            <div class="card border-0 scroll-mt-3" id="deleteAccountSection">
                <div class="card-header">
                    <h2 class="h3 mb-0">Delete Account</h2>
                </div>

                <div class="card-body">
                    <div class="alert text-bg-danger-soft d-flex align-items-center" role="alert">
                        <div>
                            <i class="bi bi-exclamation-triangle-fill text-danger me-3" style="font-size: 2rem;"></i>
                        </div>
                        <div>
                            <h4 class="mb-0">If you delete your account, you will lose all your data</h4>
                            Take a backup of your data
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">

                            <!-- Input -->
                            <input type="checkbox" class="form-check-input" id="deleteAccount">

                            <!-- Label -->
                            <label class="form-check-label" for="deleteAccount">
                                I confirm that I'd like to delete my account
                            </label>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-5">

                        <!-- Button -->
                        <button type="button" class="btn btn-danger">Delete account</button>
                    </div>
                </div>
            </div>
            <!-- </form> -->
        </div>
    </div> <!-- / .row -->
</div> <!-- / .container-fluid -->
@endsection