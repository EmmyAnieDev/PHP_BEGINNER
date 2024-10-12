<?php

error_reporting(E_ALL); 
ini_set('display_errors', 1); 

require '../includes/init.php';

$conn =  require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if (User::authenticate($conn, $_POST['username'], $_POST['password'])){

        Auth::login();

        header('Location: ../index.php');

    }else{

        die('Login incorrret');

    }

}

?>



<?php require '../includes/header.php' ?>

    <h2>Login</h2>

    <form action="" method="POST">

        <div class="form-group">
            <label for="username">Username</label>
            <input name="username" id="username" class="form-control">
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" id="password" type="password" class="form-control">
        </div>

        <button class="btn">Log in</button>

    </form>

<?php require '../includes/footer.php' ?>