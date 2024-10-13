<?php

/**
 * Database class for managing the database connection using PDO.
 * This class encapsulates the logic for establishing a connection to a MySQL database.
 */
class Database {

    protected $db_host;
    protected $db_name;
    protected $db_user;
    protected $db_pass;

    public function __construct($db_host, $db_name, $db_user, $db_pass){

        $this->db_host = $db_host;
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;

    }

    /**
     * Establishes and returns a PDO connection to the MySQL database.
     *
     * @return PDO|false Returns the PDO connection object if successful, or false if the connection fails.
     */
    public function getConn() {

        try {
            // Data Source Name (DSN) for the PDO connection
            $dsn = "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name;

            // Create a new PDO instance and establish the connection
            $conn = new PDO($dsn, $this->db_user, $this->db_pass);

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Set the PDO error mode to exception

            // Return the PDO connection object
            return $conn;
            
        } catch (PDOException $e) {
            // Handle connection error and display the error message
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

}
