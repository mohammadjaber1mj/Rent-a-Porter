<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

require("dbconnect.php");

$user_email = $_SESSION["user"];
$email_result = mysqli_query($DBConnect, "SELECT * FROM users where email='$user_email'")
    or die(mysqli_error($DBConnect));
if ($row = mysqli_fetch_array($email_result)) {
    $user_id = $row["user_id"];
    $user_fname = $row["fname"];
    $user_lname = $row["lname"];
    $user_phone_number = $row["phone_number"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link rel="stylesheet" href="css/stylesheet.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Rent à Porter</title>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <ul>
            <li class="logo-li"><a href="index.php"><img src="images/rap_logo.jpeg" width=120px></a></li>
            <li><a href="user_profile.php">Account Details</a></li>
            <li><a href="user_orders.php">Order History</a></li>
            <li><a href="user_gift_cards.php">Gift Cards History</a></li>
            <hr style="color: #E7687D;">
            <li><a href="user_signout.php">Log Out</a></li>
        </ul>
    </div>
    <div class="sidebar_content" id="main-content">
        <button onclick="window.location.href='index.php'" style="position: fixed; top: 10px; right: 10px; z-index: 1000;">X</button>
        <h1>GIFT CARDS HISTORY</h1>
        <hr>
        <div class="row">
            <div class="col">
                <h4>FROM</h4>
            </div>
            <div class="col">
                <h4>TO</h4>
            </div>
            <div class="col">
                <h4>TO EMAIL</h4>
            </div>
            <div class="col">
                <h4>AMOUNT</h4>
            </div>
            <div class="col">
                <h4>PURCHASE DATE</h4>
            </div>
        </div>
        <hr style="color: #E7687D">
        <?php
        $cards_query = mysqli_query($DBConnect, "SELECT * FROM gift_cards WHERE user_id='$user_id'")
            or die(mysqli_error($DBConnect));
        while ($cards_row = mysqli_fetch_array($cards_query)) {
            $user_name = $cards_row["user_name"];
            $recipient_name = $cards_row["recipient_name"];
            $recipient_email = $cards_row["recipient_email"];
            $amount = $cards_row["amount"];
            $purchase_date = $cards_row["purchase_date"];

            echo "
                <div class='row'>
                    <div class='col'>
                        <p style='font-size: 18px; margin-top: 2rem;'> " . $user_name . " </p>
                    </div>
                    <div class='col'>
                        <p style='font-size: 18px; margin-top: 2rem;'>" . $recipient_name . "</p>
                    </div>
                    <div class='col'>
                        <p style='font-size: 18px; margin-top: 2rem; margin-right: 5rem;'>" . $recipient_email . "</p>
                    </div>
                    <div class='col'>
                    <p style='font-size: 18px; margin-top: 2rem;'>$" . $amount . "</p>
                    </div>
                    <div class='col'>
                    <p style='font-size: 18px; margin-top: 2rem;'>" . $purchase_date . "</p>
                    </div>
                    <hr>
                </div>
                <br>
                ";
        }
        ?>
</body>

</html>