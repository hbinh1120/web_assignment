<?php
    /*
    returns json array
    [
        {
            "username": string,
            "product_id": int,
            "rating": int,
            "comment": string
        },
        ...
    ]
    finds by product if has parameter product_id, or by username if has parameter username
    */
    if (isset($_GET["product_id"])) {
        include("database.php");
        $stmt = mysqli_stmt_init($dbc);
        $query = "
            SELECT * FROM review WHERE product_id=?
        ";
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "i", $_GET["product_id"]);
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
    if (isset($_GET["username"])) {
        include("database.php");
        $stmt = mysqli_stmt_init($dbc);
        $query = "
            SELECT * FROM review WHERE username LIKE ?
        ";
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "s", $_GET["username"]);
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
    header("HTTP/1.1 400 Bad Request");
?>