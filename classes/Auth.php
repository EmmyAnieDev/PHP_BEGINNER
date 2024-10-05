<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 


/**
 * Authenticate
 * 
 * Login and Logout
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

    /**
     * Require the user to be logged In, stopping with an "Unauthoried" message is not logged in
     * 
     * @return void
     */
    public static function requireLogin(){

        if(!static::isLoggedIn()){

            die("Unauthorized"); 

        }

    }

    /**
     * Login using sessions
     * 
     * @return void
     */
    public static function login(){

        session_regenerate_id(true); 

        $_SESSION['is_logged_in'] = true;

    }

    /**
     * Logout using sessions
     * 
     * @return void
     */
    public static function logout(){

        // Clear all session variables
        $_SESSION = array();

        // If session cookies are used, delete the session cookie
        if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
        );
        }

        // Destroy the session
        session_destroy();

    }

}