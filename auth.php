<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Cek login
if (!isset($_SESSION['username'])) {
    $_SESSION['error_message'] = "Silakan login dulu!";
    header("Location: login.php");
    exit;
}
?>
