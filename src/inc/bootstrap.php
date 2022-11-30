<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";
 
// include the base controller file
require_once PROJECT_ROOT_PATH . "/controller/baseController.php";
 
// include the use model file
require_once PROJECT_ROOT_PATH . "/model/database.php";

// include all controller file (except the base)
require_once PROJECT_ROOT_PATH . "/controller/cartController.php";
require_once PROJECT_ROOT_PATH . "/controller/invoicesController.php";
require_once PROJECT_ROOT_PATH . "/controller/productController.php";
require_once PROJECT_ROOT_PATH . "/controller/userController.php";

// include all the model file (except the database)
require_once PROJECT_ROOT_PATH . "/model/cartModel.php";
require_once PROJECT_ROOT_PATH . "/model/invoicesModel.php";
require_once PROJECT_ROOT_PATH . "/model/productModel.php";
require_once PROJECT_ROOT_PATH . "/model/userModel.php";
?>