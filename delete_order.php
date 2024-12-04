<?php
// Konfigurasi database
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'order_system';

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil ID dari URL
$order_id = $_GET['id'];

// Query untuk menghapus data
$sql = "DELETE FROM orders WHERE id = $order_id";

if ($conn->query($sql) === TRUE) {
    // Redirect ke halaman display_orders.php setelah berhasil dihapus
    header("Location: display_order.php");
    exit; // Menghentikan eksekusi kode lebih lanjut
} else {
    echo "Error: " . $conn->error;
}

$conn->close();
?>
