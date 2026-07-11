<?php
require_once 'config/koneksi.php';

$id = $_GET['id'];

$data = mysqli_query($conn,"SELECT * FROM peserta WHERE id_peserta='$id'");
$p = mysqli_fetch_assoc($data);

if(isset($_POST['update'])){

    $nim = $_POST['nim'];
    $nama = $_POST['nama_peserta'];
    $jk = $_POST['jenis_kelamin'];
    $kelas = $_POST['kelas'];
    $prodi = $_POST['prodi'];
    $nohp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn,"UPDATE peserta SET
        nim='$nim',
        nama_peserta='$nama',
        jenis_kelamin='$jk',
        kelas='$kelas',
        prodi='$prodi',
        no_hp='$nohp',
        alamat='$alamat'
    WHERE id_peserta='$id'");

    header("Location: peserta.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Peserta</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="app-layout">

<!-- Sidebar -->
<aside class="sidebar">

<div class="logo">
<div class="logo-box">A</div>

<div>
<h4>AbsensiApp</h4>
<small>Panel Administrator</small>
</div>

</div>

<div class="menu-label">Menu Utama</div>

<ul class="nav-menu">
<li><a href="dashboard.php">🏠 Dashboard</a></li>
<li><a href="peserta.php" class="active">👥 Data Peserta</a></li>
<li><a href="absensi.php">📝 Input Absensi</a></li>
<li><a href="rekap.php">📊 Rekap Kehadiran</a></li>
</ul>

<div class="menu-label">Akun</div>

<ul class="nav-menu">
<li><a href="logout.php">🚪 Logout</a></li>
</ul>

</aside>

<!-- Main -->

<main class="main-content">

<div class="topbar">

<div>
<h2>Edit Peserta</h2>
<p>Ubah data peserta.</p>
</div>

<div class="user-pill">
Administrator
</div>

</div>

<div class="content-card">

<div class="card-header">
<h5>Form Edit Peserta</h5>
</div>

<div class="card-body">

<form method="post">

<div class="mb-3">
<label>NIM</label>
<input type="text" class="form-control" name="nim"
value="<?= $p['nim']; ?>" required>
</div>

<div class="mb-3">
<label>Nama Peserta</label>
<input type="text" class="form-control"
name="nama_peserta"
value="<?= $p['nama_peserta']; ?>" required>
</div>

<div class="mb-3">
<label>Jenis Kelamin</label>

<select class="form-select" name="jenis_kelamin">

<option value="L"
<?= $p['jenis_kelamin']=="L" ? "selected":"";?>>
Laki-laki
</option>

<option value="P"
<?= $p['jenis_kelamin']=="P" ? "selected":"";?>>
Perempuan
</option>

</select>

</div>

<div class="mb-3">
<label>Kelas</label>
<input type="text"
class="form-control"
name="kelas"
value="<?= $p['kelas']; ?>">
</div>

<div class="mb-3">
<label>Program Studi</label>
<input type="text"
class="form-control"
name="prodi"
value="<?= $p['prodi']; ?>">
</div>

<div class="mb-3">
<label>No HP</label>
<input type="text"
class="form-control"
name="no_hp"
value="<?= $p['no_hp']; ?>">
</div>

<div class="mb-3">
<label>Alamat</label>

<textarea class="form-control"
name="alamat"><?= $p['alamat']; ?></textarea>

</div>

<button class="btn btn-primary" name="update">
💾 Update
</button>

<a href="peserta.php" class="btn btn-secondary">
← Kembali
</a>

</form>

</div>

</div>

</main>

</div>

</body>
</html>