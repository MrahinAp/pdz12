<?php
include 'koneksi.php'; // Include file koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama_jurusan'];
  

    $sql = "INSERT INTO jurusan (nama_jurusan) VALUES ('$nama')";

    if ($conn->query($sql) === TRUE) {
        header("Location: tabeljurusan.php"); // Redirect to the table page
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    $conn->close();
}
?>
