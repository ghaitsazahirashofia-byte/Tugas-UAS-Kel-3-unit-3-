<?php
require_once 'config/koneksi.php';

if (isset($_POST['simpan'])) {

    $nim = $_POST['nim'];
    $nama = $_POST['nama_peserta'];
    $jk = $_POST['jenis_kelamin'];
    $kelas = $_POST['kelas'];
    $prodi = $_POST['prodi'];
    $nohp = $_POST['no_hp'];
    $alamat = $_POST['alamat'];

    mysqli_query($conn,"INSERT INTO peserta
    (nim,nama_peserta,jenis_kelamin,kelas,prodi,no_hp,alamat,status_peserta)
    VALUES
    ('$nim','$nama','$jk','$kelas','$prodi','$nohp','$alamat','aktif')");
    header("Location: peserta.php");
    Exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Peserta | Sistem Informasi Absensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<div class="app-layout">

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

    <main class="main-content">

        <div class="topbar">
            <div>
                <h2>Data Peserta</h2>
                <p>Kelola daftar peserta yang akan mengikuti absensi.</p>
            </div>
            <div class="user-pill">Administrator</div>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="content-card">
                    <div class="card-header">
                        <h5>Tambah Peserta</h5>
                    </div>

                    <div class="card-body">
                        <form method="post">
                            <div class="mb-3">
                                <label class="form-label">NIM</label>
                                <input type="text" class="form-control" name="nim"required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Peserta</label>
                                <input type="text" class="form-control" name="nama_peserta"required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select" name="jenis_kelamin" required>
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kelas</label>
                                <input type="text" class="form-control" name="kelas"required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Program Studi</label>
                                <input type="text" class="form-control" name="prodi"required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No. HP</label>
                                <input type="text" class="form-control" name="no_hp"required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" name="alamat"required></textarea>
                            </div>

                            <button type="submit" name="simpan" class="btn btn-primary w-100">
                                Simpan Peserta
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="content-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Daftar Peserta</h5>
                        <?php
                        $jml = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM peserta"));
                        ?>

                        <span class="badge bg-primary rounded-pill">
                            <?= $jml; ?> Peserta
                        </span>
                    </div>

                    <div class="card-body">
                        <div class="row g-3 mb-3">
                            <div class="col-md-8">
                                <input type="text" class="form-control" placeholder="Cari nama atau NIM peserta">
                            </div>
                            <div class="col-md-4">
                                <select class="form-select">
                                    <option>Semua Kelas</option>
                                    <option>Unit 01</option>
                                    <option>Unit 02</option>
                                    <option>Unit 03</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>JK</th>
                                        <th>Kelas</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $data = mysqli_query($conn, "SELECT * FROM peserta");

                                    while($d = mysqli_fetch_assoc($data)){
                                    ?>

                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $d['nim']; ?></td>
                                        <td><?= $d['nama_peserta']; ?></td>
                                        <td><?= $d['jenis_kelamin']; ?></td>
                                        <td><?= $d['kelas']; ?></td>
                                        <td>
                                            <?php
                                            if($d['status_peserta']=="aktif"){
                                                echo "<span class='badge bg-success'>Aktif</span>";
                                            }else{
                                                echo "<span class='badge bg-danger'>Nonaktif</span>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="edit_peserta.php?id=<?= $d['id_peserta']; ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="hapus_peserta.php?id=<?= $d['id_peserta']; ?>" class="btn btn-sm btn-outline-danger">Hapus</a>
                                        </td>
                                    </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </main>

</div>

</body>
</html>