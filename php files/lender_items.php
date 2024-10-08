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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        <h1>MY ITEMS</h1>
        <hr>
        <div class="row">
            <div class="col">
                <h4>IMAGE</h4>
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
                <h4>DELETE</h4>
            </div>
        </div>
        <?php
        include "dbconnect.php";
        $owner_email = $_SESSION["lender"];
        $email_result = mysqli_query($DBConnect, "SELECT lender_id FROM lenders where email='$owner_email'")
            or die(mysqli_error($DBConnect));
        if ($row = mysqli_fetch_array($email_result)) {
            $owner_id = $row["lender_id"];
        }
        $sql = "SELECT * FROM `dresses`, designers WHERE dresses.designer_id=designers.designer_id AND owner_id='$owner_id';";
        $result = mysqli_query($DBConnect, $sql);
        while ($row = mysqli_fetch_array($result)) {
            echo "
                <div class='row'>
                    <div class='col'>
                        <img src='images/" . $row['image'] . "' style='width: 100px;'>
                    </div>
                    <div class='col'>
                        <p style='font-size: 18px; margin-top: 2rem;'> " . $row['name'] . " </p>
                    </div>
                    <div class='col'>
                        <p style='font-size: 18px; margin-top: 2rem;'>" . $row['description'] . "</p>
                    </div>
                    <div class='col'>
                        <p style='font-size: 18px; margin-top: 2rem;'>$" . $row['rental_price'] . "</p>
                    </div>
                    <div class='col'>
                        <form action='lender_delete_dress.php' method='POST'>
                            <input type='hidden' name='dress_code' value='" . $row['dress_code'] . "'>
                            <button type='submit' class='btn btn-danger' style='margin-top: 2rem;'>Delete</button>
                        </form>
                    </div>
                </div>
                <br>
                ";
        }
        ?>
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
</body>

</html>
