<?php
include 'koneksi.php'; // Include file koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_kelas'];
  

    $sql = "INSERT INTO kelas (nama_kelas) VALUES ('$nama')";

    if ($conn->query($sql) === TRUE) {
        header("Location: tabelkelas.php"); // Redirect to the table page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
