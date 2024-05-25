<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$catImgRef = "../dashmin/img/category/";
$proImgRef = "../dashmin/img/product/";
include("dbcon.php");

// Handle registration
if (isset($_POST['register'])) {
    // Check if all necessary keys are set in the $_POST array
    if (isset($_POST['username'], $_POST['useremail'], $_POST['userpassword'], $_POST['userphone'])) {
        $userName = $_POST['username'];
        $userEmail = $_POST['useremail'];
        $userPassword = $_POST['userpassword'];
        $userNumber = $_POST['userphone'];

        if (registerUser($userName, $userEmail, $userNumber, $userPassword)) {
            echo "<script>alert('User added successfully'); location.assign('customer-dashboard.php');</script>";
        } else {
            echo "<script>alert('Error adding user');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all the required fields');</script>";
    }
}

// Register a new user
function registerUser($username, $useremail, $userphone, $userpassword) {
    global $pdo;
    $hashedPassword = password_hash($userpassword, PASSWORD_DEFAULT);
    $query = $pdo->prepare("INSERT INTO `user`(`username`, `useremail`, `userphone`, `userpassword`) VALUES (:un, :ue, :unum, :up)");
    $query->bindParam(":un", $username);
    $query->bindParam(":ue", $useremail);
    $query->bindParam(":unum", $userphone);
    $query->bindParam(":up", $hashedPassword);
    $query->execute();
    return $query->rowCount() > 0;
}

// Handle login
if (isset($_POST['login'])) {
    if (isset($_POST['email'], $_POST['password'])) {
        $userEmail = $_POST['email'];
        $userPassword = $_POST['password'];
        $query = $pdo->prepare("SELECT * FROM user WHERE useremail=:ue");
        $query->bindParam(":ue", $userEmail);
        $query->execute();
        $userData = $query->fetch(PDO::FETCH_ASSOC);
        if ($userData && password_verify($userPassword, $userData['userpassword'])) {
            $_SESSION['sessionemail'] = $userData['useremail'];
            $_SESSION['sessionname'] = $userData['username'];
            $_SESSION['sessionpassword'] = $userData['userpassword'];
            $_SESSION['sessionrole'] = $userData['userrole'];

            if ($_SESSION['sessionrole'] == "user") {
                echo "<script>alert('logged in successfully');
                location.assign('customer.php')
                </script>";
            } else {
                echo "<script>alert('logged in successfully');
                location.assign('../dashmin/index.php')
                </script>";
            }
        } else {
            echo "<script>alert('Invalid email or password');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all the required fields');</script>";
    }
}

// Add to cart
if (isset($_POST['addToCart'])) {
    if (isset($_POST['productid'], $_POST['productname'], $_POST['productprice'], $_POST['productquantity'], $_POST['productimage'])) {
        $productId = $_POST['productid'];
        $productName = $_POST['productname'];
        $productPrice = $_POST['productprice'];
        $productQuantity = $_POST['productquantity'];
        $productImage = $_POST['productimage'];

        if (isset($_SESSION['cart'])) {
            $cartExist = false;

            foreach ($_SESSION['cart'] as $key => $values) {
                if ($values['productid'] == $productId) {
                    $_SESSION['cart'][$key]['productquantity'] += $productQuantity;
                    $cartExist = true;
                    echo "<script>alert('Cart has been updated');</script>";
                    break;
                }
            }

            if (!$cartExist) {
                $count = count($_SESSION['cart']);
                $_SESSION['cart'][$count] = array(
                    "productid" => $productId,
                    "productname" => $productName,
                    "productquantity" => $productQuantity,
                    "productprice" => $productPrice,
                    "productimage" => $productImage
                );
                echo "<script>alert('Product added to cart');</script>";
            }
        } else {
            $_SESSION['cart'][0] = array(
                "productid" => $productId,
                "productname" => $productName,
                "productquantity" => $productQuantity,
                "productprice" => $productPrice,
                "productimage" => $productImage
            );
            echo "<script>alert('Product added to cart');</script>";
        }
    } else {
        echo "<script>alert('Product details are missing');</script>";
    }
}

// Update user details
if (isset($_POST['updatedetails'])) {
    if (isset($_POST['userid'], $_POST['username'], $_POST['useremail'], $_POST['userphone'])) {
        $userid = $_POST['userid'];
        $userName = $_POST['username'];
        $userEmail = $_POST['useremail'];
        $userPhone = $_POST['userphone'];

        if (updateUserDetails($userid, $userName, $userEmail, $userPhone)) {
            $_SESSION['sessionname'] = $userName;
            $_SESSION['sessionemail'] = $userEmail;
            $_SESSION['sessionphone'] = $userPhone;
            echo "<script>alert('User Update Successful'); location.assign('my-account.php');</script>";
        } else {
            echo "<script>alert('Error updating user'); location.assign('my-account.php');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all the required fields');</script>";
    }
}

// Update user details function
function updateUserDetails($userid, $username, $useremail, $userphone) {
    global $pdo;
    $query = $pdo->prepare("UPDATE user SET username = :un, userphone = :uphone, useremail = :uemail WHERE userid = :uid");
    $query->bindParam(":uid", $userid);
    $query->bindParam(":un", $username);
    $query->bindParam(":uemail", $useremail);
    $query->bindParam(":uphone", $userphone);
    $query->execute();
    return $query->rowCount() > 0;
}

// Handle password update
if (isset($_POST['updatePassword'])) {
    if (isset($_POST['oldPass'], $_POST['newPass'], $_POST['matchnewPass'])) {
        $oldPass = $_POST['oldPass'];
        $newPass = $_POST['newPass'];
        $retypenewPass = $_POST['matchnewPass'];

        if (updatePassword($oldPass, $newPass, $retypenewPass)) {
            echo "<script>alert('Password updated successfully'); location.assign('my-account.php');</script>";
        } else {
            echo "<script>alert('Error updating password'); location.assign('my-account.php');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all the required fields');</script>";
    }
}

// Update password function
function updatePassword($oldPass, $newPass, $retypenewPass) {
    if ($retypenewPass == $newPass) {
        global $pdo;
        $querycheck = $pdo->prepare("SELECT userpassword FROM user WHERE userid = :ui");
        $querycheck->bindParam(":ui", $_SESSION['sessionid']);
        $querycheck->execute();
        $userData = $querycheck->fetch(PDO::FETCH_ASSOC);
        if (password_verify($oldPass, $userData['userpassword'])) {
            $hashedPassword = password_hash($newPass, PASSWORD_DEFAULT);
            $queryupdate = $pdo->prepare("UPDATE user SET userpassword = :upass WHERE userid = :ui");
            $queryupdate->bindParam(":ui", $_SESSION['sessionid']);
            $queryupdate->bindParam(":upass", $hashedPassword, PDO::PARAM_STR);
            return $queryupdate->execute();
        }
    }
    return false;
}
?>
