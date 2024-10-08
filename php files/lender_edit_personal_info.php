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
// Check if the form data is posted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    // Prepare and bind
    $sql = "UPDATE lenders SET fname = ?, lname = ?, email = ?, phone_number = ? WHERE email = ?;";
    if ($stmt = mysqli_prepare($DBConnect, $sql)) {
        mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $email, $phone_number, $lender_email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

header("Location: lender_account.php");
exit();
