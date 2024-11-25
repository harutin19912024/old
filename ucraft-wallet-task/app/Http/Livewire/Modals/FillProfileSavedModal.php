<?php

namespace App\Http\Livewire\Modals;

use LivewireUI\Modal\ModalComponent;

class FillProfileSavedModal extends ModalComponent
{
    public function close(): void
    {
        $this->forceClose()->closeModal();
    }
}
