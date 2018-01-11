<?php
session_start();
//if (!isset($_SESSION["logged"]))
//    header("location: ./register.php");
require '../Core/Router.php';

$router = new Router;
$router->add('hey/ho', ['controller' => 'Home', 'action' => 'index']);
$router->add('yo/yoyo', ['controller' => 'Home_yo', 'action' => 'index_yo']);
//echo '<pre>';
//var_dump($router->getRoutes());
//echo '</pre>';
$url = $_SERVER['QUERY_STRING'];
if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';

}
else {
    echo "No route found for given URL '$url'";
}












