<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Concerns\HasPlaceholder;
use Filament\Forms\Components\Field;

class LabelField extends Field
{
    use HasPlaceholder;

    protected string $view = 'forms.components.label-field';
}
