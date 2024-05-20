<?php
include("components/header.php");
include("../cozastore/php/dbcon.php");

if(isset($_SESSION['sessionemail'])){
    header("Location: my-account.php"); 
    exit();
}

if(isset($_POST['userregister'])){
    $username = $_POST['username'];
    $useremail = $_POST['useremail'];
    $userphone = $_POST['userphone'];
    $userpassword = $_POST['userpassword'];

    // Validate email format
    if(!filter_var($useremail, FILTER_VALIDATE_EMAIL)){
        echo "<script>alert('Invalid email format.');</script>";
        exit();
    }

    // Validate password length
    if(strlen($userpassword) < 8){
        echo "<script>alert('Password must be at least 8 characters long.');</script>";
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);

    // Register the user
    $query = $pdo->prepare("INSERT INTO user (username, useremail, userphone, userpassword) VALUES (:un, :ue, :uphone, :up)");
    $query->bindParam(":un", $username);
    $query->bindParam(":ue", $useremail);
    $query->bindParam(":uphone", $userphone);
    $query->bindParam(":up", $hashedPassword);
    if ($query->execute()) {
        echo "<script>alert('User registered successfully'); location.assign('account-login.php');</script>";
        exit(); // Redirect to login page after successful registration
    } else {
        echo "<script>alert('Error registering user');</script>";
        print_r($query->errorInfo()); // Print any errors for debugging
    }
}

if(isset($_POST['userlogin'])){
    $customeremail = $_POST['customeremail'];
    $customerpassword = $_POST['customerpassword'];

    // Fetch user data
    $query = $pdo->prepare("SELECT * FROM user WHERE useremail = :ue");
    $query->bindParam(":ue", $customeremail);
    $query->execute();
    $userData = $query->fetch();

    if ($userData && password_verify($customerpassword, $userData['userpassword'])) {
        $_SESSION['sessionid'] = $userData['userid'];
        $_SESSION['sessionemail'] = $userData['useremail'];
        $_SESSION['sessionname'] = $userData['username'];
        $_SESSION['sessionphone'] = $userData['userphone'];
        $_SESSION['sessionrole'] = $userData['userrole'];

        header("Location: my-account.php");
        exit();
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }
}
?>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Account Menu
    </h2>
</section>

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form method="post" id="register-form">
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Customer Registration
                    </h4>
                    <!-- Registration form inputs -->
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" required type="text" name="username" placeholder="Full Name">
                        <img class="how-pos4 pointer-none" src="images/icons/user.png" width="25px" alt="ICON">
                    </div>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" required type="text" name="useremail" placeholder="Your Email Address">
                        <img class="how-pos4 pointer-none" src="images/icons/email.png" width="23px" alt="ICON">
                    </div>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" required type="tel" name="userphone" placeholder="Contact Number">
                        <img class="how-pos4 pointer-none" src="images/icons/phone.png"  width="20px"  alt="ICON">
                    </div>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" required type="password" name="userpassword" placeholder="Password">
                        <img class="how-pos4 pointer-none" src="images/icons/password.png"  width="20px"  alt="ICON">
                    </div>

                    <button type="submit" name="userregister" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Register
                    </button>
                </form>
            </div>

            <div class="size-210 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
                <form method="post" id="login-form">
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        Customer Login
                    </h4>
                    <!-- Login form inputs -->
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="customeremail" required placeholder="Your Email Address">
                        <img class="how-pos4 pointer-none" src="images/icons/email.png" width="23px" alt="ICON">
                    </div>
                    <div class="bor8 m-b-20 how-pos4-parent">
                        <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="customerpassword" required placeholder="Password">
                        <img class="how-pos4 pointer-none" src="images/icons/password.png"  width="20px"  alt="ICON">
                    </div>

                    <button type="submit" name="userlogin" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php
include("components/footer.php");
?>

