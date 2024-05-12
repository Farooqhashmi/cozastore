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
location.assign('myaccount.php')
</script>";
}

?>
