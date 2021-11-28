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
            SELECT * FROM cart JOIN product ON cart.product_id=product.product_id WHERE username LIKE ?
        ";
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "s", $_SESSION["username"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $response = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $response[] = $row;
        }
        echo json_encode($response);
        header("HTTP/1.1 200 OK");
        mysqli_close($dbc);
        die();
    }
    header("HTTP/1.1 403 Forbidden");
?>