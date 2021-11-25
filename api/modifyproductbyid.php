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
    if (!empty($data) || !isset($data["product_id"])) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    $query = "UPDATE product SET ";
    $first = true;
    include("database.php");
    if (isset($data["product_name"])) {
        if ($first) {
            $first = false;
            $query = $query . "product_name=?";
        }
        else $query = $query . ", product_name=?";
    }
    if (isset($data["price"])) {
        if ($first) {
            $first = false;
            $query = $query . "price=?";
        }
        else $query = $query . ", price=?";
    }
    if (isset($data["description"])) {
        if ($first) {
            $first = false;
            $query = $query . "description=?";
        }
        else $query = $query . ", description=?";
    }
    if (isset($data["stock"])) {
        if ($first) {
            $first = false;
            $query = $query . "stock=?";
        }
        else $query = $query . ", stock=?";
    }
    if ($first) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    $query = $query . " WHERE product_id=?";

    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, $query);
    if (isset($data["product_name"])) mysqli_stmt_bind_param($stmt, "s", $data["product_name"]);
    if (isset($data["price"])) mysqli_stmt_bind_param($stmt, "i", $data["price"]);
    if (isset($data["description"])) mysqli_stmt_bind_param($stmt, "s", $data["description"]);
    if (isset($data["stock"])) mysqli_stmt_bind_param($stmt, "i", $data["stock"]);
    mysqli_stmt_bind_param($stmt, "i", $data["product_id"]);
    mysqli_stmt_execute($stmt);

    if (mysqli_error($dbc) == "") {
        header("HTTP/1.1 200 OK");
    }
    else {
        header("HTTP/1.1 500 Interal Server Error");
    }
    die();
?>