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
                        <form action="#" method="post">
                            <div class="mb-3">
                                <label class="form-label">NIM</label>
                                <input type="text" class="form-control" placeholder="Contoh: 230101001">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Nama Peserta</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama lengkap">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Jenis Kelamin</label>
                                <select class="form-select">
                                    <option value="">Pilih jenis kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Kelas</label>
                                <input type="text" class="form-control" placeholder="Contoh: Unit 01">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Program Studi</label>
                                <input type="text" class="form-control" placeholder="Contoh: Pendidikan Teknologi Informasi">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">No. HP</label>
                                <input type="text" class="form-control" placeholder="Contoh: 081234567890">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <textarea class="form-control" rows="3" placeholder="Masukkan alamat"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
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
                        <span class="badge bg-primary rounded-pill">5 Peserta</span>
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
                                    <tr>
                                        <td>1</td>
                                        <td>230101001</td>
                                        <td>Ahmad Fauzi</td>
                                        <td>L</td>
                                        <td>Unit 01</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>2</td>
                                        <td>230101002</td>
                                        <td>Siti Rahmah</td>
                                        <td>P</td>
                                        <td>Unit 01</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>3</td>
                                        <td>230101003</td>
                                        <td>M. Ikhsan</td>
                                        <td>L</td>
                                        <td>Unit 01</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>4</td>
                                        <td>230101004</td>
                                        <td>Nur Aisyah</td>
                                        <td>P</td>
                                        <td>Unit 01</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>5</td>
                                        <td>230101005</td>
                                        <td>Rizky Maulana</td>
                                        <td>L</td>
                                        <td>Unit 01</td>
                                        <td><span class="badge bg-success">Aktif</span></td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-outline-primary">Edit</a>
                                            <a href="#" class="btn btn-sm btn-outline-danger">Hapus</a>
                                        </td>
                                    </tr>
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