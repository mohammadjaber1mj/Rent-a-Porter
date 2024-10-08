<?php
session_start();

require("dbconnect.php");

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Use prepared statements to prevent SQL injection
    $sql = $DBConnect->prepare('SELECT * FROM lenders WHERE email = ?');
    $sql->bind_param("s", $email);
    $sql->execute();
    $result = $sql->get_result();
    var_dump($result);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify the password using MD5
        if (password_verify($password, $row['password'])) {
            $_SESSION['lender'] = $row['email'];
            header('location: lender_dashboard.php');
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

    <div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLabel">Login Error</h5>
                    <a href="become_a_lender.php"><button type="button" class="btn-close" aria-label="Close" style="margin-left:20rem;"></button></a>
                </div>
                <div class="modal-body">
                    <?php echo htmlspecialchars($error); ?>
                </div>
                <div class="modal-footer">
                    <a href="become_a_lender.php"><button type="button" class="btn btn-secondary">Close</button></a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>