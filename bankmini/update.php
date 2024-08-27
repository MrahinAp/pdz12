<?php
include 'koneksi.php'; // Include file koneksi database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $id = $_POST['id'];
    $nama = $_POST['Nama'];
    $kelas_id = $_POST['Kelas'];
    $jurusan_id = $_POST['Jurusan'];
    $jenis_kelamin = $_POST['Jenis_Kelamin'];
    $tanggal_pembuatan = $_POST['Tanggal_Pembuatan'];
    $saldo = $_POST['Saldo'];
    $status = $_POST['Status'];

    // Prepare and bind
    $sql = "UPDATE nasabah SET nama=?, kelas_id=?, jurusan_id=?, jenis_kelamin=?, tanggal_pembuatan=?, saldo=?, status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sisssssi', $nama, $kelas_id, $jurusan_id, $jenis_kelamin, $tanggal_pembuatan, $saldo, $status, $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data nasabah berhasil diperbarui.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
    
    // Redirect to tabel.php
    header("Location: tabel.php");
    exit;
} else {
    echo "Invalid request.";
    exit;
}
?>
