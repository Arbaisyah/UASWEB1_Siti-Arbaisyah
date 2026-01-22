<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1️⃣ Koneksi ke database
include __DIR__ . '/../koneksi.php';

// 2️⃣ Proses simpan data kalau tombol submit diklik
if (isset($_POST['simpan'])) {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $stok = $_POST['stok'];
    $satuan = $_POST['satuan'];

    mysqli_query($conn, "INSERT INTO barang (kode_barang, nama_barang, kategori, harga, stok, satuan) VALUES
        ('$kode','$nama','$kategori','$harga','$stok','$satuan')");

    echo "<script>alert('Data berhasil ditambahkan!'); window.location='dashboard.php?page=listproducts';</script>";
}
?>

<!-- ======================= FORM TAMBAH PRODUK ======================= -->
<style>
body { font-family: Arial; background: #f4f4f4; padding: 20px; }
.form-container { 
    background: white; 
    padding: 20px; 
    border-radius: 6px; 
    max-width: 500px; 
    margin: 50px auto; 
    box-shadow: 0 2px 5px rgba(0,0,0,0.1); 
}
input { width: 100%; padding: 8px; margin-bottom: 12px; border-radius: 4px; border: 1px solid #ccc; }
.btn-submit { 
    background: #27ae60; 
    color: white; 
    padding: 10px; 
    border: none; 
    border-radius: 4px; 
    cursor: pointer; 
    width: 100%; 
}
h3 { text-align: center; margin-bottom: 15px; }
</style>

<div class="form-container">
    <h3>Tambah Produk</h3>
    <form method="post">
        <label>Kode Barang</label>
        <input type="text" name="kode_barang" required>

        <label>Nama Barang</label>
        <input type="text" name="nama_barang" required>

        <label>Kategori</label>
        <input type="text" name="kategori" required>

        <label>Harga</label>
        <input type="number" name="harga" required>

        <label>Stok</label>
        <input type="number" name="stok" required>

        <label>Satuan</label>
        <input type="text" name="satuan" required>

        <button type="submit" name="simpan" class="btn-submit">Simpan</button>
    </form>
</div>
