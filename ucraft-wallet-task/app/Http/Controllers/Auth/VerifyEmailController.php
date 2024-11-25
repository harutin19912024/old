<?php

namespace App\Http\Controllers\Auth;

use App\Common\FlashMessage;
use App\Http\Controllers\Controller;
use App\Http\Livewire\MyAccount\ChangeEmailBlock;
use App\Http\Requests\EmailVerificationRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        $user = $request->findUser();

        return $this->handleEmailColumn($user);
    }

    private function handleEmailColumn(User $user): RedirectResponse
    {
        Auth::login($user);

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::PROFILE . '?verified=1');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended(RouteServiceProvider::PROFILE . '?verified=1');
    }

}
