<?php
session_start();
include "koneksi.php";
?>
if(isset($_POST['simpan'])){

    $tanggal = $_POST['tanggal'];

    foreach($_POST['status'] as $id_peserta => $status){

        $keterangan = $_POST['keterangan'][$id_peserta];

        // cek apakah peserta sudah diabsen pada tanggal tersebut
        $cek = mysqli_query($conn,"
        SELECT *
        FROM absensi
        WHERE id_peserta='$id_peserta'
        AND tanggal='$tanggal'
        ");

        if(mysqli_num_rows($cek)==0){

            mysqli_query($conn,"
            INSERT INTO absensi
            (id_peserta,tanggal,status_kehadiran,keterangan)
            VALUES
            ('$id_peserta','$tanggal','$status','$keterangan')
            ");

        }

    }

    echo "<script>
    alert('Absensi berhasil disimpan');
    window.location='absensi.php';
    </script>";

}

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
                <form method="GET">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Tanggal Absensi</label>
                            <input 
                            type="date"
                            class="form-control"
                            name="tanggal"
                            value="<?= isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d'); ?>">
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Kelas</label>
                            <select class="form-select" name="kelas">

                            <option value="Unit 01"
                            <?= ($kelas=="Unit 01")?"selected":"";?>>
                            Unit 01
                            </option>

                            <option value="Unit 02"
                            <?= ($kelas=="Unit 02")?"selected":"";?>>
                            Unit 02
                            </option>

                            <option value="Unit 03"
                            <?= ($kelas=="Unit 03")?"selected":"";?>>
                            Unit 03
                            </option>

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
                                <tbody>

                                <?php

                                $kelas = isset($_GET['kelas']) ? $_GET['kelas'] : "Unit 01";


                                $no = 1;

                                $data = mysqli_query($conn,"
                                SELECT *
                                FROM peserta
                                WHERE kelas='$kelas'
                                ORDER BY nama_peserta ASC
                                ");

                                while($d = mysqli_fetch_assoc($data)){

                                ?>

                                <tr>

                                    <td><?= $no++; ?></td>
                                        <td><?= $d['nim']; ?></td>

                                    <td>
                                        <?= $d['nama_peserta']; ?>
                                    </td>

                                    <td>
                                        <select class="form-select" name="status[<?= $d['id_peserta']; ?>]">
                                            <option value="Hadir">Hadir</option>
                                            <option value="Izin">Izin</option>
                                            <option value="Sakit">Sakit</option>
                                            <option value="Alpa">Alpa</option>
                                        </select>
                                    </td>

                                    <td>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="keterangan[<?= $d['id_peserta']; ?>]"
                                            placeholder="Keterangan opsional">
                                    </td>

                                </tr>

                                <?php } ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-top d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-secondary">
                            Reset
                        </button>
                        <button 
                        type="submit"
                        name="simpan"
                        class="btn btn-primary">
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