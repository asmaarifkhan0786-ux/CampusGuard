<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\EmergencyReportController;
use App\Http\Controllers\CrisisCategoryController;
use App\Http\Controllers\ResponseTeamController;
use App\Http\Controllers\IncidentAssignmentController;
use App\Http\Controllers\EmergencyAlertController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ResourcesEquipmentController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');


// Normal Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.submit');


// Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


// Student Login
Route::get('/student-login', [StudentLoginController::class, 'showLogin'])
    ->name('student.login');

Route::post('/student-login', [StudentLoginController::class, 'login'])
    ->name('student.login.submit');


// Admin Login
Route::get('/admin-login', [AuthController::class, 'adminLogin'])
    ->name('admin.login');


// Register
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.submit');


// Forgot Password
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
    ->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('password.email');



/*
|--------------------------------------------------------------------------
| Student Portal
|--------------------------------------------------------------------------
| Student can:
| 1. Open emergency report form
| 2. Submit emergency report
|
| Student does NOT get access to admin dashboard/modules.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/emergency-reports/create', [
        EmergencyReportController::class,
        'create'
    ])->name('emergency-reports.create');


    Route::post('/emergency-reports', [
        EmergencyReportController::class,
        'store'
    ])->name('emergency-reports.store');

});



/*
|--------------------------------------------------------------------------
| Admin Portal
|--------------------------------------------------------------------------
| Only admin users can access these routes.
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'role:admin'])->group(function () {


    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->name('dashboard');



    /*
    |--------------------------------------------------------------------------
    | Emergency Reports / All Incidents
    |--------------------------------------------------------------------------
    */

    Route::get('/emergency-reports', [
        EmergencyReportController::class,
        'index'
    ])->name('emergency-reports.index');


    Route::get('/emergency-reports/{emergencyReport}', [
        EmergencyReportController::class,
        'show'
    ])
    ->whereNumber('emergencyReport')
    ->name('emergency-reports.show');


    Route::get('/emergency-reports/{emergencyReport}/edit', [
        EmergencyReportController::class,
        'edit'
    ])
    ->whereNumber('emergencyReport')
    ->name('emergency-reports.edit');


    Route::put('/emergency-reports/{emergencyReport}', [
        EmergencyReportController::class,
        'update'
    ])
    ->whereNumber('emergencyReport')
    ->name('emergency-reports.update');


    Route::delete('/emergency-reports/{emergencyReport}', [
        EmergencyReportController::class,
        'destroy'
    ])
    ->whereNumber('emergencyReport')
    ->name('emergency-reports.destroy');



    /*
    |--------------------------------------------------------------------------
    | Crisis Categories
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'crisis-categories',
        CrisisCategoryController::class
    );



    /*
    |--------------------------------------------------------------------------
    | Emergency Teams
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'response-teams',
        ResponseTeamController::class
    );



    /*
    |--------------------------------------------------------------------------
    | Team Assignments
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'incident-assignments',
        IncidentAssignmentController::class
    );



    /*
    |--------------------------------------------------------------------------
    | Emergency Alerts
    |--------------------------------------------------------------------------
    */

    Route::resource(
        'emergency-alerts',
        EmergencyAlertController::class
    );



    /*
    |--------------------------------------------------------------------------
    | Campus Locations
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/campus-locations',
        'modules.campus-locations'
    )->name('campus.locations');



    /*
    |--------------------------------------------------------------------------
    | Resources & Equipment
    |--------------------------------------------------------------------------
    */

    Route::get('/resources-equipment', [
        ResourcesEquipmentController::class,
        'index'
    ])->name('resources-equipment.index');


    Route::post('/resources-equipment', [
        ResourcesEquipmentController::class,
        'store'
    ])->name('resources-equipment.store');



    /*
    |--------------------------------------------------------------------------
    | Users & Roles
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/users-roles',
        'modules.users-roles'
    )->name('users.roles');



    /*
    |--------------------------------------------------------------------------
    | Reports & Analytics
    |--------------------------------------------------------------------------
    */

    Route::get('/reports-analytics', function () {

        $total = \App\Models\EmergencyReport::count();

        $resolved = \App\Models\EmergencyReport::where(
            'status',
            'resolved'
        )->count();

        $active = \App\Models\EmergencyReport::where(
            'status',
            '!=',
            'resolved'
        )->count();

        return view(
            'modules.reports-analytics',
            compact(
                'total',
                'resolved',
                'active'
            )
        );

    })->name('reports.analytics');



    /*
    |--------------------------------------------------------------------------
    | Audit Logs
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/audit-logs',
        'modules.audit-logs'
    )->name('audit.logs');



    /*
    |--------------------------------------------------------------------------
    | Search & Filter
    |--------------------------------------------------------------------------
    */

    Route::get('/search-filter', function () {

        $q = request('q');

        $reports = \App\Models\EmergencyReport::query()
            ->when($q, function ($query, $q) {

                $query->where(function ($sub) use ($q) {

                    $sub->where(
                        'title',
                        'like',
                        "%{$q}%"
                    )

                    ->orWhere(
                        'description',
                        'like',
                        "%{$q}%"
                    )

                    ->orWhere(
                        'location',
                        'like',
                        "%{$q}%"
                    );

                });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'modules.search-filter',
            compact(
                'reports',
                'q'
            )
        );

    })->name('search.filter');



    /*
    |--------------------------------------------------------------------------
    | Map & Navigation
    |--------------------------------------------------------------------------
    */

    Route::view(
        '/map-navigation',
        'map-navigation'
    )->name('map.navigation');



    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [
        ProfileController::class,
        'edit'
    ])->name('profile.edit');


    Route::put('/profile', [
        ProfileController::class,
        'update'
    ])->name('profile.update');



    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', [
        SettingsController::class,
        'index'
    ])->name('settings');

});