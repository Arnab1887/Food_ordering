<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Please login first!')</script>";
    echo "<script>window.location='login.php'</script>";
}
$conn = mysqli_connect("localhost", "root", "", "food-ordering-system") or die("Connection Failed");
$sql = "SELECT * FROM orders order by delivery_status,customer_id";
$result = mysqli_query($conn, $sql) or die("Query Failed");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Unique Foods Restaurant</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="index.php">
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
        <h2>Pending Orders</h2>
        <table cellpadding="7px">
            <thead>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Price</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td><?php echo $row['order_id'] ?></td>
                            <td><?php echo $row['customer_name'] ?></td>
                            <td><?php echo $row['address'] ?></td>
                            <td><?php echo $row['mobile'] ?></td>
                            <td><?php echo $row['price'] ?></td>
                            <td>
                                <a href='order_details.php?id=<?php echo $row['order_id']; ?>'>Details</a>
                                <?php if ($row['delivery_status'] == 0) { ?>
                                    <a href='delivery.php?id=<?php echo $row['order_id']; ?>'>Mark Delivered</a>
                                <?php } ?>
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