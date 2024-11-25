<?php

namespace App\Filament\Forms\Components;

use Closure;
use Filament\Forms\Components\TextInput;

class PasswordInput extends TextInput
{
    protected string $view = 'components.form.text-input';

    protected bool | Closure $isPassword = true;

    protected bool | Closure $shouldShowRevealButton = false;

    public function showRevealButton(bool | Closure $condition = true): self
    {
        $this->shouldShowRevealButton = $condition;

        return $this;
    }

    public function shouldShowRevealButton(): bool
    {
        return (bool) $this->evaluate($this->shouldShowRevealButton);
    }
}
