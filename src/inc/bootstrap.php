<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");
 
// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";
require_once PROJECT_ROOT_PATH . "/inc/parameters.php";
 
// include the base controller file
require_once PROJECT_ROOT_PATH . "/controller/api/baseController.php";
 
// include the use model file
require_once PROJECT_ROOT_PATH . "/model/userModel.php";
?>