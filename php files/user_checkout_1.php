<?php
session_start();

require("dbconnect.php");

if (!isset($_SESSION['user'])) {
    header("Location: user_signin.php");
    exit();
}

$user_email = $_SESSION['user'];
$email_result = mysqli_query($DBConnect, "SELECT user_id FROM users WHERE email='$user_email'")
    or die(mysqli_error($DBConnect));
if ($row = mysqli_fetch_array($email_result)) {
    $user_id = $row["user_id"];
}

// Check if cart is empty
$cart_result = mysqli_query($DBConnect, "SELECT * FROM cart WHERE user_id='$user_id'");
if (mysqli_num_rows($cart_result) == 0) {
    // Redirect to cart page if cart is empty
    header("Location: cart.php");
    exit();
}

// Check if there are items in the cart_item table for the current cart
$cart_id = mysqli_fetch_assoc($cart_result)["cart_id"];
$cart_item_result = mysqli_query($DBConnect, "SELECT * FROM cart_item WHERE cart_id='$cart_id'");
if (mysqli_num_rows($cart_item_result) == 0) {
    // Redirect to cart page if no items found in cart_item
    echo "<script>alert('Your cart is empty! Redirecting to cart page...');</script>";
    header("Refresh:0; url=cart.php");
    exit();
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
                        <form action="user_checkout_2.php" method="POST">
                            <div class="row">
                                <div class="col">
                                    <input type="radio" id="delivery" name="shipping_method" value="delivery" onclick="showDeliveryInfo()">
                                    <label for="delivery">
                                        <h6>DELIVERY</h6>
                                    </label>
                                </div>
                                <div class="col">
                                    <input type="radio" id="pickup" name="shipping_method" value="pickup" onclick="showPickupInfo()">
                                    <label for="pickup">
                                        <h6>PICKUP</h6>
                                    </label>
                                </div>
                            </div>
                            <hr style="color: #E7687D;">
                            <div id="delivery_info" style="display:none;">
                                <?php
                                $address_query = $DBConnect->prepare("SELECT * FROM user_address WHERE user_id = ?");
                                $address_query->bind_param("s", $user_id);
                                $address_query->execute();
                                $result = $address_query->get_result();
                                //var_dump($result);
                                //$address_query = mysqli_query($DBConnect,);
                                if ($result->num_rows > 0) {
                                    $address_row = $result->fetch_assoc();

                                    $country = $address_row["country"];
                                    $city = $address_row["city"];
                                    $street = $address_row['street'];
                                    $building = $address_row['building'];
                                    $floor = $address_row['floor'];

                                    $full_address = $country . ", " . $city . ", " . $street . ", " . $building . ", " . $floor;
                                    echo "<p>Your delivery address: " . htmlspecialchars($full_address) . "</p>";
                                    echo "<a href='edit_user_address.php' class='button_become_a_lender'>Edit</a>";
                                    echo "<p>Delivery charge: $10</p>";
                                } else {
                                    echo "<a href='user_add_address.php' class='button_become_a_lender'>Add Address</a>";
                                }
                                ?>
                            </div>
                            <div id="pickup_info" style="display:none; text-align: left;">
                                <div class="col">
                                    <div class="row">
                                        <h6>SHOWROOM DETAILS:</h6>
                                    </div>
                                    <div class="row">
                                        <p>Opening Hours: Monday till Saturday: 10:00 AM - 08:00 PM</p>
                                        <p>Phone:+961 76 811 429</p>
                                        <p>Email:leb@rent-a-porter.com</p>
                                        <p>Address: Achrafieh, 150 Abdul Wahab El Inglizi Street, Saint Antoine Bldg. ground fl. Beirut, Lebanon</p>
                                    </div>
                                    <hr style="color: #E7687D;">
                                    <h6>Delivery charge: $0</h6>
                                </div>
                            </div>
                            <button id="nextButton" class="form-btn">NEXT</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <a href="cart.php" class="btn btn-default">X</a>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    function showDeliveryInfo() {
        document.getElementById('delivery_info').style.display = 'block';
        document.getElementById('pickup_info').style.display = 'none';
        enableNextButton();
    }

    function showPickupInfo() {
        document.getElementById('pickup_info').style.display = 'block';
        document.getElementById('delivery_info').style.display = 'none';
        enableNextButton();
    }

    function enableNextButton() {
        document.getElementById('nextButton').style.pointerEvents = 'auto';
        document.getElementById('nextButton').style.opacity = 1;
    }

    window.onload = function() {
        document.getElementById('nextButton').style.pointerEvents = 'none';
        document.getElementById('nextButton').style.opacity = 0.5;
    }
</script>
</script>