<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Listing</title>
    <link rel="stylesheet" href="product.css">
</head>
<?php
    session_start();
    if (!isset($_SESSION["type"]) || $_SESSION["type"] != 1) header("Location: product.php");
?>
<body>
    <div class="topbar">
        <div class="title" onclick="window.location='product.php';">Site Title</div><!--
        --><div class="search1"><input type="text" placeholder="Search" id="search"><button onclick="window.location='cart.php';">Cart</button></div><!--
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
            <div class="centerheader" id="centerheader">
                Editing product
            </div>
            <div id="detailmain" id="detailmain">
                <div class="detailboth">
                    <div class="detailleft">
                        <div class="mainimage" id="mainimage"></div>
                        <div class="smallimagelist" id="smallimagelist"></div>
                    </div>
                    <div class="detailright">
                        <h2 class="detailname">Product name: <input type="text" id="detailname"></h2>
                        <div class="detaildescription">
                            Description: <textarea  id="detaildescription"></textarea>
                        </div>
                        <div>Price: <input type="text" id="price"></div>
                        <div class="detailstock">Stock: <input type="text" id="detailstock"></div>
                        
                        <?php
                            echo '<input type="button" onclick="update(\'' . $_GET["product_id"] . '\')" value="Save">';
                            echo '<input type="button" onclick="remove(\'' . $_GET["product_id"] . '\')" value="Delete">';
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="productedit.js"></script>
<script>
    <?php
        if (isset($_GET["product_id"])) {
            echo 'getProductById("' . $_GET["product_id"] . '");';
        }
    ?>
</script>
</html>