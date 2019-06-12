<?php

function autoloadLogger(string $message, string $className) {
    echo sprintf("[%s] %s\n", $className, $message);
}

spl_autoload_register(function($className) {
    $baseNamespace = "Symfony\\Component\\Console\\";
    $basePath = sprintf("%s/vendor/symfony/console", __DIR__);

    autoloadLogger(sprintf("Checking against %s", $baseNamespace), $className);
    /**
     * If this evaluates to 1 or -1, we'll skip autoloading here
     */
    if (strncmp($baseNamespace, $className, strlen($baseNamespace)) !== 0) {
        autoloadLogger(sprintf("Did not pass %s", $baseNamespace), $className);
        return;
    }
    $relativeClass = substr($className, strlen($baseNamespace));
    $file = sprintf("%s/%s.php", $basePath, str_replace('\\', '/', $relativeClass));
    autoloadLogger(sprintf("Looking for %s", $file), $className);

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});


spl_autoload_register(function($className) {
    $baseNamespace = "Symfony\\Component\\Debug\\";
    $basePath = sprintf("%s/vendor/symfony/debug", __DIR__);
    /**
     * If this evaluates to 1 or -1, we'll skip autoloading here
     */
    if (strncmp($baseNamespace, $className, strlen($baseNamespace)) !== 0) {
        autoloadLogger(sprintf("Did not pass %s", $baseNamespace), $className);
        return;
    }
    $relativeClass = substr($className, strlen($baseNamespace));
    $file = sprintf("%s/%s.php", $basePath, str_replace('\\', '/', $relativeClass));
    autoloadLogger(sprintf("Looking for %s", $file), $className);

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});