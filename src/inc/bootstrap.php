<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");
 
// Temp file use to manage index of elements in URL
require_once PROJECT_ROOT_PATH . "/inc/parameters.php";

// include main configuration file
require_once PROJECT_ROOT_PATH . "/inc/config.php";
 
// include the base controller file
require_once PROJECT_ROOT_PATH . "/controller/api/baseController.php";
 
// include the use model file
require_once PROJECT_ROOT_PATH . "/model/database.php";

// include all controller file (except the base)
require_once PROJECT_ROOT_PATH . "/controller/api/userController.php";

// include all the model file (except the database)
require_once PROJECT_ROOT_PATH . "/model/userModel.php";
?>