<?php
session_start();

if (!isset($_SESSION['lender'])) {
    header("Location: become_a_lender.php");
    exit();
} else {
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other desired page after logout
    header('Location: become_a_lender.php');
    exit;
}
