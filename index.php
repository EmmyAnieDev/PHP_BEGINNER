<?php

# THIS FILE IS RESPONSIBLE FOR FETCHING OR DISPLAYING ALL ARTICLES FROM DATABASE


error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require 'includes/init.php';

$conn =  require 'includes/db.php';

// Create a new instance of the Paginator class for page 1 with 4 records per page
// adding null coalescing operator to check if page is set(present) in the url else default as page 1
// add the total number of article from the database using the Article class static method getAllArticlesCount 
$paginator = new Paginator($_GET['page'] ?? 1, 4, Article::getAllArticlesCount($conn));

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

        <nav>
            <ul>
                <li>
                    <?php if($paginator->previousPage): ?>
                        <a href="?page=<?= $paginator->previousPage; ?>">Previous</a>
                    <?php else: ?>
                        Previous
                    <?php endif; ?>
                </li>
                <li>
                    <?php if($paginator->nextPage): ?>
                        <a href="?page=<?= $paginator->nextPage; ?>">Next</a>
                    <?php else: ?>
                        Next
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

<?php require 'includes/footer.php' ?>