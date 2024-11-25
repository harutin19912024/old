<?php

namespace App\Http\Livewire\Modals;

use App\Traits\CanLogOut;
use App\Traits\Flashes;
use Auth;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use LivewireUI\Modal\ModalComponent;

class VerifyEmailAfterStandardRegistrationModal extends ModalComponent
{
    use WithRateLimiting;
    use Flashes;
    use CanLogOut;

    public function resend(): void
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->addError('email', __('auth.throttle', [
                'seconds' => $exception->secondsUntilAvailable,
                'minutes' => ceil($exception->secondsUntilAvailable / 60),
            ]));

            return;
        }

        Auth::user()->sendEmailVerificationNotification();
        $this->flash('The link has been sent again')->level('success')->flash();
    }
}
