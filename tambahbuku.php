<?php
include_once("koneksi.php");

// Ambil kode buku terakhir
$query = "SELECT kode_buku FROM tb_buku ORDER BY id_buku DESC LIMIT 1";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Error saat mengambil kode buku terakhir: " . mysqli_error($conn));
}

$data = mysqli_fetch_array($result);

if ($data) {
    // Ambil angka dari kode buku terakhir, misal BK2025001 → ambil 001
    $lastNumber = (int)substr($data['kode_buku'], -3);
    $newNumber = $lastNumber + 1;
} else {
    $newNumber = 1; // Jika tidak ada buku, mulai dari 1
}

// Buat format kode buku baru (contoh: BK2025001)
$kode_buku = "BK" . date("Y") . str_pad($newNumber, 3, "0", STR_PAD_LEFT);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Tambah Buku</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>

<body>
    <div class="alert alert-success text-center">
        <h2>DATA KOLEKSI BUKU PERPUSTAKAAN</h2>
    </div>
    <div class="container">
        <h1>Tambah Koleksi Buku</h1>
        <form method="post" action="prosestambahbuku.php">
            <div class="form-group">
                <label for="kode_buku">Kode Buku</label>
                <input type="text" name="kode_buku" class="form-control" value="<?= $kode_buku ?>" readonly>
            </div>
            <div class="form-group">
                <label for="judul">Judul Buku</label>
                <input type="text" name="judul" class="form-control" placeholder="Judul Buku" required>
            </div>
            <div class="form-group">
                <label for="pengarang">Pengarang</label>
                <input type="text" name="pengarang" class="form-control" placeholder="Pengarang" required>
            </div>
            <div class="form-group">
                <label for="tahun_terbit">Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-control" placeholder="Tahun Terbit" required>
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <input type="text" name="kategori" class="form-control" placeholder="Kategori" required>
            </div>
            <button type="submit" class="btn btn-primary">Kirim</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>
