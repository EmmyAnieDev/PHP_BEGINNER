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

<h2>New Article</h2>

<?php require 'includes/article_form.php'; ?>

<?php require 'includes/footer.php'; ?>
