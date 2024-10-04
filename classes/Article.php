<?php

/**
 * Class Article
 * 
 * This class handles operations related to articles in the database.
 */
class Article {

    public $id;
    public $title;
    public $content;
    public $published_at;

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
     * @return object|null A object of the article if found, null otherwise.
     */
    public static function getById($conn, $id, $columns = '*') {
        $sql = "SELECT $columns FROM article WHERE id = :id "; // SQL query to select specific columns from the article table where the ID matches
    
        $stmt = $conn->prepare($sql); // Prepare the SQL statement for execution
    
        // Bind the $id parameter to the prepared statement
        $stmt->bindValue(':id', $id, PDO::PARAM_INT); // Bind the ID value to the placeholder in the SQL statement

        // set default fetch mode to object
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Article'); 
        
        // Execute the prepared statement
        if ($stmt->execute()) {
            return $stmt->fetch(); 
        }
    
        return null; // Return null if the execution fails or the article is not found
    }


    public function updateArticle($conn, $id, $title, $content, $published_at) {
        // Prepare the SQL statement to update the article
        $sql = "UPDATE article SET title = :title, content = :content, published_at = :published_at WHERE id = :id";
        $stmt = $conn->prepare($sql);
    
        if (!$stmt) {
            // If the statement preparation fails, output an error message
            echo "Query failed: " . implode(", ", $conn->errorInfo());
            return false; // Exit the function to prevent further execution
        } 
    
        // Bind the parameters to the prepared statement
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':title', $title, PDO::PARAM_STR);
        $stmt->bindValue(':content', $content, PDO::PARAM_STR);
        $stmt->bindValue(':published_at', $published_at, PDO::PARAM_STR);
    
        // Execute the prepared statement
        if ($stmt->execute()) {
            // Update successful, redirect to the article page or display a success message
            header("Location: article.php?id=" . $id);
            exit();
        } else {
            // Error in executing the update statement
            echo "Error in executing update: " . implode(", ", $stmt->errorInfo());
            return false; // Exit the function to prevent further execution
        }
    }
    
    

}
