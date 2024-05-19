<?php
include("components/header.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include("../cozastore/php/dbcon.php");

// Function to save order to the database
function saveOrderToDatabase($orderDetails, $pdo)
{
    try {
        $pdo->beginTransaction();

        // Prepare the SQL statement to insert order details
        $sql = "INSERT INTO orders (fullname, email, address, city, zipcode, country, payment_method) 
                VALUES (:fullname, :email, :address, :city, :zipcode, :country, :payment_method)";
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':fullname', $orderDetails['fullname']);
        $stmt->bindParam(':email', $orderDetails['email']);
        $stmt->bindParam(':address', $orderDetails['address']);
        $stmt->bindParam(':city', $orderDetails['city']);
        $stmt->bindParam(':zipcode', $orderDetails['zipcode']);
        $stmt->bindParam(':country', $orderDetails['country']);
        $stmt->bindParam(':payment_method', $orderDetails['payment_method']);

        $stmt->execute();

        $pdo->commit();

        return true; 
    } catch (PDOException $e) {
        
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
        return false; 
    }
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = $_POST['fullname'];

    $orderDetails = $_SESSION['cart'];

    saveOrderToDatabase($orderDetails, $pdo);

    unset($_SESSION['cart']);

    header("Location: thank-you.php");
    exit;
}
?>
