
<?php
$host = "localhost";
$user = "lilik";
$password = "smkn3tbn";
$database = "db_rekam_medis";

$koneksi = mysqli_connect(
    $host,
    $user,
    $password,
    $database
);

if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
