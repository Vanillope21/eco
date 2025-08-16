<?php

use App\Http\Controllers\ScheduleCollectionController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\SuperAdmin\UserManagement;
use App\Livewire\Barangay\ScheduleManagement;
use App\Livewire\Barangay\Dashboard;
use App\Livewire\Barangay\HouseholdRequests;
use Illuminate\Support\Facades\Route;
use App\Models\Schedule;
use App\Models\Barangay;
use App\Livewire\Resident\Schedules;
use App\Livewire\Admin\TruckScheduleManager;
use App\Livewire\Admin\CollectionManager;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    //guest routes
Route::get('/schedules', function () {
    $query = Schedule::with(['barangay', 'wasteType', 'dayOfWeek', 'status', 'truck']);
    if (request('barangay')) {
        $query->where('barangay_id', request('barangay'));
    }
    if (request('search')) {
        $query->where('title', 'like', '%' . request('search') . '%');
    }
    $schedules = $query->paginate(10);
    $barangays = Barangay::where('status', 'active')->orderBy('name')->get();
    return view('guest.schedules', compact('schedules', 'barangays'));
});

Route::get('/barangays', function () {
    $query = Barangay::query();
    if (request('search')) {
        $search = request('search');
        $query->where(function($q) use ($search) {
            $q->where('name', 'like', "%$search%")
              ->orWhere('captain_name', 'like', "%$search%")
              ->orWhere('address', 'like', "%$search%");
        });
    }
    if (request('status')) {
        $query->where('status', request('status'));
    }
    $barangays = $query->orderBy('name')->paginate(9);
    return view('guest.barangays', compact('barangays'));
});

Route::get('/guidelines', function () {
    return view('guest.guidelines');
});

Route::match(['get', 'post'], '/contact', function () {
    $barangays = Barangay::where('status', 'active')->orderBy('name')->get();
    // Handle form submission here if POST, otherwise just show the form
    return view('guest.contact', compact('barangays'));
});

Route::get('/faq', function () {
    return view('guest.faq');
});

Route::get('/about', function () {
    return view('guest.about');
});

Route::get('/privacy', function () {
    return view('guest.privacy');
});

Route::get('/terms', function () {
    return view('guest.terms');
});

// Household Request Routes
Route::match(['get', 'post'], '/household-request', [App\Http\Controllers\HouseholdRequestController::class, 'show'])
    ->name('household.request');

Route::post('/household-request', [App\Http\Controllers\HouseholdRequestController::class, 'store'])
    ->name('household.request.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Role-based dashboards
    Route::get('super-admin/dashboard', App\Livewire\SuperAdmin\Dashboard::class)
        ->middleware('auth')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':super-admin')
        ->name('superadmin.dashboard');

    Route::get('admin/dashboard', App\Livewire\Admin\Dashboard::class)
        ->middleware('auth')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':admin')
        ->name('admin.dashboard');

    Route::get('barangay/dashboard', App\Livewire\Barangay\Dashboard::class)
        ->middleware('auth')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':barangay-official')
        ->name('barangay.dashboard');

    // Replace resident homepage route with Livewire component
    Route::get('resident/home', App\Livewire\Resident\Homepage::class)
        ->middleware('auth')
        ->middleware(\App\Http\Middleware\RoleMiddleware::class.':resident')
        ->name('resident.home');

    Route::get('/resident/schedules', Schedules::class)->name('resident.schedules');
});


//superadmin routes usermanangement
// Route::middleware(['auth', 'can:manage-users'])->group(function () {
//     Route::get('/superadmin/users', UserManagement::class)->name('superadmin.users');
// });
// test route for superadmin
Route::middleware(['auth'])->group(function () {
    Route::get('/superadmin/users', UserManagement::class)->name('superadmin.users');
    Route::get('/superadmin/employees', App\Livewire\SuperAdmin\EmployeeManagement::class)->name('superadmin.employees');
    Route::get('/superadmin/roles', App\Livewire\SuperAdmin\RoleManagement::class)->name('superadmin.roles');
    Route::get('/superadmin/audit-trail', App\Livewire\SuperAdmin\AuditTrail::class)->name('superadmin.audit-trail');
});

// routes for admins
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/schedule-management', function () {
        return view('admin.schedule-management');
    })->name('admin.schedule-management');  
});
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/barangay-management', \App\Livewire\Admin\BarangayManagement::class)
        ->name('admin.barangay.management');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/truck-management', App\Livewire\Admin\TruckManagement::class)
        ->name('admin.truck.management');
});
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/truck-route-assignment', \App\Livewire\Admin\TruckRouteAssignment::class)
        ->name('admin.truck.route.assignment');
    Route::get('/admin/truck-schedule-manager', TruckScheduleManager::class)
        ->name('admin.truck.schedule.manager');
    Route::get('/admin/collection-management', CollectionManager::class)
        ->name('admin.collection-management');
    Route::get('/admin/truck-maintenance', \App\Livewire\Admin\TruckMaintenanceManager::class)
        ->name('admin.truck-maintenance');
});


//routes for Barangay Officials
Route::middleware(['auth'])->group(function () {
    Route::get('/barangay/dashboard', Dashboard::class)->name('barangay.dashboard');
    Route::get('/barangay/schedules', ScheduleManagement::class)->name('barangay.schedules');
    Route::get('/barangay/requests', HouseholdRequests::class)->name('barangay.requests');
});
// Route::middleware(['auth', 'role:barangay_official'])->group(function () {
//     Route::get('/barangay/scheduled-collections', [Barangay])
// })

//route for schedule collections
Route::get('/schedule-collections', [ScheduleCollectionController::class, 'index'])
    ->middleware('auth');

require __DIR__.'/auth.php';
