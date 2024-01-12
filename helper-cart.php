<?php
session_start();
if (isset($_POST['check-out-button'])) {
    $productsPlusQtyArr = explode("-", $_POST['value_qty']);
    $products = array(); //initialize $products as an array
    foreach ($productsPlusQtyArr as $product) :
        $productArr = explode("_", $product);
        echo "PID=> " . $productArr[0] . " => QTY => " . $productArr[1] . "<br>";
    // array_push($products, [
    //     "pid" => $productArr[0],
    //     "qty" => $productArr[1]
    // ]);
    endforeach;
    // foreach ($products as $p) :
    //     echo "PID=> " . $p['pid'] . " => QTY => " . $p['qty'] . "<br>";
    // endforeach;
    // echo "<pre>";
    // print_r($products);
    // echo "</pre>";
    //exit();
    $grand_total = $_POST['grand_total'];
    $user_email = $_SESSION['user_email'];
    $conn = mysqli_connect("localhost", "root", "", "food-ordering-system") or die("Connection Failed");
    $sql = "SELECT * FROM user where email = '{$user_email}' ";
    $result = mysqli_query($conn, $sql) or die("Query Failed");
    while ($row = mysqli_fetch_assoc($result)) {
        $user_name = $row['name'];
        $user_address = $row['address'];
        $user_mobile = $row['mobile'];
        $user_id = $row['uid'];
    }
    $sql = "INSERT INTO `orders` (`customer_id`, `customer_name`, `address`, `mobile`, `price`,`delivery_status`) VALUES ('{$user_id}', '{$user_name}', '{$user_address}', '{$user_mobile}', '$grand_total', '0')";
    $result = mysqli_query($conn, $sql) or die("Query Failed");
    unset($_SESSION['cart']);
    echo "<script>window.location='index.php'</script>";
}
