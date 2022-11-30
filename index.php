<?php
require __DIR__ . "/src/inc/bootstrap.php";
 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );
// $uri = ["", "index.php", "user", "list"]

// http://localhost/e-commerce-php-les-bests-benjou-et-jeremoux/index.php/user/list

if ((isset($uri[FIRST_PARAM]) && $uri[FIRST_PARAM] != 'user') || !isset($uri[SECOND_PARAM])) {
    header("HTTP/1.1 404 Not Found");
    echo "different";
    exit();
}
 
require __DIR__ . "/src/controller/api/userController.php";
 
$objFeedController = new UserController();
$strMethodName = $uri[4] . 'Action';
$objFeedController->{$strMethodName}();
?>