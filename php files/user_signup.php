<?php
session_start();

require("dbconnect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert into the database
    $sql = "INSERT INTO `users` (`fname`, `lname`, `phone_number`, `email`, `password`) VALUES (?, ?, ?, ?, ?)";
    $stmt = $DBConnect->prepare($sql);
    $stmt->bind_param("sssss", $fname, $lname, $phone, $email, $hashedPassword);
    $result = $stmt->execute();

    if ($result) {
        // Get the last inserted user ID
        $userId = $DBConnect->insert_id;

        // Create a cart for the new user
        $sqlCart = "INSERT INTO `cart` (`user_id`) VALUES (?)";
        $stmtCart = $DBConnect->prepare($sqlCart);
        $stmtCart->bind_param("i", $userId);
        $stmtCart->execute();

        $_SESSION['user'] = $email;
        header("Location: index.php");
    } else {
        echo "Registration failed.";
    }
    $DBConnect->close();
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
            <div class="col-6">
                <div class="sign_div" style="margin-top: 4rem;">
                    <div class="form-container">
                        <!--<p style="color: #E7687D;">Start earning money in just a few steps!</p>-->
                        <p class="title">SIGN UP</p>
                        <form name="signupForm" class="form" action="" method="POST" onsubmit="return validateForm()">
                            <input type="text" class="input" placeholder="First name" name="fname" required>
                            <input type="text" class="input" placeholder="Last name" name="lname" required>
                            <input type="number" class="input" placeholder="Phone number" name="phone" required>
                            <input type="email" class="input" placeholder="Email" name="email" required>
                            <input type="password" class="input" placeholder="Password" name="password" required>
                            <button class="form-btn">Sign up</button>
                        </form>
                        <p class="sign-up-label">
                            Already have an account?<span class="sign-up-link"><a href="user_signin.php">Sign in</a></span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <a href="index.php" class="btn btn-default">X</a>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    function validateForm() {
        const password = document.forms["signupForm"]["password"].value;
        const regex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

        if (!regex.test(password)) {
            alert("Password must be at least 8 characters long, include at least one uppercase letter, and one special character.");
            return false;
        }
        return true;
    }
</script>