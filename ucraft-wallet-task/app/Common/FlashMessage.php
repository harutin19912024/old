<?php

namespace App\Common;

use Laracasts\Flash\Message;

class FlashMessage extends Message
{
    public string $type;

    public static function make(string $type): self
    {
        return (new self())->type($type);
    }

    public function flash(): void
    {
        flash($this);
    }

    public function type(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function title(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function message(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function level(string $level): self
    {
        $this->level = $level;

        return $this;
    }

    public function error(): self
    {
        return $this->level('error');
    }

    public function warning(): self
    {
        return $this->level('warning');
    }

    public function info(): self
    {
        return $this->level('info');
    }

    public function success(): self
    {
        return $this->level('success');
    }
}
