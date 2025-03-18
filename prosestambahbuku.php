<?php
include_once("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul_buku = mysqli_real_escape_string($conn, $_POST['judul']);
    $pengarang = mysqli_real_escape_string($conn, $_POST['pengarang']);
    $tahun_terbit = mysqli_real_escape_string($conn, $_POST['tahun_terbit']);
    $kategori = mysqli_real_escape_string($conn, $_POST['kategori']);

    // Pastikan tidak ada data kosong
    if (empty($judul_buku) || empty($pengarang) || empty($tahun_terbit) || empty($kategori)) {
        echo "<script>alert('Semua field harus diisi!'); window.location.href='tambahbuku.php';</script>";
        exit;
    }

    // Ambil kode buku terakhir
    $query = "SELECT kode_buku FROM tb_buku ORDER BY id_buku DESC LIMIT 1";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error saat mengambil kode buku terakhir: " . mysqli_error($conn));
    }

    $data = mysqli_fetch_array($result);
    $newNumber = ($data) ? (int)substr($data['kode_buku'], -3) + 1 : 1;

    // Format kode buku baru (BK2025001, BK2025002, dst.)
    $kode_buku = "BK" . date("Y") . str_pad($newNumber, 3, "0", STR_PAD_LEFT);

    // Simpan data ke database
    $query = "INSERT INTO tb_buku (kode_buku, judul_buku, pengarang, tahun_terbit, kategori) 
              VALUES ('$kode_buku', '$judul_buku', '$pengarang', '$tahun_terbit', '$kategori')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Buku berhasil ditambahkan!'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan buku: " . mysqli_error($conn) . "'); window.location.href='tambahbuku.php';</script>";
    }
}
?>
