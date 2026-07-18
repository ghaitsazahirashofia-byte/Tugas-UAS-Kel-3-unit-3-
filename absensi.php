<?php
session_start();

if(!isset($_SESSION['id_user'])){
    header("Location: index.php");
    exit;
}

include "koneksi.php";

$nama = $_SESSION['nama_lengkap'];
$role = $_SESSION['role'];

$halaman="absensi";

$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';

// PROSES SIMPAN ABSENSI
if(isset($_POST['simpan'])){

    $tanggal = $_POST['tanggal'];
    foreach($_POST['status'] as $id_peserta => $status){

        $keterangan = $_POST['keterangan'][$id_peserta];
        $status = mysqli_real_escape_string($conn,$status);
        $keterangan = mysqli_real_escape_string($conn,$keterangan);


        // cek apakah sudah ada absensi
        $cek = mysqli_query($conn,"
            SELECT * FROM absensi
            WHERE id_peserta='$id_peserta'
            AND tanggal='$tanggal'
        ");


        if(mysqli_num_rows($cek) > 0){

            mysqli_query($conn,"
            UPDATE absensi SET
            status_kehadiran='$status',
            keterangan='$keterangan'
            WHERE id_peserta='$id_peserta'
            AND tanggal='$tanggal'
            ");

        }else{

            mysqli_query($conn,"
            INSERT INTO absensi
            (id_peserta,tanggal,status_kehadiran,keterangan)
            VALUES
            ('$id_peserta','$tanggal','$status','$keterangan')
            ");

        }

    }


    echo "
    <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>

    <script>

    Swal.fire({
        icon:'success',
        title:'Berhasil!',
        text:'Absensi berhasil disimpan.'
    }).then(function(){

    window.location='absensi.php?kelas=$kelas&tanggal=$tanggal';

    });

    </script>
    ";

}

?>

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
                <small>
                Panel <?= ucfirst($role); ?>
                </small>
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
            <a href="peserta.php"
            class="<?= ($halaman=='peserta')?'active':'' ?>">
                👥 Data Peserta
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
        <h2>Input Absensi</h2>
        <p>Input status kehadiran peserta berdasarkan tanggal dan kelas.</p>
    </div>

    <div class="user-pill">
        <?= $nama; ?> (<?= ucfirst($role); ?>)
    </div>

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
                            <option value="">-- Pilih Unit --</option>

                            <?php
                            $kelasQuery = mysqli_query($conn, 
                            "SELECT DISTINCT kelas FROM peserta 
                            WHERE status_peserta='aktif'");

                            while($k = mysqli_fetch_assoc($kelasQuery)){
                            ?>

                            <option value="<?= $k['kelas']; ?>"
                            <?= ($kelas == $k['kelas']) ? 'selected' : ''; ?>>
                            <?= $k['kelas']; ?>
                            </option>

                            <?php } ?>

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
                <span class="badge bg-primary rounded-pill">
                <?= $kelas ? $kelas : 'Belum dipilih'; ?>
                </span>
            </div>

            <div class="card-body p-0">
                <form action="absensi.php" method="post">
                    <input type="hidden" name="tanggal" value="<?= $tanggal ?>">
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

                            <?php if ($kelas == "") { ?>

                                <tr>
                                    <td colspan="5" class="text-center py-4">
                                        Silakan pilih unit terlebih dahulu.
                                    </td>
                                </tr>

                            <?php } else {

                                $no = 1;

                                $data = mysqli_query($conn, "
                                    SELECT * FROM peserta
                                    WHERE kelas='$kelas'
                                    AND status_peserta='aktif'
                                ");

                                while ($d = mysqli_fetch_assoc($data)) {

                                    $cekAbsen = mysqli_query($conn, "
                                        SELECT * FROM absensi
                                        WHERE id_peserta='".$d['id_peserta']."'
                                        AND tanggal='$tanggal'
                                    ");

                                    $absen = mysqli_fetch_assoc($cekAbsen);

                                    $statusAbsen = $absen['status_kehadiran'] ?? 'hadir';

                                    $ket = $absen['keterangan'] ?? '';
                            ?>

                                <tr>

                                    <td><?= $no++; ?></td>
                                    <td><?= $d['nim']; ?></td>

                                    <td><?= $d['nama_peserta']; ?></td>

                                    <td>
                                        <select class="form-select"
                                            name="status[<?= $d['id_peserta']; ?>]">

                                            <option value="hadir"
                                                <?= ($statusAbsen == 'hadir') ? 'selected' : ''; ?>>
                                                Hadir
                                            </option>

                                            <option value="izin"
                                                <?= ($statusAbsen == 'izin') ? 'selected' : ''; ?>>
                                                Izin
                                            </option>

                                            <option value="sakit"
                                                <?= ($statusAbsen == 'sakit') ? 'selected' : ''; ?>>
                                                Sakit
                                            </option>

                                            <option value="alpa"
                                                <?= ($statusAbsen == 'alpa') ? 'selected' : ''; ?>>
                                                Alpa
                                            </option>

                                        </select>
                                    </td>

                                    <td>
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="keterangan[<?= $d['id_peserta']; ?>]"
                                            value="<?= $ket; ?>"
                                            placeholder="Keterangan opsional">
                                    </td>

                                </tr>

                            <?php }

                            } ?>

                        </tbody>
                        </table>
                    </div>

                    <div class="p-4 border-top d-flex justify-content-end gap-2">
                        <button type="reset" class="btn btn-outline-secondary">
                            Reset
                        </button>

                        <?php if ($kelas != "") { ?>

                        <button type="submit" name="simpan" class="btn btn-primary">
                            Simpan Absensi
                        </button>

                        <?php } ?>
                    </div>
                </form>
            </div>
        </div>

    </main>

</div>
<script src="assets/js/main.js"></script>
<script src="assets/js/absensi.js"></script>
</body>
</html>