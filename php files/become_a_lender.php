<?php
session_start();

if (isset($_SESSION['lender'])) {
    header("Location: lender_dashboard.php");
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
    <div class="container text-center" style="margin-top: 1rem;">
        <div class="row">
            <div class="col-8 text-start">
                <a href="index.php"><img src="images/rap_logo.jpeg" alt="rap_logo" width="120px"></a>
            </div>
            <div class="col-4 text-end">
                <button class="button_become_a_lender" id="openSignUpPopup">Become a Lender</button>
                <button class="button_become_a_lender" id="openSignInPopup">Log in</button>
            </div>
        </div>

        <hr style="color: #E7687D;">

        <div class="row" style="margin-top: 4rem;">
            <h2 style="margin-bottom: 2rem;">WHY BECOME A LENDER</h2>
            <p style="font-size: 22px;">Is your closet overstuffed? Filled with items no longer used? No idea what to do with them?
                <br>You are not alone! Join hundreds of women in the movement and monetize your closet while doing so!
            </p>
        </div>

        <div class="row" style="margin-top: 5rem;">
            <div class="col">
                <img src="images/mbricash_99554.png" alt="" style="margin-bottom: 1rem;">
                <br>
                <h4>EXTRA CASH</h4>
                <p>Earn a passive income by renting out<br>your designer items with us.</p>
            </div>
            <div class="col">
                <img src="images/closet_5515.png" alt="" style="margin-bottom: 1rem;">
                <br>
                <h4>FREE UP STORAGE</h4>
                <p>Empty your closet from designer items you<br>don't use anymore. By renting them out<br>you'll be helping the planet as well!</p>
            </div>
            <div class="col">
                <img src="images/folder_heart_icon_135607.png" alt="" style="margin-bottom: 1rem;">
                <br>
                <h4>IT'S NOT GOODBYE</h4>
                <p>What's yours, stays yours! Unlike selling, you<br>will always have access to your loved pieces.</p>
            </div>
        </div>

        <div class="row" style="margin-top: 5rem;">
            <h2 style="margin-bottom: 2rem;">WE'VE GOT YOU COVERED</h2>
            <div class="col" style="margin-right: -3rem;">
                <img src="images/policiesBackground.png" alt="">
            </div>
            <div class="col text-start" style="background-color: #E7687D; margin-left: -4.8rem;">
                <p style="font-size: 22px; margin-top: 1rem;">
                    We, at Rent a Porter value your items just as much as you<br>do. That is why we do everything that we can to treat your<br>
                    items with the utmost care. We make sure to enforce the necessary<br>policies that protect your items, all whilst making sure we deliver<br>
                    the greatest experience for both our suppliers and customers.
                </p>
                <hr style="color: black;">
                <h3 style="margin-top: 3rem;">Handled with care</h3>
                <p style="font-size: 18px;">Our staff is trained to handle delicate and expensive pieces. We cover dry cleaning and our policies ensure your items remain in top shape.</p>
                <h3 style="margin-top: 3rem;">Equal opportunity for all</h3>
                <p style="font-size: 18px;">We will never give preferential treatment to certain suppliers at the expense of others. We select items based on quality and current trends, and our algorithm ensures that your items will be seen online as much as the rest.</p>
                <h3 style="margin-top: 3rem;">Rest assured</h3>
                <p style="font-size: 18px;">All minor wear & tear is on us and we have a solid insurance policy in place for your peace of mind. Learn more <a href="chrome-extension://efaidnbmnnnibpcajpcglclefindmkaj/https://s3-eu-west-1.amazonaws.com/d24publiccontent/supplier-pdfs/leb-market-agreement.pdf">here</a>.</p>
            </div>
        </div>

        <div class="row" style="margin-top: 5rem;">
            <h2>ITEM SUBMISSION</h2>
            <p style="font-size: 22px; margin-bottom: 3rem;">easy as ...</p>
            <div class="col">
                <img src="images/1number_1_3080.png" alt="" style="margin-bottom: 2rem;">
                <h4>SUBMIT YOUR ITEMS</h4>
                <p>Upload your items and attach photos<br>that showcase them nicely.</p>
            </div>
            <div class="col">
                <img src="images/2number_2_3830.png" alt="" style="margin-bottom: 2rem;">
                <h4>PHYSICAL INSPECTION</h4>
                <p>Drop off your accepted items, we wil inspect them<br>and get back to you within 2 working days.</p>
            </div>
            <div class="col">
                <img src="images/3number_3_3078.png" alt="" style="margin-bottom: 2rem;">
                <h4>GET PAID</h4>
                <p>Every end of month we'll transfer your<br>earnings to your bank account.</p>
            </div>
        </div>
    </div>

    <div class="lender_sign_div" id="signUpPopup">
        <span class="close-button" id="closeSignUpPopup">&times;</span>
        <div class="form-container">
            <p style="color: #E7687D;">Start earning money in just a few steps!</p>
            <p class="title">SIGN UP</p>
            <form name="lenderSignupForm" class="form" action="lender_signup.php" method="POST" onsubmit="return validateForm()">
                <input type="text" class="input" placeholder="First name" name="fname" required>
                <input type="text" class="input" placeholder="Last name" name="lname" required>
                <input type="number" class="input" placeholder="Phone number" name="phone" required>
                <input type="email" class="input" placeholder="Email" name="email" required>
                <input type="password" class="input" placeholder="Password" name="password" required>
                <button class="form-btn">Sign up</button>
                <p class="sign-up-label">
                    Already have an account?<span class="sign-up-link"><a id="triggerSignInPopup" href="#">Sign in</a></span>
                </p>
            </form>
        </div>
    </div>

    <div class="lender_sign_div" id="signInPopup">
        <span class="close-button" id="closeSignInPopup">&times;</span>
        <div class="form-container">
            <p class="title">Welcome back</p>
            <form class="form" action="lender_signin.php" method="POST">
                <input type="email" class="input" placeholder="Email" name="email">
                <input type="password" class="input" placeholder="Password" name="password">
                <button class="form-btn">Log in</button>
                <p class="sign-up-label">
                    Don't have an account?<span class="sign-up-link"><a id="triggerSignUpPopup" href="#">Sign up</a></span>
                </p>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('openSignUpPopup').addEventListener('click', function() {
            document.getElementById('signUpPopup').style.display = 'block';
            document.getElementById('signInPopup').style.display = 'none';
        });

        document.getElementById('closeSignUpPopup').addEventListener('click', function() {
            document.getElementById('signUpPopup').style.display = 'none';
        });

        document.getElementById('openSignInPopup').addEventListener('click', function() {
            document.getElementById('signInPopup').style.display = 'block';
            document.getElementById('signUpPopup').style.display = 'none';
        });

        document.getElementById('closeSignInPopup').addEventListener('click', function() {
            document.getElementById('signInPopup').style.display = 'none';
        });

        document.getElementById('triggerSignUpPopup').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default anchor click behavior
            document.getElementById('signInPopup').style.display = 'none'; // Close the login popup
            document.getElementById('signUpPopup').style.display = 'block'; // Open the sign-up popup
        });

        document.getElementById('triggerSignInPopup').addEventListener('click', function(event) {
            event.preventDefault(); // Prevent the default anchor click behavior
            document.getElementById('signUpPopup').style.display = 'none'; // Close the sign-up popup
            document.getElementById('signInPopup').style.display = 'block'; // Open the sign-in popup
        });

        function validateForm() {
            const password = document.forms["lenderSignupForm"]["password"].value;
            const regex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{8,}$/;

            if (!regex.test(password)) {
                alert("Password must be at least 8 characters long, include at least one uppercase letter, and one special character.");
                return false;
            }
            return true;
        }
    </script>

</body>

<footer style="border-top: 1px solid #E7687D; margin-top: 5rem;">
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

</html>