<?php
session_start();

// Cek apakah data username dan password tersedia
if (!isset($_POST['username']) || !isset($_POST['password'])) {
    die("Login gagal! Data tidak lengkap.");
}

// Tentukan username dan password hardcoded
$valid_username = 'admin';
$valid_password = '12345'; // Ganti dengan password yang diinginkan

// Ambil data dari form login
$user = $_POST['username'];
$pass = $_POST['password'];

// Verifikasi username dan password
if ($user === $valid_username && $pass === $valid_password) {
    // Login berhasil, set session
    $_SESSION['admin_logged_in'] = true;
    $_SESSION['username'] = $user;
    header("Location: display_orders.php");
    exit;
} else {
    // Login gagal
    echo "Login gagal! Username atau password salah.";
}
?>
