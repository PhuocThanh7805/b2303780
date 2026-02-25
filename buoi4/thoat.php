<?php
session_start();

// xóa session
session_unset();
session_destroy();

// xóa luôn cookie nếu còn
setcookie("user", "", time() - 3600, "/");
setcookie("fullname", "", time() - 3600, "/");
setcookie("id", "", time() - 3600, "/");

// quay về login
header("Location: login.php");
exit();
?>