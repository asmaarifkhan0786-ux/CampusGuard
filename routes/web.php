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
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ResourcesEquipmentController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/student-login', [AuthController::class, 'studentLogin'])
    ->name('student.login');

Route::get('/admin-login', [AuthController::class, 'adminLogin'])
    ->name('admin.login');

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.submit');

Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])
    ->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])
    ->name('password.email');


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Emergency Reports
    Route::resource('emergency-reports', EmergencyReportController::class);

    // Crisis Categories
    Route::resource('crisis-categories', CrisisCategoryController::class);

    // Response Teams
    Route::resource('response-teams', ResponseTeamController::class);

    // Incident Assignments
    Route::resource('incident-assignments', IncidentAssignmentController::class);

    // Emergency Alerts
    Route::resource('emergency-alerts', EmergencyAlertController::class);


    /*
    |--------------------------------------------------------------------------
    | Campus Locations
    |--------------------------------------------------------------------------
    */

    Route::view('/campus-locations', 'modules.campus-locations')
        ->name('campus.locations');


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

    Route::view('/users-roles', 'modules.users-roles')
        ->name('users.roles');


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
            compact('total', 'resolved', 'active')
        );

    })->name('reports.analytics');


    /*
    |--------------------------------------------------------------------------
    | Audit Logs
    |--------------------------------------------------------------------------
    */

    Route::view('/audit-logs', 'modules.audit-logs')
        ->name('audit.logs');


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

                    $sub->where('title', 'like', "%{$q}%")
                        ->orWhere('description', 'like', "%{$q}%")
                        ->orWhere('location', 'like', "%{$q}%");

                });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view(
            'modules.search-filter',
            compact('reports', 'q')
        );

    })->name('search.filter');


    /*
    |--------------------------------------------------------------------------
    | Map Navigation
    |--------------------------------------------------------------------------
    */

    Route::view('/map-navigation', 'map-navigation')
        ->name('map.navigation');


    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');


    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */

    Route::get('/settings', [SettingsController::class, 'index'])
        ->name('settings');

});