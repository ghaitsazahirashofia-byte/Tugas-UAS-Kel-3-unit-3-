<?php
session_start();
include "koneksi.php";
$halaman = "dashboard";

if (!isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit;
}

$role = $_SESSION['role'];
$nama_role = ($role == "admin") ? "Administrator" : "Operator Absensi";
$tanggalHariIni = date('Y-m-d');


// =======================
// TOTAL DATA HARI INI
// =======================

// Total peserta aktif
$totalPeserta = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM peserta
WHERE status_peserta='aktif'
"));


// Total hadir hari ini
$totalHadir = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM absensi
WHERE tanggal='$tanggalHariIni'
AND status_kehadiran='hadir'
"));


// Total izin dan sakit hari ini
$totalIzinSakit = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM absensi
WHERE tanggal='$tanggalHariIni'
AND status_kehadiran IN ('izin','sakit')
"));


// Total alpa hari ini
$totalAlpa = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM absensi
WHERE tanggal='$tanggalHariIni'
AND status_kehadiran='alpa'
"));



// =======================
// PERSENTASE KEHADIRAN
// =======================

$hadirPersen = 0;
$izinPersen  = 0;
$sakitPersen = 0;
$alpaPersen  = 0;


// Total izin
$izin = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM absensi
WHERE tanggal='$tanggalHariIni'
AND status_kehadiran='izin'
"));


// Total sakit
$sakit = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) AS total
FROM absensi
WHERE tanggal='$tanggalHariIni'
AND status_kehadiran='sakit'
"));


// Hadir dan Alpa memakai data yang sudah dibuat
$hadir = $totalHadir;
$alpa  = $totalAlpa;


// Total diambil dari jumlah peserta aktif
$total = $totalPeserta['total'];


if($total > 0){

    $hadirPersen = round(($hadir['total']/$total) * 100);
    $izinPersen  = round(($izin['total']/$total) * 100);
    $sakitPersen = round(($sakit['total']/$total) * 100);
    $alpaPersen  = round(($alpa['total']/$total) * 100);

}

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Sistem Informasi Absensi</title>

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
                <small><?= $nama_role; ?></small>
            </div>
        </div>

        <div class="menu-label">Menu Utama</div>
        <ul class="nav-menu">

        <li>
            <a href="dashboard.php" class="<?= ($halaman=='dashboard')?'active':'' ?>">🏠 Dashboard
            </a>
        </li>

        <?php if ($role == "admin") { ?>
        <li>
            <a href="peserta.php" class="<?= ($halaman=='peserta')?'active':'' ?>">👥 Data Peserta
            </a>
        </li>
        <?php } ?>

        <li>
            <a href="absensi.php" class="<?= ($halaman=='absensi')?'active':'' ?>">📝 Input Absensi
            </a>
        </li>

        <li>
            <a href="rekap.php" class="<?= ($halaman=='rekap')?'active':'' ?>">📊 Rekap Kehadiran
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
                <h2>Dashboard Absensi</h2>
                <p>Ringkasan data kehadiran peserta hari ini.</p>
            </div>
            <div class="user-pill">
                <?= $nama_role; ?>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-primary">👥</div>
                    <h3><?= $totalPeserta['total']; ?></h3>
                    <p>Total Peserta</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-success">✓</div>
                    <h3><?= $totalHadir['total']; ?></h3>
                    <p>Hadir Hari Ini</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-warning">!</div>
                    <h3><?= $totalIzinSakit['total']; ?></h3>
                    <p>Izin dan Sakit</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-danger">×</div>
                    <h3><?= $totalAlpa['total']; ?></h3>
                    <p>Alpa</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="content-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Absensi Terbaru</h5>
                        <a href="absensi.php" class="btn btn-sm btn-primary">Input Absensi</a>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Peserta</th>
                                        <th>Unit</th>
                                        <th>Tanggal</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php

                                $queryTerbaru = mysqli_query($conn, "

                                SELECT
                                    p.nama_peserta,
                                    p.kelas,
                                    a.tanggal,
                                    a.status_kehadiran

                                FROM absensi a

                                JOIN peserta p
                                ON a.id_peserta = p.id_peserta

                                WHERE a.tanggal = '$tanggalHariIni'

                                ORDER BY a.id_absensi DESC

                                ");
                                $no = 1;
                                while($d = mysqli_fetch_assoc($queryTerbaru)){
                                ?>
                                <tr>
                                 <td><?= $no++; ?></td>
                                <td>
                                    <span class="avatar">
                                        <?= strtoupper(substr($d['nama_peserta'],0,2)); ?>
                                    </span>
                                    <?= $d['nama_peserta']; ?>
                                </td>

                                <td>
                                    <?= $d['kelas']; ?>
                                </td>

                                <td>
                                    <?= date('d F Y', strtotime($d['tanggal'])); ?>
                                </td>

                                <td>
                                <?php
                                $status = $d['status_kehadiran'];
                                if($status == "hadir"){

                                echo '<span class="badge-status badge-hadir">
                                Hadir
                                </span>';

                                }

                                elseif($status == "izin"){
                                echo '<span class="badge-status badge-izin">
                                Izin
                                </span>';
                                }

                                elseif($status == "sakit"){
                                echo '<span class="badge-status badge-sakit">
                                Sakit
                                </span>';

                                }

                                else{
                                echo '<span class="badge-status badge-alpa">
                                Alpa
                                </span>';

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
            </div>

            <div class="col-lg-4">
                <div class="content-card">
                    <div class="card-header">
                        <h5>Persentase Kehadiran Hari Ini</h5>
                        <small><?= date('d F Y', strtotime($tanggalHariIni)); ?></small>
                    </div>

                    <div class="card-body">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Hadir</span>
                                <span><?= $hadirPersen ?>%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-success" 
                                style="width: <?= $hadirPersen ?>%">
                                </div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Izin</span>
                                <span><?= $izinPersen ?>%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-info" style="width: <?= $izinPersen ?>%"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Sakit</span>
                                <span><?= $sakitPersen ?>%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width: <?= $sakitPersen ?>%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Alpa</span>
                                <span><?= $alpaPersen ?>%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: <?= $alpaPersen ?>%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

</div>
<script src="assets/js/main.js"></script>
<script src="assets/js/dashboard.js"></script>

</body>
</html>