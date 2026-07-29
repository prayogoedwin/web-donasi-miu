<?php

use App\Http\Controllers\RoleController;
use App\Http\Controllers\Settings;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\InformasiController;
use App\Http\Controllers\KategoriProgramController;
use App\Http\Controllers\DonasiController;
use App\Http\Controllers\TripayController;

Route::get('/', [FrontEndController::class, 'index'])->name('home');

//alfay merubah sesuatu aku ubah lagi

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
    Route::put('settings/appearance', [Settings\AppearanceController::class, 'update'])->name('settings.appearance.update');

    // Roles Management - dengan permission check
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:view-roles');
    Route::get('roles/export', [RoleController::class, 'export'])->name('roles.export')->middleware('permission:download-roles');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:create-roles');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:create-roles');
    Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show')->middleware('permission:show-roles');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:edit-roles');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:edit-roles');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete-roles');
    
    // Permissions Management - dengan permission check
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index')->middleware('permission:view-permissions');
    Route::get('permissions/export', [PermissionController::class, 'export'])->name('permissions.export')->middleware('permission:download-permissions');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('permission:create-permissions');
    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:create-permissions');
    Route::get('permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show')->middleware('permission:show-permissions');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:edit-permissions');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:edit-permissions');
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:delete-permissions');
    
    // Users Management - dengan permission check
    Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware('permission:view-users');
    Route::get('users/export', [UserController::class, 'export'])->name('users.export')->middleware('permission:download-users');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:create-users');
    Route::post('users', [UserController::class, 'store'])->name('users.store')->middleware('permission:create-users');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission:show-users');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:edit-users');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:edit-users');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete-users');

    // Program Management - dengan permission check
    Route::get('programs', [ProgramController::class, 'index'])->name('programs.index')->middleware('permission:view-programs');
    Route::get('programs/table', [ProgramController::class, 'indexTable'])->name('programs.indexTable')->middleware('permission:view-programs');
    Route::get('programs/export', [ProgramController::class, 'export'])->name('programs.export')->middleware('permission:download-programs');
    Route::get('programs/create', [ProgramController::class, 'create'])->name('programs.create')->middleware('permission:create-programs');
    Route::post('programs', [ProgramController::class, 'store'])->name('programs.store')->middleware('permission:create-programs');
    Route::get('programs/{program}', [ProgramController::class, 'show'])->name('programs.show')->middleware('permission:show-programs');
    Route::get('programs/{program}/edit', [ProgramController::class, 'edit'])->name('programs.edit')->middleware('permission:edit-programs');
    Route::put('programs/{program}', [ProgramController::class, 'update'])->name('programs.update')->middleware('permission:edit-programs');
    Route::delete('programs/{program}', [ProgramController::class, 'destroy'])->name('programs.destroy')->middleware('permission:delete-programs');

    // Kategori Program Management - dengan permission check
    Route::get('kategori-programs', [KategoriProgramController::class, 'index'])->name('kategori-programs.index')->middleware('permission:view-kategori-programs');
    Route::get('kategori-programs/table', [KategoriProgramController::class, 'indexTable'])->name('kategori-programs.indexTable')->middleware('permission:view-kategori-programs');
    Route::get('kategori-programs/export', [KategoriProgramController::class, 'export'])->name('kategori-programs.export')->middleware('permission:download-kategori-programs');
    Route::get('kategori-programs/create', [KategoriProgramController::class, 'create'])->name('kategori-programs.create')->middleware('permission:create-kategori-programs');
    Route::post('kategori-programs', [KategoriProgramController::class, 'store'])->name('kategori-programs.store')->middleware('permission:create-kategori-programs');
    Route::get('kategori-programs/{kategoriProgram}', [KategoriProgramController::class, 'show'])->name('kategori-programs.show')->middleware('permission:show-kategori-programs');
    Route::get('kategori-programs/{kategoriProgram}/edit', [KategoriProgramController::class, 'edit'])->name('kategori-programs.edit')->middleware('permission:edit-kategori-programs');
    Route::put('kategori-programs/{kategoriProgram}', [KategoriProgramController::class, 'update'])->name('kategori-programs.update')->middleware('permission:edit-kategori-programs');
    Route::delete('kategori-programs/{kategoriProgram}', [KategoriProgramController::class, 'destroy'])->name('kategori-programs.destroy')->middleware('permission:delete-kategori-programs');

    // Informasi Management - dengan permission check
    Route::get('informasis', [InformasiController::class, 'index'])->name('informasis.index')->middleware('permission:view-informasis');
    Route::get('informasis/table', [InformasiController::class, 'indexTable'])->name('informasis.indexTable')->middleware('permission:view-informasis');
    Route::get('informasis/export', [InformasiController::class, 'export'])->name('informasis.export')->middleware('permission:download-informasis');
    Route::get('informasis/create', [InformasiController::class, 'create'])->name('informasis.create')->middleware('permission:create-informasis');
    Route::post('informasis', [InformasiController::class, 'store'])->name('informasis.store')->middleware('permission:create-informasis');
    Route::get('informasis/{informasi}', [InformasiController::class, 'show'])->name('informasis.show')->middleware('permission:show-informasis');
    Route::get('informasis/{informasi}/edit', [InformasiController::class, 'edit'])->name('informasis.edit')->middleware('permission:edit-informasis');
    Route::put('informasis/{informasi}', [InformasiController::class, 'update'])->name('informasis.update')->middleware('permission:edit-informasis');
    Route::delete('informasis/{informasi}', [InformasiController::class, 'destroy'])->name('informasis.destroy')->middleware('permission:delete-informasis');

    Route::get('donasis', [DonasiController::class, 'index'])->name('donasis.index')->middleware('permission:view-donasis');
    Route::get('donasis/table', [DonasiController::class, 'indexTable'])->name('donasis.indexTable')->middleware('permission:view-donasis');
    Route::get('donasis/export', [DonasiController::class, 'export'])->name('donasis.export')->middleware('permission:download-donasis');

    Route::get('tripay', [TripayController::class, 'index'])->name('tripay.index')->middleware('permission:view-tripay');
    Route::put('tripay', [TripayController::class, 'update'])->name('tripay.update')->middleware('permission:edit-tripay');
});

require __DIR__.'/auth.php';
