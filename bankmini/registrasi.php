<?php
include 'koneksi.php'; // Include file koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize user input
    $nama = $_POST['nama'] ?? '';
    $kelas = $_POST['kelas_id'] ?? 0;
    $jurusan = $_POST['jurusan_id'] ?? 0;
    $jenis_kelamin = $_POST['jenis_kelamin'] ?? '';
    $tanggal_pembuatan = $_POST['tanggal_pembuatan'] ?? '';
    $saldo = $_POST['saldo'] ?? 0;
    $status = $_POST['status'] ?? '';

    // Input validation (example: ensure saldo is a number)
    if (!is_numeric($saldo)) {
        die("Error: Invalid input for saldo.");
    }

    // Generate no_rekening directly using timestamp and random number
    $no_rekening = time() . rand(1000, 9999);

    // Use prepared statement to avoid SQL Injection
    $sql = "INSERT INTO nasabah (nama, no_rekening, kelas_id, jurusan_id, jenis_kelamin, tanggal_pembuatan, saldo, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die("Error preparing statement: " . htmlspecialchars($conn->error));
    }

    // Bind parameters to the statement
    if (!$stmt->bind_param("ssisssis", $nama, $no_rekening, $kelas, $jurusan, $jenis_kelamin, $tanggal_pembuatan, $saldo, $status)) {
        die("Error binding parameters: " . htmlspecialchars($stmt->error));
    }

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: tabel.php"); // Redirect to the table page
        exit();
    } else {
        echo "Error: " . htmlspecialchars($stmt->error);
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
