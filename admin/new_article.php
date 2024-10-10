<?php

    # THIS FILE IS RESPONSIBLE FOR ADDINNG NEW ARTICLE INTO THE DATABASE

    error_reporting(E_ALL); 
    ini_set('display_errors', 1); 

    require '../includes/init.php';

    $conn =  require '../includes/db.php';

    Auth::requireLogin();
    
    $article_obj = new Article();

    $title = $content = $published_at = '';

    // Extracts an array of category IDs associated with the article
    $category_ids = [];
    
    // Retrieves all categories from the database using the Category class method
    $categories = Category::getAllCategories($conn);

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get user input
        $article_obj->title = $_POST['title'];
        $article_obj->content = $_POST['content'];
        $article_obj->published_at = $_POST['published_at'];
        
        $category_ids = $_POST['category'] ?? [];
        
        // Insert the article and get the inserted article ID
        $article_id = $article_obj->insertArticle($conn, $article_obj->title, $article_obj->content, $article_obj->published_at);
        
        if ($article_id) {
            
            $article_obj->id = $article_id; // Set the ID for the article object
            $article_obj->setArticleCategories($conn, $category_ids);
            header("Location: article.php?id=$article_obj->id");
            
        }
    }
    
?>

<h2>New Article</h2>

<?php require 'includes/article_form.php'; ?>

<?php require '../includes/footer.php'; ?>
