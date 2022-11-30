<?php
class UserModel extends Database
{
    public function getUsers()
    {
        return $this->select("SELECT * FROM T_User;");
    }
}