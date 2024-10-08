<?php
session_start();

require("dbconnect.php");

if (!isset($_SESSION['user'])) {
    header("Location: user_signin.php");
    exit();
}

if (!isset($_SESSION['shipping_option'])) {
    header("Location: user_checkout_1.php");
    exit();
}

$user_email = $_SESSION['user'];
$email_result = mysqli_query($DBConnect, "SELECT user_id FROM users WHERE email='$user_email'")
    or die(mysqli_error($DBConnect));
if ($row = mysqli_fetch_array($email_result)) {
    $user_id = $row["user_id"];
}

$cart_result = mysqli_query($DBConnect, "SELECT cart_id FROM cart WHERE user_id='$user_id'")
    or die(mysqli_error($DBConnect));
if ($row = mysqli_fetch_array($cart_result)) {
    $cart_id = $row["cart_id"];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Fetch all cart items
    $cart_items_query = "SELECT * FROM cart_item WHERE cart_id='$cart_id'";
    $cart_items_result = mysqli_query($DBConnect, $cart_items_query) or die(mysqli_error($DBConnect));

    while ($item = mysqli_fetch_array($cart_items_result)) {
        $dress_code = $item['dress_code'];
        $start_date = $item['start_date'];
        $end_date = $item['end_date'];

        $dress_price_query = "SELECT rental_price FROM dresses WHERE dress_code='$dress_code'";
        $dress_price_query_result = mysqli_query($DBConnect, $dress_price_query) or die(mysqli_error($DBConnect));
        if ($row = mysqli_fetch_array($dress_price_query_result)) {
            $price = $row["rental_price"];
        }

        // Insert into rentals table
        $insert_rental_query = "INSERT INTO rentals (user_id, dress_code, price, start_date, end_date) VALUES ('$user_id', '$dress_code', '$price', '$start_date', '$end_date')";
        mysqli_query($DBConnect, $insert_rental_query) or die(mysqli_error($DBConnect));
    }

    // Delete all items from cart_item table
    $delete_cart_items_query = "DELETE FROM cart_item WHERE cart_id='$cart_id'";
    mysqli_query($DBConnect, $delete_cart_items_query) or die(mysqli_error($DBConnect));

    // Instead of redirecting with PHP, echo a JavaScript code to alert and redirect
    echo "<script>
            alert('Your order has been placed. Delivery orders takes 2-3 bussiness days to arrive.');
            window.location.href='index.php';
          </script>";
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
                        <form action="user_checkout_3.php" method="POST">
                            <p class="title"><img src="images/checkmark_tick_done_checked_icon_178088.png" alt=""> SUMMARY</p>
                            <hr style="color: #E7687D;">
                            <?php
                            $cart_item_result = mysqli_query($DBConnect, "SELECT * FROM cart_item WHERE cart_id='$cart_id'")
                                or die(mysqli_error($DBConnect));
                            $total_price = 0; // Initialize total price
                            while ($row = mysqli_fetch_array($cart_item_result)) {
                                $dress_code = $row['dress_code'];
                                $start_date = $row['start_date'];
                                $end_date = $row['end_date'];

                                $dress_details_query = "SELECT * FROM dresses, designers WHERE dresses.dress_code = '$dress_code' AND dresses.designer_id=designers.designer_id";
                                $dress_details_result = mysqli_query($DBConnect, $dress_details_query) or die(mysqli_error($DBConnect));
                                if ($dress_details_row = mysqli_fetch_array($dress_details_result)) {
                                    $total_price += $dress_details_row['rental_price'];
                                    $designer_name = $dress_details_row['name'];
                                    $dress_price = $dress_details_row['rental_price'];
                                    $dress_description = $dress_details_row['description'];
                                    $dress_size = $dress_details_row['size'];
                                    $dress_image = $dress_details_row['image'];

                                    // Determine delivery fee based on session variable from user_checkout_1.php
                                    $delivery_fee = ($_SESSION['shipping_option'] == 'pickup') ? 0 : 10;

                                    // Total amount to be paid
                                    $total_payable = $total_price + $delivery_fee;

                                    echo "
                                <div style='text-align: left; border: 1px solid #E7687D;'>
                                    <div class='row'>
                                        <div class='col'>
                                            <img src='images/$dress_image' alt='dress_image' style='width: 100%; height: auto;'>
                                        </div>
                                        <div class='col-7'>
                                            <h6>$designer_name</h6>
                                            <h6>$dress_description</p>
                                            <h6>Size: $dress_size</h6>
                                            <h6>From: $start_date</h6>
                                            <h6>To: $end_date</h6>
                                        </div>
                                        <div class='col-2'>
                                            <h6>USD $dress_price</h6>
                                        </div>
                                    </div>
                                </div>
                                ";
                                }
                            }
                            ?>
                            <br>
                            <div class="row" style="text-align: left; font-size: 18px;">
                                <div class="col">
                                    <p>Subtotal</p>
                                    <p>Delivery Fee</p>
                                    <p>Shipping Option</p>
                                    <p>Payment Method</p>
                                    Total<p style="font-size: 12px;">(including VAT)</p>
                                </div>
                                <div class="col-2">
                                    <p>USD <?php echo $total_price; ?></p>
                                    <p>USD <?php echo $delivery_fee; ?></p>
                                    <p><?php echo ucfirst($_SESSION['shipping_option']); ?></p>
                                    <p>Cash</p>
                                    <p>USD <?php echo $total_payable; ?></p>
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
                <a href="cart.php" class="btn btn-default">X</a>
            </div>
        </div>
    </div>
</body>

</html>