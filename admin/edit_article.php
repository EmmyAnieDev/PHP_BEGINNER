<?php

# THIS FILE IS RESPONSIBLE FOR EDITING OR UPDATING ARTICLE IN DATABASE USING IT'S ID

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require '../includes/init.php';

$conn =  require '../includes/db.php';

$article_obj = new Article();

// Check if 'id' is present in the query string
if (isset($_GET['id'])) {

    // Fetch the article data based on the ID
    $article = Article::getById($conn, $_GET['id']);

    if ($article) {

        $id = $article->id; 
        $title = $article->title;
        $content = $article->content;
        $published_at = $article->published_at;
        
    } else {
        die("Article not found");
    }

} else {
    die("ID not supplied, article not given");
}

// Extracts an array of category IDs associated with the article
$category_ids = array_column($article->getArticleCategories($conn), 'id');

// Retrieves all categories from the database using the Category class method
$categories = Category::getAllCategories($conn);



if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Get input from form submission
    $article_obj->id = $_GET['id'];
    $article_obj->title = $_POST['title'];
    $article_obj->content = $_POST['content'];
    $article_obj->published_at = $_POST['published_at'];
    
    $category_ids = $_POST['category'] ?? [];

    if ($article_obj->updateArticle($conn, $article_obj->id, $article_obj->title, $article_obj->content, $article_obj->published_at)) {

        // Set categories after a successful article update
        $article_obj->setArticleCategories($conn, $category_ids);

        header("Location: article.php?id=$article_obj->id");
    }
}


?>

<h2>Edit Article</h2>

<?php require 'includes/article_form.php'; ?>

<?php require '../includes/footer.php'; ?>
