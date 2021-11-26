<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Listing</title>
    <link rel="stylesheet" href="product.css">
</head>

<body>
    <div class="topbar">
        <div class="title">Site Title</div><!--
        --><div class="topnav"><a href="">Categories</a>|<a href="">Contact us</a>|<a href="">Follow us</a></div><!--
        --><div class="search1"><input type="text" placeholder="Search"></div>
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
                        echo '<a href="product.php?category_name=' . $row["category_name"] . '">' . $row["category_name"] . '<a><br>';
                    }
                ?>
            </div>
        </div><!--

        --><div class="center">
            <div class="centerheader">Top Products</div>
            <div class="centerlist" id="centerlist">
            </div>
        </div>
    </div>
</body>
<script src="product.js"></script>
</html>