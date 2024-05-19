<?php
include("components/header.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../cozastore/php/dbcon.php");

echo '<link rel="stylesheet" type="text/css" href="css/checkout.css">';

?>

<!-- Breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <span class="stext-109 cl4">Checkout</span>
    </div>
</div>

<!-- Checkout Form -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="mb-4">Checkout</h2>
            <form action="confirm-order.php" method="post">
                <div class="form-group">
                    <label for="fullname">Full Name</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>
                <!-- Add other form fields here -->
                <button type="submit" class="btn btn-primary">Place Order</button>
                <br></br>
            </form>
        </div>
    </div>
</div>

<?php
include("components/footer.php");
?>
