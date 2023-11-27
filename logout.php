<?php 
session_start();
session_destroy();

// Hapus cookie "username"
setcookie("username", "", time() - 3600, "/");

header("Location: login.php");
?>