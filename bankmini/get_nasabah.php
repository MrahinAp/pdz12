<?php
require_once 'koneksi.php';

if (isset($_POST['no_rekening'])) {
    $no_rekening = $_POST['no_rekening'];

    $query = $conn->query("SELECT nama, saldo, status FROM nasabah WHERE no_rekening = '$no_rekening'");
    if ($query->num_rows > 0) {
        $nasabah = $query->fetch_assoc();
        echo json_encode($nasabah);
    } else {
        echo json_encode(['nama' => '', 'saldo' => 0, 'status' => '']);
    }
}
?>