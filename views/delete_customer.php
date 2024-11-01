<?php
// Fungsi untuk koneksi ke database
include_once '../models/Database.php';

// Cek apakah ada parameter 'id' yang diterima
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Buat instance dari kelas Database dan lakukan koneksi
    $db = new Database();
    $conn = $db->connect();

    // Query untuk menghapus customer
    $query = "DELETE FROM customers WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirect ke halaman customers dengan pesan sukses
        header("Location: customers.php?message=Customer berhasil dihapus!");
        exit();
    } else {
        // Redirect dengan pesan error
        header("Location: customers.php?message=Error: " . $stmt->error);
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    // Jika tidak ada id, redirect ke halaman customers
    header("Location: customers.php?message=ID customer tidak ditemukan!");
    exit();
}
?>
