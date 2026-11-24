
<?php
include 'koneksi.php';

// Proses hapus rekam medis
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    mysqli_query($koneksi, "DELETE FROM rekam_medis WHERE id_rekam = $id");

    header("Location: rekam_medis.php");
    exit;
}

// Ambil data rekam medis menggunakan JOIN
$query = mysqli_query($koneksi, "
    SELECT
        rekam_medis.*,
        pasien.no_rm,
        pasien.nama_pasien,
        dokter.nama_dokter,
        dokter.spesialisasi,
        obat.nama_obat
    FROM rekam_medis
    INNER JOIN pasien
        ON rekam_medis.id_pasien = pasien.id_pasien
    INNER JOIN dokter
        ON rekam_medis.id_dokter = dokter.id_dokter
    INNER JOIN obat
        ON rekam_medis.id_obat = obat.id_obat
    ORDER BY rekam_medis.tanggal_periksa DESC
");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Rekam Medis</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
            padding: 30px;
        }

        .container {
            background: white;
            padding: 25px;
            border-radius: 10px;
            max-width: 1100px;
            margin: auto;
            overflow-x: auto;
        }

        h2 {
            color: #263b59;
        }

        a {
            text-decoration: none;
        }

        .tambah {
            display: inline-block;
            background: #2878c8;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            margin: 15px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 900px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #dceafa;
        }

        .edit {
            color: #1672c4;
        }

        .hapus {
            color: #d62828;
        }
    </style>
</head>

<body>

<div class="container">

    <h2>Data Rekam Medis</h2>

    <a href="dashboard.php">Kembali ke Dashboard</a>
    <br>

    <a href="tambah_rekam_medis.php" class="tambah">
        + Tambah Rekam Medis
    </a>

    <table>
        <tr>
            <th>No</th>
            <th>No. RM</th>
            <th>Nama Pasien</th>
            <th>Dokter</th>
            <th>Obat</th>
            <th>Tanggal Periksa</th>
            <th>Diagnosa</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;

        while ($data = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($data['no_rm']); ?></td>
            <td><?= htmlspecialchars($data['nama_pasien']); ?></td>
            <td><?= htmlspecialchars($data['nama_dokter']); ?></td>
            <td><?= htmlspecialchars($data['nama_obat']); ?></td>
            <td><?= htmlspecialchars($data['tanggal_periksa']); ?></td>
            <td><?= htmlspecialchars($data['diagnosa']); ?></td>
            <td>
                <a class="edit"
                   href="edit_rekam_medis.php?id=<?= $data['id_rekam']; ?>">
                   Edit
                </a>
                |
                <a class="hapus"
                   href="rekam_medis.php?hapus=<?= $data['id_rekam']; ?>"
                   onclick="return confirm('Yakin ingin menghapus data ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>

        <?php if (mysqli_num_rows($query) == 0) { ?>
        <tr>
            <td colspan="8" style="text-align:center;">
                Belum ada data rekam medis.
            </td>
        </tr>
        <?php } ?>

    </table>

</div>

</body>
</html>
