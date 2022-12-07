<?php
require_once __DIR__ . "/vendor/autoload.php";

use JustGo\Router\Router;

$base_url = "/e-commerce-php-les-bests-benjou-et-jeremoux";

$router = new Router();

$router->get($base_url . "", function () {
    echo "Hello !";
});
$router->get($base_url . '/user/create', "User#createAction");
$router->get($base_url . '/user/read', "User#readAction");
$router->get($base_url . '/user/read/:id', "User#readAction");
<<<<<<< HEAD
=======
$router->get($base_url . '/user/update', "User#updateAction");
>>>>>>> fc6788fc34d7a109d069100937fd8d3eab055895

$router->run();