<?php

# THIS FILE IS RESPONSIBLE FOR FETCHING OR DISPLAYING ALL ARTICLES FROM DATABASE


error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require 'includes/init.php';

$conn =  require 'includes/db.php';

// Create a new instance of the Paginator class for page 1 with 4 records per page
// adding null coalescing operator to check if page is set(present) in the url else default as page 1
// add the total number of article from the database using the Article class static method getAllArticlesCount 


$page = $_GET['page'] ?? 1;
$records_per_page = 4;

// Get total number of articles from database connection
$total_articles = Article::getAllArticlesCount($conn, true);

// Create paginator instance
$paginator = new Paginator($page, $records_per_page, $total_articles);

// Fetch a specific page of articles from the database
$articles = Article::getPage($conn, $paginator->limit, $paginator->offset, true);


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

                        <time datetime="<?= $article['published_at']?>">
                            <?php 
                                $datetime = new DateTime($article['published_at']);
                                echo $datetime->format("j, F Y");
                            ?> 
                        </time>

                         <!-- display article category name -->
                        <?php if ($article['category_names']) : ?>
                            <p>Categories:
                                <?php foreach($article['category_names'] as $name) :?>
                                    <?= htmlspecialchars($name ?? ''); ?>
                                <?php endforeach ;?>
                            </p>
                        <?php endif ;?>

                        <p><?= $article['content']; ?></p>

                    </article>
                </li>
            <?php endforeach; ?>
        </ul>

        <nav>
            <ul class="pagination">
                <li class="page-item">
                    <?php if($paginator->previousPage): ?>
                        <a class="page-link" href="?page=<?= $paginator->previousPage; ?>">Previous</a>
                    <?php else: ?>
                        <span class="page-link">Previous</span>
                    <?php endif; ?>
                </li>
                <li class="page-item">
                    <?php if($paginator->nextPage): ?>
                        <a class="page-link" href="?page=<?= $paginator->nextPage; ?>">Next</a>
                    <?php else: ?>
                        <span class="page-link">Next</span>
                    <?php endif; ?>
                </li>
            </ul>
        </nav>
    <?php endif; ?>

<?php require 'includes/footer.php' ?>