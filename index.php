<?php
require_once __DIR__ . "/vendor/autoload.php";

use JustGo\Router\Router;
use JustGo\Router\RouterException;

$base_url = "/e-commerce-php-les-bests-benjou-et-jeremoux";

session_start();
$router = new Router();

$router->get($base_url . '/', "View#home");

if (isset($_SESSION['uid'])) {
    $router->get($base_url . '/profil', "View#profil");
    $router->get($base_url . '/profil/update', "View#profil");
} else {
    $router->get($base_url . '/login', "View#login");
}
$router->get($base_url . '/products', "View#productByTypeOfPRoduct");
$router->get($base_url . '/product/:id', "View#productById");
$router->get($base_url . '/category/:name', "View#productByCategorieName");


if (isset($_SESSION['uid']) && isset($_SESSION['permission']) && $_SESSION['permission'] == 1) {
    $router->get($base_url . '/admin', "View#admin");
    $router->get($base_url . '/admin/command', "View#adminCommand");
    $router->get($base_url . '/admin/products', "View#adminProducts");
    $router->get($base_url . '/admin/users', "View#adminUsers");
    $router->get($base_url . '/admin/users/:id', "View#adminUsersId");
    $router->post($base_url . '/admin/delete/:id', "User#deleteAction");
}

$router->post($base_url . '/user/create', "User#createAction");
$router->post($base_url . '/user/delete', "View#deleteUser");
$router->post($base_url . '/user/login', "User#loginAction");
$router->get($base_url . '/user/logout', "User#logoutAction");
$router->post($base_url . '/product/create', "View#createProduct"); // formulaire post
$router->post($base_url . '/product/update', "View#updateProduct"); // formulaire post
$router->post($base_url . '/product/delete/:id', "View#deleteProduct"); // link + id = delete

$router->post($base_url . '/cart/add/:id', "Product#cartAdd"); 



try {
    $router->run();
} catch (RouterException $e) {
    echo "Afficher page 404";
}
