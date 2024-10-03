<?php

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    if ($_POST['username'] == "dave" && $_POST['password'] == "1234"){

        session_regenerate_id(true); // regenerate id when user logs in as it prevents session-related attacks.

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