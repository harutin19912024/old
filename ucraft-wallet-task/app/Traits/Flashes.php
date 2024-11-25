<?php

namespace App\Traits;

use App\Common\FlashMessage;

trait Flashes
{
    public function flash(string $message): FlashMessage
    {
        return FlashMessage::make($this->getFlashName())->message($message);
    }

    private function getFlashName(): string
    {
        if (method_exists($this, 'getName')) {
            return self::getName();
        }

        return '';
    }
}
