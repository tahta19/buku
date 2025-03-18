<?php
include_once("koneksi.php");

// Cek apakah data dikirim melalui POST
if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    die("Akses tidak sah.");
}

// Pastikan semua data dikirim
if (!isset($_POST['id'], $_POST['judul'], $_POST['pengarang'], $_POST['tahun_terbit'], $_POST['kategori'])) {
    die("Data tidak lengkap. Update dibatalkan.");
}

// Ambil data dari form
$id = intval($_POST['id']);
$judul = mysqli_real_escape_string($conn, trim($_POST['judul']));
$pengarang = mysqli_real_escape_string($conn, trim($_POST['pengarang']));
$tahun = intval($_POST['tahun_terbit']);
$kategori = mysqli_real_escape_string($conn, trim($_POST['kategori']));

// Pastikan ID ada di database
$cek = mysqli_query($conn, "SELECT * FROM tb_buku WHERE id_buku=$id");
if (mysqli_num_rows($cek) == 0) {
    die("ID tidak ditemukan. Update dibatalkan.");
}

// Query Update
$query = "UPDATE tb_buku SET 
    judul_buku='$judul', 
    pengarang='$pengarang', 
    tahun_terbit='$tahun', 
    kategori='$kategori' 
    WHERE id_buku=$id";

$hasil = mysqli_query($conn, $query);

// Cek apakah update berhasil
if ($hasil) {
    header('Location: index.php');
    exit();
} else {
    echo "Update data gagal: " . mysqli_error($conn);
}
?>
