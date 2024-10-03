<?php

# THIS FILE IS RESPONSIBLE FOR FETCHING OR DISPLAYING ALL ARTICLES FROM DATABASE


# Enable PHP error reporting for debugging
error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display errors on the screen

include 'includes/db_connect.php';

session_start();   // Add to the top of the file

$conn = getDB();


$sql = "SELECT * FROM article ORDER BY published_at";

$result = mysqli_query($conn, $sql);

if (!$result) {
    // Query failed
    echo "Query failed: " . mysqli_error($conn);
} elseif (mysqli_num_rows($result) == 0) {
    // Query successful but no rows found
    echo "Nothing to fetch as table is empty!";
}


$articles = mysqli_fetch_all($result, MYSQLI_ASSOC); // FETCH RESULT AS ASSOCIATE ARRAY


# Close the database connection after fetching the data
mysqli_close($conn);

?>


<?php require 'includes/header.php' ?>
<?php require 'auth/auth.php' ?>

    <?php if (isLoggedIn()) : ?>
        
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

<?php require 'includes/footer.php' ?>