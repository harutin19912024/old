<?php

namespace App\Http\Livewire\MyAccount;

use App\Filament\Forms\Components\PasswordInput;
use App\Traits\Flashes;
use Filament\Forms\ComponentContainer;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;

/** @property ComponentContainer $form */
class ChangePasswordBlock extends Component implements HasForms
{
    use InteractsWithForms;
    use Flashes;

    public array $data = [];

    public function render(): View
    {
        return view('livewire.my-account.change-password-block');
    }

    public function save(): void
    {
        $this->validate();

        user()->forceFill([
            'password' => Hash::make($this->form->getState()['new_password']),
            'remember_token' => Str::random(60),
        ])->save();

        $this->form->fill();

        $this->flash('Password changed successfully.')->success()->flash();
    }

    protected function getFormStatePath(): string
    {
        return 'data';
    }

    protected function getFormSchema(): array
    {
        return [
            PasswordInput::make('old_password')
                ->label('Current password')
                ->required()
                ->rule('current_password')
                ->autocomplete('current-password'),
            PasswordInput::make('new_password')
                ->label('New password *')
                ->required()
                ->minLength(12)
                ->autocomplete('new-password')
                ->showRevealButton(),
        ];
    }
}
