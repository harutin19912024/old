<?php

namespace App\Filament\Forms\Components;

use Closure;
use Filament\Forms\Components\MultiSelect;
use Illuminate\Contracts\Support\Arrayable;

class TextInputWithPromotedChipsInput extends MultiSelect
{
    protected string $view = 'components.form.text-input-with-promoted-chips';

    protected array | Arrayable | string | Closure $promotedOptions = [];

    public function promotedOptions(array | Arrayable | string | Closure $promotedOptions): self
    {
        $this->promotedOptions = $promotedOptions;

        return $this;
    }

    public function getPromotedOptions(): array
    {
        $promotedOptions = $this->evaluate($this->promotedOptions);

        if ($promotedOptions instanceof Arrayable) {
            $promotedOptions = $promotedOptions->toArray();
        }

        return $promotedOptions;
    }
}
