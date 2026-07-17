<?php
session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: index.php");
    exit;
}

include "koneksi.php";

$nama = $_SESSION['nama_lengkap'];
$role = $_SESSION['role'];

$totalPeserta = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM peserta")
);

$hadir = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM absensi
    WHERE status_kehadiran='hadir'")
);

$izinSakit = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM absensi
    WHERE status_kehadiran IN ('izin','sakit')")
);

$alpa = mysqli_fetch_assoc(
    mysqli_query($conn,"SELECT COUNT(*) AS total FROM absensi
    WHERE status_kehadiran='alpa'")
);
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
                <small>Panel <?= ucfirst($role); ?></small>
            </div>

        </div>

        <div class="menu-label">Menu Utama</div>

        <ul class="nav-menu">
            <li><a href="dashboard.php" class="active">🏠 Dashboard</a></li>
            <li><a href="peserta.php">👥 Data Peserta</a></li>
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
                <h2>Dashboard Absensi</h2>
                <p>Ringkasan data kehadiran peserta hari ini.</p>
            </div>

            <div class="user-pill">
                <?= $nama; ?> (<?= ucfirst($role); ?>)
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

                    <h3><?= $hadir['total']; ?></h3>

                    <p>Hadir Hari Ini</p>

                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">

                    <div class="stat-icon bg-soft-warning">!</div>

                    <h3><?= $izinSakit['total']; ?></h3>

                    <p>Izin dan Sakit</p>

                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">

                    <div class="stat-icon bg-soft-danger">×</div>

                    <h3><?= $alpa['total']; ?></h3>

                    <p>Alpa</p>

                </div>
            </div>

        </div>


        <div class="row g-4">

            <div class="col-lg-8">

                <div class="content-card">

                    <div class="card-header d-flex justify-content-between align-items-center">

                        <h5>Absensi Terbaru</h5>

                        <a href="absensi.php" class="btn btn-sm btn-primary">
                            Input Absensi
                        </a>

                    </div>

                    <div class="card-body p-0">

                        <div class="table-responsive">

                            <table class="table">

                                <thead>

                                <tr>
                                    <th>No</th>
                                    <th>Peserta</th>
                                    <th>Kelas</th>
                                    <th>Tanggal</th>
                                    <th>Status</th>
                                </tr>

                                </thead>

                                <tbody>

                                <?php

                                $no = 1;

                                $data = mysqli_query($conn,"
                                SELECT
                                absensi.*,
                                peserta.nama_peserta,
                                peserta.kelas
                                FROM absensi
                                JOIN peserta
                                ON peserta.id_peserta=absensi.id_peserta
                                ORDER BY tanggal DESC
                                LIMIT 10
                                ");

                                while($d=mysqli_fetch_assoc($data)){
                                ?>

                                <tr>

                                    <td><?= $no++; ?></td>

                                    <td><?= $d['nama_peserta']; ?></td>

                                    <td><?= $d['kelas']; ?></td>

                                    <td><?= date('d-m-Y',strtotime($d['tanggal'])); ?></td>

                                    <td><?= ucfirst($d['status_kehadiran']); ?></td>

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
                        <h5>Persentase Kehadiran</h5>
                    </div>

                    <div class="card-body">

                        <div class="mb-4">

                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Hadir</span>
                                <span>78%</span>
                            </div>

                            <div class="progress">
                                <div class="progress-bar bg-success" style="width:78%"></div>
                            </div>

                        </div>

                        <div class="mb-4">

                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Izin</span>
                                <span>10%</span>
                            </div>

                            <div class="progress">
                                <div class="progress-bar bg-info" style="width:10%"></div>
                            </div>

                        </div>

                        <div class="mb-4">

                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Sakit</span>
                                <span>6%</span>
                            </div>

                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width:6%"></div>
                            </div>

                        </div>

                        <div>

                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Alpa</span>
                                <span>6%</span>
                            </div>

                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width:6%"></div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </main>

</div>

</body>
</html>