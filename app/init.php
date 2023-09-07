<?php



spl_autoload_register(function ($className) {
    $classPath = str_replace('\\', '/', $className); // Convert namespace separators to directory separators
    $classFilePath = __DIR__ . "/src/" . $classPath . ".php";

    if (file_exists($classFilePath)) {
        require $classFilePath;
    }

    $middlewarePath = __DIR__ . "/middlewares/" . $classPath . ".php";
    if (file_exists($middlewarePath)) {
        require $middlewarePath;
    }
});


require_once 'vendor/autoload.php';
require "functions.php";
require "config.php";
