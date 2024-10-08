<?php
session_start();

require("dbconnect.php");

if (!isset($_SESSION['user'])) {
    header("Location: user_signin.php");
    exit();
}

$user_email = $_SESSION['user'];
$email_result = mysqli_query($DBConnect, "SELECT user_id FROM users WHERE email='$user_email'")
    or die("Error fetching user: " . mysqli_error($DBConnect));
$user_id = 0;
if ($row = mysqli_fetch_array($email_result)) {
    $user_id = $row["user_id"];
}

if (isset($_POST['submit'])) {

    $country = $_POST["country"];
    $city = $_POST["city"];
    $street = $_POST["street"];
    $building = $_POST["building"];
    $floor = $_POST["floor"];

    // Prepare an insert statement
    $insert_sql = "INSERT INTO `user_address`(`user_id`, `country`, `city`, `street`, `building`, `floor`) VALUES ('$user_id','$country','$city','$street','$building','$floor')";
    if (mysqli_query($DBConnect, $insert_sql)) {
        header("Location: card_checkout_1.php");
    } else {
        echo "Error: " . mysqli_error($DBConnect);
    }
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
    <title>Rent à Porter</title>
</head>

<body>
    <div class="container text-center">
        <div class="row" style="margin-top: 1rem;">
            <div class="col">
                <a href="index.php"><img src="images/rap_logo.jpeg" alt="rap_logo" width="150px"></a>
            </div>
            <div class="col-6" style="margin-top: 7rem;">
                <div class="sign_div">
                    <div class="form-container" style="width: 600px;">
                        <p class="title"><img src="images/shop_place_marker_address_location_pin_map_ecommerce_icon_224950.png" alt=""> SHIPPING</p>
                        <div style="position: relative; border: 2px solid black;">
                            <span class="close-button" onclick="closeCardAddressPopup()" style="position: absolute; top: 0; right: 10px; cursor: pointer;">&times;</span>
                            <h5>ADD YOUR ADDRESS</h5>
                            <hr>
                            <form action="" method="POST" style="background-color: white; padding: 20px; border-radius: 5px;">
                                <label for="country">Country:</label>
                                <input type="text" id="country" name="country" required>
                                <br><br>
                                <label for="city">City:</label>
                                <input type="text" id="city" name="city" required>
                                <br><br>
                                <label for="street">Street:</label>
                                <input type="text" id="street" name="street" required>
                                <br><br>
                                <label for="building">Building:</label>
                                <input type="text" id="building" name="building" required>
                                <br><br>
                                <label for="floor">Floor:</label>
                                <input type="number" id="floor" name="floor" required>
                                <br><br>
                                <input type="submit" name="submit" value="Save Address">
                            </form>
                        </div>
                        <br>
                        <a href="card_checkout_1.php"><button class="form-btn">NEXT</button></a>
                    </div>
                </div>
            </div>
            <div class="col">
                <a href="gift_card.php" class="btn btn-default">X</a>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    function closeCardAddressPopup() {
        window.location.href = 'card_checkout_1.php';
    }
</script>