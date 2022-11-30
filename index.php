<?php
require __DIR__ . "/src/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
// $uri = ["", "index.php", "user", "list"]
// http://localhost/e-commerce-php-les-bests-benjou-et-jeremoux/index.php/user/list

$firstParam = $uri[3];
$secondParam = $uri[4];

if (!isset($firstParam) || strlen($firstParam) == 0 || !isset($secondParam) || strlen($secondParam) == 0) {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$objFeedController = null;

switch ($firstParam) {
    case "cart":
        $objFeedController = new CartController();
        break;
    case "invoices":
        $objFeedController = new InvoicesController();
        break;
    case "product":
        $objFeedController = new ProductController();
        break;
    case "user":
        $objFeedController = new UserController();
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
}

$strMethodName = $secondParam . "Action";
// $objFeedController->{$strMethodName}();
?>