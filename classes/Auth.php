<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 


/**
 * Authenticate
 * 
 * Login and Lofout
 */
class Auth{


    /**
     * Return the user authentication status
     * 
     * @return boolean True if user is logged in, false otherwise
     */
    public static function isLoggedIn(){

        return isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'];
    
    }

}