<?php

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        print_r($_GET);
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        print_r($_POST);
    }

?>