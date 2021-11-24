<?php
    session_start();
    if (!isset($_SESSION["username"])) {
        if (!empty($_POST)) {
            //access database to find user
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["role"] = "admin";
            header("Location: product.html");
            die();
        }
    }
    else {
        header("Location: product.html");
        die();
    }
?>