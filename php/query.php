<?php
include('dbcon.php');
session_start();

//Category Reference
$catref = "../dashmin/img/category/";
//Product Reference
$proref = "../dashmin/img/product/";

if(isset($_POST['register'])){
    $userName = $_POST['username'];
    $userEmail = $_POST['useremail'];
    $userNumber = $_POST['userphone'];
    $userPassword = $_POST['userpassword'];

    $hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);

    $query= $pdo->prepare("INSERT INTO `user`(`username`, `useremail`, `userphone`, `userpassword`) VALUES (:un,:ue,:unum,:up)");
    $query->bindParam(":un",$userName);
    $query->bindParam(":ue",$userEmail);
    $query->bindParam(":unum",$userNumber);
    $query->bindParam(":up",$hashedPassword);
    $query->execute();

    echo "<script>alert('User added successfully');
    location.assign('customer-dashboard.php');
    </script>";
    exit;
}

// Update user
if(isset($_POST['updatedetails'])){
    $userid = $_POST['userid'];
    $userName = $_POST['username'];
    $userEmail = $_POST['useremail'];
    $userPhone = $_POST['userphone'];
    $query = $pdo->prepare("UPDATE user SET username = :un,  userphone = :uphone, useremail = :uemail WHERE userid = :uid");
    $query->bindParam(":uid", $userid);
    $query->bindParam(":un", $userName);
    $query->bindParam(":uemail", $userEmail);
    $query->bindParam(":uphone", $userPhone);
    $query->execute();

    // Update session data if the update was successful
    if ($query->rowCount() > 0) {
        $_SESSION['sessionname'] = $userName;
        $_SESSION['sessionemail'] = $userEmail;
        $_SESSION['sessionphone'] = $userPhone;
        echo "<script>alert('User Update Successful');
        location.assign('my-account.php');
        </script>";
    } else {
        echo "<script>alert('User Update Failed');
        location.assign('my-account.php');
        </script>";
    }
    exit;
}

//login
if(isset($_POST['login'])){
    $userEmail = $_POST['useremail'];
    $userPassword = $_POST['userpassword'];
    $query= $pdo->prepare("SELECT * from user where useremail=:ue AND userpassword=:up");
    $query->bindParam(":ue",$userEmail);
    $query->bindParam(":up",$userPassword);
    $query->execute();
    $userData = $query->fetch(PDO::FETCH_ASSOC);

    if($userData && password_verify($userPassword, $userData['userpassword'])){
        $_SESSION['sessionemail'] = $userData['useremail'];
        $_SESSION['sessionname'] = $userData['username'];
        $_SESSION['sessionpassword'] = $userData['userpassword'];
        $_SESSION['sessionrole'] = $userData['userrole'];
        
        if($_SESSION['sessionrole'] == "user"){
            echo "<script>alert('User login successfully');
            location.assign('customer-dashboard.php');
            </script>";
        }else{
            echo "<script>alert('Logged in successfully');
            location.assign('../dashmin/index.php');
            </script>";
        }
    } else {
        echo "<script>alert('Login failed. Invalid email or password');
        location.assign('login.php');
        </script>";
    }
    exit;
}
?>
