<!--<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Listing</title>
    <link rel="stylesheet" href="product.css">
</head>

<body>
    <form>
        <input type="text" id="username">
        <input type="password" id="password">
        <input type="button" value="login" onclick="login()">
    </form>
</body>
<script src="login.js"></script>
</html>
-->
<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Listing</title>
    <link rel="stylesheet" href="product.css">
</head>
<?php
    session_start();
    if (isset($_SESSION["username"])) header("Location: product.php");
?>
<body>
    <div class="topbar">
        <div class="title" onclick="window.location='product.php';">Weboe</div><!--
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
        <div class="loginform">
            <form>
                <div class="logintitle">
                    LOGIN
                </div>
                <div class="loginmain">
                    Username: 
                    <br>
                    <input type="text" id="username">
                    <br>
                    Password: 
                    <br>
                    <input type="password" id="password">
                    <br>
                    <div style="margin: 10px auto 0px auto; width: fit-content;">
                        <input type="button" value="login" onclick="login()">
                    </div>
                    <br>
                    <span class="wronglogin" id="wronglogin">Wrong username or password</span>      
                </div>
            </form>
        </div>
    </div>
</body>
<script src="login.js"></script>
</html>