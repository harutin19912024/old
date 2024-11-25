<?php

namespace BankOcrKata\Number;

class Digit implements DigitInterface
{
    private  $rawDigit;
    private const DIGITS_DEFINITIONS = [
        ' _ | ||_|' => 0,
        '     |  |' => 1,
        ' _  _||_ ' => 2,
        ' _  _| _|' => 3,
        '   |_|  |' => 4,
        ' _ |_  _|' => 5,
        ' _ |_ |_|' => 6,
        ' _   |  |' => 7,
        ' _ |_||_|' => 8,
        ' _ |_| _|' => 9,
    ];

    public function __construct($rawDigit)
    {
        $this->rawDigit = $rawDigit;
        $this->parse();
    }

    private function parse(): void
    {
        $this->parsed = preg_replace('/[^_| ]/', '', $this->rawDigit);
    }

    public function getRaw(): string
    {
        return $this->rawDigit;
    }

    public function get(): ?int
    {
        return self::DIGITS_DEFINITIONS[$this->parsed] ?? null;
    }
}
