<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit;
}

// ambil data admin dari database
include 'koneksi.php';
$username = $_SESSION['username'];
$query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
$data = mysqli_fetch_assoc($query);
?>

<h2>My Profile</h2>
<p>Username: <?= $data['username']; ?></p>
<p>Nama: <?= $data['nama']; ?></p>
<!-- Tambahkan data lain sesuai database -->
<a href="dashboard.php">Kembali ke Dashboard</a>
