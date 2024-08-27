<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf2f8;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .navbar {
            padding: 20px;
            color: #003366;
            display: flex;
            align-items: center;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            background-color: #ffffff;
        }

        .navbar .brand a {
            color: #003366;
            font-weight: bold;
            text-decoration: none;
        }

        .navbar ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            gap: 20px;
        }

        .navbar ul li a {
            color: #003366;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
        }

        .navbar ul li a:hover {
            background-color: #f2f2f2;
        }

        .main {
            display: flex;
            flex: 1;
            margin-top: 60px; /* Offset for fixed navbar */
        }

        .sidebar {
            background-color: #003366;
            padding: 15px;
            width: 120px;
            color: white;
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 60px;
            bottom: 0;
        }

        .sidebar a {
            color: white;
            text-decoration: none;
            margin-bottom: 10px;
            font-size: 14px;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .sidebar a:hover {
            background-color: #002244;
        }

        .content {
            flex: 1;
            margin-left: 140px; /* Offset for fixed sidebar */
            padding: 20px;
        }

        .container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            width: 100%;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #003366;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        h2 {
            color: #003366;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="navbar">
        <div class="brand">
            <a href="dashboard.php">BANK MINI</a>
        </div>
        <ul>
            <li><a href="index.php">Tambah Nasabah</a></li>
            <li><a href="formjurusan.php">Tambah Jurusan</a></li>
            <li><a href="formkelas.php">Tambah Kelas</a></li>
        </ul>
    </div>

    <div class="main">
        <div class="sidebar">
            <a href="tabel.php">Nasabah</a>
            <a href="riwayat.php">Riwayat</a>
            <a href="tabeljurusan.php">Jurusan</a>
            <a href="tabelkelas.php">Kelas</a>
        </div>

        <div class="content">
            <div class="container">
                <h2>Riwayat Transaksi</h2>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>No Rekening</th>
                            <th>Nama</th>
                            <th>Jenis Transaksi</th>
                            <th>Jumlah</th>
                            <th>Tanggal</th>
                        </tr>
                        <?php
                        include 'koneksi.php';

                        $sql = "SELECT * FROM transactions ORDER BY id DESC";
                        $result = $conn->query($sql);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["no_rekening"] . "</td>
                                        <td>" . $row["nama"] . "</td>
                                        <td>" . $row["jenis_transaksi"] . "</td>
                                        <td>" . number_format((float)$row["nominal"], 2, ',', '.') . "</td>
                                        <td>" . $row["tanggal"] . "</td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Tidak ada transaksi</td></tr>";
                        }

                        $conn->close();
                        ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
