<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kelas</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eaf2f8;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            overflow: hidden;
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

        .container {
            background-color: #ffffff;
            border-radius: 15px;
            box-sizing: border-box;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 1000px;
            margin: 0 auto;
            top: -7%;
            left: 5%;
            padding: 50px;
            position: relative;
        }

        h2 {
            text-align: center;
            color: #003366;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-weight: bold;
            color: #003366;
            margin-bottom: 5px;
            font-size: 14px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        button[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #003366;
            color: white;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #002244;
        }

        .back-button {
            display: inline-block;
            padding: 10px 15px;
            background-color: #6c757d;
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
            background-color: #5a6268;
        }

        .content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
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
                <h2>Tambah Kelas</h2>
                <form action="insertkelas.php" method="POST">
                    <div class="form-group">
                        <label for="nama_kelas">Nama Kelas</label>
                        <input type="text" id="nama_kelas" name="nama_kelas" required>
                    </div>
                    <div class="form-group">
                        <button type="submit">Tambah Kelas</button>
                    </div>
                </form>
                <a href="dashboard.php" class="back-button"><i class="fas fa-arrow-left"></i> Kembali ke Dashboard</a>
            </div>
        </div>
    </div>
</body>

</html>
