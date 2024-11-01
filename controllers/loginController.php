<?php
session_start();
include '../models/Database.php';

$error = ''; // Variabel untuk menyimpan pesan kesalahan

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Enkripsi MD5

    $db = new Database();
    $conn = $db->connect();

    if ($conn) {
        $query = "SELECT * FROM admins WHERE email='$email' AND password='$password'";
        $result = $conn->query($query);

        if ($result->num_rows > 0) {
            $_SESSION['admin'] = $email;
            header("Location: ../views/dashboard.php");
            exit;
        } else {
            $error = "Login gagal, email atau password salah.";
        }
    } else {
        $error = "Connection error: Tidak dapat terhubung ke database.";
    }
    // Redirect kembali ke halaman login dengan pesan error
    header("Location: ../views/login.php?error=" . urlencode($error));
    exit;
}
?>
