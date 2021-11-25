<?php
    /*
    unsets $_SESSION["username"] and $_SESSION["type"]
    */
    session_start();
    if (!isset($_SESSION["username"])) {
        unset($_SESSION["username"]);
        unset($_SESSION["type"]);
    }
    header("Location: product.html");
    die();
?>