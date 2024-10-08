<?php
session_start();

require("dbconnect.php");

if (!isset($_SESSION['user'])) {
    header("Location: user_signin.php");
    exit();
} else {
    $user_email = $_SESSION["user"];
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style="display: flex; flex-direction: column; min-height: 100vh;">
    <header class="top_header">
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <?php
                    // Check if the user is not logged in
                    if (isset($_SESSION['user'])) {
                        $user_email = $_SESSION['user'];
                        $email_result = mysqli_query($DBConnect, "SELECT fname FROM users WHERE email='$user_email'")
                            or die(mysqli_error($DBConnect));
                        if ($row = mysqli_fetch_array($email_result)) {
                            $user_fname = $row["fname"];
                        }
                        echo "<button class='btn_signin'><a href='user_profile.php'>Hi, $user_fname</a></button>";
                        //header("Location: login.html"); // Redirect to login page
                        //exit();
                    } else {
                        echo "<button class='btn_signin'><a href='user_signin.php'>SIGN IN</a></button>";
                    }
                    ?>

                </div>
                <div class="col">
                    <a href="index.php"><img src="images/rap_logo.jpeg" alt="rap_logo" width="120px"></a>
                </div>
                <div class="col">
                    <div class="right_top_search">
                        <div class="search">
                            <form action="search_results.php" method="GET">
                                <input type="text" class="search__input" name="query" placeholder="search...">
                                <button type="submit" class="search__button" title="search">
                                    <svg class="search__icon" aria-hidden="true" viewBox="0 0 24 24">
                                        <g>
                                            <path d="M21.53 20.47l-3.66-3.66C19.195 15.24 20 13.214 20 11c0-4.97-4.03-9-9-9s-9 4.03-9 9 4.03 9 9 9c2.215 0 4.24-.804 5.808-2.13l3.66 3.66c.147.146.34.22.53.22s.385-.073.53-.22c.295-.293.295-.767.002-1.06zM3.5 11c0-4.135 3.365-7.5 7.5-7.5s7.5 3.365 7.5 7.5-3.365 7.5-7.5 7.5-7.5-3.365-7.5-7.5z"></path>
                                        </g>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="right_top">
                        <button class="btn_cart" title="cart">
                            <a href="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z" />
                                </svg>
                            </a>
                        </button>
                        <button class="btn_fav" title="favourites">
                            <a href="favourites.php">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                                </svg>
                            </a>
                        </button>
                        <button class="btn_aboutus">
                            <a href="about_us.php">ABOUT US</a>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </header>

    <div class="menu_bar">
        <ul>
            <li><a href="index.php">HOME</a></li>
            <li><a href="customized.php">CUSTOMIZED</a></li>
            <li><a href="designers.php">DESIGNERS</a></li>
            <li><a href="categories.php">OCCASIONS</a></li>
            <li><a href="gift_card.php">GIFT CARD</a></li>
            <li><a href="become_a_lender.php">BECOME A LENDER</a></li>
        </ul>
    </div>

    <div class="container text-center">
        <div class="row" style='margin-top: 1rem;'>
            <div class="col">
                <h4></h4>
            </div>
            <div class="col">
                <h4>DESIGNER</h4>
            </div>
            <div class="col">
                <h4>FROM</h4>
            </div>
            <div class="col">
                <h4>TO</h4>
            </div>
            <div class="col">
                <h4>RENTAL PRICE</h4>
            </div>
            <div class="col">
                <h4></h4>
            </div>
        </div>
        <hr>
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
                $total_price += $dress_details_row['rental_price']; // Add to total price
                echo "<div class='row' style='margin-top: 1rem;'>
        <div class='col'>
            <img src='images/" . $dress_details_row['image'] . "' style='width: 100px;'>
        </div>
        <div class='col'>
            <p style='font-size: 18px; margin-top: 2rem;'>" . $dress_details_row['name'] . "</p>
        </div>
        <div class='col'>
            <p style='font-size: 18px; margin-top: 2rem;'>" . $start_date . "</p>
        </div>
        <div class='col'>
            <p style='font-size: 18px; margin-top: 2rem;'>" . $end_date . "</p>
        </div>
        <div class='col'>
            <p style='font-size: 18px; margin-top: 2rem;'>$" . $dress_details_row['rental_price'] . "</p>
        </div>
        <div class='col'>
            <form method='POST' action='user_delete_cart.php'>
                <input type='hidden' name='dress_code' value='" . $dress_details_row['dress_code'] . "'>
                <button type='submit' class='btn btn-danger' style='font-size: 15px; margin-top: 1rem;'>DELETE</button>
            </form>
        </div>
    </div>";
            }
        }
        ?>
        <hr>
        <div class="row" style='margin-top: 1rem;'>
            <div class="col">
                <h4>TOTAL PRICE</h4>
            </div>
            <div class="col">
                <h4>$<?php echo $total_price; ?></h4>
            </div>
            <div class="col">
                <a href="user_checkout_1.php" style="text-decoration: none; color: white;"><button class="checkout_btn">CHECKOUT</button></a>
            </div>
        </div>
    </div>

    <footer style="border-top: 1px solid #E7687D; margin-top: auto;">
        <div style="background-color: #fff7f4; padding: 20px 0;">
            <div class="container">
                <div class="row">
                    <div class="col" style="border-right: 1px solid #ccc; color: black;">
                        <img src="images/rap_logo.jpeg" alt="RAP Logo" style="width: 100px; border-radius: 25%; margin-bottom: 2rem;">
                        <br>
                        Beirut
                        <br>
                        Achrafieh, 150 Abdul Wahab El Inglizi Street
                        <br>
                        Monday - Saturday: 10:00 AM to 7:00 PM
                        <br>
                        Sunday: 10:00 AM to 2:00 PM
                        <br>
                        +961 76 811 429
                        <br>
                        01 875 001
                    </div>
                    <div class="col text-center" style="border-right: 1px solid #ccc;">
                        <h4>Follow Us</h4>
                        <br>
                        <a href="https://www.instagram.com/rentaporter.lb/" target="_blank"><img src="images/instagram_black_logo_icon_147122.png" alt="Instagram"></a>
                        <br><br>
                        <a href="https://www.facebook.com" target="_blank"><img src="images/social_facebook_fb_35.png" alt="Facebook"></a>
                        <br><br>
                        <a href="https://www.tiktok.com" target="_blank"><img src="images/tiktok_logo_icon_186928.png" alt="TikTok"></a>
                    </div>
                    <div class="col" style="border-right: 1px solid #ccc;">
                        <a href="index.php" style="text-decoration: none; color: black;">VIEW OUR DRESSES</a>
                        <br><br>
                        <a href="designers.php" style="text-decoration: none; color: black;">DESIGNERS</a>
                        <br><br>
                        <a href="gift_card.php" style="text-decoration: none; color: black;">GIFT CARD</a>
                        <br><br>
                        <a href="#" style="text-decoration: none; color: black;">HOW IT WORKS</a>
                    </div>
                    <div class="col">
                        <a href="become_a_lender.php" style="text-decoration: none; color: black;">BECOME A LENDER</a>
                        <br><br>
                        <a href="about_us.php" style="text-decoration: none; color: black;">ABOUT US</a>
                        <br><br>
                        <a href="#" style="text-decoration: none; color: black;">PRIVACY POLICY</a>
                        <br><br>
                        <a href="#" style="text-decoration: none; color: black;">SITEMAP</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
</body>

</html>