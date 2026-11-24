
<?php
include 'koneksi.php';

// Hapus data pasien
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];
    mysqli_query($koneksi, "DELETE FROM pasien WHERE id_pasien = $id");
    header("Location: pasien.php");
    exit;
}

// Ambil data pasien
$query = mysqli_query($koneksi, "SELECT * FROM pasien ORDER BY id_pasien DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien - Rekam Medis</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f3f6fa;
            margin: 0;
            padding: 25px;
            color: #263238;
        }

        .container {
            max-width: 1100px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 12px;
        }

        h2 { color: #24527a; }

        .tambah {
            display: inline-block;
            background: #2878b5;
            color: white;
            padding: 10px 16px;
            text-decoration: none;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background: #dceaf5;
        }

        .edit { color: #1976d2; }
        .hapus { color: #d32f2f; }

        .kembali {
            display: inline-block;
            margin-top: 20px;
            color: #24527a;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Pasien</h2>
    <p>Daftar pasien pada aplikasi Rekam Medis Sederhana.</p>

    <a href="tambah_pasien.php" class="tambah">+ Tambah Pasien</a>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>No. RM</th>
                <th>Nama Pasien</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; ?>
        <?php while ($pasien = mysqli_fetch_assoc($query)) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= htmlspecialchars($pasien['no_rm']); ?></td>
                <td><?= htmlspecialchars($pasien['nama_pasien']); ?></td>
                <td>
                    <?= $pasien['jenis_kelamin'] == 'L' ? 'Laki-laki' : 'Perempuan'; ?>
                </td>
                <td><?= htmlspecialchars($pasien['tanggal_lahir']); ?></td>
                <td><?= htmlspecialchars($pasien['alamat']); ?></td>
                <td>
                    <a class="edit" href="edit_pasien.php?id=<?= $pasien['id_pasien']; ?>">Edit</a> |
                    <a class="hapus"
                       href="pasien.php?hapus=<?= $pasien['id_pasien']; ?>"
                       onclick="return confirm('Yakin ingin menghapus pasien ini?')">
                       Hapus
                    </a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>

    <a href="dashboard.php" class="kembali">← Kembali ke Dashboard</a>
</div>

</body>
</html>
