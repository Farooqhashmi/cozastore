<?php

// Check if user is logged in
if(isset($_SESSION['sessionemail'])){
    // User is logged in
    if($_SESSION['sessionrole'] == "admin" || $_SESSION['sessionrole'] == "superadmin" 
	|| $_SESSION['sessionrole'] == "shop_manager" || $_SESSION['sessionrole'] == "sales_person" ){
        // Display admin links
?>
        <a href="../dashboard" class="flex-c-m p-lr-10 trans-04">
            Admin Area
        </a>
<?php
    } else {
        // Display customer links
?>
        <a href="my-account.php" class="flex-c-m p-lr-10 trans-04">
            Customer Dashboard
        </a>
        <a href="logout.php" class="flex-c-m p-lr-10 trans-04">
            Logout
        </a>
<?php
    }
} else {
    // User is not logged in
?>
    <a href="account-login.php" class="flex-c-m p-lr-10 trans-04">
        Login/Sign Up
    </a>
<?php
}
?>
