<?php
session_start();

if (!isset($_SESSION['lender'])) {
    header("Location: become_a_lender.php");
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
    <div class="sidebar" id="sidebar">
        <ul>
            <li class="logo-li"><a href="lender_dashboard.php"><img src="images/rap_logo.jpeg" width=120px></a></li>
            <li><a href="lender_account.php">Account</a></li>
            <li><a href="lender_dashboard.php">My Dashboard</a></li>
            <li><a href="lender_submission.php">Dress Submission</a></li>
            <li><a href="lender_items.php">My Items</a></li>
            <hr style="color: #E7687D;">
            <li><a href="lender_signout.php">Log Out</a></li>
        </ul>
    </div>

    <div class="sidebar_content" id="main-content">
        <h1>MY DASHBOARD</h1>
        <hr>
        <div class="row">
            <div class="col">
                <h6 style="margin-left: 1rem;">IMAGE</h6>
            </div>
            <div class="col">
                <h6>DESIGNER</h6>
            </div>
            <div class="col">
                <h6>RENTALS COUNT</h6>
            </div>
            <div class="col">
                <h6>IN FAVOURITES</h6>
            </div>
            <div class="col">
                <h6>TOTAL REVENUE</h6><p style="font-size: 13px;">(after 45% deduction)</p>
            </div>
        </div>
        <br>
        <?php
        require("dbconnect.php");

        $owner_email = $_SESSION["lender"];
        $email_result = mysqli_query($DBConnect, "SELECT lender_id FROM lenders where email='$owner_email'")
            or die(mysqli_error($DBConnect));
        if ($row = mysqli_fetch_array($email_result)) {
            $owner_id = $row["lender_id"];
        }

        $dresses_sql = "SELECT * FROM `dresses`, designers WHERE dresses.designer_id=designers.designer_id AND owner_id='$owner_id';";
        $dresses_result = mysqli_query($DBConnect, $dresses_sql);
        while ($dresses_row = mysqli_fetch_array($dresses_result)) {
            $dress_code = $dresses_row['dress_code'];
            $dress_description = $dresses_row['description'];
            $dress_image = $dresses_row['image'];
            $designer_name = $dresses_row['name'];

            $favs_sql = "SELECT COUNT(*) AS fav_count FROM favourites WHERE dress_code='$dress_code';";
            $favs_result = mysqli_query($DBConnect, $favs_sql);
            if ($favs_row = mysqli_fetch_array($favs_result)) {
                $fav_count = $favs_row['fav_count'];
            }

            $rentals_sql = "SELECT COUNT(*) AS rental_count FROM rentals WHERE dress_code='$dress_code';";
            $rentals_result = mysqli_query($DBConnect, $rentals_sql);
            if ($rentals_row = mysqli_fetch_array($rentals_result)) {
                $rental_count = $rentals_row['rental_count'];

                $purchased_price = 0;
                $revenue_query = "SELECT price FROM rentals WHERE dress_code='$dress_code';";
                $revenue_result = mysqli_query($DBConnect, $revenue_query);
                if ($revenue_row = mysqli_fetch_array($revenue_result)) {
                    $purchased_price = $revenue_row['price'];
                }

                $total_revenue = $rental_count * $purchased_price * 0.55;

                echo "
                        <div class='row'>
                            <div class='col'><img src='images/$dress_image' width=100px style='border-radius: 20%;'></div>
                            <div class='col' style='margin-top: 2rem;'><h6>$designer_name</h6></div>
                            <div class='col' style='margin-top: 2rem;'><h6 style='margin-left: 2rem;'>$rental_count</h6></div>
                            <div class='col' style='margin-top: 2rem;'><h6 style='margin-left: 2rem;'>$fav_count</h6></div>
                            <div class='col' style='margin-top: 2rem;'><h6 style='margin-left: 2rem;'>$$total_revenue</h6></div>
                        </div>
                        <hr style='color: #E7687D;'>
                        ";
            }
        }
        ?>
    </div>
</body>

</html>

</html>