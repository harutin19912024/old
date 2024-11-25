<?php

namespace App\Http\Livewire\Modals;

use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;
use LivewireUI\Modal\ModalComponent;

/**
 * @property ComponentContainer $form
 */
class ForgotPasswordModal extends ModalComponent implements HasForms
{
    use InteractsWithForms;
    use WithRateLimiting;

    public ?string $email = null;

    public bool $forceClose = true;

    public function mount(string $email = null): void
    {
        $this->form->fill([
            'email' => $email,
        ]);
    }

    public function submit(): void
    {
        $this->validate();

        $status = Password::sendResetLink(['email' => $this->email]);

        if ($status === Password::RESET_LINK_SENT) {
            $this->emit('openModal', ForgotPasswordEmailSentModal::getName(), ['email' => $this->email]);

            return;
        }

        throw ValidationException::withMessages(['email' => __($status)]);
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->autocomplete()
                ->view('components.form.text-input'),
        ];
    }
}
