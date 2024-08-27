<?php
$servername = "localhost";  // Nama server database (biasanya localhost)
$username = "Admin";         // Nama pengguna database
$password = "Admin";             // Kata sandi pengguna database
$dbname = "bankmini";    // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
echo "";
?>