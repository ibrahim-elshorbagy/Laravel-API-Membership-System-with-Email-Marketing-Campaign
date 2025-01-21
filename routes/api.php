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

require __DIR__.'/auth.php';
