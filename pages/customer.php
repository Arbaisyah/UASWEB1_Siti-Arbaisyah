<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi database
include __DIR__ . '/../koneksi.php';

// Proses hapus data
if (isset($_GET['hapus'])) {
    $id_hapus = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM pelanggan WHERE id_pelanggan='$id_hapus'");
    echo "<script>alert('Data berhasil dihapus!'); window.location='dashboard.php?page=customer';</script>";
}

// Ambil semua data pelanggan
$data = mysqli_query($conn, "SELECT * FROM pelanggan");
?>

<style>
.card {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    margin-bottom: 30px;
}

.card-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.card-header h3 { margin: 0; }

.btn {
    padding: 6px 12px;
    text-decoration: none;
    border-radius: 5px;
    color: white;
    font-size: 13px;
    margin-left: 3px;
}

.btn-tambah { background: #27ae60; }
.btn-edit   { background: #2980b9; }
.btn-hapus  { background: #c0392b; }

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}

th, td {
    padding: 10px;
    border-bottom: 1px solid #ddd;
    text-align: center;
}

th { background: #f1f1f1; font-weight: 600; }

td .btn { margin: 0 2px; }
</style>

<div class="card">
    <div class="card-header">
        <h3>List Pelanggan</h3>
        <a href="dashboard.php?page=tambahcustomer" class="btn btn-tambah">+ Tambah Pelanggan</a>
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

        <?php
        $no = 1;
        while ($row = mysqli_fetch_assoc($data)) {
        ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $row['kode_pelanggan'] ?? '-'; ?></td>
            <td><?= $row['nama_pelanggan'] ?? '-'; ?></td>
            <td><?= $row['alamat'] ?? '-'; ?></td>
            <td><?= $row['no_hp'] ?? '-'; ?></td>
            <td><?= $row['email'] ?? '-'; ?></td>
            <td>
                <!-- EDIT Pelanggan → pakai profile.php tapi versi pelanggan -->
               <a href="pages/profile.php?id=<?= $row['id_pelanggan']; ?>&type=customer" class="btn btn-edit">Edit</a>
                <a href="dashboard.php?page=customer&hapus=<?= $row['id_pelanggan']; ?>" 
                   class="btn btn-hapus"
                   onclick="return confirm('Yakin hapus data?')">Hapus</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
