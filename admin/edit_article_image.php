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

    var_dump($_FILES);

    try{

        // If the total POST data exceeds the post_max_size limit, $_FILES will be empty, indicating an invalid upload
        if (empty($_FILES)) {
            throw new Exception('Invalid upload: File size exceeds the allowed limit.');
        }

        switch($_FILES['file']['error']) {

            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                throw new Exception('No file selected');
                break;
                case UPLOAD_ERR_INI_SIZE:
                    throw new Exception('File is too large (from the server settings)');
                    break;
            default:
                throw new Exception('An error occurred');
            
        }

        // if file is greater than 1 MB
        if($_FILES['file']['size'] > 1000000){
            throw new Exception('File is too large!');
        }

    }catch (Exception $e){
        echo $e->getMessage();
    }
    
}

?>

<?php require '../includes/header.php'; ?>

<h2>Edit Article Image</h2>

<form enctype="multipart/form-data" method="post">

    <div>
        <label for="file">Image file</label>
        <input type="file" name="file" id="file">
    </div>

    <button>Upload</button>

</form>

<?php require '../includes/footer.php'; ?>
