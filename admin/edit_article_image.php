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

        // Define the allowed MIME types for image files
        $mime_types = ['image/gif', 'image/png', 'image/jpeg', 'image/webp'];

        $info = finfo_open(FILEINFO_MIME_TYPE); // Open a fileinfo resource to get the MIME type of the uploaded file
        $mime_type = finfo_file($info, $_FILES['file']['tmp_name']); // Get the actual MIME type of the uploaded file
        
        // Check if the MIME type of the file is not in the allowed list
        if (!in_array($mime_type, $mime_types)){ 
            throw new Exception('Invalid file type'); 
        }

        // Extract the components of the uploaded file's name (filename and extension)
        $pathinfo = pathinfo($_FILES['file']['name']);

        // Get the file's base name (filename without the extension)
        $base = $pathinfo['filename'];

        // Replace any characters that are not letters, numbers, underscores, or dashes with underscores
        $base = preg_replace('/[^a-zA-Z0-9_-]/', '_', $base);

        // Rebuild the file name with the sanitized base name and the original file extension
        $filename = $base . "." . $pathinfo['extension'];

        // Define the destination path where the file will be uploaded, inside the 'uploads' directory
        $destination = "../uploads/$filename";


        // Attempt to move the uploaded file from the temporary location to the destination
        if (move_uploaded_file($_FILES['file']['tmp_name'], $destination)){

            echo "File uploaded successfully.";

        }else{

            throw new Exception("Unable to move uploaded file.");

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
