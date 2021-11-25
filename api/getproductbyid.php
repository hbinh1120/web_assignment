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
    $productQuery = mysqli_query($dbc, "SELECT * FROM product WHERE product_id = " . $_GET["id"]);
    while ($productRow = mysqli_fetch_assoc($productQuery)) {
        header("HTTP/1.1 200 OK");
        echo json_encode($productRow);
        mysqli_close($dbc);
        die();
    }
    if (mysqli_error($dbc) != "") {
        header("HTTP/1.1 500 Interal Server Error");
    }
    mysqli_close($dbc);
?>