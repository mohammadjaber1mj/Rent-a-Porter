<?php
session_start();

require("dbconnect.php");
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
                            <a href="cart.php">
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
            <li><a href="become_a_lender.php" target="_blank">BECOME A LENDER</a></li>
        </ul>
    </div>

    <div class="container text-center">
        <div class="filter-row" style="margin-top: 1rem;">
            <form action="" method="GET">
                <div class="row">
                    <div class="col">
                        <h2>FILTER</h2>
                    </div>
                    <div class="col">
                        <select name="occasion" onchange="this.form.submit()" style="background-color: #E7687D; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
                            <option value="">Select Occasion</option>
                            <?php
                            $occasions_query = mysqli_query($DBConnect, "SELECT category_id, name FROM categories ORDER BY name");
                            while ($occasion = mysqli_fetch_assoc($occasions_query)) {
                                $selected = (isset($_GET['occasion']) && $_GET['occasion'] == $occasion['category_id']) ? 'selected' : '';
                                echo "<option value='" . $occasion['category_id'] . "' $selected>" . $occasion['name'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="color" onchange="this.form.submit()" style="background-color: #E7687D; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
                            <option value="">Select Color</option>
                            <?php
                            $colors = mysqli_query($DBConnect, "SELECT DISTINCT color FROM dresses ORDER BY color");
                            while ($color = mysqli_fetch_assoc($colors)) {
                                $selected = (isset($_GET['color']) && $_GET['color'] == $color['color']) ? 'selected' : '';
                                echo "<option value='" . $color['color'] . "' $selected>" . $color['color'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="size" onchange="this.form.submit()" style="background-color: #E7687D; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
                            <option value="">Select Size</option>
                            <?php
                            $sizes = mysqli_query($DBConnect, "SELECT DISTINCT size FROM dresses ORDER BY size");
                            while ($size = mysqli_fetch_assoc($sizes)) {
                                $selected = (isset($_GET['size']) && $_GET['size'] == $size['size']) ? 'selected' : '';
                                echo "<option value='" . $size['size'] . "' $selected>" . $size['size'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col">
                        <select name="length" onchange="this.form.submit()" style="background-color: #E7687D; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
                            <option value="">Select Length</option>
                            <?php
                            $lengths = mysqli_query($DBConnect, "SELECT DISTINCT length FROM dresses");
                            while ($length = mysqli_fetch_assoc($lengths)) {
                                $selected = (isset($_GET['length']) && $_GET['length'] == $length['length']) ? 'selected' : '';
                                echo "<option value='" . $length['length'] . "' $selected>" . $length['length'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="row row-cols-3" style='margin-top: 1rem;'>
            <?php
            // Initialize the conditions array
            $conditions = [];

            // Helper function to add conditions safely
            function addCondition(&$conditions, $field, $value, $connection)
            {
                if (isset($value) && $value != '') {
                    $safe_value = mysqli_real_escape_string($connection, $value);
                    $conditions[] = "$field='$safe_value'";
                }
            }

            // Check user inputs and add conditions
            addCondition($conditions, 'dresses.category_id', $_GET['occasion'] ?? null, $DBConnect);
            addCondition($conditions, 'color', $_GET['color'] ?? null, $DBConnect);
            addCondition($conditions, 'size', $_GET['size'] ?? null, $DBConnect);
            addCondition($conditions, 'length', $_GET['length'] ?? null, $DBConnect);

            // Base SQL query
            $query = "SELECT * FROM dresses JOIN designers ON dresses.designer_id = designers.designer_id";

            // Append conditions to the query if any exist
            if (!empty($conditions)) {
                $query .= " WHERE " . implode(" AND ", $conditions);
            }

            // Execute the query
            $result = mysqli_query($DBConnect, $query);

            if (mysqli_num_rows($result) == 0) {
                echo "<div class='col text-center' style='margin-top: 10rem; margin-left: 27rem;'><h3>No dresses found for the selected filters. Please try different options.</h3></div>";
            } else {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='col'>";
                    echo "<div class='image-container'><a href='dress_details.php?dress_code=" . $row['dress_code'] . "'><img src='images/" . $row['image'] . "' style='width: 80%; height: 420px; object-fit: cover; border-radius: 5%;'></a></div>";
                    echo "<p class='dress_designer_p'><a href='designer_index.php?designer_id=" . $row['designer_id'] . "' title='" . $row['name'] . "'>" . $row['name'] . "</a></p>";
                    echo "<p class='dress_description_p'>" . $row['description'] . "</p>";
                    echo "<p class='dress_price_p'>Rental price: $" . $row['rental_price'] . "</p>";
                    echo "<p class='dress_size_p'>Size: " . $row['size'] . "</p>";
                    echo "</div>";
                }
            }
            ?>
        </div>

        <style>
            .image-container {
                overflow: hidden;
            }

            .image-container img {
                width: 100%;
                transition: transform 0.3s ease;
            }

            .image-container img:hover {
                transform: scale(1.1);
            }
        </style>
    </div>

    <footer style="border-top: 1px solid #E7687D;">
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