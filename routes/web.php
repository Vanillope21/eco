<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    // Role-based dashboards
    Route::get('super-admin/dashboard', \App\Livewire\SuperAdmin\Dashboard::class)->name('superadmin.dashboard');
    Route::get('admin/dashboard', \App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
    Route::get('barangay/dashboard', \App\Livewire\Barangay\Dashboard::class)->name('barangay.dashboard');
    Route::get('resident/dashboard', \App\Livewire\Resident\Dashboard::class)->name('resident.dashboard');
});

require __DIR__.'/auth.php';
