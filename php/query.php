<?php
include("dbcon.php");
if(isset($POST['register'])) {
    $username = $_POST['name'];
    $useremail = $_POST['email'];
    $userpassword = $_POST['password'];
    $usernumber = $_POST['number'];
    $query= $pdo->prepare("insert into users (name,email,password,number)
    values (:un, :ue, :up, :unm");
    $query->bindParam("un", $username);
    $query->bindParam("ue", $useremail);
    $query->bindParam("up", $userpassword);
    $query->bindParam("unm", $usernumber);
    $query->excute();
}
?>