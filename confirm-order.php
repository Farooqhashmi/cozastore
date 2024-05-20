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

// Function to get product details
function getProductDetails($productId, $pdo)
{
    $sql = "SELECT * FROM products WHERE productId = :productId";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['productId' => $productId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Function to calculate total order amount
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

// Function to save order to the database
function saveOrderToDatabase($orderDetails, $pdo, $user_id)
{
    try {
        $pdo->beginTransaction();

        // Insert order into orders table
        $sqlOrder = "INSERT INTO orders (user_id, date_of_order, time_of_order) 
                     VALUES (:user_id, :date_of_order, :time_of_order)";
        $stmtOrder = $pdo->prepare($sqlOrder);
        $stmtOrder->execute([
            'user_id' => $user_id,
            'date_of_order' => date('Y-m-d'),
            'time_of_order' => date('H:i:s')
        ]);

        $order_id = $pdo->lastInsertId();

        // Insert each product into order_details table
        foreach ($orderDetails as $proCartData) {
            $productId = $proCartData['productId'];
            $productDetails = getProductDetails($productId, $pdo);

            $sqlOrderDetails = "INSERT INTO order_details (order_id, product_id, product_name, product_quantity, product_price) 
                                VALUES (:order_id, :product_id, :product_name, :product_quantity, :product_price)";
            $stmtOrderDetails = $pdo->prepare($sqlOrderDetails);
            $stmtOrderDetails->execute([
                'order_id' => $order_id,
                'product_id' => $productId,
                'product_name' => $productDetails['productName'],
                'product_quantity' => $proCartData['productQuantity'],
                'product_price' => $productDetails['productPrice']
            ]);
        }

        // Calculate total amount for the invoice
        $totalAmount = calculateTotal($orderDetails, $pdo);

        // Insert invoice into invoices table
        $sqlInvoice = "INSERT INTO invoices (order_id, user_id, total_amount, invoice_date, order_status) 
                       VALUES (:order_id, :user_id, :total_amount, :invoice_date, :order_status)";
        $stmtInvoice = $pdo->prepare($sqlInvoice);
        $stmtInvoice->execute([
            'order_id' => $order_id,
            'user_id' => $user_id,
            'total_amount' => $totalAmount,
            'invoice_date' => date('Y-m-d H:i:s'),
            'order_status' => 'pending'
        ]);

        $pdo->commit();

        return true;
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
        return false;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $orderDetails = $_SESSION['cart'];

    if (saveOrderToDatabase($orderDetails, $pdo, $user_id)) {
        unset($_SESSION['cart']);
        header("Location: thank-you.php");
        exit;
    } else {
        echo "<p>There was an issue processing your order. Please try again.</p>";
    }
}

include("components/header.php");
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

<!-- Checkout Confirmation -->
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="mb-4">Confirm Order</h2>
            <p>Your order has been processed successfully.</p>
        </div>
    </div>
</div>

<?php include("components/footer.php"); ?>
