<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nasabah</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
        }
        .container {
            max-width: 1200px;
            margin: auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        header h1 {
            margin: 0;
            color: #333;
            font-size: 24px;
        }
        nav a {
            text-decoration: none;
            color: #007bff;
            font-size: 16px;
            font-weight: bold;
            display: inline-flex;
            align-items: center;
        }
        nav a:hover {
            color: #0056b3;
        }
        .back-button i {
            margin-right: 8px;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 20px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table th, table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }
        table th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
        }
        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        table tbody tr:hover {
            background-color: #e9ecef;
        }
        .edit-button, .delete-button {
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            color: #fff;
            font-size: 14px;
            transition: background-color 0.3s, transform 0.3s;
        }
        .edit-button {
            background-color: #28a745;
        }
        .edit-button:hover {
            background-color: #218838;
            transform: scale(1.05);
        }
        .delete-button {
            background-color: #dc3545;
        }
        .delete-button:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Data Nasabah</h1>
            <nav>
                <a href="dashboard.php" class="back-button"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
            </nav>
        </header>
        <main>
            <h2>List of Nasabah</h2>
            <table>
                <thead>
                    <tr>
                        <th>No Rekening</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Jurusan</th>
                        <th>Jenis Kelamin</th>
                        <th>Tanggal Pembuatan</th>
                        <th>Saldo</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'koneksi.php';
                    $sql = "SELECT nasabah.id, nasabah.no_rekening, nasabah.nama, kelas.nama_kelas, jurusan.nama_jurusan, 
                                   nasabah.jenis_kelamin, nasabah.tanggal_pembuatan, nasabah.saldo, nasabah.status
                            FROM nasabah
                            INNER JOIN kelas ON nasabah.kelas_id = kelas.id
                            INNER JOIN jurusan ON nasabah.jurusan_id = jurusan.id";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>".$row["no_rekening"]."</td>
                                    <td>".$row["nama"]."</td>
                                    <td>".$row["nama_kelas"]."</td>
                                    <td>".$row["nama_jurusan"]."</td>
                                    <td>".$row["jenis_kelamin"]."</td>
                                    <td>".$row["tanggal_pembuatan"]."</td>
                                    <td>".$row["saldo"]."</td>
                                    <td>".$row["status"]."</td>
                                    <td>
                                        <a href='edit.php?id=".$row["id"]."' class='edit-button'>Edit</a>
                                        <a href='delete.php?id=".$row["id"]."' class='delete-button' onclick='return confirm(\"Are you sure you want to delete this record?\")'>Delete</a>
                                    </td>
                                  </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>No records found</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </main>
    </div>
</body>
</html>
