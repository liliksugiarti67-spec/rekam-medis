
<?php
include 'koneksi.php';

// Proses hapus obat
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    mysqli_query($koneksi, "DELETE FROM obat WHERE id_obat = $id");

    header("Location: obat.php");
    exit;
}

// Ambil data obat
$query = mysqli_query($koneksi, "SELECT * FROM obat ORDER BY id_obat DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Obat</title>
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
            max-width: 900px;
            margin: auto;
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
            margin-bottom: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
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
    <h2>Data Obat</h2>

    <a href="dashboard.php">Kembali ke Dashboard</a>
    <br><br>

    <a href="tambah_obat.php" class="tambah">+ Tambah Obat</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Obat</th>
            <th>Satuan</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while ($obat = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($obat['nama_obat']); ?></td>
            <td><?= htmlspecialchars($obat['satuan']); ?></td>
            <td><?= htmlspecialchars($obat['stok']); ?></td>
            <td>
                <a class="edit" href="edit_obat.php?id=<?= $obat['id_obat']; ?>">Edit</a>
                |
                <a class="hapus"
                   href="obat.php?hapus=<?= $obat['id_obat']; ?>"
                   onclick="return confirm('Yakin ingin menghapus obat ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
