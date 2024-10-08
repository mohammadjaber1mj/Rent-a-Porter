<?php
session_start();

require("dbconnect.php");

if (!isset($_SESSION['user'])) {
    header("Location: user_signin.php");
    exit();
} else {
    $user_email = $_SESSION['user'];
    $email_result = mysqli_query($DBConnect, "SELECT users.user_id, cart.cart_id FROM users, cart WHERE email='$user_email' AND users.user_id=cart.user_id")
        or die(mysqli_error($DBConnect));
    if ($row = mysqli_fetch_array($email_result)) {
        $user_id = $row["user_id"];
        $cart_id = $row["cart_id"];
    }

    if (isset($_POST['submit'])) {
        $dress_code = $_POST['dress_code'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];

        // Insert into cart_item table
        $insert_sql = "INSERT INTO cart_item (cart_id, dress_code, start_date, end_date) VALUES ('$cart_id', '$dress_code', '$start_date', '$end_date')";
        if (mysqli_query($DBConnect, $insert_sql)) {
            // Redirect to cart page
            header("Location: cart.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($DBConnect);
        }
    }
}
