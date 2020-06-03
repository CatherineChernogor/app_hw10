<?php

include 'app/functions.php';

mb_internal_encoding('UTF-8');

spl_autoload_extensions('.php');

spl_autoload_register(function ($class) {
    include __DIR__ . '/'. str_replace('\\', '/', $class) . '.php';
});

session_start();

ini_set('display_errors', 1); 
ini_set('display_startup_errors', 1); 
error_reporting(E_ALL);