<?php
session_start();

spl_autoload_register(function ($class) {
    $root = dirname(__DIR__); //get the parent directory
    $file = $root . '/' . str_replace('\\', '/', $class) . '.php';
    if (is_readable($file)) {
        require $root. '/' .str_replace('\\', '/', $class) . '.php';
    }
});

//PDO::ERRMODE_EXCEPTION

error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


$router = new Core\Router;


$router->add('', ['controller' => 'Home', 'action' => 'index']);
//$router->add('log-in', ['controller' => 'Authorization', 'action' => 'logIn']);
//$router->add('log-out', ['controller' => 'Authorization', 'action' => 'logOut']);
$router->add('{controller}/{action}');
$router->add('{controller}/{id:\d+}/{action}');

$router->dispatch($_SERVER['QUERY_STRING']);












