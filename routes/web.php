
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmergencyReportController;
use App\Http\Controllers\CrisisCategoryController;
use App\Http\Controllers\ResponseTeamController;
use App\Http\Controllers\IncidentAssignmentController;
use App\Http\Controllers\EmergencyAlertController;

/*
|--------------------------------------------------------------------------
| Public Home Page
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/student-login', [AuthController::class, 'studentLogin'])
    ->name('student.login');

Route::get('/admin-login', [AuthController::class, 'adminLogin'])
    ->name('admin.login');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.submit');

Route::get('/forgot-password', [
    AuthController::class,
    'showForgotPassword'
])->name('password.request');

Route::post('/forgot-password', [
    AuthController::class,
    'forgotPassword'
])->name('password.email');

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Report Incident and All Incidents
|--------------------------------------------------------------------------
*/

// All Incidents: incidents ki list
Route::get('/incidents', [
    EmergencyReportController::class,
    'index'
])->name('incidents.index');

// Report Incident: naya report form
Route::get('/incidents/create', [
    EmergencyReportController::class,
    'create'
])->name('incidents.create');

// Submit new report
Route::post('/incidents', [
    EmergencyReportController::class,
    'store'
])->name('incidents.store');

// View a single incident
Route::get('/incidents/{emergencyReport}', [
    EmergencyReportController::class,
    'show'
])->whereNumber('emergencyReport')
  ->name('incidents.show');

// Edit incident
Route::get('/incidents/{emergencyReport}/edit', [
    EmergencyReportController::class,
    'edit'
])->whereNumber('emergencyReport')
  ->name('incidents.edit');

// Update incident
Route::put('/incidents/{emergencyReport}', [
    EmergencyReportController::class,
    'update'
])->whereNumber('emergencyReport')
  ->name('incidents.update');

// Delete incident
Route::delete('/incidents/{emergencyReport}', [
    EmergencyReportController::class,
    'destroy'
])->whereNumber('emergencyReport')
  ->name('incidents.destroy');

/*
|--------------------------------------------------------------------------
| Emergency Reports Resource
|--------------------------------------------------------------------------
|
| Existing emergency-reports URLs bhi available rahenge.
|
*/

Route::resource('emergency-reports', EmergencyReportController::class);

/*
|--------------------------------------------------------------------------
| Crisis Categories
|--------------------------------------------------------------------------
*/

Route::resource('crisis-categories', CrisisCategoryController::class);

/*
|--------------------------------------------------------------------------
| Response Teams
|--------------------------------------------------------------------------
*/

Route::resource('response-teams', ResponseTeamController::class);

/*
|--------------------------------------------------------------------------
| Incident Assignments
|--------------------------------------------------------------------------
*/

Route::resource('incident-assignments', IncidentAssignmentController::class);

/*
|--------------------------------------------------------------------------
| Emergency Alerts
|--------------------------------------------------------------------------
*/

Route::resource('emergency-alerts', EmergencyAlertController::class);

/*
|--------------------------------------------------------------------------
| Map Navigation
|--------------------------------------------------------------------------
*/

Route::view('/map-navigation', 'map-navigation')
    ->name('map.navigation');

/*
|--------------------------------------------------------------------------
| Other CampusGuard Pages
|--------------------------------------------------------------------------
*/

$pages = [
    'emergency-teams'       => 'Emergency Teams',
    'campus-locations'      => 'Campus Locations',
    'resources-equipment'   => 'Resources & Equipment',
    'users-roles'           => 'Users & Roles',
    'reports-analytics'     => 'Reports & Analytics',
    'audit-logs'            => 'Audit Logs',
    'search-filter'         => 'Search & Filter',
    'settings'              => 'Settings',
    'profile'               => 'My Profile',
    'quick-actions'         => 'Quick Actions',
];

foreach ($pages as $url => $title) {
    Route::view('/' . $url, 'placeholder', [
        'pageTitle' => $title,
    ])->name(str_replace('-', '.', $url));
}
