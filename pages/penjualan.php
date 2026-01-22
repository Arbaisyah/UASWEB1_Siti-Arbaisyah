<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include __DIR__ . '/../koneksi.php';

// ====================== SIMPAN DATA ======================
if (isset($_POST['simpan'])) {
    $tanggal = $_POST['tanggal'];
    $id_pelanggan = $_POST['id_pelanggan'];
    $total = $_POST['total'];

    mysqli_query($conn, "INSERT INTO penjualan (tanggal, id_pelanggan, total) VALUES ('$tanggal','$id_pelanggan','$total')");
    echo "<script>alert('Data penjualan berhasil ditambahkan!'); window.location='?page=penjualan';</script>";
    exit;
}

// ====================== HAPUS DATA ======================
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM penjualan WHERE id_penjualan='$id_hapus'");
    echo "<script>alert('Data penjualan berhasil dihapus!'); window.location='?page=penjualan';</script>";
    exit;
}

// ====================== AMBIL DATA ======================
$data = mysqli_query($conn, "SELECT p.*, pl.nama_pelanggan FROM penjualan p LEFT JOIN pelanggan pl ON p.id_pelanggan=pl.id_pelanggan");
$pelanggan = mysqli_query($conn, "SELECT * FROM pelanggan");
?>

<style>
.card { background:white; padding:20px; border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.1); margin-bottom:30px; }
.card-header { display:flex; justify-content:space-between; align-items:center; margin-bottom:15px; }
.btn { padding:6px 12px; text-decoration:none; border-radius:5px; color:white; font-size:13px; margin-left:3px; cursor:pointer; }
.btn-tambah { background:#27ae60; }
.btn-edit { background:#2980b9; }
.btn-hapus { background:#c0392b; }
table { width:100%; border-collapse:collapse; margin-top:15px; }
th, td { padding:10px; border-bottom:1px solid #ddd; text-align:center; }
th { background:#f1f1f1; font-weight:600; }
.form-container { background:white; padding:20px; border-radius:6px; max-width:500px; margin:20px auto; box-shadow:0 2px 5px rgba(0,0,0,0.1); display:none; }
input, select { width:100%; padding:8px; margin-bottom:12px; border-radius:4px; border:1px solid #ccc; }
.btn-submit { background:#27ae60; color:white; padding:10px; border:none; border-radius:4px; cursor:pointer; width:100%; }
h3 { text-align:center; margin-bottom:15px; }
label { font-weight:600; }
</style>

<!-- FORM TAMBAH -->
<div class="form-container" id="formTambah">
    <h3>Tambah Penjualan</h3>
    <form method="post">
        <label>Tanggal</label>
        <input type="date" name="tanggal" required>

        <label>Pelanggan</label>
        <select name="id_pelanggan" required>
            <option value="">-- Pilih Pelanggan --</option>
            <?php while($pl=mysqli_fetch_assoc($pelanggan)): ?>
                <option value="<?= $pl['id_pelanggan']; ?>"><?= $pl['nama_pelanggan']; ?></option>
            <?php endwhile; ?>
        </select>

        <label>Total</label>
        <input type="number" name="total" required>

        <button type="submit" name="simpan" class="btn-submit">Simpan</button>
    </form>
</div>

<!-- LIST PENJUALAN -->
<div class="card">
    <div class="card-header">
        <h3>List Penjualan</h3>
        <button class="btn btn-tambah" onclick="toggleForm()">+ Tambah Penjualan</button>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Pelanggan</th>
            <th>Total</th>
            <th>Aksi</th>
        </tr>
        <?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['tanggal']; ?></td>
            <td><?= $row['nama_pelanggan']; ?></td>
            <td>Rp <?= number_format($row['total'],0,',','.'); ?></td>
            <td>
                <a href="pages/profile.php?id=<?= $row['id_penjualan']; ?>&type=penjualan" class="btn btn-edit">Edit</a>
                <a href="?page=penjualan&hapus=<?= $row['id_penjualan']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<script>
function toggleForm() {
    const form = document.getElementById('formTambah');
    form.style.display = form.style.display==='none'?'block':'none';
}
</script>
