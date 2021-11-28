<?php
    /*
    returns json object
    {
        "username": string,
        "name": string,
        "phone": int,
        "bdate": date,
        "type": int
    }
    */
    if (!isset($_GET["username"])) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    include("database.php");
    $stmt = mysqli_stmt_init($dbc);
    $query = "
        SELECT * FROM user WHERE username=?
    ";
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "i", $_GET["username"]);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
        header("HTTP/1.1 200 OK");
        echo json_encode($row);
        mysqli_close($dbc);
        die();
    }
?>