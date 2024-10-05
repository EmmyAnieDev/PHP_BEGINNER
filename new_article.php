<?php

    # THIS FILE IS RESPONSIBLE FOR ADDINNG NEW ARTICLE INTO THE DATABASE

    error_reporting(E_ALL); 
    ini_set('display_errors', 1); 

    require 'includes/init.php';

    $conn =  require 'includes/db.php';


    Auth::requireLogin();

    $title = $content = $published_at = '';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get user input
        $title = $_POST['title'];
        $content = $_POST['content'];
        $published_at = $_POST['published_at'];


        $article_obj = new Article();
        $article_obj->InsertArticle($conn, $title, $content, $published_at);

         
    }
?>

<h2>New Article</h2>

<?php require 'includes/article_form.php'; ?>

<?php require 'includes/footer.php'; ?>
