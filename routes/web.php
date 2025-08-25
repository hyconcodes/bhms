<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicalController;
use App\Http\Controllers\EMRController;
use App\Http\Controllers\PatientController;
use App\Jobs\UpdateMatricNumbers;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('storage-links', function() {
    Artisan::call('storage:link');
    return 'Storage link has been created';
});

Route::get('storage-link', function() {
    $target = storage_path('app/public');
    $link = public_path('storage');

    if (!file_exists($link)) {
        symlink($target, $link); // Alternative logic here
    }

    return 'Storage link has been created';
});


Route::middleware(['guest'])->group(function () {
    Route::get('/', fn() => view('auth.login'))->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/password/reset', fn() => view('auth.password_reset'))->name('password.reset');
    Route::post('/password/reset', [AuthController::class, 'passwordResetStore'])->name('password.reset.store');
});
// Dashboard
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    // Admins Dashboard
    Route::get('/dashboard', function () {
        $api_url = Setting::first()?->api_url;
        $users = User::whereHas('role', fn($query) => $query->where('name', 'student'))
            ->orderBy('updated_at', 'desc')->paginate(8);
        $all_student_reg_no = User::whereHas('role', fn($query) => $query->where('name', 'student'))->pluck('reg_no');

        // Dispatch the background job
        UpdateMatricNumbers::dispatch($all_student_reg_no, $api_url);

        // Chart configuration for monthly student registrations
        $chart_options = [
            'chart_title' => 'Students by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Models\User',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
            'chart_color' => '0, 186, 199',
            'date_format' => 'F Y',
            'filter_period' => 'year',
            'filter_days' => 365,
            'continuous_time' => true,
            'show_blank_data' => true,
            'where_raw' => "role_id = (SELECT id FROM roles WHERE name = 'student')"
        ];
        $chart1 = new LaravelChart($chart_options);
        return view('admin.home', compact('users', 'all_student_reg_no', 'api_url', 'chart1'));
    })->middleware('admins');

    Route::get('/admin/create', function () {
        $roles = Role::whereNotIn('name', ['super admin', 'student'])->get();
        $users = User::whereHas('role', function ($query) {
            $query->whereNotIn('name', ['super admin', 'student']);
        })->orderBy('updated_at', 'desc')->paginate(8);
        return view('admin.create_admin', [
            'roles' => $roles,
            'users' => $users,
        ]);
    })->name('admin.create')->middleware('superadmin');
    Route::post('/admin/store', [AuthController::class, 'adminStore'])->name('admin.store')->middleware('superadmin');
    //FOR SUSPENDING AND ACTIVATING ACCOUNT
    Route::patch('/admin/users/{userId}/toggle-status', function ($userId) {
        $user = User::findOrFail($userId);
        $user->status = !$user->status;
        $user->save();
        $msg = $user->status ? 'Account activated.' : 'Account suspended.';
        return redirect()->back()->with('message', $msg);
    })->name('admin.toggleStatus')->middleware('superadmin');
    Route::get('admin/users/search', [AuthController::class, 'searchAdmin'])->name('admin.search')->middleware('superadmin');
    Route::get('admin/users/{userId}/view', function ($userId) {
        $user = User::with(['role', 'appointments'])->findOrFail($userId);
        $roles = Role::where('name', '!=', 'super admin')->get();
        return view('admin.view_admin', [
            'user' => $user,
            'roles' => $roles,
        ]);
    })->name('admin.view')->middleware('superadmin');

    // Route for all role start
    Route::get('/profile', function () {
        $user = auth()->user();
        $api_url = Setting::first()?->api_url;
        $countries = [
            'Afghanistan',
            'Aland Islands',
            'Albania',
            'Algeria',
            'American Samoa',
            'Andorra',
            'Angola',
            'Anguilla',
            'Antarctica',
            'Antigua and Barbuda',
            'Argentina',
            'Armenia',
            'Aruba',
            'Australia',
            'Austria',
            'Azerbaijian',
            'Bahamas',
            'Bahrain',
            'Bangladesh',
            'Barbados',
            'Belarus',
            'Belgium',
            'Belize',
            'Benin',
            'Bermuda',
            'Bhutan',
            'Bolivia (Plurinational State of)',
            'Bonaire, Sint Eustatius and Saba',
            'Bosnia and Herzegovina',
            'Botswana',
            'Brazil',
            'British Indian Ocean Territory',
            'Brunei Darussalam',
            'Bulgaria',
            'Burkina Faso',
            'Burundi',
            'Cabo Verde',
            'Cambodia',
            'Cameroon',
            'Canada',
            'Cayman Islands',
            'Central African Republic',
            'Chad',
            'Chile',
            'China',
            'Christmas Island',
            'Cocos (Keeling) Islands',
            'Colombia',
            'Comoros',
            'Congo',
            'Congo (the Democratic Republic of the)',
            'Cook Islands',
            'Costa Rica',
            "Cote D'ivoire",
            'Croatia',
            'Cuba',
            'Curacao',
            'Cyprus',
            'Czechia',
            'Denmark',
            'Djibouti',
            'Dominica',
            'Dominican Republic',
            'Ecuador',
            'Egypt',
            'El Salvador',
            'Equatorial Guinea',
            'Eritrea',
            'Estonia',
            'Ethiopia',
            'Falkland Islands (Malvinas)',
            'Faroe Islands',
            'Fiji',
            'Finland',
            'France',
            'French Guiana',
            'French Polynesia',
            'French Southern Territories',
            'Gabon',
            'Gambia',
            'Georgia',
            'Germany',
            'Ghana',
            'Gibraltar',
            'Greece',
            'Greenland',
            'Grenada',
            'Guadeloupe',
            'Guam',
            'Guatemala',
            'Guernsey',
            'Guinea',
            'Guinea-Bissau',
            'Guyana',
            'Haiti',
            'Holy See',
            'Honduras',
            'Hong Kong',
            'Hungary',
            'Iceland',
            'India',
            'Indonesia',
            'Iran (Islamic Republic of)',
            'Iraq',
            'Ireland',
            'Isle of Man',
            'Israel',
            'Italy',
            'Jamaica',
            'Japan',
            'Jersey',
            'Jordan',
            'Kazakhstan',
            'Kenya',
            'Kiribati',
            "Korea (the Democratic People's Republic of)",
            'Korea (the Republic of)',
            'Kuwait',
            'Kyrgyzstan',
            "Lao People's Democratic Republic",
            'Latvia',
            'Lebanon',
            'Lesotho',
            'Liberia',
            'Libya',
            'Liechtenstein',
            'Lithuania',
            'Luxembourg',
            'Macao',
            'North Macedonia',
            'Madagascar',
            'Malawi',
            'Malaysia',
            'Maldives',
            'Mali',
            'Malta',
            'Marshall Islands',
            'Martinique',
            'Mauritania',
            'Mauritius',
            'Mayotte',
            'Mexico',
            'Micronesia (Federated States of)',
            'Moldova (the Republic of)',
            'Monaco',
            'Mongolia',
            'Montenegro',
            'Montserrat',
            'Morocco',
            'Mozambique',
            'Myanmar',
            'Namibia',
            'Nauru',
            'Nepal',
            'Netherlands',
            'New Caledonia',
            'New Zealand',
            'Nicaragua',
            'Niger',
            'Nigeria',
            'Niue',
            'Norfolk Island',
            'Northern Mariana Islands',
            'Norway',
            'Oman',
            'Pakistan',
            'Palau',
            'Palestine, State of',
            'Panama',
            'Papua New Guinea',
            'Paraguay',
            'Peru',
            'Philippines',
            'Pitcairn',
            'Poland',
            'Portugal',
            'Puerto Rico',
            'Qatar',
            'Reunion',
            'Romania',
            'Russian Federation',
            'Rwanda',
            'Saint Barthelemy',
            'Saint Helena, Ascension and Tristan Da Cunha',
            'Saint Kitts and Nevis',
            'Saint Lucia',
            'Saint Martin (French Part)',
            'Saint Pierre and Miquelon',
            'Saint Vincent and The Grenadines',
            'Samoa',
            'San Marino',
            'Sao Tome and Principe',
            'Saudi Arabia',
            'Senegal',
            'Serbia',
            'Seychelles',
            'Sierra Leone',
            'Singapore',
            'Sint Maarten (Dutch Part)',
            'Slovakia',
            'Slovenia',
            'Solomon Islands',
            'Somalia',
            'South Africa',
            'South Georgia and The South Sandwich Islands',
            'South Sudan',
            'Spain',
            'Sri Lanka',
            'Sudan',
            'Suriname',
            'Svalbard and Jan Mayen',
            'Eswatini',
            'Sweden',
            'Switzerland',
            'Syrian Arab Republic',
            'Taiwan (Province of China)',
            'Tajikistan',
            'Tanzania, United Republic of',
            'Thailand',
            'Timor-Leste',
            'Togo',
            'Tokelau',
            'Tonga',
            'Trinidad and Tobago',
            'Tunisia',
            'Turkey',
            'Turkmenistan',
            'Turks and Caicos Islands',
            'Tuvalu',
            'Uganda',
            'Ukraine',
            'United Arab Emirates',
            'United Kingdom of Great Britain and Northern Ireland',
            'United States of America',
            'United States Minor Outlying Islands',
            'Uruguay',
            'Uzbekistan',
            'Vanuatu',
            'Venezuela (Bolivarian Republic of)',
            'Viet Nam',
            'Virgin Islands (British)',
            'Virgin Islands (U.S.)',
            'Wallis and Futuna',
            'Western Sahara',
            'Yemen',
            'Zambia',
            'Zimbabwe',
        ];
        return view('admin.profile', compact('user', 'countries', 'api_url'));
    })->name('admin.profile');
    Route::post('/profile', [AuthController::class, 'adminProfileUploadPicture'])->name('admin.profile.upload_picture');
    Route::put('/profile/info', [AuthController::class, 'adminProfileInfo'])->name('admin.profile.update');
    Route::put('/profile/update/password', [AuthController::class, 'adminProfileUpdatePassword'])->name('admin.profile.update_password');
    Route::delete('/account/delete', [AuthController::class, 'adminDeleteAccount'])->name('admin.profile.delete_account');
    Route::get('/view/calendar', fn() => view('student.calendar'))->name('calendar');
    // Route for all role end

    Route::middleware(['superadmin'])->group(function () {
        Route::patch('/admin/profile/{userId}/update/role', [AuthController::class, 'adminProfileUpdateRole'])->name('admin.users.updateRole');
        Route::patch('/admin/update/api', [AuthController::class, 'adminUpdateApiUrl'])->name('admin.update_api_url');
    });
    // FOR CREATING PATIENTS by admins
    Route::middleware(['admins'])->group(function () {
        Route::get('/admin/create/patient', function () {
            $api_url = Setting::first()?->api_url;
            $roles = Role::where('name', 'student')->get();
            $users = User::whereHas('role', fn($query) => $query->where('name', 'student'))
                ->orderBy('updated_at', 'desc')->paginate(8);
            return view('admin.create_patient', [
                'api_url' => $api_url,
                'roles' => $roles,
                'users' => $users,
            ]);
        })->name('admin.create.patient');
        Route::post('/patient/store', [PatientController::class, 'patientStore'])->name('patient.store');
        Route::get('/admin/patient/search', [PatientController::class, 'searchPatient'])->name('patient.search');
        Route::get('/admin/patient/{userId}/view', function ($userId) {
            $user = User::with(['role', 'patientAppointments'])->findOrFail($userId);
            $roles = Role::where('name', '!=', 'Super Admin')->get();
            return view('admin.view_patient', [
                'user' => $user,
                'roles' => $roles,
            ]);
        })->name('admin.patient.view');
    });

    // Super Admin can delete staff and patient
    Route::middleware(['superadmin'])->group(function () {
        Route::delete('/admin/staff/{userId}/delete', [AdminController::class, 'deletePatient'])->name('admin.staff.delete');
        Route::delete('/admin/patient/{userId}/delete', [PatientController::class, 'deletePatient'])->name('admin.patient.delete');
    });

    // Electronic Medical Records (EMR)
    Route::middleware(['admins'])->group(function () {
        Route::get('/admin/emr', [EMRController::class, 'index'])->name('admin.emr.index');
        Route::patch('/admin/emr/patient/{userId}.updateBioData', [EMRController::class, 'updateBioData'])->name('admin.patient.updateBioData');
        Route::patch('/admin/emr/patient/{userId}.updateMedicalHistory', [EMRController::class, 'updateMedicalHistory'])->name('admin.patient.updateMedicalHistory');
        Route::patch('/admin/emr/patient/{userId}.updateInvestigationResults', [EMRController::class, 'updateInvestigationResults'])->name('admin.patient.updateInvestigationResults');
        Route::get('/admin/emr/patient/{userId}.downloadPDF', [EMRController::class, 'downloadPDF'])->name('admin.patient.downloadPDF');
        Route::get('/admin/emr/patient/search', [EMRController::class, 'emrSearchPatient'])->name('emr.patient.search');
    });

    // Clinical Records Route
    Route::middleware(['admins'])->group(function () {
        Route::get('admin/clinical-records', [ClinicalController::class, 'index'])->name('clinical.index');
        Route::get('/admin/clinical-records/{userId}/view', [ClinicalController::class, 'viewClinicalRecord'])->name('clinical.view');
        Route::get('/admin/clinical-records/{userId}/newRecord', [ClinicalController::class, 'newRecord'])->name('clinical.newRecord');
        Route::post('/admin/clinical-records/{userId}/store', [ClinicalController::class, 'store'])->name('clinical.store');
        
        Route::get('/admin/clinical-records/{userId}/edit', [ClinicalController::class, 'edit'])->name('clinical.edit');
        Route::put('/admin/clinical-records/{userId}/update', [ClinicalController::class, 'update'])->name('clinical.update');

        Route::patch('/admin/clinical-records/{userId}/updateVitalSigns', [ClinicalController::class, 'updateVitalSigns'])->name('clinical.updateVitalSigns');
        Route::patch('/admin/clinical-records/{userId}/updateLabTest', [ClinicalController::class, 'updateLabTest'])->name('clinical.updateLabTest');
        Route::patch('/admin/clinical-records/{userId}/updateDiagnosisAndPrescription', [ClinicalController::class, 'updateDiagnosisAndPrescription'])->name('clinical.updateDiagnosisAndPrescription');
    });
    // STUDENTS
    Route::middleware(['student'])->group(function () {
        Route::get('/student', [PatientController::class, 'index']);
        Route::get('/student/book/appointment/{userId}', [PatientController::class, 'bookAppointment'])->name('student.book.appointment');
        Route::post('/student/store/appointment/{userId}', [PatientController::class, 'storeAppointment'])->name('student.store.appointment');
        Route::get('/student/doctors/search', [PatientController::class, 'searchDoctors'])->name('doctors.search');
        // FOR BOOKING APPOINTMENTS FOR STUDENTS
        Route::get('/student/appointments', [PatientController::class, 'studentAppointments'])->name('student.appointments');
        Route::get('/student/appointment/{id}/view', [PatientController::class, 'viewAppointment'])->name('appointment.view');
        Route::put('/student/appointment/{id}', [PatientController::class, 'updateAppointment'])->name('appointment.update');
        Route::delete('/student/appointment/{id}', [PatientController::class, 'destroyAppointment'])->name('appointment.destroy');
    });

    // FOR BOOKING APPOINTMENTS FOR ADMIN
    Route::middleware(['admins'])->group(function () {
        Route::get('/admin/appointments', [AdminController::class, 'adminAppointments'])->name('admin.appointments');
        Route::put('/admin/appointments/{id}/cancel', [AdminController::class, 'adminCancelAppointments'])->name('appointment.cancel');
        Route::get('/admin/appointment/{id}/view', [AdminController::class, 'viewAppointment'])->name('admin.appointment.view');
        Route::put('/admin/appointment/{id}/update', [AdminController::class, 'updateAppointment'])->name('admin.appointment.update');
    });
});
