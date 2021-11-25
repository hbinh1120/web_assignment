<?php
    /*
    returns json array
    [
        {
            "product_id": int,
            "product_name": string,
            "price": int,
            "description": string,
            "stock": int,
            "imgurl": [{"imgurl": string}, ...]
        },
        ...
    ]
    */
    include("database.php");
    $productQuery = mysqli_query($dbc, "SELECT * FROM product");
    $response = array();
    while ($productRow = mysqli_fetch_assoc($productQuery)) {
        $imgQuery = mysqli_query($dbc, "SELECT * FROM imgurl WHERE product_id LIKE " . $productRow["product_id"]);
        $imgList = array();
        while ($imgRow = mysqli_fetch_assoc($imgQuery)) {
            $imgList[] = $imgRow;
        }
        $productRow["imgurl"] = $imgList;
        $response[] = $productRow;
    }
    header("HTTP/1.1 200 OK");
    echo json_encode($response);
    mysqli_close($dbc);
?>