<?php
$conn = mysqli_connect("localhost", "root", "", "food-ordering-system") or die("Connection Failed");
session_start();


if (isset($_POST['add'])) {
    if (!isset($_SESSION['user_email'])) {
        echo "<script>alert('Please login first!')</script>";
        echo "<script>window.location='login.php'</script>";
    }
    if (isset($_SESSION['cart'])) {
        $item_array_id = array_column($_SESSION['cart'], 'product_id');
        if (in_array($_POST['productid'], $item_array_id)) {
            echo "<script>alert('Product already added!')</script>";
            echo "<script>window.location='index.php'</script>";
            print_r($_SESSION['cart']);
        } else {
            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['productid']
            );
            $_SESSION['cart'][$count] = $item_array;
            print_r($_SESSION['cart']);
            echo "<script>window.location='index.php'</script>";
        }
    } else {
        $item_array = array(
            'product_id' => $_POST['productid']
        );
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
        // echo "<script>window.location='index.php'</script>";
    }
}
if (isset($_POST['search-btn'])) {
    $str = $_POST['search'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Foods Restaurant</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#">
                    <img src="images/myLogo.png" alt="Restaurant Logo">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a href="index.php#menu-section">Food Menu</a>
                    </li>
                    <li>
                        <a href="Cart.php">Cart
                            <?php if (isset($_SESSION['cart'])) {
                                $count = count($_SESSION['cart']);
                            ?>
                                <span style="color: red;">[<?php echo "$count"; ?>]</span>
                            <?php } else { ?>
                                <span style="color: red;"> [0]</span>
                            <?php } ?>

                        </a>
                    </li>
                    <?php
                    if (isset($_SESSION["user_email"])) {
                    ?>
                        <li>
                            <a href="logout.php"><?php echo $_SESSION["user_name"] ?> Log Out</a>
                        </li>
                    <?php
                    } else {
                    ?>
                        <li>
                            <a href="login.php">Log In</a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->

    <!--SEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">

            <form action="search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="search-btn" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- SEARCH Section Ends Here -->

    <!--Menu Section Starts Here -->
    <h1 class="text-center" style="margin: 30px 0">Food Menu</h1>
    <section class="food-menu" id="menu-section">
        <div class="menu-container">
            <div class="menu">
                <h2 class="menu-group-heading">
                    Bengali
                </h2>
                <div class="menu-group">
                    <?php
                    // $conn = mysqli_connect("localhost","root","","food-ordering-system") or die("Connection Failed");
                    $sql = "SELECT * FROM product where type = 'Bengali' and available = 1 and name like '%{$str}%'";
                    $result = mysqli_query($conn, $sql) or die("Query Failed");

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                                <div class="menu-item">
                                    <img class="menu-item-image" src="<?php echo $row['image'] ?>" alt="Biryani">
                                    <div class="menu-item-text">
                                        <h3 class="menu-item-heading">
                                            <span class="menu-item-name"><?php echo $row['name'] ?></span>
                                            <span class="menu-item-price">৳ <?php echo $row['price'] ?></span>
                                        </h3>
                                        <div class="menu-item-description">
                                            <p><?php echo $row['description'] ?></p>
                                            <span class="add-to-cart"><button type="submit" name="add" class="atc-btn">Add to Cart Now</button></span>
                                        </div>
                                        <input type="hidden" name="productid" value="<?php echo $row['pid'] ?>">
                                    </div>
                                </div>
                            </form>
                    <?php
                        }
                    }
                    ?>
                </div>
                <h2 class="menu-group-heading">
                    Sub Continental
                </h2>
                <div class="menu-group">
                    <?php
                    // $conn = mysqli_connect("localhost","root","","food-ordering-system") or die("Connection Failed");
                    $sql = "SELECT * FROM product where type = 'Sub Continental' and available = 1 and name like '%{$str}%'";
                    $result = mysqli_query($conn, $sql) or die("Query Failed");

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                                <div class="menu-item">
                                    <img class="menu-item-image" src="<?php echo $row['image'] ?>" alt="Biryani">
                                    <div class="menu-item-text">
                                        <h3 class="menu-item-heading">
                                            <span class="menu-item-name"><?php echo $row['name'] ?></span>
                                            <span class="menu-item-price">৳ <?php echo $row['price'] ?></span>
                                        </h3>
                                        <div class="menu-item-description">
                                            <p><?php echo $row['description'] ?></p>
                                            <span class="add-to-cart"><button type="submit" name="add" class="atc-btn">Add to Cart Now</button></span>
                                            <input type="hidden" name="productid" value="<?php echo $row['pid'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                    <?php
                        }
                    }
                    ?>
                </div>
                <h2 class="menu-group-heading">
                    Western
                </h2>
                <div class="menu-group">
                    <?php
                    // $conn = mysqli_connect("localhost","root","","food-ordering-system") or die("Connection Failed");
                    $sql = "SELECT * FROM product where type = 'Western' and available = 1 and name like '%{$str}%'";
                    $result = mysqli_query($conn, $sql) or die("Query Failed");

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                                <div class="menu-item">
                                    <img class="menu-item-image" src="<?php echo $row['image'] ?>" alt="Biryani">
                                    <div class="menu-item-text">
                                        <h3 class="menu-item-heading">
                                            <span class="menu-item-name"><?php echo $row['name'] ?></span>
                                            <span class="menu-item-price">৳ <?php echo $row['price'] ?></span>
                                        </h3>
                                        <div class="menu-item-description">
                                            <p><?php echo $row['description'] ?></p>
                                            <span class="add-to-cart"><button type="submit" name="add" class="atc-btn">Add to Cart Now</button></span>
                                            <input type="hidden" name="productid" value="<?php echo $row['pid'] ?>">
                                        </div>
                                    </div>
                                </div>
                            </form>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!--Menu Section Ends Here -->
    <!--contact section starts here -->
    <h1 class="text-center" style="margin: 30px 0">Contact Us</h1>
    <section id="contact-section">
        <div class="contact-container">
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3690.366633519253!2d91.83588601421545!3d22.339781147107573!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30ad27b8b50b6325%3A0x9b52f9ab53fcb57d!2sTeri%20bazar!5e0!3m2!1sen!2sbd!4v1656206522846!5m2!1sen!2sbd" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

            <div class="contact-details">
                <h3>Contact Details</h3> <br>

                <div>
                    <h5>Unique Foods Restaurant</h5>
                    <address>
                        245, Ghatforhadbeg,Kotwali,Chittagong
                    </address> <br>
                </div>

                <div>
                    <h5>Phone : </h5>
                    <p>+8801710444700</p><br>
                </div>
                <div>
                    <h5>Opening hours :</h5>
                    <p>
                        Everyday: 9 A.M. to 11P.M. <br>
                        Inc. Bank Holidays <br>
                    </p>
                </div>
            </div>
            <div class="social">
                <ul>
                    <li>
                        <a href="http://www.facebook.com"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png" /></a>
                    </li>
                    <li>
                        <a href="http://www.instagram.com"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png" /></a>
                    </li>
                    <li>
                        <a href="http://www.twitter.com"><img src="https://img.icons8.com/fluent/48/000000/twitter.png" /></a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Contact Section Ends Here -->
    <!-- footer Section Starts Here -->
    <section class="footer">
        <div style="background-color: #595b83; text-align: center; color: white; margin-bottom: 50px; padding: 50px;">
            <p>&copyAll rights reserved. Unique Foods</p>
        </div>
    </section>
    <!-- footer Section Ends Here -->
</body>

</html>
<?php

?>