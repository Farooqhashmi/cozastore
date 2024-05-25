<?php
session_start();
include("../cozastore/php/dbcon.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION['sessionemail'])) {
    echo "<script>alert('You are not logged in. Please log in to access your account.'); location.assign('account-login.php');</script>";
    exit();
}

// Update user data
if (isset($_POST['update'])) {
    $username = $_POST['username'] ?? '';
    $useremail = $_POST['useremail'] ?? '';
    $userphone = $_POST['userphone'] ?? '';
    $useraddress = $_POST['useraddress'] ?? '';
    $userdob = $_POST['userdob'] ?? '';
    $newpassword = $_POST['newpassword'] ?? '';
    $confirmpassword = $_POST['confirmpassword'] ?? '';

    if ($newpassword !== $confirmpassword) {
        echo "<script>alert('Passwords do not match.'); location.assign('my-account.php');</script>";
        exit();
    }

    $updateQuery = "UPDATE user SET username = :un, useremail = :ue, userphone = :up, useraddress = :ua, userdob = :ud";
    if (!empty($newpassword)) {
        $hashedPassword = password_hash($newpassword, PASSWORD_BCRYPT);
        $updateQuery .= ", userpassword = :upw";
    }
    $updateQuery .= " WHERE useremail = :original_email";

    $query = $pdo->prepare($updateQuery);
    $query->bindParam(":un", $username);
    $query->bindParam(":ue", $useremail);
    $query->bindParam(":up", $userphone);
    $query->bindParam(":ua", $useraddress);
    $query->bindParam(":ud", $userdob);
    if (!empty($newpassword)) {
        $query->bindParam(":upw", $hashedPassword);
    }
    $query->bindParam(":original_email", $_SESSION['sessionemail']);

    if ($query->execute()) {
        $_SESSION['sessionemail'] = $useremail; // Update session email if changed
        echo "<script>alert('Profile updated successfully.'); location.assign('my-account.php');</script>";
    } else {
        echo "<script>alert('Failed to update profile. Please try again.'); location.assign('my-account.php');</script>";
    }
}
?>
