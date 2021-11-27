<?php
    /*
    add image url to product by id
    must be logged in as admin user
    */
    session_start();
    if (!isset($_SESSION["type"]) || $_SESSION["type"] != 1) {
        header("HTTP/1.1 403 Forbidden");
        die();
    }
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data) || !isset($data["product_id"]) || !isset($data["imgurl"])) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    include("database.php");
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, "INSERT INTO imgurl VALUES (?, ?)");
    mysqli_stmt_bind_param($stmt, "si", $data["imgurl"], $data["product_id"]);
    mysqli_stmt_execute($stmt);
    if (mysqli_error($dbc) == "") {
        header("HTTP/1.1 200 OK");
    }
    else {
        header("HTTP/1.1 500 Interal Server Error");
    }
    die();
?>