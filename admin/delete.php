<?php
session_start();
if (!isset($_SESSION['admin'])) {
    echo "<script>alert('Please login first!')</script>";
    echo "<script>window.location='login.php'</script>";
}
$pid = number_format($_GET['id']);
$conn = mysqli_connect("localhost", "root", "", "food-ordering-system") or die("Connection Failed");
$sql = "DELETE FROM `product` WHERE `pid` = '{$pid}' ";
$result = mysqli_query($conn, $sql) or die("Query Failed");
echo "<script>window.location='allProduct.php'</script>";
