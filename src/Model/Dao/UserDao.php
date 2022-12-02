<?php

namespace JustGo\Model\Dao;
class UserModel extends Dao
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