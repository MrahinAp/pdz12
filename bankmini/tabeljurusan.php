<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kelas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf2f8;
            margin: 0;
            padding: 20px;
        }

        .navbar {
            padding: 20px 20px;
            color: #003366;
            display: flex;
            justify-content: space-between;
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
            width: 90%;
            display: flex;
        }

        .navbar ul li {
            margin-left: 20px;
        }

        .navbar ul li a {
            color: #003366;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
            font-size: 14px;
        }

        .navbar ul li a:hover {
            background-color: #fff;
        }

        .main {
            display: flex;
            flex: 1;
            padding-top: 60px;
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
            border-radius: 50px;
        }

        .content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding-left: 140px;
        }

        .container {
            max-width: 1000px;
            width: 90%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
        }

        h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #003366;
            color: #fff;
            font-size: 14px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .action-links a {
            text-decoration: none;
            padding: 8px 12px;
            margin: 0 5px;
            color: #fff;
            border-radius: 4px;
            font-size: 14px;
        }

        .action-links .edit {
            background-color: #28a745;
        }

        .action-links .delete {
            background-color: #dc3545;
        }

        .back-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #003366;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            position: absolute;
            top: 20px;
            left: 20px;
            font-weight: bold;
        }

        .back-button i {
            margin-right: 8px;
        }

        .back-button:hover {
            background-color: #002244;
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
                <h2>Daftar Kelas</h2>
                <table>
                    <tr>
                        <th>ID</th>
                        <th>Nama Kelas</th>
                        <th>Aksi</th>
                    </tr>
                    <?php
                    include 'koneksi.php';

                    $sql = "SELECT * FROM jurusan";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["nama_jurusan"] . "</td>
                                <td class='action-links'>
                                    <a href='editjurusan.php?id=" . $row["id"] . "' class='edit'>Edit</a>
                                    <a href='deletejurusan.php?id=" . $row["id"] . "' class='delete'>Delete</a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No records found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </table>
                <a href="dashboard.php" class="back-button"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>

</html>
