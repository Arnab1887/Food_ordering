<?php
$conn = mysqli_connect("localhost", "root", "", "food-ordering-system") or die("Connection Failed");
session_start();
if (count($_SESSION['cart']) == 0) {
    echo "<script>alert('Cart is empty')</script>";
    echo "<script>window.location='index.php'</script>";
}
if (isset($_POST['remove-btn'])) {
    $product_id = array_column($_SESSION['cart'], 'product_id');
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['product_id'] == $_POST['removeid']) {
            unset($_SESSION['cart'][$key]);
        }
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
    <link rel="stylesheet" href="css/cartz.css">
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
                        <a href="index.php#menu-section">Food Menu</a>
                    </li>
                    <li>
                        <a href="cart.php">Cart</a><span id="cart-count"></span>
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


    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Sub-total</th>
            </tr>
            <?php
            $product_id = array_column($_SESSION['cart'], 'product_id');
            foreach ($product_id as $id) {

                $sql = "SELECT * FROM product where pid = {$id}";
                $result = mysqli_query($conn, $sql) or die("Query Failed");
                $row = mysqli_fetch_assoc($result);
            ?>
                <tr>
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                        <td>
                            <div class="cart-info">
                                <img src="<?php echo $row['image']; ?>">
                                <div>
                                    <p style="font-size: 20px; text-align: center; margin-bottom: 10px"><?php echo $row['name']; ?></p>
                                    <input type="submit" name="remove-btn" value="Remove Item">
                                    <input type="hidden" name="removeid" value="<?php echo $row['pid']; ?>">
                                </div>
                            </div>
                        </td>
                        <td><input class="iquantity" onchange="subTotal()" type="number" value="1" min="1"></td>
                        <td>৳<?php echo $row['price']; ?>
                            <input type="hidden" class="ipid" value="<?php echo $row['pid']; ?>">
                            <input type="hidden" class="iprice" value="<?php echo $row['price']; ?>">
                        </td>
                        <td class="itotal"></td>
                    </form>
                </tr>
            <?php } ?>
        </table>

        <div class="total-price">
            <table>
                <tr>
                    <td>Total</td>
                    <td id="total"></td>
                </tr>
                <tr>
                    <td>Discount</td>
                    <td>৳0</td>
                </tr>
                <tr>
                    <td>Grand Total</td>
                    <td id="grandtotal"></td>
                </tr>
                <tr>
                    <td>
                        <form action="helper-cart.php" method="POST">
                            <input type="hidden" id="value_qty" name="value_qty" />
                            <input type="submit" class="check-out-btn" name="check-out-button" value="Proceed to Checkout"></input>
                            <input type="hidden" name="grand_total" id="grand_total">
                        </form>
                    </td>
                    <td><a href="index.php" class="continue-shopping-btn">Continue Shopping</a></td>
                </tr>
            </table>
        </div>
    </div>
    <section>
        <div style="background-color: #595b83; text-align: center; color: white;padding: 50px;">
            <p>&copyAll rights reserved. Unique Foods</p>
        </div>
    </section>
    <script>
        var iprice = document.getElementsByClassName('iprice');
        var ipid = document.getElementsByClassName('ipid');
        var iquantity = document.getElementsByClassName('iquantity');
        var itotal = document.getElementsByClassName('itotal');
        var total = document.getElementById('total');
        var grandtotal = document.getElementById('grandtotal');
        var gt = 0;

        function subTotal() {
            var pid_qty = "";
            gt = 0;
            for (i = 0; i < iprice.length; i++) {
                itotal[i].innerText = '৳' + (iprice[i].value) * (iquantity[i].value);
                if (i == (iprice.length - 1)) {
                    pid_qty += `${ipid[i].value}_${iquantity[i].value}`;
                } else {
                    pid_qty += `${ipid[i].value}_${iquantity[i].value}-`;
                }
                gt = gt + (iprice[i].value) * (iquantity[i].value);
            }
            total.innerText = '৳' + gt;
            grandtotal.innerText = '৳' + gt;
            document.getElementById("grand_total").value = gt;
            document.getElementById("value_qty").value = pid_qty;
        }

        // php code -> if(isset($_POST['grand_total'])) { $grandTotal = $_POST['grand_total']; }
        subTotal(); //calls the function whenever the page loads
    </script>
</body>

</html>