<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Please login first!')</script>";
    echo "<script>window.location='login.php'</script>";
}
$conn = mysqli_connect("localhost", "root", "", "food-ordering-system") or die("Connection Failed");
$sql = "SELECT * FROM product ";
$result = mysqli_query($conn, $sql) or die("Query Failed");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Foods Restaurant</title>
    <link rel="stylesheet" href="css/product.css">
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

    <div class="container" id="main-content">
        <h2>All products</h2>
        <table cellpadding="7px">
            <thead>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Type</th>
                <th>Image Location</th>
                <th>Description</th>
                <th>Price</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['pid'] ?></td>
                            <td><?php echo $row['name'] ?></td>
                            <td><?php echo $row['type'] ?></td>
                            <td><?php echo $row['image'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['price'] ?></td>
                            <td>
                                <a href='edit.php?id=<?php echo $row['pid']; ?>'>Edit</a>
                                <a href='delete.php?id=<?php echo $row['pid']; ?>'>Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>