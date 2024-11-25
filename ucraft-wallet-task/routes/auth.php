<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Livewire\PasswordResetPage;
use App\Http\Livewire\RegisterPage;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(callback: function () {
    Route::get('register', RegisterPage::class)->name('register');
    Route::view('login', 'auth.login')->name('login');
    Route::get('reset-password/{token}', PasswordResetPage::class)->name('password.reset');
    Route::get('oauth/redirect/{driver}', [SocialiteController::class, 'redirect'])->name('oauth.redirect');
    Route::get('oauth/callback/{driver}', [SocialiteController::class, 'callback'])->name('oauth.callback');
});


Route::middleware(['auth'])->group(function () {
    Route::get('verify-email', [EmailVerificationPromptController::class, '__invoke'])->name('verification.notice');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])->name('password.confirm');
    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});

Route::get('verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware([
    'signed',
    'throttle:6,1',
])->name('verification.verify');
