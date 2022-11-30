<?php
require __DIR__ . "/src/inc/bootstrap.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);
// $uri = ["", "index.php", "user", "list"]
// http://localhost/e-commerce-php-les-bests-benjou-et-jeremoux/index.php/user/list

$firstParam = $uri[3];

$objFeedController = null;

switch ($firstParam) {
    case "views":
        require __DIR__ . '/src/views/index.html.twig';
        break;
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

// $secondParam = $uri[4];

// $strMethodName = $secondParam . "Action";
// $objFeedController->{$strMethodName}();
?>
