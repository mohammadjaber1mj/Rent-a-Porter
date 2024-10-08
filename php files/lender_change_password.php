<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['lender'])) {
    header("Location: become_a_lender.php");
    exit();
}

// Include database connection
require("dbconnect.php");

$lender_email = $_SESSION['lender'];
$email_result = mysqli_query($DBConnect, "SELECT password FROM lenders where email='$lender_email';")
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
        $sql = "UPDATE lenders SET password = ? WHERE email = ?;";
        if ($stmt = mysqli_prepare($DBConnect, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $hashedPassword, $lender_email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header("Location: lender_signout.php");
            exit();
        }
    } else {
        // Set an error message
        $_SESSION['error_message'] = 'The current password you entered is incorrect.';
        header("Location: lender_account.php");
        exit();
    }
}

header("Location: lender_account.php");
exit();
