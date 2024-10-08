<?php
session_start();

require("dbconnect.php");

if (!isset($_SESSION['user'])) {
    header("Location: user_signin.php");
    exit();
}

if (isset($_POST['shipping_method'])) {
    $_SESSION['shipping_option'] = $_POST['shipping_method'];
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
                        <p class="title"><img src="images/business_cash_coin_dollar_finance_money_payment_icon_123244.png" alt=""> PAYMENT</p>
                        <form class="form" action="" method="POST">
                            <hr style="color: #E7687D;">
                            <div id="card_info" style="text-align: left;">
                                <h5>Please note that we currently do not accept card payments.</h5>
                                <br>
                                <h6>The amount in the summary will be expected from you upon reception of your items.</h6>
                            </div>
                            <a href="user_checkout_3.php" id="nextButton" class="form-btn" style="text-decoration: none;">NEXT</a>
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