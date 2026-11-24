
<?php
include 'koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: pasien.php");
    exit;
}

$id = (int) $_GET['id'];

$result = mysqli_query($koneksi, "SELECT * FROM pasien WHERE id_pasien = $id");
$pasien = mysqli_fetch_assoc($result);

if (!$pasien) {
    die("Data pasien tidak ditemukan.");
}

$pesan = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $no_rm = mysqli_real_escape_string($koneksi, $_POST['no_rm']);
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama_pasien']);
    $jk = $_POST['jenis_kelamin'];
    $tanggal = $_POST['tanggal_lahir'];
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);

    $query = "UPDATE pasien SET
              no_rm = '$no_rm',
              nama_pasien = '$nama',
              jenis_kelamin = '$jk',
              tanggal_lahir = '$tanggal',
              alamat = '$alamat'
              WHERE id_pasien = $id";

    if (mysqli_query($koneksi, $query)) {
        header("Location: pasien.php");
        exit;
    } else {
        $pesan = "Gagal mengubah data: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pasien</title>
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

        a {
            display: inline-block;
            margin-top: 20px;
            color: #24527a;
        }

        .pesan { color: red; }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Data Pasien</h2>

    <?php if ($pesan): ?>
        <p class="pesan"><?= htmlspecialchars($pesan); ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nomor Rekam Medis</label>
        <input type="text" name="no_rm"
            value="<?= htmlspecialchars($pasien['no_rm']); ?>" required>

        <label>Nama Pasien</label>
        <input type="text" name="nama_pasien"
            value="<?= htmlspecialchars($pasien['nama_pasien']); ?>" required>

        <label>Jenis Kelamin</label>
        <select name="jenis_kelamin" required>
            <option value="L" <?= $pasien['jenis_kelamin'] == 'L' ? 'selected' : ''; ?>>
                Laki-laki
            </option>
            <option value="P" <?= $pasien['jenis_kelamin'] == 'P' ? 'selected' : ''; ?>>
                Perempuan
            </option>
        </select>

        <label>Tanggal Lahir</label>
        <input type="date" name="tanggal_lahir"
            value="<?= htmlspecialchars($pasien['tanggal_lahir']); ?>" required>

        <label>Alamat</label>
        <textarea name="alamat" rows="3" required><?= htmlspecialchars($pasien['alamat']); ?></textarea>

        <button type="submit">Simpan Perubahan</button>
    </form>

    <a href="pasien.php">← Kembali ke Data Pasien</a>
</div>

</body>
</html>
