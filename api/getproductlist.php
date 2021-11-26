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
            "imgurl": [{"imgurl": string}, ...],
            "rating": float,
            "review_count": int
        },
        ...
    ]
    if has parameter "category", returns only products of that category
    */
    include("database.php");
    if (!isset($_GET["category"])) {
        $productQuery = mysqli_query($dbc, "SELECT product.*, COALESCE(AVG(rating), 0) rating, COALESCE(COUNT(*), 0) review_count FROM product LEFT JOIN review ON review.product_id=product.product_id GROUP BY product.product_id");
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
        echo json_encode($response);
        mysqli_close($dbc);
    }
    else {
        $stmt = mysqli_stmt_init($dbc);
        $query = "
            SELECT product.*, COALESCE(AVG(rating), 0) rating, COALESCE(COUNT(*), 0) review_count
            FROM product LEFT JOIN review
            ON review.product_id=product.product_id
            WHERE product.product_id IN (
                SELECT product_id FROM has
                WHERE category_name LIKE ?
            )
            GROUP BY product.product_id
        ";
        mysqli_stmt_prepare($stmt, $query);
        mysqli_stmt_bind_param($stmt, "s", $_GET["category"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $response = array();
        while ($productRow = mysqli_fetch_assoc($result)) {
            $imgQuery = mysqli_query($dbc, "SELECT * FROM imgurl WHERE product_id LIKE " . $productRow["product_id"]);
            $imgList = array();
            while ($imgRow = mysqli_fetch_assoc($imgQuery)) {
                $imgList[] = $imgRow;
            }
            $productRow["imgurl"] = $imgList;
            $response[] = $productRow;
        }
        echo json_encode($response);
        mysqli_close($dbc);
    }
    header("HTTP/1.1 200 OK");
?>