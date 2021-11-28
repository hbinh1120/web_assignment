<?php
    /*
    modify user by username
    must be logged in
    */
    session_start();
    if (!isset($_SESSION["username"])) {
        header("HTTP/1.1 403 Forbidden");
        die();
    }
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data) || !isset($data["name"]) || !isset($data["password"]) || !isset($data["phone"]) || !isset($data["bdate"])) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    include("database.php");
    $query = "UPDATE user SET name=?, password=?, phone=?, bdate=? WHERE username=?";
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "ssiss", $data["name"], $data["password"], $data["phone"], $data["bdate"], $_SESSION["username"]);
    mysqli_stmt_execute($stmt);

    if (mysqli_error($dbc) == "") {
        header("HTTP/1.1 200 OK");
    }
    else {
        header("HTTP/1.1 500 Interal Server Error");
    }
?>