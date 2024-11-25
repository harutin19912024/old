<?php

namespace BankOcrKata\Number;

interface NumberInterface
{
    public function getRaw(): string;

    public function get(): string;
}
