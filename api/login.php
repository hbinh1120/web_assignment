<?php
    /*
    sets $_SESSION["username"] and $_SESSION["type"]
    returns json object {"status": int}
    1 for successful login, 0 for failure
    */
    session_start();
    $data = json_decode(file_get_contents('php://input'), true);
    if (empty($data) || !isset($data["username"]) || !isset($data["password"])) {
        header("HTTP/1.1 400 Bad Request");
        echo '{"status": 0}';
        die();
    }
    if (!isset($_SESSION["username"])) {
        include("database.php");
        $stmt = mysqli_stmt_init($dbc);
        mysqli_stmt_prepare($stmt, "SELECT * FROM user WHERE username=? AND password=?");
        mysqli_stmt_bind_param($stmt, "ss", $data["username"], $data["password"]);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION["username"] = $data["username"];
            $_SESSION["type"] = $row["type"];
            header("HTTP/1.1 200 OK");
            echo '{"status": 1}';
            die();
        }
        header("HTTP/1.1 200 OK");
        echo '{"status": 0}';
    }
    else {
        header("HTTP/1.1 200 OK");
        echo '{"status": 0}';
        die();
    }
?>