<?php

$myAutoloader = function($className) {
    require("{$className}.class.php");
};

spl_autoload_register($myAutoloader);

new Test();