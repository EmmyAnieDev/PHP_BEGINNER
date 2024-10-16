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

        /// If the user was successfully fetched, store the (authenticated) logged-in user in the $user variable
        if($user = $stmt->fetch()){
            
            // Verify that the provided password matches the hashed password in the database
            return password_verify($password, $user->password); // ($user->password) is the password retuned from the fetch method

        }

    }

}