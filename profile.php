<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Listing</title>
    <link rel="stylesheet" href="product.css">
</head>
<?php
    session_start();
?>
<body>
    <div class="topbar">
        <div class="title" onclick="window.location='product.php';">Site Title</div><!--
        --><div class="search1"><input type="text" placeholder="Search" id="search"><button>Cart</button></div><!--
        --><div class="topnav"><a href="">About Us</a>|<?php
        if (!isset($_SESSION["username"])) echo '<a href="login.html">Login</a></div>';
        else echo '<a href="api/logout.php">Logout</a></div>';
        ?>
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
            <div class="centerheader" id="centerheader">
                Profile
            </div>
            <div id="detailmain" style="display:none;" id="detailmain">
                <div class="detailleft">
                    <div class="mainimage" id="mainimage"></div>
                </div>
                <div class="detailright">
                    <h2 class="detailname" id="detailname">Sample Product Title</h2>
                    <div class="detailrating" id="detailrating"></div>
                    <div class="detailstock" id="detailstock"></div>
                    <input type="button" value="Buy now">
                </div>
                <div class="reviewlist" id="reviewlist"></div>
            </div>
        </div>
    </div>
</body>
<script src="profile.js"></script>
<script>
    <?php
        if (isset($_GET["username"])) {
            echo 'getUserByUsername("' . $_GET["username"] . '");';
            echo 'getReviewByUsername("' . $_GET["username"] . '");';
        }
    ?>
</script>
</html>