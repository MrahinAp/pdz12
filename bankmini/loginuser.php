<?php
session_start();
require 'koneksi.php'; // Memanggil koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nis = $_POST['nis'];
    $password = $_POST['password'];

    // Ambil data nasabah dari database
    $query = "SELECT * FROM nasabah WHERE nis = ?";
    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        die('Prepare failed: ' . htmlspecialchars($conn->error));
    }
    $stmt->bind_param('s', $nis);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $nasabah = $result->fetch_assoc();
        // Verifikasi password
        if ($password === $nasabah['password']) {
            // Password benar, mulai sesi user
            $_SESSION['nasabah_id'] = $nasabah['id'];
            $_SESSION['nama'] = $nasabah['Nama'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Password salah.";
        }
    } else {
        echo "NIS tidak ditemukan.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="dashboarduser.php">
        <label for="nis">NIS:</label>
        <input type="text" id="nis" name="nis" required>
        
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit">Login</button>
    </form>
</body>
</html>
