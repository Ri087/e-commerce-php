<?php

namespace JustGo\Model;

class UserModel extends Database
{
    public function createUser()
    {

    }
    public function getUsers()
    {
        return $this->select("SELECT * FROM T_User;");
    }

    public function deleteUser()
    {

    }

}