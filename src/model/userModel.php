<?php
require_once PROJECT_ROOT_PATH . "/model/database.php";
 
class UserModel extends Database
{
    public function getUsers()
    {
        return $this->select("SELECT * FROM T_User;");
    }
}