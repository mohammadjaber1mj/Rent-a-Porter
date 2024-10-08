<?php
session_start();

require("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection
    // Replace DB_CONNECTION_CODE with your database connection logic

    // Retrieve form data
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into the database
    $sql = "INSERT INTO `lenders` (`fname`, `lname`, `phone_number`, `email`, `password`) VALUES ('$fname', '$lname', '$phone', '$email', '$hashedPassword')";
    $result = mysqli_query($DBConnect, $sql);

    // Perform the query (not recommended, use prepared statements)
    // Replace DB_QUERY_EXECUTION with your method for executing queries
    if ($result) {
        $_SESSION['lender'] = $email;
        header("Location: lender_dashboard.php");
    } else {
        echo "Registration failed.";
    }
    $DBConnect->close();
}
