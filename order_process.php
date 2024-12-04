<?php
// Konfigurasi database
$host = 'localhost';
$username = 'root'; // Sesuaikan dengan username MySQL Anda
$password = ''; // Sesuaikan dengan password MySQL Anda
$dbname = 'order_system';

// Koneksi ke database
$conn = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Proses data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $order_amount = $_POST['order_amount'];
    $food_name = $_POST['food_name'];
    $address = $_POST['address'];

    // Query untuk memasukkan data ke tabel
    $sql = "INSERT INTO orders (name, email, phone_number, order_amount, food_name, address) 
            VALUES ('$name', '$email', '$phone_number', '$order_amount', '$food_name', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "Pesanan Anda telah berhasil disimpan!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Tutup koneksi
$conn->close();
?>
