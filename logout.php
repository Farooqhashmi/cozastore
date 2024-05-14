<?php
	session_start();
    session_unset();
    echo "<script>
    alert('User Logout');
    location.assign('account-login.php')</script>";
?>