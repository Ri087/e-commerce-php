<?php

namespace JustGo\Model\Dao;

class UserDao extends Dao
{
    private $everyUserTable = [
        "UserInfo" => "T_User",
        "UserPassword" => "T_UserSecret",
        "UserAddresses" => "T_UserAddresses",
        "UserPhoto" => "T_UserPhoto",
        "UserPayements" => "T_UserPayement"
    ];
    public function createUser($fakeName, $firstName, $lastName, $email, $phoneNumber, $birthDate, $salt, $password)
    {
        $sqlStmtUserInfo = "INSERT INTO {$this->everyUserTable['UserInfo']} (User_FakeName, User_FirstName, User_LastName, User_Email, User_PhoneNumber, User_BirthDate) VALUES ('$fakeName', '$firstName', '$lastName', '$email' ,'$phoneNumber' ,'$birthDate');";
        if ($this->connection->query($sqlStmtUserInfo) === TRUE) {
            $id = $this->connection->insert_id;
            $sqlStmtUserPassword = "INSERT INTO {$this->everyUserTable['UserPassword']} VALUES ($id, '$salt', '$password');";
            if ($this->connection->query($sqlStmtUserPassword) === TRUE) {
                return true;
            }
            $sqlStmtUserInfoDelete = "DELETE FROM {$this->everyUserTable['UserInfo']} WHERE User_ID = $id";
            $this->connection->query($sqlStmtUserInfoDelete);
        }
        return false;
    }

    public function getUsers($id = null)
    {
        $data = null;
        if ($id == null) {
            $data = $this->connection->query("SELECT * FROM {$this->everyUserTable['UserPassword']};");
            return $data;
        }
        $data = $this->connection->query("SELECT * FROM {$this->everyUserTable['UserPassword']} WHERE User_ID = $id;");
        return $data;
    }

    public function deleteUser($id)
    {
        return $this->select("DELETE FROM T_User WHERE User_ID = $id;");

    }

}