<?php
    /*
    sets $_SESSION["username"] and $_SESSION["type"]
    */
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);
    if (!empty($data) || !isset($data["username"]) || !isset($data["password"])) {
        header("HTTP/1.1 400 Bad Request");
        die();
    }
    if (!isset($_SESSION["username"])) {
        include("database.php");
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, "SELECT * FROM user WHERE username=? AND password=?");
        mysqli_stmt_bind_param($stmt, "s", $data["username"]);
        mysqli_stmt_bind_param($stmt, "s", $data["password"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            header("HTTP/1.1 200 OK");
            $_SESSION["username"] = $_POST["username"];
            $_SESSION["type"] = $row["type"];
            header("Location: product.html");
            die();
        }
    }
    else {
        header("Location: product.html");
        die();
    }
?>