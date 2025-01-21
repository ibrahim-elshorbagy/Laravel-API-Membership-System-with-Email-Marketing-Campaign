<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\NewPasswordController;

use App\Http\Controllers\Auth\SignUpWith\GoogleContoller;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Profile\ProfileController;

//------------------------------ Login system -----------------------------------------//


Route::middleware(['guest','api'])->group(function () {

    Route::post('/register', [RegisteredUserController::class, 'store']);

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login');
    Route::post('/Admin/login', [AuthenticatedSessionController::class, 'store'])->name('admin-login');

    Route::post('/forgot-password', [PasswordResetLinkController::class, 'store']);

    Route::post('/reset-password', [NewPasswordController::class, 'store']);


    // Login with Google
    // Route::get('/login-with-google',[GoogleContoller::class, 'redirectToGoogle']);
    // Route::get('/google-callback',[GoogleContoller::class, 'handleGoogleCallback']);




});

//------------------------------ Profile -----------------------------------------//

Route::middleware(['auth:sanctum'])->group(function () {

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy']);
    Route::post('/get-user-info', [ProfileController::class, 'getUserInfo']);

    Route::prefix('profile')->group(function () {

        Route::post('/update-name',[ProfileController::class, 'updateName']);
        Route::post('/update-password',[ProfileController::class, 'updatePassword']);
        Route::post('/update-profile-image',[ProfileController::class, 'updateImage']);


        // Send a new verification link
        Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware(['throttle:6,1']);

            // Verify email (the link user clicks)
        Route::get('/verify-email/{id}/{hash}', VerifyEmailController::class)
                    ->middleware(['signed', 'throttle:6,1'])
                    ->name('verification.verify');
    });

});




//------------------------------ Admin -----------------------------------------//






?>
