<?php
include_once("koneksi.php");

// Cek apakah parameter ID tersedia
if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = $_GET['id'];

// Pastikan ID adalah angka
if (!is_numeric($id)) {
    die("ID tidak valid.");
}

// Cek apakah buku dengan ID tersebut ada di database
$cek = mysqli_query($conn, "SELECT * FROM tb_buku WHERE id_buku=$id");
if (mysqli_num_rows($cek) == 0) {
    die("Buku tidak ditemukan.");
}

// Hapus data dari database
$query = "DELETE FROM tb_buku WHERE id_buku=$id";
$hasil = mysqli_query($conn, $query);

if ($hasil) {
    header("Location: index.php?msg=deleted");
    exit();
} else {
    echo "Gagal menghapus buku: " . mysqli_error($conn);
}
?>
