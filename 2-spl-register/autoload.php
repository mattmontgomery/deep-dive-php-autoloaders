<?php

spl_autoload_register(function($className) {
    $baseNamespace = "DeepDives\\";
    $basePath = sprintf("%s/src", __DIR__);
    /**
     * If this evaluates to 1 or -1, we'll skip autoloading here
     */
    if (strncmp($baseNamespace, $className, strlen($baseNamespace)) !== 0) {
        return;
    }
    $relativeClass = substr($className, strlen($baseNamespace));
    $file = sprintf("%s%s.php", $basePath, str_replace('\\', '/', $relativeClass));

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});