<?php
    /*
    updates cart info
    */
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data)) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    include("database.php");
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, "INSERT INTO cart VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "isi", $data["number"], $_SESSION["username"], $data["product_id"]);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_prepare($stmt, "UPDATE cart SET number=? WHERE username LIKE ? AND product_id=?");
    mysqli_stmt_bind_param($stmt, "isi", $data["number"], $_SESSION["username"], $data["product_id"]);
    mysqli_stmt_execute($stmt);
    header("HTTP/1.1 200 OK");
?>