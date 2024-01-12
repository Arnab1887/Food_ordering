<?php
    $conn = mysqli_connect("localhost","root","","food-ordering-system") or die("Connection Failed");
    session_start();
    session_unset();
    session_destroy();
    header("Location: http://localhost/demoProject/index.php");
?>