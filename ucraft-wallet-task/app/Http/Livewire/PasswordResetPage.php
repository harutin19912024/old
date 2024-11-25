<?php

namespace App\Http\Livewire;

use App\Common\AuthManager;
use App\Filament\Forms\Components\PasswordInput;
use App\Models\User;
use App\Traits\Flashes;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Auth\Passwords\PasswordBroker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Livewire\Component;

/**
 * @property ComponentContainer $form
 */
class PasswordResetPage extends Component implements HasForms
{
    use InteractsWithForms;
    use Flashes;

    public ?string $email = null;

    public ?string $token = null;

    public ?string $password = null;

    public ?string $password_confirmation = null;

    public function mount(PasswordBroker $passwordBroker): void
    {
        $this->form->fill([
            'email' => request()->email,
            'token' => request('token'),
        ]);

        $user = User::where('email', $this->email)->firstOrFail();
        $tokenValid = $passwordBroker->tokenExists($user, $this->token);

        if (!$tokenValid) {
            $this->flash('Slaptažodžio atkūrimo nuorodos galiojimas baigėsi, bandykite dar kartą.')
                ->type('url_expired')
                ->level('error')
                ->flash();

            // return redirect('/?open-modal=' . LoginModal::getName());
        }

        // return null;
    }

    public function submit(): void
    {
        $this->validate();

        $status = Password::reset([
            'email' => $this->email,
            'password' => $this->password,
            'password_confirmation' => $this->password_confirmation,
            'token' => $this->token,
        ], function ($user) {
            $user->forceFill([
                'password' => Hash::make($this->password),
                'remember_token' => Str::random(60),
            ])->save();

            event(new PasswordReset($user));

            app(AuthManager::class)->login($user);
        });

        if ($status === Password::PASSWORD_RESET) {
            // TODO: add notification.

            $this->redirect('/');
        }

        $this->flash('Įvyko klaida, bandykite dar kartą.')->error()->flash();
    }

    protected function getFormSchema(): array
    {
        return [
            PasswordInput::make('password')
                ->label('Password')
                ->rule('confirmed')
                ->required()
                ->minLength(12)
                ->showRevealButton(),
            PasswordInput::make('password_confirmation')
                ->label('Repeat the password')
                ->required()
                ->showRevealButton(),
        ];
    }
}
