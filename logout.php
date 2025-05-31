<?php
session_start();
session_unset();      // Hapus semua variabel session
session_destroy();    // Hancurkan session

// Arahkan ke beranda.php setelah logout
header("Location: beranda.php");
exit;
?>
