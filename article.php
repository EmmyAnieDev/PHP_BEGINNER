<?php



error_reporting(E_ALL); 
ini_set('display_errors', 1); 

include 'includes/db_connect.php';


// Check if 'id' is present in the query string and is a numeric value to prevent SQL injection by validating ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $conn = getDB();

    
    // USING QUERY STRING INSTEAD OF HARDCODING THE ID IN THE SQL QUERY
    $sql = "SELECT * FROM article WHERE id = {$_GET['id']}";

    $result = mysqli_query($conn, $sql);

    if (!$result) {
        // Query failed
        echo "Query failed: " . mysqli_error($conn);
    } elseif (mysqli_num_rows($result) == 0) {
        // Query successful but no rows found
        echo "Nothing to fetch as table is empty!";
    }

    $article = mysqli_fetch_assoc($result);   // FETCH RESULT AS ASSOCIATE ARRAY
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