<?php
include 'koneksi.php'; // Include file koneksi database

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch nasabah data based on id
    $sql = "SELECT * FROM nasabah WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Fetch kelas and jurusan for dropdown
    $kelasResult = $conn->query("SELECT * FROM kelas");
    $jurusanResult = $conn->query("SELECT * FROM jurusan");

    $stmt->close();
} else {
    echo "ID tidak ditemukan.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['Nama'];
    $kelas_id = $_POST['Kelas'];
    $jurusan_id = $_POST['Jurusan'];
    $jenis_kelamin = $_POST['Jenis_Kelamin'];
    $tanggal_pembuatan = $_POST['Tanggal_Pembuatan'];
    $saldo = $_POST['Saldo'];
    $status = $_POST['Status'];

    $sql = "UPDATE nasabah SET nama=?, kelas_id=?, jurusan_id=?, jenis_kelamin=?, tanggal_pembuatan=?, saldo=?, status=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('sisssssi', $nama, $kelas_id, $jurusan_id, $jenis_kelamin, $tanggal_pembuatan, $saldo, $status, $id);

    if ($stmt->execute()) {
        header("Location: tabel.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Nasabah</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        form {
            max-width: 600px;
            width: 100%;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        input[type="text"], input[type="date"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        .radio-group {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .radio-group label {
            margin-right: 20px;
            font-weight: normal;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
        .back-icon {
            display: block;
            text-decoration: none;
            color: #007bff;
            margin-bottom: 20px;
            font-size: 18px;
            font-weight: bold;
        }
        .back-icon:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
    <form id="editForm" action="update.php?id=<?php echo $id; ?>" method="post">
        <a href="tabel.php" class="back-icon">&#x2190; Back</a>
        <h2>Edit Data Nasabah</h2>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['id']); ?>">
        
        <label for="Nama">Nama</label>
        <input type="text" id="Nama" name="Nama" value="<?php echo htmlspecialchars($row['Nama']); ?>" required>
        
        <label for="Kelas">Kelas</label>
        <select id="Kelas" name="Kelas" required>
            <?php while ($kelas = $kelasResult->fetch_assoc()) {
                $selected = $kelas['id'] == $row['kelas_id'] ? 'selected' : '';
                echo "<option value='{$kelas['id']}' $selected>{$kelas['nama_kelas']}</option>";
            } ?>
        </select>
        
        <label for="Jurusan">Jurusan</label>
        <select id="Jurusan" name="Jurusan" required>
            <?php while ($jurusan = $jurusanResult->fetch_assoc()) {
                $selected = $jurusan['id'] == $row['jurusan_id'] ? 'selected' : '';
                echo "<option value='{$jurusan['id']}' $selected>{$jurusan['nama_jurusan']}</option>";
            } ?>
        </select>
        
        <label>Jenis Kelamin</label>
        <div class="radio-group">
            <input type="radio" id="pria" name="Jenis_Kelamin" value="Pria" <?php if ($row['Jenis_Kelamin'] == 'Pria') echo 'checked'; ?> required>
            <label for="pria">Pria</label>
            <input type="radio" id="wanita" name="Jenis_Kelamin" value="Wanita" <?php if ($row['Jenis_Kelamin'] == 'Wanita') echo 'checked'; ?> required>
            <label for="wanita">Wanita</label>
        </div>
        
        <label for="Tanggal_Pembuatan">Tanggal Pembuatan</label>
        <input type="date" id="Tanggal_Pembuatan" name="Tanggal_Pembuatan" value="<?php echo htmlspecialchars($row['Tanggal_Pembuatan']); ?>" required>
        
        <label for="Saldo">Saldo</label>
        <input type="number" id="Saldo" name="Saldo" step="0.01" value="<?php echo htmlspecialchars($row['Saldo']); ?>" required>
        
        <label for="Status">Status</label>
        <select id="Status" name="Status" required>
            <option value="Aktif" <?php if ($row['Status'] == 'Aktif') echo 'selected'; ?>>Aktif</option>
            <option value="Non-Aktif" <?php if ($row['Status'] == 'Non-Aktif') echo 'selected'; ?>>Non-Aktif</option>
        </select>
        
        <input type="submit" value="Update">
    </form>

    <script>
        document.getElementById('editForm').onsubmit = function() {
            return confirm('Apakah Anda yakin ingin memperbarui data nasabah ini?');
        }
    </script>
</body>
</html>
