<?php

require '../includes/init.php'; // to get sessions start function

Auth::logout();

// Redirect to the index page
header("Location: ../index.php");
exit();

?>
