<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "assignment";
    $dbc = mysqli_connect($host, $username, $password);
    mysqli_select_db($dbc, $database);
?>