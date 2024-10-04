<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

class User{

    public static function authenticate($username, $password){

        return $username == "dave" && $password == "1234";

    }

}