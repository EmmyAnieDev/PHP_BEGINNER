<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

include 'includes/db_connect.php';
require 'includes/get_article.php'; 
require 'includes/validate_article.php'; 

$conn = getDB();

// Check if 'id' is present in the query string
if (isset($_GET['id'])) {

    // Fetch the article data based on the ID
    $article = getArticle($conn, $_GET['id']);

    if ($article) {
        $id = $article['id']; // This is crucial to target the correct article
        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    } else {
        die("Article not found");
    }

} else {
    die("ID not supplied, article not given");
}

$sql = "DELETE FROM article WHERE id = ? ";
$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    echo "Query failed: " . mysqli_error($conn);

} else {

    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {

        // delete successful, redirect to the index page or display a success message
        header("Location: index.php");
        exit(); 

    } else {
        // Error in executing the update statement
        echo "Error in executing delete: " . mysqli_stmt_error($stmt);
    }
}

// if ($_SERVER['REQUEST_METHOD'] == "POST") {

//     // // Get input from form submission
//     // $title = $_POST['title'];
//     // $content = $_POST['content'];
//     // $published_at = $_POST['published_at'];

//     // // Validate the article data
//     // $errors = validateArticle($title, $content, $published_at);

//     // if (empty($errors)) {

//         // Prepare the SQL statement to update the article

    
// }

// Close the database connection
mysqli_close($conn);

?>

