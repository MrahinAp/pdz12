<?php
// Include file koneksi database
include 'koneksi.php';

// Inisialisasi variabel $data
$data = null;

// Cek jika parameter ID ada dalam URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Mengamankan ID dengan fungsi intval

    // Query untuk mendapatkan data berdasarkan ID
    $sql = "SELECT * FROM kelas WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Prepare failed: ' . $conn->error);
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();

    if (!$data) {
        echo "Data tidak ditemukan!";
        exit;
    }

    // Menutup statement
    $stmt->close();
} else {
    echo "ID tidak ditemukan!";
    exit;
}

// Menutup koneksi
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Kelas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eaf2f8;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 100%;
            max-width: 600px;
        }
        h2 {
            color: #003366;
            text-align: center;
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
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #003366;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #002244;
        }
        .button {
            display: inline-block;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            background-color: #003366;
            color: white;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s;
            margin: 10px 0;
        }
        .button:hover {
            background-color: #002244;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Kelas</h2>
        <form action="updatekelas.php" method="post">
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($data['id']); ?>">
            <div class="form-group">
                <label for="kelas">Kelas:</label>
                <input type="text" id="kelas" name="kelas" value="<?php echo htmlspecialchars($data['nama_kelas']); ?>" required>
            </div>
            <input type="submit" value="Update">
        </form>
        <a href="tabelkelas.php" class="button">Back</a>
    </div>
</body>
</html>