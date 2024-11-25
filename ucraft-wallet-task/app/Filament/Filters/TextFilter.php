<?php

namespace App\Filament\Filters;

use Filament\Forms;
use Filament\Tables\Filters\Filter;
use Illuminate\Contracts\Database\Query\Builder;

class TextFilter
{
    public static function make(string $name, string $label = null): Filter
    {
        return Filter::make($name)->form([
            Forms\Components\TextInput::make($name)->label($label),
        ])->query(function (Builder $query, array $data) use ($name) {
            return $query->when(
                $data[$name],
                fn(Builder $query, string $value) => $query->where($name, 'like', "%{$value}%"),
            );
        });
    }
}
