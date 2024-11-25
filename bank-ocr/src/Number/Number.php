<?php

namespace BankOcrKata\Number;

class Number implements NumberInterface
{
    private const EXPECTED_LINE_LENGTH = 27;

    private $parsed;
    private $rawNumber;

    public function __construct($rawNumber)
    {
        $this->rawNumber = $rawNumber;
        $this->parse();
    }

    public function getRaw(): string
    {
        return $this->rawNumber;
    }

    public function get(): string
    {
        return $this->parsed;
    }

    private function parse(): void
    {
        $this->parseDigits($this->parseLines());
    }

    private function parseDigits(array $lines): void
    {
        $this->parsed = '';

        foreach ($lines[0] as $index => $block) {
            $rawDigit = implode(
                "\n",
                [$block ?? '', $lines[1][$index] ?? '', $lines[2][$index] ?? '']
            );
            $digit = new Digit($rawDigit);
            $this->parsed .= $digit->get();
        }
    }

    private function parseLines(): array
    {
        $parsedLines = array_slice(explode("\n", $this->rawNumber), 0, 3);

        foreach ($parsedLines as &$line) {
            $line = str_split(str_pad($line, self::EXPECTED_LINE_LENGTH, ' '), 3);
        }

        return $parsedLines;
    }
}
