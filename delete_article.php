<?php


# THIS FILE IS RESPONSIBLE FOR DELETING ARTICLE IN THE DATABASE USING IT'S ID

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require 'includes/init.php';

$db = new Database(); 
$conn = $db->getConn();

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

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $article_obj = new Article();
    $article_obj->deleteArticle($conn, $id);

}


?>


<?php require 'includes/header.php' ?>

    <h2>Delete Article</h2>

    <form method = "POST">
        <p>Are you sure you want to delete this article?</p>
        <button>Delete</button>
        <a href="article.php?id=<?= $article->id; ?>">Cancel</a>
    </form>

<?php require 'includes/footer.php' ?>

