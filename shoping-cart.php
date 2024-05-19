<?php
include("components/header.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../cozastore/php/dbcon.php");

echo '<link rel="stylesheet" type="text/css" href="css/shoping-cart.css">';

// fetch product details from the database
function getProductDetails($productId, $pdo)
{
    $sql = "SELECT * FROM products WHERE productId = :productId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['productId' => $productId]);
    $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);
    return $productDetails;
}

// calculate total price for all items in the cart
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

// apply coupon code
function applyCouponCode($couponCode)
{
    return 0; 
}

// calculate shipping cost
function calculateShippingCost($country)
{
    return 0; 
}

// Update cart quantities
if (isset($_POST['update_cart'])) {
    foreach ($_SESSION['cart'] as $key => $product) {
        if (isset($_POST['quantity_' . $product['productId']])) {
            $_SESSION['cart'][$key]['productQuantity'] = $_POST['quantity_' . $product['productId']];
        }
    }
    echo "<script>alert('Cart updated successfully!');</script>";
}

// Proceed to checkout
if (isset($_POST['proceed_to_checkout'])) {
    header("Location: checkout.php");
    exit;
}

?>

<!-- Breadcrumb -->
<div class="container">
    <div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
        <a href="index.html" class="stext-109 cl8 hov-cl1 trans-04">
            Home
            <i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
        </a>
        <span class="stext-109 cl4">Shopping Cart</span>
    </div>
</div>

<!-- Shopping Cart -->
<form class="bg0 p-t-75 p-b-85" method="post" action="">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
                <div class="m-l-25 m-r--38 m-lr-0-xl">
                    <div class="wrap-table-shopping-cart">
                        <table class="table-shopping-cart">
                            <tr class="table_head">
                                <th class="column-5">Id</th>
                                <th class="column-1">Product</th>
                                <th class="column-2"></th>
                                <th class="column-3">Price</th>
                                <th class="column-4">Quantity</th>
                                <th class="column-5">Total</th>
                                <th class="column-5">Remove</th>
                            </tr>
                            <?php
                            if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $proCartData) {
                                    $productId = $proCartData['productId'];
                                    $productDetails = getProductDetails($productId, $pdo);
                                    if ($productDetails) {
                                        $total = $productDetails['productPrice'] * $proCartData['productQuantity'];
                            ?>
                                        <tr class="table_row">
                                            <td class="column-5"><?php echo $productId ?></td>
                                            <td class="column-1">
                                                <div class="how-itemcart1">
                                                    <img src="<?php echo $proImgRef . $productDetails['productImage'] ?>" alt="Product Image">
                                                </div>
                                            </td>
                                            <td class="column-2"><?php echo $productDetails['productName'] ?></td>
                                            <td class="column-3">$ <?php echo $productDetails['productPrice'] ?></td>
                                            <td class="column-4">
                                                <div class="wrap-num-product flex-w m-l-auto m-r-0">
                                                    <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-minus"></i>
                                                    </div>
                                                    <input class="mtext-104 cl3 txt-center num-product" type="number" name="quantity_<?php echo $productId ?>" value="<?php echo $proCartData["productQuantity"] ?>">
                                                    <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m">
                                                        <i class="fs-16 zmdi zmdi-plus"></i>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="column-5">$ <?php echo $total ?></td>
                                            <td class="column-5">
                                                <a href="?deleteCart=<?php echo $productId ?>" class="btn btn-danger">Remove</a>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                }
                            } else {
                                echo '<tr class="table_row"><td colspan="7" class="column-1">Your cart is empty</td></tr>';
                            }
                            ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coupon Code and Update Cart Button -->
    <div class="flex-c-m m-tb-5">
        <input class="stext-104 cl2 plh4 size-117 bor13 p-lr-20 m-r-10 m-tb-5" type="text" name="coupon" placeholder="Coupon Code">
        <div class="flex-c-m stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5">
            Apply coupon
        </div>
    </div>
    <div class="flex-c-m m-tb-10">
        <input type="submit" class="stext-101 cl2 size-118 bg8 bor13 hov-btn3 p-lr-15 trans-04 pointer m-tb-5" name="update_cart" value="Update Cart">
    </div>

    <!-- Cart Totals -->
    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
            <h4 class="mtext-109 cl2 p-b-30">
                Cart Totals
            </h4>
            <div class="flex-w flex-t bor12 p-b-13">
                <div class="size-208">
                    <span class="stext-110 cl2">
                        Subtotal:
                    </span>
                </div>
                <div class="size-209">
                    <span class="mtext-110 cl2">
                        $<?php echo calculateTotal(isset($_SESSION['cart']) ? $_SESSION['cart'] : [], $pdo); ?>
                    </span>
                </div>
            </div>
            <!-- Proceed to Checkout Button -->
            <div class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer m-tb-10">
                <button type="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer" name="proceed_to_checkout">Proceed to Checkout</button>
            </div>
        </div>
    </div>
</form>

<?php
include("components/footer.php");
?>
