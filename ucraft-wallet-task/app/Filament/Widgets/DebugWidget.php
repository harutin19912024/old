<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use Illuminate\Mail\Message;
use Mail;

class DebugWidget extends Widget
{
    protected static string $view = 'filament.widgets.debug-widget';

    protected int | string | array $columnSpan = 2;

    public string $email = '';

    public function send(): void
    {
        Mail::raw('Hello World', function (Message $message) {
            $message->to($this->email)->subject('Hello World')->from('test@test.com');
        });
    }
}
