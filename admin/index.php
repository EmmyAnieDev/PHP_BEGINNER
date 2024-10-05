<?php

# THIS FILE IS RESPONSIBLE FOR FETCHING OR DISPLAYING ALL ARTICLES FROM DATABASE


error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require '../includes/init.php';

$conn =  require '../includes/db.php';

Auth::requireLogin();

$articles = Article::getAllArticles($conn);


?>


<?php require '../includes/header.php' ?>

    <?php if (Auth::isLoggedIn()) : ?>
        
        <p>You are currently logged in<a href="auth/logout.php">   Logout</a></p>

        <a href="new_article.php">New Article</a>

    <?php else: ?>   
        
        <p>You are currently logged out<a href="auth/login.php">   Login</a></p>

    <?php endif; ?>  

    <h2>Administration</h2>

    <?php if(empty($articles)) : ?>
    <p>No article found.</p>
    <?php else: ?>
        <table>
            <thead>
                <th>Title</th>
            </thead>
            <tbody>
            <?php foreach($articles as $article) : ?>
                <tr>
                    <td>
                        <a href="article.php?id=<?= $article['id']; ?>"><?= $article['title']; ?></a>
                    </td>
                </tr>
            <?php endforeach; ?></tbody>
        </table>
    <?php endif; ?>

<?php require '../includes/footer.php' ?>