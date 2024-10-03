<?php

/**
 * Fetches an article from the database by its ID.
 * 
 * @param mysqli $conn The database connection object.
 * @param int $id The ID of the article to fetch.
 * @param string $columns (Optional) Specifies which columns to retrieve. 
 *                        Default is '*' to retrieve all columns.
 * 
 * By default, the $columns parameter is set to '*' to fetch all columns 
 * from the 'article' table. However, if specific columns are needed, 
 * a string of column names can be passed (e.g., 'title, content').
 * This provides flexibility in selecting which data to retrieve, 
 * making the function more reusable.
 * 
 * @return array|null The article data as an associative array, or null if not found.
 */

function getArticle($conn, $id, $columns = '*'){

    $sql = "SELECT $columns FROM article WHERE id = ? ";

    // mysqli_prepare prepares the SQL query for execution
    $stmt = mysqli_prepare($conn, $sql); 

    // Check if the statement was successfully prepared
    if($stmt == false){
        
        // If the statement fails, output the error
        echo mysqli_error($conn);

    } else {

        // Bind the $id parameter to the prepared statement
        // 's' means the type of the bound variable is string (use 'i' for integer, etc.)
        mysqli_stmt_bind_param($stmt, 'i', $id);

        // Execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            
            // Get the result set from the executed statement
            $result = mysqli_stmt_get_result($stmt);

            // Fetch the resulting row as an associative array
            return mysqli_fetch_array($result, MYSQLI_ASSOC);
        }

    }

}

