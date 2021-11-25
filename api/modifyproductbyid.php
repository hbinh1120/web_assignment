<?php
    /*
    modify product by id, updates all specified parameters
    */
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);
    if (!empty($data) || !isset($data["id"])) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    include("database.php");
    if (isset($data["product_name"])) {
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, "UPDATE product SET product_name=? WHERE product_id=?");
        mysqli_stmt_bind_param($stmt, "s", $data["product_name"]);
        mysqli_stmt_bind_param($stmt, "s", $data["id"]);
        mysqli_stmt_execute($stmt);
    }
    if (isset($data["price"])) {
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, "UPDATE product SET price=? WHERE product_id=?");
        mysqli_stmt_bind_param($stmt, "i", $data["price"]);
        mysqli_stmt_bind_param($stmt, "s", $data["id"]);
        mysqli_stmt_execute($stmt);
    }
    if (isset($data["description"])) {
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, "UPDATE product SET description=? WHERE product_id=?");
        mysqli_stmt_bind_param($stmt, "s", $data["description"]);
        mysqli_stmt_bind_param($stmt, "s", $data["id"]);
        mysqli_stmt_execute($stmt);
    }
    if (isset($data["stock"])) {
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, "UPDATE product SET stock=? WHERE product_id=?");
        mysqli_stmt_bind_param($stmt, "i", $data["stock"]);
        mysqli_stmt_bind_param($stmt, "s", $data["id"]);
        mysqli_stmt_execute($stmt);
    }
    if (mysqli_error($dbc) == "") {
        header("HTTP/1.1 200 OK");
    }
    else {
        header("HTTP/1.1 500 Interal Server Error");
    }
    die();
?>