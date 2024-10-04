<?php

/**
 * Database class for managing the database connection using PDO.
 * This class encapsulates the logic for establishing a connection to a MySQL database.
 */
class Database {

    /**
     * Establishes and returns a PDO connection to the MySQL database.
     *
     * @return PDO|false Returns the PDO connection object if successful, or false if the connection fails.
     */
    public function getConn() {

        // Database credentials
        $db_host = 'localhost';
        $db_name = 'cms';
        $db_user = 'emmy';
        $db_password = 'test1234';

        try {
            // Data Source Name (DSN) for the PDO connection
            $dsn = "mysql:host=" . $db_host . ";dbname=" . $db_name;

            // Create a new PDO instance and establish the connection
            $conn = new PDO($dsn, $db_user, $db_password);

            // Return the PDO connection object
            return $conn;
            
        } catch (PDOException $e) {
            // Handle connection error and display the error message
            echo "Connection failed: " . $e->getMessage();
            return false;
        }
    }

}
