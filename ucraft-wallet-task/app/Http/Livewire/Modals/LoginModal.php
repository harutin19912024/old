<?php

namespace App\Http\Livewire\Modals;

use App\Filament\Forms\Components\PasswordInput;
use App\Providers\RouteServiceProvider;
use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use DanHarrin\LivewireRateLimiting\WithRateLimiting;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Redirector;
use LivewireUI\Modal\ModalComponent;

/** @property ComponentContainer $form */
class LoginModal extends ModalComponent implements HasForms
{
    use InteractsWithForms;
    use WithRateLimiting;

    public ?string $email = null;

    public ?string $password = null;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function authenticate(): RedirectResponse|Redirector|null
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->addError('email', __('auth.throttle', [
                'seconds' => $exception->secondsUntilAvailable,
                'minutes' => ceil($exception->secondsUntilAvailable / 60),
            ]));

            return null;
        }

        if (!Auth::attempt($this->only(['email', 'password']), true)) {
            $this->addError('email', __('auth.failed'));

            return null;
        }

        if (!Auth::user()->hasVerifiedEmail()) {
            $this->addError('email', __('auth.blocked'));
            Auth::logout();

            return null;
        }

        session()->regenerate();

        return redirect()->to(app(UrlGenerator::class)->previous(RouteServiceProvider::PROFILE));
    }

    public static function closeModalOnClickAway(): bool
    {
        return true;
    }

    public static function closeModalOnEscape(): bool
    {
        return true;
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('email')
                ->label('Email *')
                ->email()
                ->required()
                ->autocomplete()
                ->view('components.form.text-input'),
            PasswordInput::make('password')
                ->label('Password *')
                ->required()
                ->autocomplete('current-password')
                ->showRevealButton(),
        ];
    }
}
