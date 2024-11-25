<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

class FirstWalletAddedModal extends ModalComponent
{

    public function resend(): void
    {
        $this->flash('You have successfully added your first wallet')->level('success')->flash();
    }
}
