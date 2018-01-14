<?php
session_start();
//if (!isset($_SESSION["logged"]))
//    header("location: ./register.php");
require '../App/Controllers/Posts.php';
require '../Core/Router.php';


$router = new Router;
//$router->add('hey/ho', ['controller' => 'Home', 'action' => 'index']);
//$router->add('yo/yoyo', ['controller' => 'Home_yo', 'action' => 'index_yo']);
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('posts', ['controller' => 'Posts', 'action' => 'index']);
$router->add('my/own/url/test/442', ['controller' => 'MyOwnController', 'action' => 'action']);
$router->add('{controller}/{action}');
//$router->add('admin/{action}/{controller}');
$router->add('{controller}/{id:\d+}/{action}');


/*
echo '<pre>';
//echo 'hey';
//var_dump($router->getRoutes());
echo htmlspecialchars(print_r($router->getRoutes(), true));
//echo 'hey2';
var_dump($_SERVER['QUERY_STRING']);
echo '</pre>';
$url = $_SERVER['QUERY_STRING'];
if ($router->match($url)) {
    echo '<pre>';
    var_dump($router->getParams());
    echo '</pre>';

}
else {
    echo "No route found for given URL '$url'";
}
*/
$router->dispatch($_SERVER['QUERY_STRING']);











