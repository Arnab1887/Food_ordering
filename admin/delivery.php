<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Please login first!')</script>";
    echo "<script>window.location='login.php'</script>";
}
$oid = number_format($_GET['id']);
$conn = mysqli_connect("localhost", "root", "", "food-ordering-system") or die("Connection Failed");
$sql = "UPDATE `orders` SET `delivery_status` = 1 WHERE `order_id` = '{$oid}' ";
$result = mysqli_query($conn, $sql) or die("Query Failed");
echo "<script>window.location='index.php'</script>";
