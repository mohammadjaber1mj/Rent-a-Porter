<?php
session_start();

if (!isset($_SESSION['lender'])) {
    header("Location: become_a_lender.php");
    exit();
}

require("dbconnect.php");

$owner_email = $_SESSION["lender"];
$email_result = mysqli_query($DBConnect, "SELECT lender_id FROM lenders where email='$owner_email'")
    or die(mysqli_error($DBConnect));
if ($row = mysqli_fetch_array($email_result)) {
    $owner_id = $row["lender_id"];
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Read non-file inputs
    $length = isset($_POST['length']) ? $_POST['length'] : '';
    $size = isset($_POST['size']) ? $_POST['size'] : '';
    $color = isset($_POST['color']) ? $_POST['color'] : '';
    $category_id = isset($_POST['category_id']) ? $_POST['category_id'] : '';
    $designer_id = isset($_POST['designer_id']) ? $_POST['designer_id'] : '';
    $rental_price = isset($_POST['rental_price']) ? $_POST['rental_price'] : '';
    $price = isset($_POST['price']) ? $_POST['price'] : '';
    $description = isset($_POST['description']) ? $_POST['description'] : '';
    $notes = isset($_POST['notes']) ? $_POST['notes'] : '';

    // Existing image upload code
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $targetDir = "images/";
        $imageName = basename($_FILES["image"]["name"]);
        $targetFile = $targetDir . $imageName;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if ($_FILES["image"]["size"] <= 5000000 && in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $imageName = htmlspecialchars($imageName);
                $stmt = $DBConnect->prepare("INSERT INTO `dresses`(`image`, `rental_price`, `color`, `size`, `length`, `notes`, `description`, `owner_id`, `designer_id`, `category_id`, `price`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bind_param("sssssssssss", $imageName, $rental_price, $color, $size, $length, $notes, $description, $owner_id, $designer_id, $category_id, $price);

                if ($stmt->execute()) {
                    echo "Dress Uploaded.";
                } else {
                    echo "Error: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
            }
        } else {
            echo "Sorry, your file was not uploaded. Ensure it's an image and doesn't exceed the size limit.<br>";
        }
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
        <h1>SUBMISSION PAGE</h1>
        <hr>
        <div class="container">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col">
                        <h5>Length</h5>
                        <div class="length_radio-input">
                            <label>
                                <input type="radio" id="value-1" name="length" value="Short" checked="" required>
                                <span>Short</span>
                            </label>
                            <label>
                                <input type="radio" id="value-2" name="length" value="Midi" required>
                                <span>Midi</span>
                            </label>
                            <label>
                                <input type="radio" id="value-3" name="length" value="Tall" required>
                                <span>Tall</span>
                            </label>
                            <span class="length_selection"></span>
                        </div>
                    </div>
                    <div class="col">
                        <h5>Size</h5>
                        <div class="size-radio-input">
                            <label>
                                <input value="34" name="size" id="value-1" type="radio" checked="" required>
                                <span>34</span>
                            </label>
                            <label>
                                <input value="36" name="size" id="value-2" type="radio" required>
                                <span>36</span>
                            </label>
                            <label>
                                <input value="38" name="size" id="value-3" type="radio" required>
                                <span>38</span>
                            </label>
                            <label>
                                <input value="40" name="size" id="value-4" type="radio" required>
                                <span>40</span>
                            </label>
                            <span class="size_selection"></span>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <h5>Color</h5>
                    <div class="colors_container">
                        <div class="radio-tile-group">
                            <div class="colors_input-container">
                                <input value="Red" id="red" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="red" class="radio-tile-label">red</label>
                                </div>
                            </div>
                            <div class="colors_input-container">
                                <input value="Pink" id="pink" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="pink" class="radio-tile-label">pink</label>
                                </div>
                            </div>
                            <div class="colors_input-container">
                                <input value="Purple" id="purple" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="purple" class="radio-tile-label">purple</label>
                                </div>
                            </div>
                            <div class="colors_input-container">
                                <input value="Blue" id="blue" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="blue" class="radio-tile-label">blue</label>
                                </div>
                            </div>
                            <div class="colors_input-container">
                                <input value="Light Blue" id="light_blue" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="light_blue" class="radio-tile-label">Light blue</label>
                                </div>
                            </div>
                            <div class="colors_input-container">
                                <input value="Green" id="green" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="green" class="radio-tile-label">green</label>
                                </div>
                            </div>
                            <div class="colors_input-container">
                                <input value="Yellow" id="yellow" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="yellow" class="radio-tile-label">yellow</label>
                                </div>
                            </div>
                            <div class="colors_input-container">
                                <input value="Orange" id="orange" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="orange" class="radio-tile-label">orange</label>
                                </div>
                            </div>
                            <div class="colors_input-container">
                                <input value="Black" id="black" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="black" class="radio-tile-label">black</label>
                                </div>
                            </div>
                            <div class="colors_input-container">
                                <input value="White" id="white" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="white" class="radio-tile-label">white</label>
                                </div>
                            </div>
                            <div class="colors_input-container">
                                <input value="Gold" id="gold" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="gold" class="radio-tile-label">gold</label>
                                </div>
                            </div>
                            <div class="colors_input-container">
                                <input value="Others" id="others" class="radio-button" type="radio" name="color" required>
                                <div class="radio-tile">
                                    <label for="others" class="radio-tile-label">other</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <h5>Upload Dress Image</h5>
                        <input type="file" name="image" accept="image/*" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <h5>Choose Category</h5>
                        <div>
                            <?php
                            $result = mysqli_query($DBConnect, "SELECT * FROM categories ORDER BY name")
                                or die(mysqli_error($DBConnect));
                            echo "<select name ='category_id' class='dropdownmenu' required>
                                  <option value=''>Select Category</option>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row["category_id"] . "' required>" . $row["name"] . "</option>";
                            }
                            echo "</select>";
                            ?>
                        </div>
                    </div>
                    <div class="col">
                        <h5>Choose Designer</h5>
                        <div>
                            <?php
                            require("dbconnect.php");
                            $result = mysqli_query($DBConnect, "SELECT * FROM designers ORDER BY name")
                                or die(mysqli_error($DBConnect));
                            echo "<select name ='designer_id' class='dropdownmenu' required>
                                  <option value=''>Select Designer</option>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<option value='" . $row["designer_id"] . "' required>" . $row["name"] . "</option>";
                            }
                            echo "</select>";
                            ?>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <h5>Rental Price(USD)</h5>
                        <input type="number" name="rental_price" placeholder="Enter Rental Price" style="width: 300px;" required>
                    </div>
                    <div class="col">
                        <h5>Original Price(USD)</h5>
                        <input type="number" name="price" placeholder="Enter Original Price" style="width: 300px;" required>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <h5>Description about the Dress</h5>
                        <textarea name="description" placeholder="Enter a description of the dress" rows="4" cols="50" required></textarea>
                    </div>
                    <div class="col">
                        <h5>Notes for Admin</h5>
                        <textarea name="notes" placeholder="Enter notes for the admin" rows="4" cols="50" required></textarea>
                    </div>
                </div>
                <br>
                <input class="upload_btn" type="submit" name="submit" value="Upload">
                <button type="reset" class="form-btn"> Reset </button>
            </form>
        </div>
    </div>
</body>

</html>

</html>