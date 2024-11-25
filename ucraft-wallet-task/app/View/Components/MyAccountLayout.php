<?php

namespace App\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MyAccountLayout extends Component
{
    public function __construct(
        public string $title,
        public ?string $iconName = null,
        public ?bool $hideTitle = false
    ) {}

    public function render(): View
    {
        return view('layouts.my-account');
    }
}
