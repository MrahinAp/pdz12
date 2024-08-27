<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eaf2f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
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

        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }

        input[type="submit"] {
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

        input[type="submit"]:hover {
            background-color: #002244;
        }

        .error-message {
            color: red;
            display: none;
            margin-top: 10px;
        }

        .ui-autocomplete {
            max-height: 150px;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Tambah Transaksi</h2>
        <form action="setor.php" method="post">
            <div class="form-group">
                <label for="no_rekening">No Rekening:</label>
                <input type="text" id="no_rekening" name="no_rekening" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama:</label>
                <input type="text" id="nama" name="nama" required readonly>
            </div>
            <div class="form-group">
                <label for="nominal">Nominal Transaksi:</label>
                <input type="number" id="nominal" name="nominal" required min="10000">
            </div>
            <div class="form-group">
                <label for="jenis_transaksi">Jenis Transaksi:</label>
                <select id="jenis_transaksi" name="jenis_transaksi" required>
                    <option value="">Pilih Jenis Transaksi</option>
                    <option value="Setor_tunai">Setor Tunai</option>
                    <option value="tarik_tunai">Tarik Tunai</option>
                </select>
            </div>
            <input type="submit" value="Submit">
            <p class="error-message">Transaksi tidak bisa dilakukan. Rekening ini tidak aktif.</p>
        </form>
    </div>

    <script>
        $(function () {
            // Autocomplete for no_rekening
            $("#no_rekening").autocomplete({
                source: "search_norek.php",
                minLength: 1,
                select: function (event, ui) {
                    $("#no_rekening").val(ui.item.value);
                    $("#nama").val(ui.item.nama);
                    return false;
                }
            });

            // Fetch nasabah details on no_rekening input change
            $("#no_rekening").on("change", function () {
                var no_rekening = $(this).val();
                if (no_rekening !== "") {
                    $.ajax({
                        url: "get_nasabah.php",
                        type: "POST",
                        data: { no_rekening: no_rekening },
                        success: function (data) {
                            var nasabah = JSON.parse(data);
                            $("#nama").val(nasabah.nama);
                            if (nasabah.status === "tidak aktif") {
                                $(".error-message").show();
                                $("input[type='submit']").prop("disabled", true);
                            } else {
                                $(".error-message").hide();
                                $("input[type='submit']").prop("disabled", false);
                            }
                        }
                    });
                }
            });

            // Validate minimum transaction amount
            $("form").on("submit", function (event) {
                var nominal = parseInt($("input[name='nominal']").val());

                if (nominal < 10000) {
                    alert("Nominal transaksi minimal adalah Rp. 10.000.");
                    event.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
</body>

</html>
