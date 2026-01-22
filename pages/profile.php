<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 1️⃣ Koneksi database
include __DIR__ . '/../koneksi.php';

// 2️⃣ Ambil ID & type dari URL
$id = $_GET['id'] ?? '';
$type = $_GET['type'] ?? 'barang'; // default: barang

if (!$id) {
    echo "ID tidak ditemukan!";
    exit;
}

// 3️⃣ Ambil data dari database sesuai type
if ($type === 'customer') {
    $query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
    $data = mysqli_fetch_assoc($query);
    if (!$data) { echo "Data pelanggan tidak ditemukan!"; exit; }
} else {
    $query = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
    $data = mysqli_fetch_assoc($query);
    if (!$data) { echo "Data barang tidak ditemukan!"; exit; }
}

// 4️⃣ Proses update saat tombol Update diklik
if (isset($_POST['update'])) {
    if ($type === 'customer') {
        $kode = $_POST['kode_pelanggan'];
        $nama = $_POST['nama_pelanggan'];
        $alamat = $_POST['alamat'];
        $no_hp = $_POST['no_hp'];
        $email = $_POST['email'];

        $update = mysqli_query($conn, "UPDATE pelanggan SET 
            kode_pelanggan='$kode',
            nama_pelanggan='$nama',
            alamat='$alamat',
            no_hp='$no_hp',
            email='$email'
            WHERE id_pelanggan='$id'");
        
        if ($update) {
            echo "<script>alert('Data pelanggan berhasil diupdate!'); window.location='../dashboard.php?page=customer';</script>";
            exit;
        } else { echo "Error: ".mysqli_error($conn); }
    } else {
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
            echo "<script>alert('Data barang berhasil diupdate!'); window.location='../dashboard.php?page=listproducts';</script>";
            exit;
        } else { echo "Error: ".mysqli_error($conn); }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit <?= ucfirst($type); ?></title>
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
input, select { width: 100%; padding: 8px; margin-bottom: 12px; border-radius: 4px; border: 1px solid #ccc; }
.btn-submit { background: #27ae60; color: white; padding: 10px; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
h3 { text-align: center; margin-bottom: 15px; }
label { font-weight: 600; }
</style>
</head>
<body>

<div class="form-container">
    <?php if($type==='customer'): ?>
        <h3>Edit Pelanggan</h3>
        <form method="post">
            <label>Kode Pelanggan</label>
            <input type="text" name="kode_pelanggan" value="<?= $data['kode_pelanggan']; ?>" required>

            <label>Nama Pelanggan</label>
            <input type="text" name="nama_pelanggan" value="<?= $data['nama_pelanggan']; ?>" required>

            <label>Alamat</label>
            <input type="text" name="alamat" value="<?= $data['alamat']; ?>" required>

            <label>No HP</label>
            <input type="text" name="no_hp" value="<?= $data['no_hp']; ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= $data['email']; ?>" required>

            <button type="submit" name="update" class="btn-submit">Update</button>
        </form>

    <?php else: ?>
        <h3>Edit Barang</h3>
        <form method="post">
            <label>Kode Barang</label>
            <input type="text" name="kode_barang" value="<?= $data['kode_barang']; ?>" required>

            <label>Nama Barang</label>
            <input type="text" name="nama_barang" value="<?= $data['nama_barang']; ?>" required>

            <label>Kategori</label>
            <input type="text" name="kategori" value="<?= $data['kategori']; ?>" required>

            <label>Harga</label>
            <input type="number" name="harga" value="<?= $data['harga']; ?>" required>

            <label>Stok</label>
            <input type="number" name="stok" value="<?= $data['stok']; ?>" required>

            <label>Satuan</label>
            <input type="text" name="satuan" value="<?= $data['satuan']; ?>" required>

            <button type="submit" name="update" class="btn-submit">Update</button>
        </form>
    <?php endif; ?>
</div>

</body>
</html>
