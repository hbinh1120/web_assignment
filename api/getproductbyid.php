<?php
    /*
    returns json object
    {
        "product_id": int,
        "product_name": string,
        "price": int,
        "description": string,
        "stock": int,
        "imgurl": [{"imgurl": string}, ...]
    }
    */
    if (!isset($_GET["id"])) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    include("database.php");
    $stmt = mysqli_stmt_init($dbc);
    mysqli_stmt_prepare($stmt, "SELECT * FROM product WHERE product_id=?");
    mysqli_stmt_bind_param($stmt, "i", $_GET["id"]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        header("HTTP/1.1 200 OK");
        echo json_encode($row);
        mysqli_close($dbc);
        die();
    }
    header("HTTP/1.1 404 Not Found");
    mysqli_close($dbc);
?>