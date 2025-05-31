<?php
include __DIR__ . '/../connetdb.php';

$sekarang = date('Y-m-d H:i:s');

// bisa di ganti berapa aja untuk hilangin buku yang di ganti 
$sql = "DELETE FROM buku WHERE waktupeminjaman <= DATE_SUB(?, INTERVAL 10 MINUTE)";
$stmt = $koneksi->prepare($sql);
$stmt->bind_param("s", $sekarang);

if ($stmt->execute()) {
    echo "Data buku yang sudah lebih dari 1 menit berhasil dihapus.";
} else {
    echo "Gagal menghapus data: " . $koneksi->error;
}
file_put_contents("log.txt", date("Y-m-d H:i:s") . " - Script dijalankan\n", FILE_APPEND);
$stmt->close();
$koneksi->close();
