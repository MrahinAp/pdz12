<?php
session_start();
if (!isset($_SESSION['nasabah_id'])) {
    header("Location: loginuser.php");
    exit();
}

require 'koneksi.php'; // Memanggil koneksi ke database

// Ambil data nasabah berdasarkan sesi
$nasabah_id = $_SESSION['nasabah_id'];
$query = "SELECT nasabah.*, jurusan.nama_jurusan FROM nasabah 
          JOIN jurusan ON nasabah.jurusan_id = jurusan.id 
          WHERE nasabah.id = ?";
$stmt = $conn->prepare($query);
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt->bind_param('i', $nasabah_id);
$stmt->execute();
$result = $stmt->get_result();
$nasabah = $result->fetch_assoc();
$stmt->close();

// Ambil data transaksi nasabah berdasarkan no_rekening
$no_rekening = $nasabah['no_rekening'];
$query_transaksi = "SELECT * FROM transactions WHERE no_rekening = ?";
$stmt_transaksi = $conn->prepare($query_transaksi);
if ($stmt_transaksi === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}
$stmt_transaksi->bind_param('s', $no_rekening);
$stmt_transaksi->execute();
$result_transaksi = $stmt_transaksi->get_result();
$transaksi = $result_transaksi->fetch_all(MYSQLI_ASSOC);
$stmt_transaksi->close();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1b1b1b;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 30px auto;
        }
        header {
            background: #333;
            padding: 20px;
            border-bottom: 2px solid #e8491d;
            text-align: center;
        }
        header h1 {
            margin: 0;
            font-size: 36px;
            color: #e8491d;
        }
        .welcome {
            text-align: center;
            margin-top: 10px;
            font-size: 20px;
        }
        .card {
            background: #2c2c2c;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }
        .card h2 {
            border-bottom: 2px solid #e8491d;
            padding-bottom: 10px;
            margin-bottom: 20px;
            color: #e8491d;
        }
        .card p {
            line-height: 1.6;
            font-size: 18px;
        }
        .card strong {
            color: #e8491d;
        }
        .transaction-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .transaction-table th, .transaction-table td {
            border: 1px solid #555;
            padding: 12px;
            text-align: left;
        }
        .transaction-table th {
            background-color: #444;
            color: #ffffff;
        }
        .transaction-table tr:nth-child(even) {
            background-color: #333;
        }
    </style>
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    
    <div class="container">
        <div class="welcome">
            <p>Welcome, <?php echo $_SESSION['nama']; ?>!</p>
        </div>
        
        <div class="card">
            <h2>Biodata</h2>
            <p><strong>ID:</strong> <?php echo $nasabah['id']; ?></p>
            <p><strong>Nama:</strong> <?php echo $nasabah['Nama']; ?></p>
            <p><strong>NIS:</strong> <?php echo $nasabah['nis']; ?></p>
            <p><strong>No Rekening:</strong> <?php echo $nasabah['no_rekening']; ?></p>
            <p><strong>Tanggal Pembuatan:</strong> <?php echo $nasabah['Tanggal_Pembuatan']; ?></p>
            <p><strong>Saldo:</strong> <?php echo $nasabah['Saldo']; ?></p>
            <p><strong>Status:</strong> <?php echo $nasabah['Status']; ?></p>
            <p><strong>Kelas:</strong> <?php echo $nasabah['kelas_id']; ?></p>
            <p><strong>Jurusan:</strong> <?php echo $nasabah['nama_jurusan']; ?></p>
        </div>
        
        <div class="card">
            <h2>Riwayat Transaksi</h2>
            <?php if (count($transaksi) > 0): ?>
                <table class="transaction-table">
                    <tr>
                        <th>ID Transaksi</th>
                        <th>Tanggal</th>
                        <th>Nominal</th>
                        <th>Jenis Transaksi</th>
                    </tr>
                    <?php foreach ($transaksi as $trans): ?>
                        <tr>
                            <td><?php echo $trans['id']; ?></td>
                            <td><?php echo $trans['tanggal']; ?></td>
                            <td><?php echo $trans['nominal']; ?></td>
                            <td><?php echo $trans['jenis_transaksi']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>Tidak ada riwayat transaksi.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
