<?php
include("components/header.php");
include("../cozastore/php/dbcon.php");

// Check if user is logged in
if(!isset($_SESSION['sessionemail'])){
    echo "<script>
        alert('You are not logged in. Please log in to access your account.');
        location.assign('account-login.php');
    </script>";
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

<!-- Content page -->
<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <h4 class="mtext-105 cl2 txt-center p-b-30">
                    Welcome, <?php echo $userData['username']; ?>!
                </h4>
                <div>
                    <p><strong>Name:</strong> <?php echo $userData['username']; ?></p>
                    <p><strong>Email:</strong> <?php echo $userData['useremail']; ?></p>
                    <p><strong>Phone:</strong> <?php echo $userData['userphone']; ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
include("components/footer.php");
?>
