<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class TextViewField extends Field
{
    protected string $view = 'forms.components.text-view-field';

    public ?string $text = null;

    public function text(?string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }
}
