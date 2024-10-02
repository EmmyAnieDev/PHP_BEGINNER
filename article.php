<?php



error_reporting(E_ALL); 
ini_set('display_errors', 1); 

include 'includes/db_connect.php';
require 'includes/get_article.php'; 

$conn = getDB();

// Check if 'id' is present in the query string
if (isset($_GET['id'])) {


    $article = getArticle($conn, $_GET['id']);

} else {
    $article = null;
}


# Close the database connection after fetching the data
mysqli_close($conn);

?>


<?php require 'includes/header.php' ?>

    <?php if(empty($article)) : ?>
        <p>No article found.</p>
    <?php else: ?>
        <ul>
            <li>
                <article>
                    <h2><?= $article['title']; ?></h2>
                    <p><?= $article['content']; ?></p>

                </article>
            </li>
        </ul>
    <?php endif; ?>

<?php require 'includes/footer.php' ?>