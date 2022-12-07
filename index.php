<?php
require_once __DIR__ . "/vendor/autoload.php";

use JustGo\Router\Router;

$base_url = "/e-commerce-php-les-bests-benjou-et-jeremoux";

$router = new Router();

$router->get($base_url . '/', "View#profil");
$router->get($base_url . '/profil', "View#profil");
// $router->get($base_url . '/product', "View#product");
$router->get($base_url . '/admin', "View#profil");
$router->get($base_url . '/product_id/:id', "View#productById");
$router->get($base_url . '/product_name/:name', "View#productByCategorieName");
$router->get($base_url . '/product_list', "View#productByTypeOfPRoduct");
$router->get($base_url . '/create_product', "View#createProduct");
$router->get($base_url . '/update_product', "View#updateProduct");//recuperer les données !!!
$router->get($base_url . '/delete_product/:id', "View#deleteProduct");





// $router->get($base_url . '/profil', "View#profil");
// $router->get($base_url . '/profil', "View#profil");


// $router->get($base_url . '/user/create', "User#createAction");
// $router->get($base_url . '/user/read', "User#readAction");
// $router->get($base_url . '/user/read/:id', "User#readAction");
// $router->get($base_url . '/user/update', "User#updateAction");

$router->run();

