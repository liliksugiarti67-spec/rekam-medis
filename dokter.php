
<?php
include 'koneksi.php';

// Proses hapus dokter
if (isset($_GET['hapus'])) {
    $id = (int) $_GET['hapus'];

    mysqli_query($koneksi, "DELETE FROM dokter WHERE id_dokter = $id");

    header("Location: dokter.php");
    exit;
}

// Ambil data dokter
$query = mysqli_query($koneksi, "SELECT * FROM dokter ORDER BY id_dokter DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Dokter</title>
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
    <h2>Data Dokter</h2>

    <a href="dashboard.php">Kembali ke Dashboard</a>
    <br><br>

    <a href="tambah_dokter.php" class="tambah">+ Tambah Dokter</a>

    <table>
        <tr>
            <th>No</th>
            <th>Nama Dokter</th>
            <th>Spesialisasi</th>
            <th>Aksi</th>
        </tr>

        <?php
        $no = 1;
        while ($dokter = mysqli_fetch_assoc($query)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= htmlspecialchars($dokter['nama_dokter']); ?></td>
            <td><?= htmlspecialchars($dokter['spesialisasi']); ?></td>
            <td>
                <a class="edit" href="edit_dokter.php?id=<?= $dokter['id_dokter']; ?>">Edit</a>
                |
                <a class="hapus"
                   href="dokter.php?hapus=<?= $dokter['id_dokter']; ?>"
                   onclick="return confirm('Yakin ingin menghapus dokter ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
