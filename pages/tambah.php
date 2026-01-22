<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1️⃣ Koneksi ke database
include __DIR__ . '/../koneksi.php';

// 2️⃣ Proses simpan data kalau tombol submit diklik
if (isset($_POST['simpan'])) {
    $kode = $_POST['kode_pelanggan'];
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];

    mysqli_query($conn, "INSERT INTO pelanggan (kode_pelanggan, nama_pelanggan, alamat, no_hp, email) VALUES
        ('$kode','$nama','$alamat','$no_hp','$email')");

    echo "<script>alert('Data pelanggan berhasil ditambahkan!'); window.location='dashboard.php?page=customer';</script>";
}
?>

<!-- ======================= FORM TAMBAH PELANGGAN ======================= -->
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
label { font-weight: 600; }
</style>

<div class="form-container">
    <h3>Tambah Pelanggan</h3>
    <form method="post">
        <label>Kode Pelanggan</label>
        <input type="text" name="kode_pelanggan" required>

        <label>Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" required>

        <label>Alamat</label>
        <input type="text" name="alamat" required>

        <label>No HP</label>
        <input type="text" name="no_hp" required>

        <label>Email</label>
        <input type="email" name="email" required>

        <button type="submit" name="simpan" class="btn-submit">Simpan</button>
    </form>
</div>
