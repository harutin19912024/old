<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class NoticeField extends Field
{
    protected string $view = 'forms.components.notice-field';

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
