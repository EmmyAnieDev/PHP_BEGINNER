<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require '../includes/init.php';

$conn =  require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if (User::authenticate($conn, $_POST['username'], $_POST['password'])){

        session_regenerate_id(true); 
        $_SESSION['is_logged_in'] = true;

        header('Location: ../index.php');

    }else{

        die('Login incorrret');

    }

}

?>



<?php require '../includes/header.php' ?>

    <h2>Login</h2>

    <form action="" method="POST">

        <div>
            <label for="username">Username</label>
            <input name="username" id="username">
        </div>

        <div>
            <label for="password">Password</label>
            <input name="password" id="password" type="password">
        </div>

        <button>Log in</button>

    </form>

<?php require '../includes/footer.php' ?>