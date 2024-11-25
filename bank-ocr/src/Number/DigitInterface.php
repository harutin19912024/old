<?php

namespace BankOcrKata\Number;

interface DigitInterface
{
    public function getRaw(): string;

    public function get(): ?int;
}
