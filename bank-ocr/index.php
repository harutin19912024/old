<?php
namespace BankOcrKata;

$file =  __DIR__.'/vendor/autoload.php';

if (!file_exists($file)) {
    throw new \RuntimeException('Unable to locate autoload.php file.');
}

require_once $file;

unset($file);

use Symfony\Component\Console\Application;
use BankOcrKata\Command\ParseCommand;

$app = new Application('Bank OCR', '1.0');
$app->add(new ParseCommand());

$app->run();

__halt_compiler();
