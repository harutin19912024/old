<?php

namespace App\View\Components;

use App\Models\User;
use App\Settings\AttentionBarSettings;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Header extends Component
{
    public function __construct(
        public ?string $isAuthenticated = null,
        public ?string $hasMembership = null,
        public ?string $attentionBarEnabled = null,
        public ?User $user = null,
    ) {
        $this->isAuthenticated ??= Auth::check();
        $this->hasMembership ??= false;
        $this->attentionBarEnabled ??= true;
        $this->user = empty($this->user->getAttributes()) ? Auth::user() : $this->user;
    }

    public function render(): View
    {
        return view('components.header', [
            'isAuthenticated' => $this->isAuthenticated,
            'hasMembership' => $this->hasMembership,
            'attentionBarEnabled' => $this->attentionBarEnabled,
            'user' => $this->user,
        ]);
    }
}
