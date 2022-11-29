<?php
require __DIR__ . "/src/inc/bootstrap.php";
 
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

foreach ($uri as $value) {
    echo $value . " | ";
}

// if ((isset($uri[2]) && $uri[2] != 'user') || !isset($uri[3])) {
//     header("HTTP/1.1 404 Not Found");
//     exit();
// }
 
// require PROJECT_ROOT_PATH . "/src/controller/api/userController.php";
 
// $objFeedController = new UserController();
// $strMethodName = $uri[3] . 'Action';
// $objFeedController->{$strMethodName}();
?>