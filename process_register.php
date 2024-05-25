<?php
include("dbcon.php"); 

if (isset($_POST['register'])) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $number = trim($_POST['number']);

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); history.back();</script>";
        exit();
    }

    // Validate password length and complexity
    if (strlen($password) < 8 || 
        !preg_match('/[A-Z]/', $password) || 
        !preg_match('/[a-z]/', $password) || 
        !preg_match('/[0-9]/', $password) || 
        !preg_match('/[!@#$%^&*()_+=-{};:"<>,./?]/', $password)) {
        echo "<script>alert('Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.'); history.back();</script>";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user into database
    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, number) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashed_password, $number]);
        echo "<script>alert('Registration successful!'); location.assign('login.php');</script>";
    } catch (PDOException $e) {
        // Check if the email already exists
        if ($e->getCode() == 23000) { // 23000 is the SQLSTATE code for a unique constraint violation
            echo "<script>alert('Email already registered. Please use a different email.'); history.back();</script>";
        } else {
            echo "<script>alert('Registration failed: " . $e->getMessage() . "'); history.back();</script>";
        }
    }
} else {
    echo "<script>location.assign('register.php');</script>";
}
?>
