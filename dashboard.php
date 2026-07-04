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
                <small>Panel Administrator</small>
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
            <li><a href="#">🚪 Logout</a></li>
        </ul>
    </aside>

    <main class="main-content">
        <div class="topbar">
            <div>
                <h2>Dashboard Absensi</h2>
                <p>Ringkasan data kehadiran peserta hari ini.</p>
            </div>
            <div class="user-pill">Administrator</div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-primary">👥</div>
                    <h3>32</h3>
                    <p>Total Peserta</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-success">✓</div>
                    <h3>25</h3>
                    <p>Hadir Hari Ini</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-warning">!</div>
                    <h3>4</h3>
                    <p>Izin dan Sakit</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-danger">×</div>
                    <h3>3</h3>
                    <p>Alpa</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="content-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5>Absensi Terbaru</h5>
                        <a href="absensi.html" class="btn btn-sm btn-primary">Input Absensi</a>
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
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <span class="avatar">AF</span>
                                            Ahmad Fauzi
                                        </td>
                                        <td>Unit 01</td>
                                        <td>01 Juli 2026</td>
                                        <td><span class="badge-status badge-hadir">Hadir</span></td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>
                                            <span class="avatar">SR</span>
                                            Siti Rahmah
                                        </td>
                                        <td>Unit 01</td>
                                        <td>01 Juli 2026</td>
                                        <td><span class="badge-status badge-izin">Izin</span></td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>
                                            <span class="avatar">MI</span>
                                            M. Ikhsan
                                        </td>
                                        <td>Unit 01</td>
                                        <td>01 Juli 2026</td>
                                        <td><span class="badge-status badge-sakit">Sakit</span></td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>
                                            <span class="avatar">RM</span>
                                            Rizky Maulana
                                        </td>
                                        <td>Unit 01</td>
                                        <td>01 Juli 2026</td>
                                        <td><span class="badge-status badge-alpa">Alpa</span></td>
                                    </tr>
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
                                <div class="progress-bar bg-success" style="width: 78%"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Izin</span>
                                <span>10%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-info" style="width: 10%"></div>
                            </div>
                        </div>

                        <div class="mb-4">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Sakit</span>
                                <span>6%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" style="width: 6%"></div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="fw-bold">Alpa</span>
                                <span>6%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-danger" style="width: 6%"></div>
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