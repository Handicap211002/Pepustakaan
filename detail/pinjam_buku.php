<?php
session_start();
include '../connetdb.php';

if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit;
}

// Ambil data dari form
$namabuku = $_POST['namabuku'] ?? '';
$penciptabuku = $_POST['penciptabuku'] ?? '';
$fotobuku = $_POST['fotobuku'] ?? '';
$tahunterbit = $_POST['tahunterbit'] ?? '';
$penerbit = $_POST['penerbit'] ?? '';
$halaman = $_POST['halaman'] ?? '';
$waktupeminjaman = date('Y-m-d H:i:s');
$NamaPengguna = $_SESSION['username'];  // Ambil dari session
$redirect_to = $_POST['redirect_to'] ?? 'buku.php';

// Simpan ke tabel buku
$sql_buku = "INSERT INTO buku (namabuku, penciptabuku, fotobuku, waktupeminjaman, tahunterbit, penerbit, halaman, NamaPengguna) 
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt_buku = $koneksi->prepare($sql_buku);
$stmt_buku->bind_param("ssssssss", $namabuku, $penciptabuku, $fotobuku, $waktupeminjaman, $tahunterbit, $penerbit, $halaman, $NamaPengguna);

if ($stmt_buku->execute()) {
    // Data berhasil masuk ke tabel buku
    $id_peminjaman = $koneksi->insert_id;

    // Masukkan data ke tabel peminjaman (dengan struktur yang sama)
    $sql_peminjaman = "INSERT INTO peminjaman (namabuku, penciptabuku, fotobuku, waktupeminjaman, tahunterbit, penerbit, halaman, NamaPengguna) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_peminjaman = $koneksi->prepare($sql_peminjaman);
    $stmt_peminjaman->bind_param("ssssssss", $namabuku, $penciptabuku, $fotobuku, $waktupeminjaman, $tahunterbit, $penerbit, $halaman, $NamaPengguna);
    $stmt_peminjaman->execute();
    $stmt_peminjaman->close();

    $_SESSION['success_message'] = "Berhasil meminjam buku '$namabuku'.";
    header("Location: $redirect_to?id=$id_peminjaman");
} else {
    echo "Gagal menyimpan data: " . $koneksi->error;
}

$stmt_buku->close();
$koneksi->close();
