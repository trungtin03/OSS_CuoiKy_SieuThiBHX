<?php
session_start();
// Clear specific session data
unset($_SESSION['hoTen']); // Assuming 'hoTen' is the user session variable to clear
// You can perform additional logout actions here if necessary
// Redirect to indicate a successful logout
header("Location: trang-chu.php");
exit();
?>
