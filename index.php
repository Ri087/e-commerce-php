<?php
require_once __DIR__ . "/vendor/autoload.php";

use JustGo\Router\Router;

$base_url = "/e-commerce-php-les-bests-benjou-et-jeremoux";

$router = new Router($_SERVER['REQUEST_URI']);

$router->get($base_url . '/', "User#create");

// $router->get($base_url . '/home', function () {
// });

// $router->get($base_url . '/register', function () {
// });

// $router->get($base_url . '/connexion', function () {
// });

$router->run();
