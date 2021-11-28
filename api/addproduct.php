<?php
    /*
    add new product
    must be logged in as admin
    */
    session_start();
    if (!isset($_SESSION["username"]) || $_SESSION["type"] != 1) {
        header("HTTP/1.1 403 Forbidden");
        die();
    }
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data)) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    include("database.php");
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, "INSERT INTO product (product_name, description, price, stock) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssii", $data["product_name"], $data["description"], $data["price"], $data["stock"]);
    mysqli_stmt_execute($stmt);
    if (mysqli_error($dbc) == "") {
        header("HTTP/1.1 200 OK");
    }
    else {
        header("HTTP/1.1 500 Interal Server Error");
    }
    die();
?>