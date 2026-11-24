
<?php
include 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$result = mysqli_query($koneksi, "SELECT * FROM dokter WHERE id_dokter = $id");
$dokter = mysqli_fetch_assoc($result);

if (!$dokter) {
    die("Data dokter tidak ditemukan.");
}

if (isset($_POST['simpan'])) {
    $nama_dokter = mysqli_real_escape_string($koneksi, $_POST['nama_dokter']);
    $spesialisasi = mysqli_real_escape_string($koneksi, $_POST['spesialisasi']);

    $query = "UPDATE dokter SET
              nama_dokter = '$nama_dokter',
              spesialisasi = '$spesialisasi'
              WHERE id_dokter = $id";

    if (mysqli_query($koneksi, $query)) {
        header("Location: dokter.php");
        exit;
    } else {
        echo "Gagal mengubah data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Dokter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            padding: 30px;
        }

        .container {
            background: white;
            max-width: 500px;
            margin: auto;
            padding: 25px;
            border-radius: 10px;
        }

        h2 {
            color: #263b59;
        }

        label {
            display: block;
            margin-top: 15px;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 7px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            background: #2878c8;
            color: white;
            border: none;
            padding: 11px 18px;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: #2878c8;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Data Dokter</h2>

    <a href="dokter.php">Kembali ke Data Dokter</a>

    <form method="POST">
        <label>Nama Dokter</label>
        <input type="text" name="nama_dokter"
               value="<?= htmlspecialchars($dokter['nama_dokter']); ?>"
               required>

        <label>Spesialisasi</label>
        <input type="text" name="spesialisasi"
               value="<?= htmlspecialchars($dokter['spesialisasi']); ?>"
               required>

        <button type="submit" name="simpan">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>
