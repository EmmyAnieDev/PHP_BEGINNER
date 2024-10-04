<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

class User{

    public $id;
    public $username;
    public $password;

    public static function authenticate($conn, $username, $password){

        $sql = "SELECT * FROM user WHERE username = :username";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':username', $username, PDO::PARAM_STR);

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'User');

        $stmt->execute();

        if($user = $stmt->fetch()){
            
            return $user->password == $password;

        }

    }

}