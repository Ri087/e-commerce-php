<?php
require_once __DIR__ . "/vendor/autoload.php";

use JustGo\Router\Router;

$base_url = "/e-commerce-php-les-bests-benjou-et-jeremoux";

session_start();
$router = new Router();

$router->get($base_url . '/', "View#home");
$router->get($base_url . '/profil', "View#profil");
$router->get($base_url . '/login', "View#login");

$router->post($base_url . '/user/create', "User#createAction");
$router->post($base_url . '/user/login', "User#loginAction");
$router->get($base_url . '/user/logout', "User#logoutAction");

// $router->get($base_url . '/user/read', "User#readAction");
// $router->get($base_url . '/user/read/:id', "User#readAction");
// $router->get($base_url . '/user/update', "User#updateAction");

$router->run();