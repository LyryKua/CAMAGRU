<?php
/**
 * Front controller
 */

/*
 * Autoloader
 */
spl_autoload_register(function ($class) {
	$root = dirname(__DIR__); // get the parent directory
	$file = $root . '/' . str_replace('\\', '/', $class) . '.class.php';
	if (is_readable($file)) {
		require $root . '/' . str_replace('\\', '/', $class) . '.class.php';
	}
});

$router = new Core\Router();
$url = trim($_SERVER['QUERY_STRING'], '/');

// Adding routes to the routing table
$router->add('', ['controller' => 'Home', 'action' => 'index']);
$router->add('sign-up', ['controller' => 'Authorization', 'action' => 'signUp']);
$router->add('log-in', ['controller' => 'Authorization', 'action' => 'logIn']);
$router->add('log-out', ['controller' => 'Authorization', 'action' => 'logOut']);
$router->add('user', ['controller' => 'User', 'action' => 'index']);
$router->add('{controller}/{action}');
//$router->add('{controller}/{id}/{action}');

$router->dispatch($url);
