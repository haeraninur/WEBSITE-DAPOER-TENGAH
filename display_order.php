<?php
session_start();
// Cek apakah pengguna sudah login sebagai admin
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
?>
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

// Query untuk mendapatkan data
$sql = "SELECT id, name, email, phone_number, order_amount, food_name, address, order_date FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        .logout-btn {
            display: block;
            margin: 10px 0;
            padding: 10px 15px;
            background-color: #d9534f;
            color: white;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .logout-btn:hover {
            background-color: #c9302c;
        }
    </style>
</head>
<body>

<!-- Tombol Logout -->
<a href="logout.php" class="logout-btn">Logout</a>

<h2>Order Table</h2>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Order Amount</th>
            <th>Food Name</th>
            <th>Address</th>
            <th>Order Date</th>
            <th>Action</th> <!-- Tambahkan kolom aksi -->
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result->num_rows > 0) {
            // Output data per row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["id"] . "</td>
                        <td>" . $row["name"] . "</td>
                        <td>" . $row["email"] . "</td>
                        <td>" . $row["phone_number"] . "</td>
                        <td>" . $row["order_amount"] . "</td>
                        <td>" . $row["food_name"] . "</td>
                        <td>" . $row["address"] . "</td>
                        <td>" . $row["order_date"] . "</td>
                        <td>
                            <a href='edit_order.php?id=" . $row["id"] . "'>Edit</a> | 
                            <a href='delete_order.php?id=" . $row["id"] . "' onclick='return confirm(\"Are you sure you want to delete this order?\")'>Delete</a>
                        </td>
                    </tr>";
            }
        } else {
            echo "<tr><td colspan='9'>No orders found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>
