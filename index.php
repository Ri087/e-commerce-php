<?php
require_once __DIR__ . "/vendor/autoload.php";

use JustGo\Router\Router;

$base_url = "/e-commerce-php-les-bests-benjou-et-jeremoux";

$router = new Router($_SERVER['REQUEST_URI']);

$router->get($base_url . "/", function () {
    echo "Hello !";
});
$router->get($base_url . '/test', "");
$router->get($base_url . '/user/create', "User#createAction");
$router->get($base_url . '/user/read', "User#readAction");
$router->get($base_url . '/user/read/:id', "User#readAction");

$router->run();
