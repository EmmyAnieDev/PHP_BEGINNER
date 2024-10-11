<?php

  #THIS FILE IS RESPONSIBLE FOR GETTING ARTICLE USING IT'S ID


error_reporting(E_ALL); 
ini_set('display_errors', 1); 


require 'includes/init.php';

$conn =  require 'includes/db.php';


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

                    <time datetime="<?= $article->published_at?>">
                        <?php 
                            $datetime = new DateTime($article->published_at);
                            echo $datetime->format("j, F Y");
                        ?> 
                    </time>

                    <?php if ($article->image_file) : ?>
                    <img src="uploads/<?= htmlspecialchars($article->image_file); ?>" width="300" height="200">
                    <?php endif; ?>

                    <p><?= htmlspecialchars($article->content); ?></p>

                </article>

            </li>
        </ul>
    <?php endif; ?>

<?php require 'includes/footer.php' ?>