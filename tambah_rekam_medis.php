
<?php
include 'koneksi.php';

$pesan = '';

$pasien = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY nama_pasien ASC");
$dokter = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY nama_dokter ASC");
$obat = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY nama_obat ASC");

if (isset($_POST['simpan'])) {
    $id_pasien = (int) $_POST['id_pasien'];
    $id_dokter = (int) $_POST['id_dokter'];
    $id_obat = (int) $_POST['id_obat'];
    $tanggal = mysqli_real_escape_string($koneksi, $_POST['tanggal_periksa']);
    $keluhan = mysqli_real_escape_string($koneksi, $_POST['keluhan']);
    $diagnosa = mysqli_real_escape_string($koneksi, $_POST['diagnosa']);
    $tindakan = mysqli_real_escape_string($koneksi, $_POST['tindakan']);
    $resep = mysqli_real_escape_string($koneksi, $_POST['resep']);

    $query = "INSERT INTO rekam_medis
        (id_pasien, id_dokter, id_obat, tanggal_periksa,
         keluhan, diagnosa, tindakan, resep)
        VALUES
        ($id_pasien, $id_dokter, $id_obat, '$tanggal',
         '$keluhan', '$diagnosa', '$tindakan', '$resep')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: rekam_medis.php");
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
    <title>Tambah Rekam Medis</title>

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
            resize: vertical;
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

        .pesan {
            color: red;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Tambah Rekam Medis</h2>

    <a href="rekam_medis.php">Kembali ke Data Rekam Medis</a>

    <?php if ($pesan != '') { ?>
        <p class="pesan"><?= htmlspecialchars($pesan); ?></p>
    <?php } ?>

    <form method="POST">

        <label>Nama Pasien</label>
        <select name="id_pasien" required>
            <option value="">-- Pilih Pasien --</option>
            <?php while ($p = mysqli_fetch_assoc($pasien)) { ?>
                <option value="<?= $p['id_pasien']; ?>">
                    <?= htmlspecialchars($p['nama_pasien']); ?>
                </option>
            <?php } ?>
        </select>

        <label>Nama Dokter</label>
        <select name="id_dokter" required>
            <option value="">-- Pilih Dokter --</option>
            <?php while ($d = mysqli_fetch_assoc($dokter)) { ?>
                <option value="<?= $d['id_dokter']; ?>">
                    <?= htmlspecialchars($d['nama_dokter']); ?>
                </option>
            <?php } ?>
        </select>

        <label>Nama Obat</label>
        <select name="id_obat" required>
            <option value="">-- Pilih Obat --</option>
            <?php while ($o = mysqli_fetch_assoc($obat)) { ?>
                <option value="<?= $o['id_obat']; ?>">
                    <?= htmlspecialchars($o['nama_obat']); ?>
                </option>
            <?php } ?>
        </select>

        <label>Tanggal Periksa</label>
        <input type="date" name="tanggal_periksa" required>

        <label>Keluhan</label>
        <textarea name="keluhan" required></textarea>

        <label>Diagnosa</label>
        <textarea name="diagnosa" required></textarea>

        <label>Tindakan</label>
        <textarea name="tindakan" required></textarea>

        <label>Resep</label>
        <input type="text" name="resep" required>

        <button type="submit" name="simpan">Simpan Rekam Medis</button>

    </form>

</div>

</body>
</html>
