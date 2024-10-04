<?php

/**
 * Class Article
 * 
 * This class handles operations related to articles in the database.
 */
class Article {

    /**
     * Retrieve all articles from the database.
     *
     * @param PDO $conn The PDO connection object.
     * @return array An associative array of all articles.
     */
    public static function getAllArticles($conn) {
        $sql = "SELECT * FROM article ORDER BY published_at"; // SQL query to select all articles ordered by publication date

        $result = $conn->query($sql);  // Query the connection with the SQL statement

        return $result->fetchAll(PDO::FETCH_ASSOC); // Fetch the result as an associative array
    }


    
    /**
     * Retrieve an article by its ID from the database.
     *
     * @param PDO $conn The PDO connection object.
     * @param int $id The ID of the article to retrieve.
     * @param string $columns The columns to select (default is all columns).
     * @return array|null An associative array of the article if found, null otherwise.
     */
    public static function getById($conn, $id, $columns = '*') {
        $sql = "SELECT $columns FROM article WHERE id = :id "; // SQL query to select specific columns from the article table where the ID matches
    
        $stmt = $conn->prepare($sql); // Prepare the SQL statement for execution
    
        // Bind the $id parameter to the prepared statement
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Bind the ID value to the placeholder in the SQL statement
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC); // Fetch and return the article as an associative array if the execution is successful
        }
    
        return null; // Return null if the execution fails or the article is not found
    }
    

}
