<?php
require_once __DIR__ . "/vendor/autoload.php";

use JustGo\Router\Router;

$base_url = "/e-commerce-php-les-bests-benjou-et-jeremoux";

$router = new Router($_SERVER['REQUEST_URI']);
$router->get($base_url . '/', function () {
    echo "Bienvenue sur ma homepage !"; });
$router->get($base_url . '/posts/:id', function ($id) {
    echo "Voila l'article $id"; });
$router->run();