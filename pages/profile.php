<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// FIXED: path koneksi
include __DIR__ . '/../koneksi.php';

// Ambil ID barang
$id = $_GET['id'] ?? '';

if (!$id) {
    echo "ID Barang tidak ditemukan!";
    exit;
}

// Ambil data barang sesuai ID
$query = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
$barang = mysqli_fetch_assoc($query);

if (!$barang) {
    echo "Data barang tidak ditemukan!";
    exit;
}


// 2️⃣ Ambil data barang dari database sesuai ID
$query = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
$barang = mysqli_fetch_assoc($query);

if (!$barang) {
    // Kalau data tidak ditemukan di DB, berhenti
    echo "Data barang tidak ditemukan!";
    exit;
}

// 3️⃣ Proses update data kalau tombol Update diklik
if (isset($_POST['update'])) {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];

    $update = mysqli_query($conn, "UPDATE barang SET 
        kode_barang='$kode',
        nama_barang='$nama',
        kategori='$kategori',
        harga='$harga',
        stok='$stok',
        satuan='$satuan'
        WHERE id_barang='$id'");

    if ($update) {
        // Kalau berhasil, kembali ke list produk
        echo "<script>alert('Data berhasil diupdate!'); window.location='listproducts.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Produk</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f4f4f4;
    padding: 20px;
}
.form-container {
    background: white;
    padding: 20px;
    border-radius: 6px;
    max-width: 500px;
    margin: 50px auto;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
}
h3 { text-align: center; margin-bottom: 15px; }
.form-group { margin-bottom: 12px; }
label { display: block; margin-bottom: 5px; }
input { width: 100%; padding: 8px; border-radius: 4px; border: 1px solid #ccc; }
.btn-submit {
    background: #27ae60;
    color: white;
    padding: 10px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    width: 100%;
}
</style>
</head>
<body>

<div class="form-container">
    <h3>Edit Produk</h3>
    <form method="post">
        <div class="form-group">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" value="<?= $barang['kode_barang']; ?>" required>
        </div>
        <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= $barang['nama_barang']; ?>" required>
        </div>
        <div class="form-group">
            <label>Kategori</label>
            <input type="text" name="kategori" value="<?= $barang['kategori']; ?>" required>
        </div>
        <div class="form-group">
            <label>Harga</label>
            <input type="number" name="harga" value="<?= $barang['harga']; ?>" required>
        </div>
        <div class="form-group">
            <label>Stok</label>
            <input type="number" name="stok" value="<?= $barang['stok']; ?>" required>
        </div>
        <div class="form-group">
            <label>Satuan</label>
            <input type="text" name="satuan" value="<?= $barang['satuan']; ?>" required>
        </div>
        <button type="submit" name="update" class="btn-submit">Update</button>
    </form>
</div>

</body>
</html>
