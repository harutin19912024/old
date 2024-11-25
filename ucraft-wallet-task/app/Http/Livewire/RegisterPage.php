<?php

namespace App\Http\Livewire;

use App\Common\Cookies;
use App\Filament\Forms\Components\PasswordInput;
use App\Http\Livewire\Modals\VerifyEmailAfterStandardRegistrationModal;
use App\Models\User;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Str;

/**
 * @property ComponentContainer $form
 */
class RegisterPage extends Component implements HasForms
{
    use InteractsWithForms;

    public ?string $first_name = null;

    public ?string $last_name = null;

    public ?string $email = null;

    public ?string $phone = null;

    public ?string $password = null;

    public function mount(): void
    {
        $this->form->fill();
    }

    public function register(): void
    {
        $this->validate();

        $user = User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'email_verified' => false,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        $this->emit('openModal', VerifyEmailAfterStandardRegistrationModal::getName());
    }

    protected function getFormSchema(): array
    {
        return [
            TextInput::make('first_name')
                ->label('First Name')
                ->required()
                ->minLength(3)
                ->maxLength(255)
                ->view('components.form.text-input'),
            TextInput::make('last_name')
                ->label('Last Name')
                ->required()
                ->minLength(3)
                ->maxLength(255)
                ->view('components.form.text-input'),
            TextInput::make('email')
                ->label('Email')
                ->email()
                ->required()
                ->maxLength(700)
                ->unique('users', 'email')
                ->autocomplete()
                ->view('components.form.text-input'),
            TextInput::make('phone')
                ->label('Phone')
                ->maxLength(255)
                ->autocomplete('phone')
                ->view('components.form.text-input'),
            PasswordInput::make('password')
                ->label('Password')
                ->required()
                ->minLength(12)
                ->autocomplete('current-password')
                ->showRevealButton()
        ];
    }
}
