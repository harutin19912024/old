<?php

namespace App\Http\Livewire\Modals;

use App\Common\FlowProgressTracker;
use App\Common\FlowProgressTypes;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Auth;
use LivewireUI\Modal\ModalComponent;

/** @property ComponentContainer $form */
class FillEmailModal extends ModalComponent implements HasForms
{
    use InteractsWithForms;

    public ?string $email = null;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function save(): void
    {
        $this->validate();

        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->update(['email' => $this->email]);
        $user->sendEmailVerificationNotification();

        app(FlowProgressTracker::class)->record(FlowProgressTypes::EMAIL_VERIFICATION_SENT_AFTER_FILLING_EMAIL);

        $this->emit('openModal', VerifyEmailAfterFillingEmailModal::getName());
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(700)
                ->unique('users', 'email')
                ->autocomplete()
                ->view('components.form.text-input'),
        ];
    }
}
