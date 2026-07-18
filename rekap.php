<?php
include "koneksi.php";
$halaman = "rekap";

$tglMulai = isset($_GET['mulai']) ? $_GET['mulai'] : date('Y-m-01');
$tglSelesai = isset($_GET['selesai']) ? $_GET['selesai'] : date('Y-m-d');

$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';
$whereStat = "";

if ($kelas != "") {
    $whereStat = "AND p.kelas='$kelas'";
}

$statistik = mysqli_fetch_assoc(mysqli_query($conn, "
    SELECT

    SUM(a.status_kehadiran='hadir') AS hadir,
    SUM(a.status_kehadiran='izin') AS izin,
    SUM(a.status_kehadiran='sakit') AS sakit,
    SUM(a.status_kehadiran='alpa') AS alpa

    FROM absensi a

    JOIN peserta p
    ON a.id_peserta = p.id_peserta

    WHERE a.tanggal BETWEEN '$tglMulai' AND '$tglSelesai'

    $whereStat
"));
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Kehadiran | Sistem Informasi Absensi</title>

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
            <li>
                <a href="dashboard.php" class="<?= ($halaman=='dashboard')?'active':'' ?>">
                🏠 Dashboard
                </a>
                </li>

            <li>
                <a href="peserta.php" class="<?= ($halaman=='peserta')?'active':'' ?>">
                👥 Data Peserta
                </a>
                </li>

            <li>
                <a href="absensi.php" class="<?= ($halaman=='absensi')?'active':'' ?>">
                📝 Input Absensi
                </a>
                </li>

            <li>
                <a href="rekap.php" class="<?= ($halaman=='rekap')?'active':'' ?>">
                📊 Rekap Kehadiran
                </a>
                </li>
        </ul>

        <div class="menu-label">Akun</div>
        <ul class="nav-menu">
            <li><a href="logout.php">🚪 Logout</a></li>
        </ul>
    </aside>

    <main class="main-content">

        <div class="topbar">
            <div>
                <h2>Rekap Kehadiran</h2>
                <p>Lihat ringkasan kehadiran peserta berdasarkan periode tertentu.</p>
            </div>
            <div class="user-pill">Administrator</div>
        </div>

        <div class="content-card mb-4">
            <div class="card-header">
                <h5>Filter Rekap</h5>
            </div>

            <div class="card-body">
                <form action="#" method="get">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">Tanggal Mulai</label>
                            <input type="date" 
                            name="mulai"
                            class="form-control"
                            value="<?= $tglMulai ?>">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date"
                            name="selesai"
                            class="form-control"
                            value="<?= $tglSelesai ?>">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Kelas</label>

                            <select class="form-select" name="kelas">

                                <option value="">Semua Kelas</option>

                                <?php

                                $qkelas = mysqli_query($conn,"
                                SELECT DISTINCT kelas FROM peserta
                                WHERE status_peserta='aktif'
                                ");

                                while($k = mysqli_fetch_assoc($qkelas)){

                                ?>

                                <option value="<?= $k['kelas'] ?>"
                                <?= ($kelas == $k['kelas']) ? 'selected' : '' ?>>
                                    <?= $k['kelas'] ?>
                                </option>

                                <?php } ?>

                            </select>

                        </div>

                        <div class="col-md-3 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                Tampilkan Rekap
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-success">✓</div>
                    <h3><?= $statistik['hadir'] ?? 0 ?></h3>
                    <p>Total Hadir</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-primary">i</div>
                    <h3><?= $statistik['izin'] ?? 0 ?></h3>
                    <p>Total Izin</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-warning">+</div>
                    <h3><?= $statistik['sakit'] ?? 0 ?></h3>
                    <p>Total Sakit</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-danger">×</div>
                    <h3><?= $statistik['alpa'] ?? 0 ?></h3>
                    <p>Total Alpa</p>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Tabel Rekap Kehadiran</h5>
                <a href="cetak_rekap.php?mulai=<?= $tglMulai ?>&selesai=<?= $tglSelesai ?>&kelas=<?= $kelas ?>"
                    target="_blank"
                    class="btn btn-sm btn-outline-primary">
                        Cetak Rekap
                </a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Peserta</th>
                                <th>Kelas</th>
                                <th>Hadir</th>
                                <th>Izin</th>
                                <th>Sakit</th>
                                <th>Alpa</th>
                                <th>Persentase</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                        $where = "";

                        if($kelas != ""){
                            $where = "AND p.kelas='$kelas'";
                        }
                        $query = mysqli_query($conn,"
                        SELECT 
                        p.nim,
                        p.nama_peserta,
                        p.kelas,

                        SUM(a.status_kehadiran='hadir') AS hadir,
                        SUM(a.status_kehadiran='izin') AS izin,
                        SUM(a.status_kehadiran='sakit') AS sakit,
                        SUM(a.status_kehadiran='alpa') AS alpa

                        FROM peserta p

                        LEFT JOIN absensi a 
                        ON p.id_peserta=a.id_peserta

                        AND a.tanggal BETWEEN '$tglMulai'
                        AND '$tglSelesai'

                        WHERE p.status_peserta='aktif'
                        $where
                        GROUP BY p.id_peserta
                        ORDER BY p.nama_peserta

                        ");
                        $no=1;

                        while($d=mysqli_fetch_assoc($query)){


                        $total = $d['hadir']+$d['izin']+$d['sakit']+$d['alpa'];

                        $persen = ($total>0) ? round(($d['hadir']/$total)*100) : 0;


                        ?>

                        <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $d['nim'] ?></td>
                        <td><?= $d['nama_peserta'] ?></td>
                        <td><?= $d['kelas'] ?></td>
                        <td><?= $d['hadir'] ?></td>
                        <td><?= $d['izin'] ?></td>
                        <td><?= $d['sakit'] ?></td>
                        <td><?= $d['alpa'] ?></td>
                        <td>
                        <?= $persen ?>%
                        </td>
                        <td>
                        <?php
                        if($persen>=80){
                        echo "Baik";
                        }
                        elseif($persen>=60){
                        echo "Cukup";
                        }
                        else{
                        echo "Perlu perhatian";
                        }
                        ?>
                        </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

</div>
<script src="assets/js/main.js"></script>
<script src="assets/js/rekap.js"></script>
</body>
</html>