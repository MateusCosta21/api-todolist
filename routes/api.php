<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['guest'])->group(function () {
    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::post('/reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');
});



Route::middleware(['auth'])->group(function () {
    Route::prefix('/tasks')->group(function () {
        Route::get('/', [TaskController::class, 'list'])
        ->name('task.index');
        Route::post('/create', [TaskController::class, 'store'])
            ->name('task.store');
        Route::put('/{id}/update', [TaskController::class, 'update'])
            ->name('task.update');
        Route::patch('/{id}/status', [TaskController::class, 'updateStatus'])
            ->name('task.status');
        Route::delete('/{id}', [TaskController::class, 'destroy'])
            ->name('task.destroy');
        Route::get('/{id}', [TaskController::class, 'show'])
            ->name('task.show');


    });
});
