<?php
// Include file koneksi database
include 'koneksi.php';

// Cek jika data telah dikirim melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari formulir
    $id = intval($_POST['id']); // Mengamankan ID dengan fungsi intval
    $kelas = $_POST['kelas']; // Anda mungkin ingin membersihkan data ini

    // Query untuk memperbarui data
    $sql = "UPDATE kelas SET nama_kelas = ? WHERE id = ?";
    
    // Menggunakan prepared statements untuk keamanan
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $kelas, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data kelas berhasil diperbarui'); window.location.href='tabelkelas.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Menutup statement
    $stmt->close();
}

// Menutup koneksi
$conn->close();
?>