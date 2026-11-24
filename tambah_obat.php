
<?php
include 'koneksi.php';

$pesan = '';

if (isset($_POST['simpan'])) {
    $nama_obat = mysqli_real_escape_string($koneksi, $_POST['nama_obat']);
    $satuan = mysqli_real_escape_string($koneksi, $_POST['satuan']);
    $stok = (int) $_POST['stok'];

    $query = "INSERT INTO obat (nama_obat, satuan, stok)
              VALUES ('$nama_obat', '$satuan', $stok)";

    if (mysqli_query($koneksi, $query)) {
        header("Location: obat.php");
        exit;
    } else {
        $pesan = "Gagal menyimpan data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Obat</title>
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

        .pesan {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Data Obat</h2>

    <a href="obat.php">Kembali ke Data Obat</a>

    <?php if ($pesan != '') { ?>
        <p class="pesan"><?= htmlspecialchars($pesan); ?></p>
    <?php } ?>

    <form method="POST">
        <label>Nama Obat</label>
        <input type="text" name="nama_obat" required>

        <label>Satuan</label>
        <input type="text" name="satuan" placeholder="Contoh: Tablet, Botol" required>

        <label>Stok</label>
        <input type="number" name="stok" min="0" required>

        <button type="submit" name="simpan">Simpan Data</button>
    </form>
</div>

</body>
</html>
