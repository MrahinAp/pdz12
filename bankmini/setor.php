<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_rekening = $_POST['no_rekening'];
    $nama = $_POST['nama'];
    $nominal = $_POST['nominal'];
    $jenis_transaksi = $_POST['jenis_transaksi'];

    // Check if no_rekening exists
    $query = $conn->prepare("SELECT saldo FROM nasabah WHERE no_rekening = ? AND nama = ?");
    $query->bind_param("ss", $no_rekening, $nama);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $current_saldo = $row['saldo'];

        // Pastikan current_saldo tidak NULL
        if ($current_saldo !== null) {
            // Update saldo based on transaction type
            if ($jenis_transaksi == 'Setor_tunai') {
                $new_saldo = $current_saldo + $nominal;
            } else if ($jenis_transaksi == 'tarik_tunai') {
                if ($current_saldo >= $nominal) {
                    $new_saldo = $current_saldo - $nominal;
                } else {
                    die("Saldo tidak mencukupi untuk tarik tunai.");
                }
            }

            // Update nasabah saldo
            $update_saldo = $conn->prepare("UPDATE nasabah SET saldo = ? WHERE no_rekening = ?");
            $update_saldo->bind_param("ds", $new_saldo, $no_rekening);
            $update_saldo->execute();

            // Insert into transactions table
            $insert_transaksi = $conn->prepare("INSERT INTO transactions (no_rekening, nama, nominal, jenis_transaksi) VALUES (?, ?, ?, ?)");
            $insert_transaksi->bind_param("ssds", $no_rekening, $nama, $nominal, $jenis_transaksi);
            $insert_transaksi->execute();

            echo "Transaksi berhasil!";
            // Redirect to riwayat.php after successful transaction
            header("Location: riwayat.php");
            exit();
        } else {
            die("Saldo saat ini tidak ditemukan atau NULL.");
        }
    } else {
        echo "No rekening atau nama tidak ditemukan.";
    }
}
?>
