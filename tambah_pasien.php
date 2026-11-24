
<?php
include 'koneksi.php';

$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_rm = mysqli_real_escape_string($koneksi, $_POST['no_rm']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_pasien']);
    $jk = $_POST['jenis_kelamin'];
    $tanggal = $_POST['tanggal_lahir'];
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $query = "INSERT INTO pasien
              (no_rm, nama_pasien, jenis_kelamin, tanggal_lahir, alamat)
              VALUES ('$no_rm', '$nama', '$jk', '$tanggal', '$alamat')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: pasien.php");
        exit;
    } else {
        $pesan = "Gagal menambahkan pasien: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pasien</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            padding: 25px;
            color: #263238;
        }
        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }
        h2 { color: #24527a; }
        label {
            display: block;
            margin-top: 15px;
        }
        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 7px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        button {
            margin-top: 20px;
            padding: 11px 18px;
            background: #2878b5;
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .kembali {
            display: inline-block;
            margin-top: 20px;
            color: #24527a;
        }
        .pesan { color: red; }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Data Pasien</h2>

    <?php if ($pesan): ?>
        <p class="pesan"><?= htmlspecialchars($pesan); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nomor Rekam Medis</label>
        <input type="text" name="no_rm" required>

        <label>Nama Pasien</label>
        <input type="text" name="nama_pasien" required>

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" required>
            <option value="">-- Pilih --</option>
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>

        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir" required>

        <label>Alamat</label>
        <textarea name="alamat" rows="3" required></textarea>

        <button type="submit">Simpan Pasien</button>
    </form>

    <a href="pasien.php" class="kembali">← Kembali ke Data Pasien</a>
</div>

</body>
</html>
