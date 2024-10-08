<?php
session_start();
require("dbconnect.php");

if (!isset($_SESSION['user'])) {
    header("Location: user_signin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dress_code = $_POST['dress_code'];
    $user_email = $_SESSION['user'];

    // Fetch user_id based on email
    $user_result = mysqli_query($DBConnect, "SELECT user_id FROM users WHERE email='$user_email'");
    if ($user_row = mysqli_fetch_assoc($user_result)) {
        $user_id = $user_row['user_id'];

        $cart_result = mysqli_query($DBConnect, "SELECT cart_id FROM cart WHERE user_id='$user_id'")
            or die(mysqli_error($DBConnect));
        if ($row = mysqli_fetch_array($cart_result)) {
            $cart_id = $row["cart_id"];
        }

        // Delete the favourite item
        $delete_sql = "DELETE FROM cart_item WHERE cart_id='$cart_id' AND dress_code='$dress_code'";
        if (mysqli_query($DBConnect, $delete_sql)) {
            header("Location: cart.php");
            exit();
        }
    }
}
