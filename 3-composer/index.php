<?php

require_once("./autoload.php");

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Debug\Debug;

echo sprintf("** %s loaded\n\n", get_class(new Command()));
echo sprintf("** %s loaded\n\n", get_class(new Debug()));