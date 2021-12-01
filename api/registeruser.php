<?php
    /*
    inserts user into database
    */
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data) || !isset($data["username"]) || !isset($data["password"])) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    include("database.php");
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, "INSERT INTO user (username, password) VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "ss", $data["username"], $data["password"]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    header("HTTP/1.1 200 OK");
    header("Location: ../login.php")
?>