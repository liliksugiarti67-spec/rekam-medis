
<?php
include 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$result = mysqli_query($koneksi, "SELECT * FROM obat WHERE id_obat = $id");
$obat = mysqli_fetch_assoc($result);

if (!$obat) {
    die("Data obat tidak ditemukan.");
}

if (isset($_POST['simpan'])) {
    $nama_obat = mysqli_real_escape_string($koneksi, $_POST['nama_obat']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $stok = (int) $_POST['stok'];

    $query = "UPDATE obat SET
              nama_obat = '$nama_obat',
              satuan = '$satuan',
              stok = $stok
              WHERE id_obat = $id";

    if (mysqli_query($koneksi, $query)) {
        header("Location: obat.php");
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
    <title>Edit Obat</title>
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
    <h2>Edit Data Obat</h2>

    <a href="obat.php">Kembali ke Data Obat</a>

    <form method="POST">
        <label>Nama Obat</label>
        <input type="text" name="nama_obat"
               value="<?= htmlspecialchars($obat['nama_obat']); ?>"
               required>

        <label>Satuan</label>
        <input type="text" name="satuan"
               value="<?= htmlspecialchars($obat['satuan']); ?>"
               required>

        <label>Stok</label>
        <input type="number" name="stok" min="0"
               value="<?= htmlspecialchars($obat['stok']); ?>"
               required>

        <button type="submit" name="simpan">Simpan Perubahan</button>
    </form>
</div>

</body>
</html>
