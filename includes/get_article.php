<?php


function getArticle($conn, $id, $columns = '*'){

    $sql = "SELECT $columns FROM article WHERE id = :id ";

    $stmt = $conn->prepare($sql); 

    // Bind the $id parameter to the prepared statement
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    // Execute the prepared statement
    if($stmt->execute()){
        
        return $stmt->fetch(PDO::FETCH_ASSOC);

    }



}

