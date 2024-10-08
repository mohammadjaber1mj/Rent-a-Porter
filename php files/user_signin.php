<?php
session_start();

require("dbconnect.php");

$error = ""; // Initialize the error message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $sql = $DBConnect->prepare('SELECT * FROM users WHERE email = ?');
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['email'];
            header('location: index.php');
            exit;
        } else {
            // Handle invalid login
            $error = "Incorrect password!";
        }
    } else {
        // Handle invalid login
        $error = "Incorrect email!";
    }

    $sql->close();
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <title>Rent à Porter</title>
</head>

<body>
    <?php
    if (!empty($error)) {
        echo '<script type="text/javascript">',
        'document.addEventListener("DOMContentLoaded", function() {',
        'var myModal = new bootstrap.Modal(document.getElementById("errorModal"));',
        'myModal.show();',
        '});',
        '</script>';
    }
    ?>

    <!-- Modal -->
    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="row" style="margin-top: 1rem;">
            <div class="col">
                <a href="index.php"><img src="images/rap_logo.jpeg" alt="rap_logo" width="150px"></a>
            </div>
            <div class="col-6">
                <div class="sign_div" style="margin-top: 4rem;">
                    <div class="form-container">
                        <p class="title">Welcome back</p>
                        <form class="form" action="" method="POST">
                            <input type="email" class="input" placeholder="Email" name="email" required>
                            <input type="password" class="input" placeholder="Password" name="password" required>
                            <button class="form-btn">Log in</button>
                        </form>
                        <p class="sign-up-label">
                            Don't have an account? <span class="sign-up-link"><a href="user_signup.php">Sign up</a></span>
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