<?php

  #THIS FILE IS RESPONSIBLE FOR GETTING ARTICLE USING IT'S ID


error_reporting(E_ALL); 
ini_set('display_errors', 1); 


require 'includes/init.php';

$conn =  require 'includes/db.php';

$db = new Database(); 
$conn = $db->getConn(); 

// Check if 'id' is present in the query string
if (isset($_GET['id'])) {

    $article = Article::getById($conn, $_GET['id']);

} else {

    $article = null;

}


?>


<?php require 'includes/header.php' ?>

    <?php if(!$article) : ?>
        <p>No article found.</p>
    <?php else: ?>
        <ul>
            <li>
                <article>

                    <h2><?= htmlspecialchars($article->title); ?></h2>
                    <p><?= htmlspecialchars($article->content); ?></p>

                </article>
                 
                <a href="edit_article.php?id=<?= $article->id; ?>">Edit</a>
                <a href="delete_article.php?id=<?= $article->id; ?>">Delete</a>

            </li>
        </ul>
    <?php endif; ?>

<?php require 'includes/footer.php' ?>