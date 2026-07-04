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
                            <input type="date" class="form-control" value="2026-07-01">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Tanggal Selesai</label>
                            <input type="date" class="form-control" value="2026-07-31">
                        </div>

                        <div class="col-md-3">
                            <label class="form-label">Kelas</label>
                            <select class="form-select">
                                <option>Semua Kelas</option>
                                <option>Unit 01</option>
                                <option>Unit 02</option>
                                <option>Unit 03</option>
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
                    <h3>80</h3>
                    <p>Total Hadir</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-primary">i</div>
                    <h3>8</h3>
                    <p>Total Izin</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-warning">+</div>
                    <h3>5</h3>
                    <p>Total Sakit</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="stat-card">
                    <div class="stat-icon bg-soft-danger">×</div>
                    <h3>7</h3>
                    <p>Total Alpa</p>
                </div>
            </div>
        </div>

        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Tabel Rekap Kehadiran</h5>
                <a href="#" class="btn btn-sm btn-outline-primary">Cetak Rekap</a>
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
                            <tr>
                                <td>1</td>
                                <td>230101001</td>
                                <td>Ahmad Fauzi</td>
                                <td>Unit 01</td>
                                <td><span class="badge-status badge-hadir">12</span></td>
                                <td><span class="badge-status badge-izin">1</span></td>
                                <td><span class="badge-status badge-sakit">0</span></td>
                                <td><span class="badge-status badge-alpa">0</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar bg-success" style="width: 92%"></div>
                                        </div>
                                        <span class="fw-bold">92%</span>
                                    </div>
                                </td>
                                <td>Baik</td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>230101002</td>
                                <td>Siti Rahmah</td>
                                <td>Unit 01</td>
                                <td><span class="badge-status badge-hadir">10</span></td>
                                <td><span class="badge-status badge-izin">2</span></td>
                                <td><span class="badge-status badge-sakit">1</span></td>
                                <td><span class="badge-status badge-alpa">0</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar bg-success" style="width: 77%"></div>
                                        </div>
                                        <span class="fw-bold">77%</span>
                                    </div>
                                </td>
                                <td>Cukup</td>
                            </tr>

                            <tr>
                                <td>3</td>
                                <td>230101003</td>
                                <td>M. Ikhsan</td>
                                <td>Unit 01</td>
                                <td><span class="badge-status badge-hadir">9</span></td>
                                <td><span class="badge-status badge-izin">1</span></td>
                                <td><span class="badge-status badge-sakit">1</span></td>
                                <td><span class="badge-status badge-alpa">2</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar bg-warning" style="width: 69%"></div>
                                        </div>
                                        <span class="fw-bold">69%</span>
                                    </div>
                                </td>
                                <td>Perlu perhatian</td>
                            </tr>

                            <tr>
                                <td>4</td>
                                <td>230101004</td>
                                <td>Nur Aisyah</td>
                                <td>Unit 01</td>
                                <td><span class="badge-status badge-hadir">12</span></td>
                                <td><span class="badge-status badge-izin">0</span></td>
                                <td><span class="badge-status badge-sakit">1</span></td>
                                <td><span class="badge-status badge-alpa">0</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar bg-success" style="width: 92%"></div>
                                        </div>
                                        <span class="fw-bold">92%</span>
                                    </div>
                                </td>
                                <td>Baik</td>
                            </tr>

                            <tr>
                                <td>5</td>
                                <td>230101005</td>
                                <td>Rizky Maulana</td>
                                <td>Unit 01</td>
                                <td><span class="badge-status badge-hadir">8</span></td>
                                <td><span class="badge-status badge-izin">2</span></td>
                                <td><span class="badge-status badge-sakit">1</span></td>
                                <td><span class="badge-status badge-alpa">2</span></td>
                                <td>
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1">
                                            <div class="progress-bar bg-danger" style="width: 62%"></div>
                                        </div>
                                        <span class="fw-bold">62%</span>
                                    </div>
                                </td>
                                <td>Perlu pembinaan</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </main>

</div>

</body>
</html>