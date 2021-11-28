<?php
    /*
    updates cart info
    */
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);
    if (isset($_SESSION["username"])) {
        include("database.php");
        $stmt = mysqli_stmt_init($dbc);
        $query = "
            DELETE FROM cart WHERE product_id=?
        ";
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "i", $data["product_id"]);
        mysqli_stmt_execute($stmt);
        header("HTTP/1.1 200 OK");
        mysqli_close($dbc);
        die();
    }
    header("HTTP/1.1 403 Forbidden");
?>