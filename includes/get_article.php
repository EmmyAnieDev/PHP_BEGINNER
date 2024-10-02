<?php

function getArticle($conn, $id){

    $sql = "SELECT * FROM article WHERE id = ? ";

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

