<?php
require_once 'koneksi.php';
$kelas_query = $conn->query("SELECT * FROM kelas");
$kelas_options = "";
while ($row = $kelas_query->fetch_assoc()) {
    $kelas_options .= "<option value=\"{$row['id']}\">{$row['nama_kelas']}</option>";
}

// Ambil data jurusan dari database
$jurusan_query = $conn->query("SELECT * FROM jurusan");
$jurusan_options = "";
while ($row = $jurusan_query->fetch_assoc()) {
    $jurusan_options .= "<option value=\"{$row['id']}\">{$row['nama_jurusan']}</option>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM NASABAH</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #e0f7fa, #80deea); /* Gradient background */
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
        }
        h2 {
            color: #004d40; /* Darker teal */
            margin-top: 20px;
        }
        form {
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin-bottom: 30px;
            border: 1px solid #b0bec5; /* Light grey */
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
            color: #004d40; /* Darker teal */
        }
        input[type="text"], input[type="date"], input[type="number"], select {
            width: calc(100% - 16px);
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #b0bec5; /* Light grey */
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
        }
        input[type="radio"] {
            margin-right: 8px;
        }
        input[type="submit"] {
            background-color: #004d40; /* Darker teal */
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #00251a; /* Even darker teal */
        }
        .button {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            background-color: #00796b; /* Dark teal */
            color: white;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            position: absolute; /* Position absolutely */
            top: 20px; /* Distance from the top */
            right: 20px; /* Distance from the right */
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #004d40; /* Darker teal */
        }
    </style>
</head>
<body>
    <a href="dashboard.php" class="button">BACK</a>
    <h2>FORM NASABAH</h2>
    <form id="nasabahForm" action="registrasi.php" method="post">
        <label for="nama">Nama:</label>
        <input type="text" id="nama" name="nama" required>

        <label for="kelas_id">Kelas</label>
        <select id="kelas_id" name="kelas_id" required>
                    <?php echo $kelas_options; ?>
                </select>

        <label for="jurusan_id">Jurusan</label>
        <select id="jurusan_id" name="jurusan_id" required>
                    <?php echo $jurusan_options; ?>
                </select>

        <label for="jenis_kelamin">Jenis Kelamin:</label>
        <input type="radio" id="pria" name="jenis_kelamin" value="Pria" required>
        <label for="pria">Pria</label>
        <input type="radio" id="wanita" name="jenis_kelamin" value="Wanita" required>
        <label for="wanita">Wanita</label>

        <label for="tanggal_pembuatan">Tanggal Pembuatan:</label>
        <input type="date" id="tanggal_pembuatan" name="tanggal_pembuatan" required>

        <label for="saldo">Saldo:</label>
        <input type="number" id="saldo" name="saldo" step="0.01" required>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="" disabled selected>Pilih Status</option>
            <option value="Aktif">Aktif</option>
            <option value="Non-Aktif">Non-Aktif</option>
        </select>

        <input type="submit" value="Daftar">
    </form>

    <script>
        document.getElementById('nasabahForm').addEventListener('submit', function(event) {
            const nama = document.getElementById('nama').value;
            const kelas = document.getElementById('kelas_id').value;
            const jurusan = document.getElementById('jurusan_id').value;
            const jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
            const tanggalPembuatan = document.getElementById('tanggal_pembuatan').value;
            const saldo = document.getElementById('saldo').value;
            const status = document.getElementById('status').value;

            if (!nama || !kelas || !jurusan || !jenisKelamin || !tanggalPembuatan || !saldo || !status) {
                alert('Mohon isi semua kolom.');
                event.preventDefault();
            }
        });
    </script>
</body>
</html>