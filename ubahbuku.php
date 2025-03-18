<?php
include_once("koneksi.php");

if (!isset($_GET['id']) || empty($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid.");
}

$id = intval($_GET['id']);
$query = "SELECT * FROM tb_buku WHERE id_buku=$id";
$hasil = mysqli_query($conn, $query);

if (mysqli_num_rows($hasil) == 0) {
    die("Data tidak ditemukan.");
}

$data = mysqli_fetch_assoc($hasil);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Buku</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="alert alert-success text-center">
            <h2>DATA KOLEKSI BUKU PERPUSTAKAAN</h2>
        </div>
        <h3>Ubah Koleksi Buku</h3>
        
        <form method="post" action="prosesubahbuku.php">
            <input type="hidden" name="id" value="<?php echo $data['id_buku']; ?>">
            
            <div class="form-group">
                <label>Judul Buku</label>
                <input type="text" name="judul" class="form-control" value="<?php echo $data['judul_buku']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Pengarang</label>
                <input type="text" name="pengarang" class="form-control" value="<?php echo $data['pengarang']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-control" value="<?php echo $data['tahun_terbit']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Kategori</label>
                <input type="text" name="kategori" class="form-control" value="<?php echo $data['kategori']; ?>" required>
            </div>
            
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
