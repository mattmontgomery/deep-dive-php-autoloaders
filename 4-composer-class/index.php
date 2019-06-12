<?php

require_once("./autoload.php");

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Debug\Debug;
use Psr\Log\AbstractLogger;

echo sprintf("** %s loaded\n\n", get_class(new Command()));
echo sprintf("** %s loaded\n\n", get_class(new Debug()));

class Logger extends AbstractLogger {
    public function log($level, $message, array $context = []) {
        print_r($message);
    }
}