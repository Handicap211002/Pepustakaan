<?php
session_start();
include 'connetdb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $stmt = $koneksi->prepare("DELETE FROM buku WHERE id_peminjaman = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Buku berhasil dikembalikan.";
    } else {
        $_SESSION['error_message'] = "Gagal mengembalikan buku.";
    }

    $stmt->close();
}

$koneksi->close();
header("Location: manajemenbuku.php");
exit;
