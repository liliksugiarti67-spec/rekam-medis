
<?php
include 'koneksi.php';

// Menghitung jumlah data
$jumlah_pasien = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pasien")
)['total'];

$jumlah_dokter = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM dokter")
)['total'];

$jumlah_obat = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM obat")
)['total'];

$jumlah_rekam = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM rekam_medis")
)['total'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Rekam Medis</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f7fb;
            margin: 0;
        }

        header {
            background: #2878c8;
            color: white;
            padding: 25px;
            text-align: center;
        }

        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 20px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
            text-align: center;
        }

        .card h3 {
            color: #526477;
        }

        .angka {
            font-size: 32px;
            font-weight: bold;
            color: #2878c8;
        }

        .menu {
            display: block;
            background: white;
            padding: 18px;
            margin-top: 15px;
            border-radius: 8px;
            color: #263b59;
            text-decoration: none;
            border-left: 5px solid #2878c8;
        }

        .menu:hover {
            background: #eaf3fc;
        }

        footer {
            text-align: center;
            color: #777;
            margin-top: 35px;
        }
    </style>
</head>

<body>

<header>
    <h1>Aplikasi Rekam Medis Sederhana</h1>
    <p>Sistem Pengelolaan Data Rekam Medis Pasien</p>
</header>

<div class="container">

    <h2>Dashboard</h2>
    <p>Selamat datang di Aplikasi Rekam Medis.</p>

    <div class="cards">

        <div class="card">
            <h3>Total Pasien</h3>
            <div class="angka"><?= $jumlah_pasien; ?></div>
        </div>

        <div class="card">
            <h3>Total Dokter</h3>
            <div class="angka"><?= $jumlah_dokter; ?></div>
        </div>

        <div class="card">
            <h3>Total Obat</h3>
            <div class="angka"><?= $jumlah_obat; ?></div>
        </div>

        <div class="card">
            <h3>Total Rekam Medis</h3>
            <div class="angka"><?= $jumlah_rekam; ?></div>
        </div>

    </div>

    <h2>Menu Utama</h2>

    <a href="pasien.php" class="menu">Data Pasien</a>

    <a href="dokter.php" class="menu">Data Dokter</a>

    <a href="obat.php" class="menu">Data Obat</a>

    <a href="rekam_medis.php" class="menu">Data Rekam Medis</a>

    <footer>
        <p>Aplikasi Rekam Medis Sederhana</p>
    </footer>

</div>

</body>
</html>
