<?php

# Enable PHP error reporting for debugging
error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display errors on the screen


/**
 * Get e database connection
 * 
 * @return object connection to a MySQL server
 */
function getDB(){

    # connecting to the database
    
    $db_host = 'localhost';
    $db_name = 'cms';
    $db_user = 'emmy';
    $db_password = 'test1234';
    
    
    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);
    
    if(mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }

    return $conn;
    
    echo 'connected successfully!';

}


?>