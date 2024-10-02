<?php


error_reporting(E_ALL); 
ini_set('display_errors', 1); 

include 'includes/db_connect.php';
require 'includes/get_article.php'; 

$conn = getDB();

// Check if 'id' is present in the query string
if (isset($_GET['id'])) {


    $article = getArticle($conn, $_GET['id']);

    if($article){

        $title = $article['title'];
        $content = $article['content'];
        $published_at = $article['published_at'];
    
    }else{

        die("article not found");
        
    }

} else {
  
    die("id not supplied, article not given");
}


# Close the database connection after fetching the data
mysqli_close($conn);

?>


<h2>Edit Article</h2>

<?php require 'includes/article_form.php'; ?>

<?php require 'includes/footer.php'; ?>