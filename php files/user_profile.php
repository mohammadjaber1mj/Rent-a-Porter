<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user'])) {
    header('location: index.php');
}

require("dbconnect.php");

$user_email = $_SESSION["user"];
$email_result = mysqli_query($DBConnect, "SELECT * FROM users where email='$user_email'")
    or die(mysqli_error($DBConnect));
if ($row = mysqli_fetch_array($email_result)) {
    $user_id = $row["user_id"];
    $user_fname = $row["fname"];
    $user_lname = $row["lname"];
    $user_phone_number = $row["phone_number"];
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Rent à Porter</title>
</head>

<body>
    <div class="sidebar" id="sidebar">
        <ul>
            <li class="logo-li"><a href="index.php"><img src="images/rap_logo.jpeg" width=120px></a></li>
            <li><a href="user_profile.php">Account Details</a></li>
            <li><a href="user_orders.php">Order History</a></li>
            <li><a href="user_gift_cards.php">Gift Cards History</a></li>
            <hr style="color: #E7687D;">
            <li><a href="user_signout.php">Log Out</a></li>
        </ul>
    </div>
    <div class="sidebar_content" id="main-content">
        <button onclick="window.location.href='index.php'" style="position: fixed; top: 10px; right: 10px; z-index: 1000;">X</button>
        <h1>MY ACCOUNT</h1>
        <hr>
        <?php if (isset($_SESSION['user_error_message'])) : ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['user_error_message']; ?>
                <button title="Dismiss Message" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <?php unset($_SESSION['user_error_message']); // Clear the message after displaying it 
                ?>
            </div>
        <?php endif; ?>
        <div class="row">
            <div class="col">
                <h4>Personal Information
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editUserPersonalInfoModal" style="width: 100px; margin-left: 2rem; background-color: black;">
                        Edit
                    </button>
                </h4>
                <p style='font-size: 18px;'>Name: <?php echo "$user_fname $user_lname"; ?></p>
                <p style='font-size: 18px;'>Email: <?php echo "$user_email"; ?></p>
                <p style='font-size: 18px;'>Phone Number: <?php echo "$user_phone_number"; ?></p>
            </div>
            <div class="col-2">
                <button type="button" data-bs-toggle="modal" data-bs-target="#changeUserPasswordModal" style="width: 180px; height: 40px; background-color: black; color: white;">
                    Change Password
                </button>
            </div>
        </div>
        <br>
        <button class="btn btn-danger" style="width: 150px;"><a href="user_signout.php" style="text-decoration: none; color: white;">Log out</a></button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="editUserPersonalInfoModal" tabindex="-1" aria-labelledby="editUserPersonalInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserPersonalInfoModalLabel">Edit Personal Information</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editInfoForm" action="user_edit_personal_info.php" method="POST">
                        <div class="mb-3">
                            <label for="fname" class="form-label">First Name:</label>
                            <input type="text" class="form-control" id="fname" name="fname" value="<?php echo "$user_fname"; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name:</label>
                            <input type="text" class="form-control" id="lname" name="lname" value="<?php echo "$user_lname"; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo "$user_email"; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number:</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo "$user_phone_number"; ?>" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Update Information">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Change Password Modal -->
    <div class="modal fade" id="changeUserPasswordModal" tabindex="-1" aria-labelledby="changeUserPasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changeUserPasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="UserchangePasswordForm" action="user_change_password.php" method="POST">
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password:</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm New Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Change Password">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('UserchangePasswordForm').addEventListener('submit', function(event) {
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            if (newPassword !== confirmPassword) {
                event.preventDefault(); // Stop form submission
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'New password and confirmation password do not match!',
                });
            }
        });
    </script>

</body>

</html>