
<?php
include 'koneksi.php';

$id = (int) ($_GET['id'] ?? 0);

$result = mysqli_query($koneksi, "
    SELECT * FROM rekam_medis WHERE id_rekam = $id
");

$data = mysqli_fetch_assoc($result);

if (!$data) {
    die("Data rekam medis tidak ditemukan.");
}

if (isset($_POST['simpan'])) {
    $id_pasien = (int) $_POST['id_pasien'];
    $id_dokter = (int) $_POST['id_dokter'];
    $id_obat = (int) $_POST['id_obat'];

    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal_periksa']);
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $diagnosa = mysqli_real_escape_string($koneksi, $_POST['diagnosa']);
    $tindakan = mysqli_real_escape_string($koneksi, $_POST['tindakan']);
    $resep = mysqli_real_escape_string($koneksi, $_POST['resep']);

    $query = "UPDATE rekam_medis SET
        id_pasien = $id_pasien,
        id_dokter = $id_dokter,
        id_obat = $id_obat,
        tanggal_periksa = '$tanggal',
        keluhan = '$keluhan',
        diagnosa = '$diagnosa',
        tindakan = '$tindakan',
        resep = '$resep'
        WHERE id_rekam = $id";

    if (mysqli_query($koneksi, $query)) {
        header("Location: rekam_medis.php");
        exit;
    } else {
        echo "Gagal mengubah data: " . mysqli_error($koneksi);
    }
}

$pasien = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY nama_pasien ASC");
$dokter = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY nama_dokter ASC");
$obat = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY nama_obat ASC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Rekam Medis</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            padding: 30px;
        }

        .container {
            background: white;
            max-width: 600px;
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

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 7px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            min-height: 75px;
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

    <h2>Edit Rekam Medis</h2>

    <a href="rekam_medis.php">Kembali ke Data Rekam Medis</a>

    <form method="POST">

        <label>Nama Pasien</label>
        <select name="id_pasien" required>
            <?php while ($p = mysqli_fetch_assoc($pasien)) { ?>
                <option value="<?= $p['id_pasien']; ?>"
                    <?= $p['id_pasien'] == $data['id_pasien'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($p['nama_pasien']); ?>
                </option>
            <?php } ?>
        </select>

        <label>Nama Dokter</label>
        <select name="id_dokter" required>
            <?php while ($d = mysqli_fetch_assoc($dokter)) { ?>
                <option value="<?= $d['id_dokter']; ?>"
                    <?= $d['id_dokter'] == $data['id_dokter'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($d['nama_dokter']); ?>
                </option>
            <?php } ?>
        </select>

        <label>Nama Obat</label>
        <select name="id_obat" required>
            <?php while ($o = mysqli_fetch_assoc($obat)) { ?>
                <option value="<?= $o['id_obat']; ?>"
                    <?= $o['id_obat'] == $data['id_obat'] ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($o['nama_obat']); ?>
                </option>
            <?php } ?>
        </select>

        <label>Tanggal Periksa</label>
        <input type="date" name="tanggal_periksa"
            value="<?= htmlspecialchars($data['tanggal_periksa']); ?>" required>

        <label>Keluhan</label>
        <textarea name="keluhan" required><?= htmlspecialchars($data['keluhan']); ?></textarea>

        <label>Diagnosa</label>
        <textarea name="diagnosa" required><?= htmlspecialchars($data['diagnosa']); ?></textarea>

        <label>Tindakan</label>
        <textarea name="tindakan" required><?= htmlspecialchars($data['tindakan']); ?></textarea>

        <label>Resep</label>
        <input type="text" name="resep"
            value="<?= htmlspecialchars($data['resep']); ?>" required>

        <button type="submit" name="simpan">Simpan Perubahan</button>

    </form>

</div>

</body>
</html>
