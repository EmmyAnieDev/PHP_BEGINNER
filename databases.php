<?php


# Enable PHP error reporting for debugging
error_reporting(E_ALL); // Report all types of errors
ini_set('display_errors', 1); // Display errors on the screen


# DATABASE


# Sample articles data stored in the system (as in a database table)
// $articles = [
//     [
//         'title' => 'First post',
//         'content' => 'This is the first of many posts'
//     ],
//     [
//         'title' => 'Another post',
//         'content' => 'Yet another fascinating posts...'
//     ],
//     [
//         'title' => 'Read this!',
//         'content' => 'You must read this now, it\'s essential reading!'
//     ],
//     [
//         'title' => 'The latest news',
//         'content' => 'Here is the latest new, read it now!'
//     ]
// ];


// print_r($articles);


# connecting to the database

$db_host = 'localhost';
$db_name = 'cms';
$db_user = 'emmy';
$db_password = 'test1234';


$conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

if(mysqli_connect_error()){
    echo mysqli_connect_error();
    exit;
}

echo 'connected successfully!';

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
        <?php if(empty($articles)) : ?>
            <p>No paragraph found.</p>
        <?php else: ?>
            <ul>
                <?php foreach($articles as $article) : ?>
                    <li>
                        <article>
                            <h2><?= $article['title']; ?></h2>
                            <p><?= $article['content']; ?></p>

                        </article>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </main>
</html>
