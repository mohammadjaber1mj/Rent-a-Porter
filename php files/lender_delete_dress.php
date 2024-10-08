<?php
session_start();

if (!isset($_SESSION['lender'])) {
    header("Location: login.php");
    exit();
}

include "dbconnect.php";

if (isset($_POST['dress_code'])) {
    $dress_code = $_POST['dress_code'];
    $sql = "DELETE FROM dresses WHERE dress_code = ?";
    
    if ($stmt = mysqli_prepare($DBConnect, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $dress_code);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}

header("Location: lender_items.php");
exit();