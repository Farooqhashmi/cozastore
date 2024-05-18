<?php
session_start();
session_unset();
session_destroy(); // Destroy the session completely

// Optional: Unset session cookie
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

echo "<script>alert('Logout successfully');</script>";
header('Location: index.php'); // Use header for redirection
exit(); // Ensure no further code is executed
?>
