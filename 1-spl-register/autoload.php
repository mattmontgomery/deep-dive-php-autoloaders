<?php

spl_autoload_register(function($class) {
    $className = str_replace("\\", "/", $class);
    $filePath = __DIR__ . "/{$className}.php";
    if (file_exists($filePath)) {
        require_once($filePath);
        return true;
    }
    return;

});