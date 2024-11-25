<?php

namespace App\Http\Livewire;

use App\Common\Events;
use Livewire\Component;

class HeaderUserNameWidget extends Component
{
    protected $listeners = [
        Events::USER_NAME_UPDATED => '$refresh',
    ];
}
