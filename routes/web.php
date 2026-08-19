<?php
use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;

Route::post('/admin/logout', function () {
    Filament::auth()->logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/admin/login');
})->name('admin.logout');
