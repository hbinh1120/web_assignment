<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Listing</title>
    <link rel="stylesheet" href="product.css">
</head>
<?php
    session_start();
    if (!isset($_SESSION["username"])) header("Location: /assignment/product.php");
?>
<body>
    <div class="topbar">
        <div class="title" onclick="window.location='product.php';">Weboe</div><!--
        --><div class="search1"><input type="text" placeholder="Search" id="search"><button onclick="window.location='cart.php';"></button></div><!--
        --><div class="topnav"><a href="about.php">About Us</a>|<?php
        if (!isset($_SESSION["username"])) echo '<a href="login.php">Login</a>';
        else {
            echo '<a href="profile.php?username=' . $_SESSION["username"] . '">Profile</a>|';
            echo '<a href="api/logout.php">Logout</a>';
        }
        ?>
        </div>
    </div>
    
    <div class="main">
        <div class="left">
            <div class="lefttitle">Category</div>
            <div class="leftlist" id="leftlist">
                <?php
                    include("api/database.php");
                    $stmt = mysqli_stmt_init($dbc);
                    mysqli_stmt_prepare($stmt, "SELECT * FROM category");
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $response = array();
                    while ($productRow = mysqli_fetch_assoc($result)) {
                        $response[] = $productRow;
                    }
                    mysqli_close($dbc);
                    foreach ($response as $row) {
                        echo '<a href="product.php?category_name=' . $row["category_name"] . '">' . $row["category_name"] . '</a><br>';
                    }
                ?>
            </div>
        </div><!--

        --><div class="center">
            <table class="cart" id="cart">
                <tr>
                    <th>Product</th>
                    <th>Number</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                <?php
                    include("api/database.php");
                    $stmt = mysqli_stmt_init($dbc);
                    $query = "
                        SELECT * FROM cart JOIN product ON cart.product_id=product.product_id WHERE username LIKE ?
                    ";
                    mysqli_stmt_prepare($stmt, $query);
                    mysqli_stmt_bind_param($stmt, "s", $_SESSION["username"]);
                    mysqli_stmt_execute($stmt);
                    $result = mysqli_stmt_get_result($stmt);
                    $cart = array();
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cart[] = $row;
                    }

                    foreach ($cart as $cartitem) {
                        if ($cartitem["number"] != 0) {
                            echo '<tr>';

                            echo '<td>' . $cartitem["product_name"] . '</td>';
                            echo '<td>' . $cartitem["number"] . '</td>';
                            echo '<td>' . $cartitem["number"] * $cartitem["price"] . '</td>';
                            echo '<td><input type="button" value="x" onclick="remove(\'' . $cartitem["product_id"] . '\')"></td>';

                            echo '</tr>';
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="cart.js"></script>
</html>