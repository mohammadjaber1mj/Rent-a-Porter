<?php

session_start();

require("dbconnect.php");

if (!isset($_SESSION['user'])) {
    header("Location: user_signin.php");
    exit();
}

if (isset($_POST['dress_code'])) {
    $user_email = $_SESSION['user'];
    $dress_code = mysqli_real_escape_string($DBConnect, $_POST['dress_code']);

    // Check if already in favourites
    $email_result = mysqli_query($DBConnect, "SELECT * FROM users WHERE email='$user_email'")
        or die(mysqli_error($DBConnect));
    if ($row = mysqli_fetch_array($email_result)) {
        $user_fname = $row["fname"];
        $user_id = $row["user_id"];
    }
    $check_query = "SELECT * FROM favourites WHERE user_id='$user_id' AND dress_code='$dress_code'";
    $check_result = mysqli_query($DBConnect, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        echo "This item is already in your favourites.";
    } else {
        $insert_query = "INSERT INTO favourites (user_id, dress_code) VALUES ('$user_id', '$dress_code')";
        if (mysqli_query($DBConnect, $insert_query)) {
            echo "Added to favourites successfully!";
        } else {
            echo "Error adding to favourites: " . mysqli_error($DBConnect);
        }
    }
} else {
    echo "No dress code provided.";
}

header("Location: dress_details.php?dress_code=" . $_POST['dress_code']); // Redirect back
exit();
