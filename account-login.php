<?php
session_start(); 
ob_start();
include("components/header.php");
include("../cozastore/php/dbcon.php");

if (isset($_SESSION['sessionemail'])) {
    header("Location: my-account.php"); 
    exit();
}

if (isset($_POST['userlogin'])) {
    $customeremail = $_POST['customeremail'];
    $customerpassword = $_POST['customerpassword'];

    // Fetch user data
    $query = $pdo->prepare("SELECT * FROM user WHERE useremail = :email");
    $query->bindParam(":email", $customeremail);
    $query->execute();
    $userData = $query->fetch();

    if ($userData && password_verify($customerpassword, $userData['userpassword'])) {
        $_SESSION['sessionid'] = $userData['userid'];
        $_SESSION['sessionemail'] = $userData['useremail'];
        $_SESSION['sessionname'] = $userData['username'];
        $_SESSION['sessionphone'] = $userData['userphone'];
        $_SESSION['sessionrole'] = $userData['userrole'];

        header("Location: index.php"); // Redirect to index.php after successful login
        exit();
    } else {
        echo "<script>alert('Invalid email or password');</script>";
    }
}
?>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        Sign In
    </h2>
</section>

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-c-m flex-w">
            <div class="size-120 bor10 flex-w flex-col-m p-lr-93 p-tb-30 p-lr-15-lg w-full-md">
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
ob_end_flush();
?>
