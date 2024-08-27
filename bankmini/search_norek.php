<?php
require_once 'koneksi.php';

if (isset($_GET['term'])) {
    $term = $_GET['term'];
    $query = $conn->query("SELECT no_rekening, nama FROM nasabah WHERE no_rekening LIKE '%$term%'");
    $result = [];
    while ($row = $query->fetch_assoc()) {
        $result[] = [
            'label' => $row['no_rekening'] . ' - ' . $row['nama'],
            'value' => $row['no_rekening'],
            'nama' => $row['nama'],
        ];
    }
    echo json_encode($result);
}
?>