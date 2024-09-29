<?php



error_reporting(E_ALL); 
ini_set('display_errors', 1); 

include 'db_connect.php';


$sql = "SELECT * FROM article WHERE id = 10";

$result = mysqli_query($conn, $sql);

if (!$result) {
    // Query failed
    echo "Query failed: " . mysqli_error($conn);
} elseif (mysqli_num_rows($result) == 0) {
    // Query successful but no rows found
    echo "Nothing to fetch as table is empty!";
}


$article = mysqli_fetch_assoc($result);   // FETCH RESULT AS ASSOCIATE ARRAY


# Close the database connection after fetching the data
mysqli_close($conn);

?>


<!DOCTYPE html>
<html>
    <head>
        <title>My Blog</title>
        <meta charest="utf-8">
    </head>
    <body>
        <header?>
            <h1>My Blog</h1>
        </header>
    </body>

    <main>
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
    </main>
</html>
