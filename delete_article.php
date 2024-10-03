<?php


# THIS FILE IS RESPONSIBLE FOR DELETING ARTICLE IN THE DATABASE USING IT'S ID

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

include 'includes/db_connect.php';
require 'includes/get_article.php'; 
require 'includes/validate_article.php'; 

$conn = getDB();

// Check if 'id' is present in the query string
if (isset($_GET['id'])) {

    // Fetch the article data based on the ID
    $article = getArticle($conn, $_GET['id'], 'id');  // In this case, instead of fetching all columns (using '*'), we are only fetching 'id'

    if ($article) {

        $id = $article['id']; // This is crucial to target the correct article
     
    } else {
        die("Article not found");
    }

} else {
    die("ID not supplied, article not given");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

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

}

// Close the database connection
mysqli_close($conn);

?>


<?php require 'includes/header.php' ?>

    <h2>Delete Article</h2>

    <form method = "POST">
        <p>Are you sure you want to delete this article?</p>
        <button>Delete</button>
        <a href="article.php?id=<?= $article['id']; ?>">Cancel</a>
    </form>

<?php require 'includes/footer.php' ?>

