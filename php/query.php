<?php
include('dbcon.php');
if(isset($_POST['register'])){
    $userName = $_POST['username'];
    $userEmail = $_POST['useremail'];
    $userNumber = $_POST['userphone'];
    $userPassword = $_POST['userpassword'];
    $query= $pdo->prepare("INSERT INTO `user`(`username`, `useremail`, `userphone`, `userpassword`) VALUES (:un,:ue,:unum,:up)");
    $query->bindParam("un",$userName);
    $query->bindParam("ue",$userEmail);
    $query->bindParam("unum",$userNumber);
    $query->bindParam("up",$userPassword);
    $query->execute();
echo "<script>alert('User added successfully')
location.assign('login.php')
</script>";
}

//login
if(isset($_POST['login'])){
    $userEmail = $_POST['useremail'];
    $userPassword = $_POST['userpassword'];
    $query= $pdo->prepare("SELECT * from user where useremail=:ue && userpassword=:up");
    $query->bindParam("ue",$userEmail);
    $query->bindParam("up",$userPassword);
    $query->execute();
    $userData = $query->fetch(PDO::FETCH_ASSOC);
    if($userData){
    $_SESSION['sessionEmail'] = $userData['useremail'];
    $_SESSION['sessionName'] = $userData['username'];
    $_SESSION['sessionPassword'] = $userData['userpassword'];
    $_SESSION['sessionRole'] = $userData['userrole'];
    if($_SESSION['sessionRole'] == "user"){
        echo "<script>alert('User login successfully')
        location.assign('customer-dashboard.php')
        </script>";
    }else{
        echo "<script>alert('Logged in successfully')
        location.assign('index.php')
        </script>";
    }

}
}

?>
