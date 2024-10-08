<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: user_signin.php");
    exit();
}

// Include database connection
require("dbconnect.php");

$user_email = $_SESSION['user'];
$email_result = mysqli_query($DBConnect, "SELECT password FROM users where email='$user_email';")
    or die(mysqli_error($DBConnect));
if ($row = mysqli_fetch_array($email_result)) {
    $old_password = $row["password"];
}
// Check if the form data is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    if (password_verify($current_password, $old_password)) {
        $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET password = ? WHERE email = ?;";
        if ($stmt = mysqli_prepare($DBConnect, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $user_email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header("Location: user_signout.php");
            exit();
        }
    } else {
        // Set an error message
        $_SESSION['user_error_message'] = 'The current password you entered is incorrect.';
        header("Location: user_profile.php");
        exit();
    }
}

header("Location: user_profile.php");
exit();
