<?php

class Category{

    /**
     * Retrieve all categories from the database.
     *
     * @param PDO $conn The PDO connection object.
     * @return array An associative array of all categories.
     */
    public static function getAllCategories($conn) {
        $sql = "SELECT * FROM category ORDER BY name;"; 

        $result = $conn->query($sql);  

        return $result->fetchAll(PDO::FETCH_ASSOC); 
    }


}