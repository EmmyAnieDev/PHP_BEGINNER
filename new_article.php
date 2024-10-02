<?php

    error_reporting(E_ALL); 
    ini_set('display_errors', 1); 

    include 'includes/db_connect.php';

    $errors = [];
    $title = $content = $published_at = '';

    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        // Get user input
        $title = $_POST['title'];
        $content = $_POST['content'];
        $published_at = $_POST['published_at'];

        // Validation checks
        if ($title == '') {
            $errors[] = 'Title is required';
        }
        if ($content == '') {
            $errors[] = 'Content is required';
        }
        if ($published_at == '') {
            $errors[] = 'Publication date is required';
        }

        if (empty($errors)) {

            // Establish DB connection
            $conn = getDB();

            // Prepare the SQL statement
            $sql = "INSERT INTO article (title, content, published_at) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);

            if (!$stmt) {
                // Query failed
                echo "Query failed: " . mysqli_error($conn);
            } else {
                // Bind and execute the statement
                mysqli_stmt_bind_param($stmt, "sss", $title, $content, $published_at);

                if (mysqli_stmt_execute($stmt)) {
                    // Query successful, redirect to index.php
                    header('Location: index.php');
                    exit();
                } else {
                    // Error in executing the statement
                    echo mysqli_stmt_error($stmt);
                }
            }
        }
    }
?>

<?php require 'includes/header.php'; ?>

<h2>New Article</h2>

<!-- Display errors if any -->
<?php if (!empty($errors)) : ?>
    <ul>
        <?php foreach($errors as $error) : ?>
            <li><?= htmlspecialchars($error); ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<!-- Article Form -->
<form action="new_article.php" method="post">
    <div>
        <label for="title">Title</label>
        <input name="title" id="title" placeholder="Article title" value="<?= htmlspecialchars($title); ?>">
    </div>

    <div>
        <label for="content">Content</label>
        <textarea name="content" id="content" rows="4" cols="40" placeholder="Article content"><?= htmlspecialchars($content); ?></textarea>
    </div>

    <div>
        <label for="published_at">Publication date and time</label>
        <input name="published_at" id="published_at" type="datetime-local" value="<?= htmlspecialchars($published_at); ?>">
    </div>

    <button type="submit">Add</button>
</form>

<?php require 'includes/footer.php'; ?>
