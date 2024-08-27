<?php
include 'koneksi.php'; // Include file koneksi database

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete the nasabah data
    $sql = "DELETE FROM jurusan WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "Data nasabah berhasil dihapus.";
        header('Location: tabeljurusan.php'); // Redirect to the main page
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "ID tidak ditemukan.";
}
?>
