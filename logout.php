<?php
session_start();
session_unset();
session_destroy(); 

// Unset session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

echo "<script>alert('Logout successfully');</script>";
header('Location: index.php'); 
exit(); 
?>
