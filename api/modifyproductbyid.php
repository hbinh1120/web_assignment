<?php
    /*
    modify product by id, updates all specified parameters
    must be logged in as admin user
    */
    session_start();
    if (!isset($_SESSION["type"]) || $_SESSION["type"] != 1) {
        header("HTTP/1.1 403 Forbidden");
        die();
    }
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data) || !isset($data["product_id"])) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    include("database.php");
    if (isset($data["product_name"])) {
        $query = "UPDATE product SET product_name=? WHERE product_id=?";
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "si", $data["product_name"], $data["product_id"]);
        mysqli_stmt_execute($stmt);
    }
    if (isset($data["price"])) {
        $query = "UPDATE product SET price=? WHERE product_id=?";
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "ii", $data["price"], $data["product_id"]);
        mysqli_stmt_execute($stmt);
    }
    if (isset($data["description"])) {
        $query = "UPDATE product SET description=? WHERE product_id=?";
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "si", $data["description"], $data["product_id"]);
        mysqli_stmt_execute($stmt);
    }
    if (isset($data["stock"])) {
        $query = "UPDATE product SET stock=? WHERE product_id=?";
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "ii", $data["stock"], $data["product_id"]);
        mysqli_stmt_execute($stmt);
    }
    if ($first) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    $query = $query . " WHERE product_id=?";


    if (mysqli_error($dbc) == "") {
        header("HTTP/1.1 200 OK");
    }
    else {
        header("HTTP/1.1 500 Interal Server Error");
    }
    die();
?>