<?php

# THIS FILE IS RESPONSIBLE FOR FETCHING OR DISPLAYING ALL ARTICLES FROM DATABASE


error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require 'includes/init.php';

$conn =  require 'includes/db.php';

// Create a new instance of the Paginator class for page 1 with 4 records per page
// adding null coalescing operator to check if page is set(present) in the url else default as page 1
$paginator = new Paginator($_GET['page'] ?? 1, 4);

// Fetch a specific page of articles from the database
$articles = Article::getPage($conn, $paginator->limit, $paginator->offset);


?>


<?php require 'includes/header.php' ?>  

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

<?php require 'includes/footer.php' ?>