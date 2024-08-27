<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Aplikasi Bank</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf2f8;
            margin: 0;
            padding: 0;
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

        header {
            text-align: center;
            padding: 20px;
            margin-bottom: 20px;
        }

        header h1 {
            color: #003366;
            margin: 0;
        }

        .buttons {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .buttons .button {
            background-color: #003366;
            color: #fff;
            padding: 15px 30px;
            margin: 10px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 16px;
            text-align: center;
            width: 200px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }

        .buttons .button:hover {
            background-color: #002244;
        }

        .buttons .button i {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="brand">
            <a href="index.php">BANK MINI</a>
        </div>
    
    </div>

    <div class="main">
        <div class="sidebar">
            <a href="riwayat.php">Riwayat</a>
            <a href="tabeljurusan.php">Jurusan</a>
            <a href="tabelkelas.php">Kelas</a>
        </div>

        <div class="content">
            <div class="container">
                <header>
                    <h1>Dashboard Aplikasi Bank</h1>
                </header>
                <main>
                    <div class="buttons">
                        <a href="tabel.php" class="button"><i class="fas fa-users"></i>Data Nasabah</a>
                        <a href="index.php" class="button"><i class="fas fa-user-plus"></i>Tambah Nasabah</a>
                        <a href="tabelkelas.php" class="button"><i class="fas fa-list"></i>Data Kelas</a>
                        <a href="formkelas.php" class="button"><i class="fas fa-plus"></i>Tambah Kelas</a>
                        <a href="tabeljurusan.php" class="button"><i class="fas fa-list"></i>Data Jurusan</a>
                        <a href="formjurusan.php" class="button"><i class="fas fa-plus"></i>Tambah Jurusan</a>
                        <a href="formsetor.php" class="button"><i class="fas fa-exchange-alt"></i>Transaksi</a>
                    </div>
                </main>
            </div>
        </div>
    </div>
</body>
</html>
