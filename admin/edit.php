<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Please login first!')</script>";
    echo "<script>window.location='login.php'</script>";
}
$pid = number_format($_GET['id']);
$conn = mysqli_connect("localhost", "root", "", "food-ordering-system") or die("Connection Failed");
$sql = "SELECT * FROM `product` WHERE pid = '{$pid}' ";
$result = mysqli_query($conn, $sql) or die("Query Failed");
$row = mysqli_fetch_assoc($result);
if (isset($_POST['update-menu'])) {
    $product_name = $_POST['product-name'];
    $image_location = $_POST['image-location'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $availability = $_POST['availability'];
    $sql = "UPDATE `product` SET `name` = '{$product_name}', `description` = '{$description}', `price` = '{$price}', `type` = '{$type}', `available` = '{$availability}', `image` = '{$image_location}' WHERE `pid` = '{$pid}' ";
    $result = mysqli_query($conn, $sql) or die("Query Failed");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Foods Restaurant</title>
    <link rel="stylesheet" href="css/edit.css">
</head>

<body>
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
                        <a href="allProduct.php">See All Products</a>
                    </li>
                    <li>
                        <a href="add.php">Add Food Menu</a>
                    </li>
                    <?php
                    if (isset($_SESSION["admin"])) {
                    ?>
                        <li>
                            <a href="logout.php">Log Out</a>
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

    <div id="wrapper">
        <div id="main-content">
            <h2>Update Record</h2>
            <form class="post-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="product-name" value="<?php echo $row['name'] ?>" required />
                </div>
                <div class="form-group">
                    <label>Image Location</label>
                    <input type="text" name="image-location" value="<?php echo $row['image'] ?>" required />
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input class="special_class" type="text" name="description" value="<?php echo $row['description'] ?>" required />
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" value="<?php echo $row['price'] ?>" required />
                </div>
                <div class="form-group">
                    <label>Type</label>
                    <select name="type" required>
                        <option value="" selected disabled>Select Class</option>
                        <option value="Bengali">Bengali</option>
                        <option value="Western">Western</option>
                        <option value="Sub Continental">Sub Continental</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Availability</label>
                    <select name="availability" required>
                        <option value="" selected disabled>Select Class</option>
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>
                </div>
                <input class="submit" type="submit" name="update-menu" value="UPDATE" />
            </form>
        </div>
    </div>
</body>

</html>