<?php
session_start();

// Periksa apakah pengguna sudah login, jika ya, arahkan ke display_orders.php
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: display_order.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ganti 'admin_dapteng' dan 'admin123' dengan username dan password yang Anda inginkan
    if ($username === 'admin_dapteng' && $password === 'admin123') {
        $_SESSION['admin_logged_in'] = true;
        header('Location: display_order.php');
        exit();
    } else {
        $error = "Username atau password salah!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login Admin</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: url('img/loginbackground.png') no-repeat center center/cover; 
        }
        .tm-item-container {
            background: rgba(0, 0, 0, 0.5);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            width: 100%;
            max-width: 400px;
        }
        .error {
            color: white; /* Menetapkan warna teks menjadi putih */ 
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="tm-item-container">
        <h2 class="mb-6 text-white text-4xl font-medium">
            Login Admin
        </h2>
        <form id="Login" class="text-lg" action="" method="POST">
            <input 
                type="text" 
                name="username" 
                class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold" 
                placeholder="Username" 
                required 
            />
            <input 
                type="password" 
                name="password" 
                class="input w-full bg-black border-b bg-opacity-0 text-white px-0 py-4 mb-4 tm-border-gold" 
                placeholder="Password" 
                required 
            />
            <button type="submit" class="w-full bg-green-500 hover:bg-green-700 text-white py-2 rounded">Login</button>
            <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
        </form>
    </div>
</body>
</html>
