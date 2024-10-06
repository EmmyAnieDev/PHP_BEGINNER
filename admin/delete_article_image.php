<?php

# THIS FILE IS RESPONSIBLE FOR EDITING OR UPDATING ARTICLE IMAGE IN DATABASE USING IT'S ID

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require '../includes/init.php';

$conn =  require '../includes/db.php';

// Check if 'id' is present in the query string
if (isset($_GET['id'])) {

    // Fetch the article data based on the ID
    $article = Article::getById($conn, $_GET['id']);

} else {
    die("ID not supplied, article not given");
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // variable to hold current image file
    $current_image = $article->image_file;

    // Attempt to update the article's image file to null, indicating removal of the current image.
    if ($article->setImageFile($conn, null)) {
        // If the current image file exists, delete it when a new image is being uploaded.
        if ($current_image) {
            unlink("../uploads/$current_image");
        }

        header("Location: edit_article_image.php?id={$article->id}");
    }

}

?>

<?php require '../includes/header.php'; ?>

    <h2>Delete Article Image</h2>

    <?php if ($article->image_file) : ?>
    <img src="../uploads/<?= htmlspecialchars($article->image_file); ?>" width="300" height="200">
    <?php endif; ?>



    <form method = "POST">
        <p>Are you sure you want to delete this article image?</p>
        <button>Delete</button>
        <a href="edit_article_image.php?id=<?= $article->id; ?>">Cancel</a>
    </form>

<?php require '../includes/footer.php'; ?>
