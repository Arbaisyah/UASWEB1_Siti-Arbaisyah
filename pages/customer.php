<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include __DIR__ . '/../koneksi.php';

// ====================== SIMPAN DATA ======================
if (isset($_POST['simpan'])) {
    $kode = $_POST['kode_pelanggan'];
    $nama = $_POST['nama_pelanggan'];
    $alamat = $_POST['alamat'];
    $no_hp = $_POST['no_hp'];
    $email = $_POST['email'];

    mysqli_query($conn, "INSERT INTO pelanggan (kode_pelanggan, nama_pelanggan, alamat, no_hp, email) VALUES
        ('$kode','$nama','$alamat','$no_hp','$email')");

    echo "<script>alert('Data pelanggan berhasil ditambahkan!'); window.location='?page=customer';</script>";
    exit;
}

// ====================== EDIT DATA ======================
if (isset($_GET['edit'])) {
    $id_edit = $_GET['edit'];
    $data_edit = mysqli_query($conn, "SELECT * FROM pelanggan WHERE id_pelanggan='$id_edit'");
    $row_edit = mysqli_fetch_assoc($data_edit);
}

// ====================== HAPUS DATA ======================
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan='$id_hapus'");
    echo "<script>alert('Data berhasil dihapus!'); window.location='?page=customer';</script>";
    exit;
}

// Ambil semua data pelanggan
$data = mysqli_query($conn, "SELECT * FROM pelanggan");
?>

<style>
.card { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 30px; }
.card-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
.card-header h3 { margin: 0; }
.btn { padding: 6px 12px; text-decoration: none; border-radius: 5px; color: white; font-size: 13px; margin-left: 3px; }
.btn-tambah { background: #27ae60; }
.btn-edit   { background: #2980b9; }
.btn-hapus  { background: #c0392b; }
table { width: 100%; border-collapse: collapse; margin-top: 15px; }
th, td { padding: 10px; border-bottom: 1px solid #ddd; text-align: center; }
th { background: #f1f1f1; font-weight: 600; }
td .btn { margin: 0 2px; }
.form-container { background: white; padding: 20px; border-radius: 6px; max-width: 500px; margin: 20px auto; box-shadow: 0 2px 5px rgba(0,0,0,0.1); display: none; } /* hidden by default */
input { width: 100%; padding: 8px; margin-bottom: 12px; border-radius: 4px; border: 1px solid #ccc; }
.btn-submit { background: #27ae60; color: white; padding: 10px; border: none; border-radius: 4px; cursor: pointer; width: 100%; }
h3 { text-align: center; margin-bottom: 15px; }
label { font-weight: 600; }
</style>

<!-- ====================== FORM TAMBAH ====================== -->
<div class="form-container" id="formTambah">
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

<!-- ====================== LIST PELANGGAN ====================== -->
<div class="card">
    <div class="card-header">
        <h3>List Pelanggan</h3>
        <button class="btn btn-tambah" onclick="toggleForm()">+ Tambah Pelanggan</button>
    </div>

    <table>
        <tr>
            <th>No</th>
            <th>Kode</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No HP</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
        <?php $no=1; while($row=mysqli_fetch_assoc($data)): ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['kode_pelanggan']; ?></td>
            <td><?= $row['nama_pelanggan']; ?></td>
            <td><?= $row['alamat']; ?></td>
            <td><?= $row['no_hp']; ?></td>
            <td><?= $row['email']; ?></td>
            <td>
                <a href="?page=customer&edit=<?= $row['id_pelanggan']; ?>" class="btn btn-edit">Edit</a>
                <a href="?page=customer&hapus=<?= $row['id_pelanggan']; ?>" class="btn btn-hapus" onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
</div>

<script>
function toggleForm() {
    const form = document.getElementById('formTambah');
    form.style.display = form.style.display === 'none' ? 'block' : 'none';
}
</script>
