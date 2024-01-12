<?php
if (isset($_POST['login'])) {
    $user_email = $_POST['email'];
    $user_password = md5($_POST['password']);

    $conn = mysqli_connect("localhost", "root", "", "food-ordering-system") or die("Connection Failed");
    $sql = "SELECT * FROM admin where email = '{$user_email}' AND password = '{$user_password}' ";
    $result = mysqli_query($conn, $sql) or die("Query Failed");

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            session_start();
            $_SESSION["admin"] = $row['email'];
            echo "<script>window.location='index.php'</script>";
        }
    } else {
        echo "<script>alert('Wrong Password!')</script>";
        echo "<script>window.location='login.php'</script>";
    }
}
