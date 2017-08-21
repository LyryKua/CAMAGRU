<?php
/**
 * Front controller
 */

require 'Core/Router.class.php';

$router = new Core\Router();
$url = $_SERVER['QUERY_STRING'];

// Adding routes to the routing table
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('sign-up', ['controller' => 'AuthorizationModel', 'action' => 'signUp']);
$router->add('log-in', ['controller' => 'AuthorizationModel', 'action' => 'logIn']);
$router->add('log-out', ['controller' => 'AuthorizationModel', 'action' => 'logOut']);
$router->add('user', ['controller' => 'User', 'action' => 'index']);
//$router->add('user/add', ['controller' => 'User', 'action' => 'add']);
//$router->add('user/del', ['controller' => 'User', 'action' => 'del']);
//$router->add('user/like', ['controller' => 'User', 'action' => 'like']);
$router->add('{controller}/{action}');

if ($router->match($url)) {
    echo "<pre>";
    print_r($router->getParams());
    echo "</pre>";
} else {
    echo "<h1>404</h1>";
}
