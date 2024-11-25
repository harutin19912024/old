<?php

namespace App\Http\Livewire\Modals;

use App\Traits\Flashes;
use Filament\Forms\ComponentContainer;
use Illuminate\Support\Facades\Password;
use LivewireUI\Modal\ModalComponent;

/**
 * @property ComponentContainer $form
 */
class ForgotPasswordEmailSentModal extends ModalComponent
{
    use Flashes;

    public bool $forceClose = true;

    public ?string $email = null;

    public function resend(): void
    {
        if ($this->email) {
            // config()->set('auth.passwords.users.throttle', 0);

            $status = Password::sendResetLink(['email' => $this->email]);

            if ($status === Password::RESET_LINK_SENT) {
                $this->flash('Nuoroda išsiųsta dar kartą.')->level('success')->flash();

                return;
            }

            $this->flash(__($status))->level('error')->flash();
        }
    }
}
