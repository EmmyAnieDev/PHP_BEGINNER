<?php

    error_reporting(E_ALL); 
    ini_set('display_errors', 1); 

    include 'includes/db_connect.php';



    if($_SERVER['REQUEST_METHOD'] == "POST"){

        // # UNSAFE WAY: Vulnerable to SQL Injection
        // $sql = "INSERT INTO article (title, content, published_at) 
        // VALUES ('{$_POST['title']}', '{$_POST['content']}', '{$_POST['published_at']}')";


        // $result = mysqli_query($conn, $sql);


        // if (!$result) {
        //     // Query failed
        //     echo "Query failed: " . mysqli_error($conn);
        // } else{
        //     // Query successful
        //     echo "Successfully added";
        // }




        // # SAFE WAY: Using mysqli escape string function
        // $sql = "INSERT INTO article (title, content, published_at) VALUES 
        // ('" . mysqli_escape_string($conn, $_POST['title']) . "',
        // '" . mysqli_escape_string($conn, $_POST['content']) . "',
        // '" . mysqli_escape_string($conn, $_POST['published_at']) . "')";


        // $result = mysqli_query($conn, $sql);


        // if (!$result) {
        //     // Query failed
        //     echo "Query failed: " . mysqli_error($conn);
        // } else{
        //     // Query successful
        //     echo "Successfully added";
        // }

        $errors = [];

        if($_POST['title'] == ''){
            $errors[] = 'Title is required';
        }
        if($_POST['content'] == ''){
            $errors[] = 'Content is required';
        }


        if(empty($errors)){

            $conn = getDB();
            
    
            # SAFE WAY: Using prepared statements
            $sql = "INSERT INTO article (title, content, published_at) VALUES (?, ?, ?)";
    
    
            $stmt = mysqli_prepare($conn, $sql);
    
    
            if (!$stmt) {
                
                // Query successful
                echo "Query failed: " . mysqli_error($conn);
    
            } else{
                
                mysqli_stmt_bind_param($stmt, "sss", $_POST['title'], $_POST['content'], $_POST['published_at']);
    
                if(mysqli_stmt_execute($stmt)){
    
                    // Query successful
                    echo "Successfully added";
    
                }else{
    
                    echo mysqli_stmt_error($stmt);
    
                }
    
            }

        }

    }

?>



<?php require 'includes/header.php' ?>


    <h2>New Article</h2>

    <?php if (!empty($errors)) : ?>
        <ul>
            <?php foreach($errors as $error) : ?>
                <li><?= $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>


    <form action="new_article.php", method="post">

        <div>

            <label for="title">Title</label>
            <input name="title" id="title" placeholder="Article title">

        </div>

        <div>

            <label for="content">Content</label>
            <textarea name="content" id="content" row="4" cols="40" placeholder="Article content"></textarea>

        </div>

        <div>

            <label for="published_at">Publication date and time</label>
            <input name="published_at" id="published_at" type="datetime-local">

        </div>

        <button>Add</button>

    </form>

<?php require 'includes/footer.php' ?>