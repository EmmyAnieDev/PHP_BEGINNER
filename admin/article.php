<?php

  #THIS FILE IS RESPONSIBLE FOR GETTING ARTICLE USING IT'S ID


error_reporting(E_ALL); 
ini_set('display_errors', 1); 


require '../includes/init.php';

$conn =  require '../includes/db.php';

Auth::requireLogin();


// Check if 'id' is present in the query string
if (isset($_GET['id'])) {

    // $article = Article::getById($conn, $_GET['id']);
    $article = Article::getArticleWithCategoryById($conn, $_GET['id']);

} else {

    $article = null;

}


?>


<?php require '../includes/header.php' ?>

    <?php if(!$article) : ?>
        <p>No article found.</p>
    <?php else: ?>
        <ul>
            <li>
                <article>

                    <?php if($article[0]['category_name']) : ?>

                        <p>Categories:

                            <?php foreach($article as $article_category): ?>
                                <?= htmlspecialchars($article_category['category_name'] ?? ''); ?>
                            <?php endforeach; ?>

                        </p>
                    
                    <?php endif; ?>

                    <h2><?= htmlspecialchars($article[0]['title']); ?></h2>

                    <?php if ($article[0]['image_file']) : ?>
                    <img src="../uploads/<?= htmlspecialchars($article[0]['image_file']); ?>" width="300" height="200">
                    <?php endif; ?>

                    <p><?= htmlspecialchars($article[0]['content']); ?></p>

                </article>

                <a href="edit_article.php?id=<?= $article[0]['article_id']; ?>">Edit</a>
                <a href="delete_article.php?id=<?= $article[0]['article_id']; ?>">Delete</a>
                <a href="edit_article_image.php?id=<?= $article[0]['article_id']; ?>">Edit Image</a>


            </li>
        </ul>
    <?php endif; ?>

<?php require '../includes/footer.php' ?>