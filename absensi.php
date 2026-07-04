<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Input Absensi | Sistem Informasi Absensi</title>

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
                <h2>Input Absensi</h2>
                <p>Input status kehadiran peserta berdasarkan tanggal dan kelas.</p>
            </div>
            <div class="user-pill">Administrator</div>
        </div>

        <div class="content-card mb-4">
            <div class="card-header">
                <h5>Filter Absensi</h5>
            </div>

            <div class="card-body">
                <form action="#" method="get">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Absensi</label>
                            <input type="date" class="form-control" value="2026-07-01">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Kelas</label>
                            <select class="form-select">
                                <option>Unit 01</option>
                                <option>Unit 02</option>
                                <option>Unit 03</option>
                            </select>
                        </div>

                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">
                                Tampilkan Peserta
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="content-card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Form Kehadiran Peserta</h5>
                <span class="badge bg-primary rounded-pill">Unit 01</span>
            </div>

            <div class="card-body p-0">
                <form action="#" method="post">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="60">No</th>
                                    <th>NIM</th>
                                    <th>Nama Peserta</th>
                                    <th width="180">Status Kehadiran</th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>230101001</td>
                                    <td>
                                        <span class="avatar">AF</span>
                                        Ahmad Fauzi
                                    </td>
                                    <td>
                                        <select class="form-select">
                                            <option value="hadir">Hadir</option>
                                            <option value="izin">Izin</option>
                                            <option value="sakit">Sakit</option>
                                            <option value="alpa">Alpa</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Keterangan opsional">
                                    </td>
                                </tr>

                                <tr>
                                    <td>2</td>
                                    <td>230101002</td>
                                    <td>
                                        <span class="avatar">SR</span>
                                        Siti Rahmah
                                    </td>
                                    <td>
                                        <select class="form-select">
                                            <option value="hadir">Hadir</option>
                                            <option value="izin">Izin</option>
                                            <option value="sakit">Sakit</option>
                                            <option value="alpa">Alpa</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Keterangan opsional">
                                    </td>
                                </tr>

                                <tr>
                                    <td>3</td>
                                    <td>230101003</td>
                                    <td>
                                        <span class="avatar">MI</span>
                                        M. Ikhsan
                                    </td>
                                    <td>
                                        <select class="form-select">
                                            <option value="hadir">Hadir</option>
                                            <option value="izin">Izin</option>
                                            <option value="sakit">Sakit</option>
                                            <option value="alpa">Alpa</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Keterangan opsional">
                                    </td>
                                </tr>

                                <tr>
                                    <td>4</td>
                                    <td>230101004</td>
                                    <td>
                                        <span class="avatar">NA</span>
                                        Nur Aisyah
                                    </td>
                                    <td>
                                        <select class="form-select">
                                            <option value="hadir">Hadir</option>
                                            <option value="izin">Izin</option>
                                            <option value="sakit">Sakit</option>
                                            <option value="alpa">Alpa</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Keterangan opsional">
                                    </td>
                                </tr>

                                <tr>
                                    <td>5</td>
                                    <td>230101005</td>
                                    <td>
                                        <span class="avatar">RM</span>
                                        Rizky Maulana
                                    </td>
                                    <td>
                                        <select class="form-select">
                                            <option value="hadir">Hadir</option>
                                            <option value="izin">Izin</option>
                                            <option value="sakit">Sakit</option>
                                            <option value="alpa">Alpa</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" placeholder="Keterangan opsional">
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-top d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-secondary">
                            Reset
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Simpan Absensi
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </main>

</div>

</body>
</html>