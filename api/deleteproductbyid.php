<?php
    /*
    deletes product by id
    */
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);
    if (!empty($data) || !isset($data["id"])) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    include("database.php");
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, "DELETE FROM product WHERE product_id=?");
    mysqli_stmt_bind_param($stmt, "s", $data["id"]);
    mysqli_stmt_execute($stmt);
    if (mysqli_error($dbc) == "") {
        header("HTTP/1.1 200 OK");
    }
    else {
        header("HTTP/1.1 500 Interal Server Error");
    }
    die();
?>