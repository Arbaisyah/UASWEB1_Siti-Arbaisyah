<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi
include __DIR__ . '/../koneksi.php';

// Ambil id dan type
$id = $_GET['id'] ?? '';
$type = $_GET['type'] ?? '';

if (!$id || !$type) {
    die("ID atau type tidak ditemukan!");
}

// Ambil data sesuai type
switch ($type) {
    case 'customer':
        $query = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan='$id'");
        $data = mysqli_fetch_assoc($query);
        if (!$data) die("Data pelanggan tidak ditemukan!");
        break;
    case 'barang':
        $query = mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'");
        $data = mysqli_fetch_assoc($query);
        if (!$data) die("Data barang tidak ditemukan!");
        break;
    case 'penjualan':
        $query = mysqli_query($conn, "SELECT * FROM penjualan WHERE id_penjualan='$id'");
        $data = mysqli_fetch_assoc($query);
        if (!$data) die("Data penjualan tidak ditemukan!");
        break;
    default:
        die("Type tidak valid!");
}

// Proses update
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
        if ($update) echo "<script>alert('Pelanggan diupdate'); window.location='../dashboard.php?page=customer';</script>";
        else echo "Error: ".mysqli_error($conn);

    } elseif ($type === 'barang') {
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
        if ($update) echo "<script>alert('Barang diupdate'); window.location='../dashboard.php?page=listproducts';</script>";
        else echo "Error: ".mysqli_error($conn);

    } elseif ($type === 'penjualan') {
        $tanggal = $_POST['tanggal'];
        $id_pelanggan = $_POST['id_pelanggan'];
        $total = $_POST['total'];

        $update = mysqli_query($conn, "UPDATE penjualan SET 
            tanggal='$tanggal',
            id_pelanggan='$id_pelanggan',
            total='$total'
            WHERE id_penjualan='$id'");
        if ($update) echo "<script>alert('Penjualan diupdate'); window.location='../dashboard.php?page=penjualan';</script>";
        else echo "Error: ".mysqli_error($conn);
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
.form-container { background: white; padding: 20px; border-radius: 6px; max-width: 500px; margin: 50px auto; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
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

<?php elseif($type==='barang'): ?>
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

<?php elseif($type==='penjualan'): ?>
<h3>Edit Penjualan</h3>
<form method="post">
    <label>Tanggal</label>
    <input type="date" name="tanggal" value="<?= $data['tanggal']; ?>" required>
    <label>Pelanggan</label>
    <select name="id_pelanggan" required>
        <?php
        $pelanggan_list = mysqli_query($conn, "SELECT * FROM pelanggan");
        while($pl=mysqli_fetch_assoc($pelanggan_list)){
            $sel = ($pl['id_pelanggan']==$data['id_pelanggan'])?'selected':'';
            echo "<option value='{$pl['id_pelanggan']}' $sel>{$pl['nama_pelanggan']}</option>";
        }
        ?>
    </select>
    <label>Total</label>
    <input type="number" name="total" value="<?= $data['total']; ?>" required>
    <button type="submit" name="update" class="btn-submit">Update</button>
</form>
<?php endif; ?>

</div>
</body>
</html>
