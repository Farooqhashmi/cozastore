<?php
session_start();
include("components/header.php");
include("../cozastore/php/dbcon.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION['sessionemail'])) {
    echo "<script>alert('You are not logged in. Please log in to access your account.'); location.assign('account-login.php');</script>";
    exit();
}

// Fetch user data
$query = $pdo->prepare("SELECT * FROM user WHERE useremail = :ue");
$query->bindParam(":ue", $_SESSION['sessionemail']);
$query->execute();
$userData = $query->fetch(PDO::FETCH_ASSOC);
?>

<!-- Title page -->
<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('images/bg-01.jpg');">
    <h2 class="ltext-105 cl0 txt-center">
        My Account
    </h2>
</section>

<?php echo '<link rel="stylesheet" type="text/css" href="../cozastore/css/my-account.css">'; ?>

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container center-container">
        <div class="size-215 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
            <h4 class="mtext-105 cl2 txt-center p-b-30">
                Welcome, <?php echo htmlspecialchars($userData['username']); ?>!
            </h4>
            <form action="update-profile.php" method="post">
                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="username" placeholder="Your Name" value="<?php echo htmlspecialchars($userData['username']); ?>" required>
                    <img class="how-pos4 pointer-none" src="images/icons/user.png" alt="ICON" width="23p">
                </div>
                <div class="bor8 m-b-20 how-pos4-parent">    
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="email" name="useremail" placeholder="Your Email Address" value="<?php echo htmlspecialchars($userData['useremail']); ?>" required>
                    <img class="how-pos4 pointer-none" src="images/icons/email.png" alt="ICON" width="23p">
                </div>
                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="userphone" placeholder="Your Phone" value="<?php echo htmlspecialchars($userData['userphone']); ?>" required>
                    <img class="how-pos4 pointer-none" src="images/icons/phone.png" alt="ICON" width="23p">
                </div>
                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="text" name="useraddress" placeholder="Your Address" value="<?php echo htmlspecialchars($userData['useraddress'] ?? ''); ?>">
                    <img class="how-pos4 pointer-none" src="images/icons/address.png" alt="ICON" width="23p">
                </div>
                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="date" name="userdob" placeholder="Your Date of Birth" value="<?php echo htmlspecialchars($userData['userdob'] ?? ''); ?>">
                    <img class="how-pos4 pointer-none" src="images/icons/dob.png" alt="ICON" width="23p">
                </div>
                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="newpassword" placeholder="New Password">
                    <img class="how-pos4 pointer-none" src="images/icons/password.png" alt="ICON" width="23p">
                </div>
                <div class="bor8 m-b-20 how-pos4-parent">
                    <input class="stext-111 cl2 plh3 size-116 p-l-62 p-r-30" type="password" name="confirmpassword" placeholder="Confirm Password">
                    <img class="how-pos4 pointer-none" src="images/icons/enter.png" alt="ICON" width="23p">
                </div>
                <button type="submit" class="flex-c-m stext-101 cl0 size-121 bg3 bor1 hov-btn3 p-lr-15 trans-04 pointer" name="update">
                    Update
                </button>
            </form>
        </div>
    </div>
</section>

<?php
include("components/footer.php");
?>
