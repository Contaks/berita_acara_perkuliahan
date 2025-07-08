<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\BapController;
use App\Models\Bap;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\MahasiswaMiddleware;


Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/registersss', [AuthController::class, 'register'])->name('register');
Route::post('/registersss', [AuthController::class, 'registerSave'])->name('register.save');

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/', [AuthController::class, 'loginAction']);

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard'); // Cukup ini saja


    Route::resource('jadwal', JadwalController::class);
    Route::resource('matakuliah', MataKuliahController::class);
    Route::resource('bap', BapController::class);
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
});

Route::get('/feedback/form/{bap_id}', [FeedbackController::class, 'create'])->name('feedback.create');
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');

use App\Http\Controllers\ManajemenUserController;

Route::middleware([AdminMiddleware::class])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    Route::get('/admin/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');

    // BAP
    Route::get('/admin/bap', [BapController::class, 'adminIndex'])->name('admin.bap.index');
    Route::post('/admin/bap/reject/{id}', [BapController::class, 'reject'])->name('admin.bap.reject');
    Route::post('/admin/bap/approve/{id}', [BapController::class, 'approve'])->name('admin.bap.approve');
    Route::get('/admin/bap/approved', [BapController::class, 'approvedBaps'])->name('admin.bap.approved');
    Route::get('/admin/bap/{id}', [BapController::class, 'adminShow'])->name('admin.bap.show');

    // Manajemen User
    // web.php
    Route::resource('/admin/manajemen-user', ManajemenUserController::class)->names('admin.manajemen_user');
});

Route::middleware([MahasiswaMiddleware::class])->group(function () {
    Route::get('/mahasiswa/dashboard', function () {
        return view('mahasiswa.dashboard');
    })->name('mahasiswa.dashboard');

    Route::get('/mahasiswa/bap', [BapController::class, 'mahasiswaIndex'])->name('mahasiswa.bap.index');
    Route::get('/mahasiswa/bap/{id}', [BapController::class, 'mahasiswaShow'])->name('mahasiswa.bap.show');

    Route::get('/mahasiswa/profile', [AuthController::class, 'profileMahasiswa'])->name('mahasiswa.profile');
    Route::post('/mahasiswa/profile/update', [AuthController::class, 'profileUpdate'])->name('mahasiswa.profile.update');

    // Route untuk feedback mahasiswa
    Route::get('/mahasiswa/bap/{id}/feedback', [FeedbackController::class, 'createMahasiswa'])->name('mahasiswa.feedback.create');
    Route::post('/mahasiswa/bap/feedback/store', [FeedbackController::class, 'storeMahasiswa'])->name('mahasiswa.feedback.store');
});
