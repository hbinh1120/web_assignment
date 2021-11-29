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
            <div class="centerheader" id="centerheader">
                Profile
            </div>
            <div id="detailmain" id="detailmain">
                <div class="profileleft">
                    <div class="profileimage" id="profileimage">
                        <img src="img/user.png" alt="">
                    </div>
                </div>
                <div class="profileright">
                    <div class="username" id="username"></div>
                    <div class="password">Password: <input type="password" id="password"></div>
                    <div class="name">Full name: <input type="text" id="name"></div>
                    <div class="phone">Phone number: <input type="text" id="phone"></div>
                    <div class="bdate">Date of birth: <input type="text" id="bdate"></div>
                    <?php
                        if (isset($_SESSION["username"])) echo '<input type="button" onclick="update(\'' . $_SESSION["username"] . '\')" value="Save">'
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="profileedit.js"></script>
<script>
    <?php
        if (isset($_SESSION["username"])) {
            echo 'getUserByUsername("' . $_SESSION["username"] . '");';
        }
    ?>
</script>
</html>