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

// Ambil data pesanan berdasarkan ID
$sql = "SELECT * FROM orders WHERE id = $order_id";
$result = $conn->query($sql);
$order = $result->fetch_assoc();

// Proses form jika disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $order_amount = $_POST['order_amount'];
    $food_name = $_POST['food_name'];
    $address = $_POST['address'];

    // Update data di database
    $update_sql = "UPDATE orders SET 
                    name = '$name', 
                    email = '$email', 
                    phone_number = '$phone_number', 
                    order_amount = $order_amount, 
                    food_name = '$food_name', 
                    address = '$address'
                    WHERE id = $order_id";

    if ($conn->query($update_sql) === TRUE) {
        // Redirect ke halaman display_orders.php setelah berhasil diperbarui
        header("Location: display_order.php");
        exit; // Menghentikan eksekusi kode lebih lanjut
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        form {
            max-width: 500px;
            margin: 20px auto;
        }
        .input {
            margin-bottom: 15px;
        }
        .input label {
            display: block;
            margin-bottom: 5px;
        }
        .input input {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
        }
        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h2>Edit Order</h2>

<form method="POST">
    <div class="input">
        <label>Name</label>
        <input type="text" name="name" value="<?php echo $order['name']; ?>" required>
    </div>

    <div class="input">
        <label>Email</label>
        <input type="email" name="email" value="<?php echo $order['email']; ?>" required>
    </div>

    <div class="input">
        <label>Phone Number</label>
        <input type="text" name="phone_number" value="<?php echo $order['phone_number']; ?>" required>
    </div>

    <div class="input">
        <label>Order Amount</label>
        <input type="number" name="order_amount" value="<?php echo $order['order_amount']; ?>" required>
    </div>

    <div class="input">
        <label>Food Name</label>
        <input type="text" name="food_name" value="<?php echo $order['food_name']; ?>" required>
    </div>

    <div class="input">
        <label>Address</label>
        <input type="text" name="address" value="<?php echo $order['address']; ?>" required>
    </div>

    <button type="submit">Update Order</button>
</form>

</body>
</html>
