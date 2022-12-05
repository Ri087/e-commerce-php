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
    public function createUser($fakeName, $firstName, $lastName, $email, $phoneNumber, $birthDate)
    {
        // return "Hello";
        return $this->select("INSERT INTO t_user (User_FakeName, User_FirstName, User_LastName, User_Email, User_PhoneNumber, User_BirthDate)
        VALUES ('$fakeName','$firstName',$lastName,'$email','$phoneNumber','$birthDate');");
    }

    public function getUsers($id = null)
    {
        if ($id == null) {

            return $this->select("SELECT * FROM T_User;");
        }
        return $this->select("SELECT * FROM T_User WHERE User_ID = $id; ");
    }

    public function deleteUser($id)
    {
        return $this->select("DELETE FROM T_User WHERE User_ID = $id;");

    }

}