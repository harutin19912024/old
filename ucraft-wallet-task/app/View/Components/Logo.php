<?php

namespace App\View\Components;

use App\Settings\GeneralSettings;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Logo extends Component
{
    public function __construct(private GeneralSettings $generalSettings) {}

    public function render(): View
    {
        return view('components.logo', [
            'src' => $this->generalSettings->getLogoUrl(),
        ]);
    }
}
