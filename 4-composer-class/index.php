<?php

require_once("./autoload.php");

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Debug\Debug;
use Psr\Log\AbstractLogger;


class Logger extends AbstractLogger {
    public function log($level, $message, array $context = []) {
        print_r(sprintf("[%s] %s", date("Y-m-d h:i:s"), $message));
    }
}

$logger = new Logger();
$logger->info(sprintf("** %s loaded\n\n", get_class(new Command())));
$logger->info(sprintf("** %s loaded\n\n", get_class(new Debug())));