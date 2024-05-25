<?php
ob_start();
include("components/header.php");
include("../cozastore/php/dbcon.php");

if (isset($_POST['register'])) {
    // Check if the necessary keys are set in the $_POST array
    if(isset($_POST['username'], $_POST['useremail'], $_POST['userpassword'], $_POST['userphone'])) {
        $name = trim($_POST['username']);
        $email = trim($_POST['useremail']);
        $password = trim($_POST['userpassword']);
        $phone = trim($_POST['userphone']);
        $userrole = "customer"; // Default role for new users

        // Validate if all required fields are filled
        $requiredFields = ['username', 'useremail', 'userpassword', 'userphone'];
        $missingFields = array_filter($requiredFields, function($field) {
            return empty(trim($_POST[$field]));
        });

        if (!empty($missingFields)) {
            echo "<script>alert('Please fill in all the required fields.'); history.back();</script>";
            exit();
        }

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Invalid email format.');</script>";
            exit();
        }

        // Validate password length
        if (strlen($password) < 14) {
            echo "<script>alert('Password must be at least 14 characters long.');</script>";
            exit();
        }

        // Validate phone number length
        if (strlen($phone) != 11) {
            echo "<script>alert('Phone number must be 11 characters long.');</script>";
            exit();
        }

        // Check if email already exists
        $query = $pdo->prepare("SELECT * FROM user WHERE useremail = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        if ($query->rowCount() > 0) {
            echo "<script>alert('Email already registered. Please use a different email.');</script>";
            exit();
        }

        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Register the user
        $query = $pdo->prepare("INSERT INTO user (username, useremail, userphone, userpassword, userrole) VALUES (:name, :email, :phone, :password, :role)");
        $query->bindParam(":name", $name);
        $query->bindParam(":email", $email);
        $query->bindParam(":phone", $phone);
        $query->bindParam(":password", $hashedPassword);
        $query->bindParam(":role", $userrole);

        if ($query->execute()) {
            echo "<script>alert('User registered successfully'); location.assign('account-login.php');</script>";
            exit(); // Redirect to login page after successful registration
        } else {
            echo "<script>alert('Error registering user');</script>";
            print_r($query->errorInfo()); // Print any errors for debugging
        }
    } else {
        // If any required key is missing, display an error message
        echo "<script>alert('One or more required fields are missing.');</script>";
    }
}
?>

<!--CSS To center the registration form-->
<style>
    .center-container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .size-215 {
        width: 100%;
    }
</style>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Sign Up
    </h2>
</section>

<!-- Content page -->
<section class="bg0">
    <div class="container center-container">
        <div class="size-215 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
            <form method="post" action="">
                <h4 class="mtext-105 cl2 txt-center p-b-30">
                    Register Your Account
                </h4>

                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="username" placeholder="Your Name" required>
                    <img class="how-pos4 pointer-none" src="images/icons/user.png" alt="ICON" width="23p">
                </div>
                <div class="bor8 m-b-20 how-pos4-parent">    
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="useremail" placeholder="Your Email Address" required>
                    <img class="how-pos4 pointer-none" src="images/icons/email.png" alt="ICON" width="23p">
                </div>
                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="userpassword" placeholder="Your Password" required>
                    <img class="how-pos4 pointer-none" src="images/icons/password.png" alt="ICON" width="23p">
                </div>
                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="userphone" placeholder="Your Phone" required>
                    <img class="how-pos4 pointer-none" src="images/icons/phone.png" alt="ICON" width="23p">
                </div>

                <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" name="register">
                    Submit
                </button>
            </form>
        </div>
    </div>
</section>

<?php
include("components/footer.php");
ob_end_flush();
?>
