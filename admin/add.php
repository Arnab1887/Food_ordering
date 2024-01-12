<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Please login first!')</script>";
    echo "<script>window.location='login.php'</script>";
}
if (isset($_POST['add-menu'])) {
    $product_name = $_POST['product-name'];
    $image_location = $_POST['image-location'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $type = $_POST['type'];
    $availability = $_POST['availability'];
    $conn = mysqli_connect("localhost", "root", "", "food-ordering-system") or die("Connection Failed");
    $sql = "INSERT INTO `product` (`name`, `description`, `price`, `type`, `available`, `image`) VALUES ('{$product_name}', '{$description}', '$price', '$type', '$availability', '$image_location')";
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
            <h2>Add Item</h2>
            <form class="post-form" action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                <div class="form-group">
                    <label>Product Name</label>
                    <input type="text" name="product-name" value="" required />
                </div>
                <div class="form-group">
                    <label>Image Location</label>
                    <input type="text" name="image-location" value="" required />
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <input class="special_class" type="text" name="description" value="" required />
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" name="price" value="" required />
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
                <input class="submit" type="submit" name="add-menu" value="ADD" />
            </form>
        </div>
    </div>
</body>

</html>