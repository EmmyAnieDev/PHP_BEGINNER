<?php

# THIS FILE IS RESPONSIBLE FOR FETCHING OR DISPLAYING ALL ARTICLES FROM DATABASE


error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require '../includes/init.php';

$conn =  require '../includes/db.php';

$articles = Article::getAllArticles($conn);


?>


<?php require '../includes/header.php' ?>

    <?php if (Auth::isLoggedIn()) : ?>
        
        <p>You are currently logged in<a href="auth/logout.php">   Logout</a></p>

        <a href="new_article.php">New Article</a>

    <?php else: ?>   
        
        <p>You are currently logged out<a href="auth/login.php">   Login</a></p>

    <?php endif; ?>  

    <?php if(empty($articles)) : ?>
    <p>No article found.</p>
    <?php else: ?>
        <ul>
            <?php foreach($articles as $article) : ?>
                <li>
                    <article>
                        <h2><a href="article.php?id=<?= $article['id']; ?>"><?= $article['title']; ?></a></h2>
                        <p><?= $article['content']; ?></p>

                    </article>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

<?php require '../includes/footer.php' ?>