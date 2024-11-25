<?php

namespace BankOcrKata\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use BankOcrKata\Number\Number;

class ParseCommand extends Command
{
    private const FILE_ARGUMENT_NAME = 'file';

    protected static $defaultName = 'parse';

    protected function configure(): void
    {
        $this->addArgument(
            self::FILE_ARGUMENT_NAME,
            InputArgument::REQUIRED,
            'Path to file with statement'
        );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filePath = realpath($input->getArgument(self::FILE_ARGUMENT_NAME));

        if (false === $filePath) {
            return Command::FAILURE;
        }

        $file = new \SplFileObject($filePath);
        $rawNumber = '';
        $lineNumber = 0;

        while (!$file->eof()) {
            $rawNumber .= $file->fgets();

            if (4 !== ++$lineNumber) {
                continue;
            }

            $number = new Number($rawNumber);
            $output->writeln($number->get());
            $lineNumber = 0;
            $rawNumber = '';
        }

        return Command::SUCCESS;
    }
}
