<?php
session_start();

require("dbconnect.php");

if (!isset($_SESSION['user'])) {
    header("Location: user_signin.php");
    exit();
}

if (!isset($_SESSION['recipient_name'], $_SESSION['recipient_email'], $_SESSION['amount'], $_SESSION['message'], $_SESSION['user_name'])) {
    header("Location: gift_card.php");
    exit();
} else {
    $recipient_name = $_SESSION['recipient_name'];
    $recipient_email = $_SESSION['recipient_email'];
    $user_name = $_SESSION['user_name'];
    $amount = $_SESSION['amount'];
    $message = $_SESSION['message'];

    $user_email = $_SESSION['user'];
    $email_result = mysqli_query($DBConnect, "SELECT user_id FROM users WHERE email='$user_email'")
        or die(mysqli_error($DBConnect));
    if ($row = mysqli_fetch_array($email_result)) {
        $user_id = $row["user_id"];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $purchased_date = date('Y-m-d');

        $insert_rental_query = "INSERT INTO gift_cards (recipient_name, recipient_email, amount, message, user_name, user_id, purchase_date) VALUES ('$recipient_name', '$recipient_email', '$amount', '$message', '$user_name', '$user_id', '$purchased_date')";
        mysqli_query($DBConnect, $insert_rental_query) or die(mysqli_error($DBConnect));

        echo "<script>
            alert('Your order has been placed. Delivery orders takes 2-3 bussiness days to arrive.');
            window.location.href='gift_card.php';
          </script>";
        exit();
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
                        <form action="card_checkout_3.php" method="POST">
                            <p class="title"><img src="images/checkmark_tick_done_checked_icon_178088.png" alt=""> SUMMARY</p>
                            <hr style="color: #E7687D;">
                            <?php
                            $recipient_name = $_SESSION['recipient_name'];
                            $user_name = $_SESSION['user_name'];
                            $amount = $_SESSION['amount'];
                            $message = $_SESSION['message'];

                            // Determine delivery fee based on session variable from card_checkout_1.php
                            $delivery_fee = ($_SESSION['shipping_option'] == 'pickup') ? 0 : 10;

                            // Total amount to be paid
                            $total_price = $_SESSION['amount'] + $delivery_fee;

                            ?>
                            <br>
                            <div class="row" style="text-align: left; font-size: 18px;">
                                <div class="col">
                                    <p>From</p>
                                    <p>To</p>
                                    <p>To email</p>
                                    <p>Card Amount</p>
                                    <p>Delivery Fee</p>
                                    <p>Shipping Option</p>
                                    <p>Payment Method</p>
                                    Total<p style="font-size: 12px;">(including VAT)</p>
                                </div>
                                <div class="col-2 text-center" style="margin-right: 7rem;">
                                    <p><?php echo $user_name; ?></p>
                                    <p><?php echo $recipient_name; ?></p>
                                    <p><?php echo $recipient_email; ?></p>
                                    <p>USD <?php echo $amount; ?></p>
                                    <p>USD <?php echo $delivery_fee; ?></p>
                                    <p><?php echo ucfirst($_SESSION['shipping_option']); ?></p>
                                    <p>Cash</p>
                                    <p>USD <?php echo $total_price; ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="form-btn">PLACE ORDER</button>
                            </div>
                        </form>
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