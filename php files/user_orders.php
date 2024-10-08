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
        <h1>ORDER HISTORY</h1>
        <hr>
        <div class="row">
            <div class="col">
                <h4></h4>
            </div>
            <div class="col">
                <h4>DESIGNER</h4>
            </div>
            <div class="col">
                <h4>DESCRIPTION</h4>
            </div>
            <div class="col">
                <h4>RENTAL PRICE</h4>
            </div>
            <div class="col">
                <h4>FROM</h4>
            </div>
            <div class="col">
                <h4>TO</h4>
            </div>
        </div>
        <hr style="color: #E7687D">
        <?php
        $rentals_query = mysqli_query($DBConnect, "SELECT * FROM rentals WHERE user_id='$user_id'")
            or die(mysqli_error($DBConnect));
        while ($rentals_row = mysqli_fetch_array($rentals_query)) {
            $dress_code = $rentals_row["dress_code"];
            $dress_price = $rentals_row["price"];
            $start_date = $rentals_row["start_date"];
            $end_date = $rentals_row["end_date"];

            $dresses_sql = mysqli_query($DBConnect, "SELECT * FROM dresses, designers WHERE dresses.designer_id=designers.designer_id AND dresses.dress_code='$dress_code'")
                or die(mysqli_error($DBConnect));
            while ($dresses_row = mysqli_fetch_array($dresses_sql)) {
                $dress_image = $dresses_row['image'];
                $dress_description = $dresses_row['description'];
                $designer_name = $dresses_row['name'];

                echo "
                <div class='row'>
                    <div class='col'>
                        <img src='images/" . $dress_image . "' style='width: 100px;'>
                    </div>
                    <div class='col'>
                        <p style='font-size: 18px; margin-top: 2rem;'> " . $designer_name . " </p>
                    </div>
                    <div class='col'>
                        <p style='font-size: 18px; margin-top: 2rem;'>" . $dress_description . "</p>
                    </div>
                    <div class='col'>
                        <p style='font-size: 18px; margin-top: 2rem; margin-left: 2rem;'>$" . $dress_price . "</p>
                    </div>
                    <div class='col'>
                    <p style='font-size: 18px; margin-top: 2rem;'>" . $start_date . "</p>
                    </div>
                    <div class='col'>
                    <p style='font-size: 18px; margin-top: 2rem;'>" . $end_date . "</p>
                    </div>
                </div>
                <br>
                ";
            }
        }
        ?>
</body>

</html>