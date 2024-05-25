<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../cozastore/php/dbcon.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$userDetailsQuery = "SELECT * FROM users WHERE user_id = :user_id";
$stmt = $pdo->prepare($userDetailsQuery);
$stmt->execute(['user_id' => $user_id]);
$userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

include("components/header.php");

echo '<link rel="stylesheet" type="text/css" href="css/checkout.css">';

function getProductDetails($productId, $pdo)
{
    $sql = "SELECT * FROM products WHERE productId = :productId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['productId' => $productId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function calculateTotal($cart, $pdo)
{
    $total = 0;
    if (is_array($cart)) {
        foreach ($cart as $proCartData) {
            $productId = $proCartData['productId'];
            $productDetails = getProductDetails($productId, $pdo);
            if ($productDetails) {
                $total += $productDetails['productPrice'] * $proCartData['productQuantity'];
            }
        }
    }
    return $total;
}
?>

<!-- Breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
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
                    <input type="text" class="form-control" id="fullname" name="fullname" value="<?php echo htmlspecialchars($userDetails['username']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($userDetails['email']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="<?php echo htmlspecialchars($userDetails['phone']); ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea class="form-control" id="address" name="address" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Place Order</button>
            </form>
        </div>
    </div>
</div>

<?php
include("components/footer.php");
?>
