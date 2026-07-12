<?php
require_once 'koneksi.php';

$pesan = '';

$kelasResult = mysqli_query($conn, "SELECT DISTINCT kelas FROM peserta WHERE status_peserta='aktif' ORDER BY kelas");
$kelasList = [];
while ($row = mysqli_fetch_assoc($kelasResult)) {
    $kelasList[] = $row['kelas'];
}

$tanggalFilter = isset($_GET['tanggal']) ? $_GET['tanggal'] : date('Y-m-d');
$kelasFilter = isset($_GET['kelas']) ? $_GET['kelas'] : (count($kelasList) > 0 ? $kelasList[0] : '');
$pesertaList = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['simpan'])) {
    $tanggal = mysqli_real_escape_string($conn, $_POST['tanggal']);
    $pesertaIds = $_POST['id_peserta'] ?? [];
    $statusKehadiran = $_POST['status_kehadiran'] ?? [];
    $keterangan = $_POST['keterangan'] ?? [];

    foreach ($pesertaIds as $index => $idPeserta) {
        $idPeserta = intval($idPeserta);
        $status = mysqli_real_escape_string($conn, $statusKehadiran[$index] ?? 'alpa');
        $ket = mysqli_real_escape_string($conn, $keterangan[$index] ?? '');

        $checkQuery = "SELECT id_absensi FROM absensi WHERE id_peserta = $idPeserta AND tanggal = '$tanggal'";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) > 0) {
            $row = mysqli_fetch_assoc($checkResult);
            $idAbsensi = intval($row['id_absensi']);
            mysqli_query($conn, "UPDATE absensi SET status_kehadiran = '$status', keterangan = '$ket' WHERE id_absensi = $idAbsensi");
        } else {
            mysqli_query($conn, "INSERT INTO absensi (id_peserta, tanggal, status_kehadiran, keterangan, created_by) 
                VALUES ($idPeserta, '$tanggal', '$status', '$ket', 1)");
        }
    }

    $pesan = '✓ Absensi berhasil disimpan.';
}

if ($kelasFilter) {
    $kelasFilterEscaped = mysqli_real_escape_string($conn, $kelasFilter);
    $query = "SELECT p.id_peserta, p.nim, p.nama_peserta, p.jenis_kelamin, 
                     a.status_kehadiran, a.keterangan 
              FROM peserta p 
              LEFT JOIN absensi a ON p.id_peserta = a.id_peserta AND a.tanggal = '$tanggalFilter' 
              WHERE p.kelas = '$kelasFilterEscaped' AND p.status_peserta = 'aktif' 
              ORDER BY p.nama_peserta";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $pesertaList[] = $row;
    }
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
                <small>Panel Administrator</small>
            </div>
        </div>

        <div class="menu-label">Menu Utama</div>
        <ul class="nav-menu">
            <li><a href="dashboard.php">🏠 Dashboard</a></li>
            <li><a href="peserta.php">👥 Data Peserta</a></li>
            <li><a href="absensi.php" class="active">📝 Input Absensi</a></li>
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

        <?php if ($pesan): ?>
            <div class="alert alert-succes alert-dismissible fade show" role="alert">
                <?=$pesan ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"><button>
            </div>
        <?php endif; ?>

        <div class="content-card mb-4">
            <div class="card-header"><h5>Filter Absensi<h5></div>
            <div class="card-body">
                <form action="absensi.php" method="get" class="row g-3 align-items-end">
                    <div class="col-md-4">
                        <label class="form-label">Tanggal Absensi</label>
                        <input type="date" name="tanggal" class="form-control" value="<?= htmlspecialchars($tanggalFilter) ?>" required>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label">Kelas</label>
                        <select name="kelas" class="form-select" required>
                            <option value="">-- Pilih Kelas --</option>
                            <?php foreach ($kelasList as $kelas): ?>
                                <option value="<?= htmlspecialchars($kelas) ?>" <?= ($kelasFilter === $kelas) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($kelas) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-4 d-grid">
                        <button type="submit" class="btn btn-primary">Tampilkan Peserta</button>
                    </div>
                </form>
            </div>
        </div>

        <?php if ($kelasFilter && count($pesertaList) > 0): ?>
            <div class="content-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Form Kehadiran Peserta</h5>
                    <span class="badge bg-primary rounded-pill"><?= htmlspecialchars($kelasFilter) ?> (<?= count($pesertaList) ?> peserta)</span>
                </div>
                <div class="card-body p-0">
                    <form action="absensi.php" method="post">
                        <input type="hidden" name="tanggal" value="<?= htmlspecialchars($tanggalFilter) ?>">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="60">No</th>
                                        <th>NIM</th>
                                        <th>Nama Peserta</th>
                                        <th width="180">Status Kehadiran</th>
                                        <th>Keterangan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; foreach ($pesertaList as $peserta): ?>
                                        <tr>
                                            <td class="fw-bold"><?= $no++ ?></td>
                                            <td><?= htmlspecialchars($peserta['nim']) ?></td>
                                            <td>
                                                <strong><?= htmlspecialchars($peserta['nama_peserta']) ?></strong><br>
                                                <small class="text-muted"><?= $peserta['jenis_kelamin'] === 'L' ? 'Laki-laki' : 'Perempuan' ?></small>
                                            </td>
                                            <td>
                                                <select name="status_kehadiran[]" class="form-select form-select-sm" required>
                                                    <option value="hadir" <?= ($peserta['status_kehadiran'] === 'hadir') ? 'selected' : '' ?>>Hadir</option>
                                                    <option value="izin" <?= ($peserta['status_kehadiran'] === 'izin') ? 'selected' : '' ?>>Izin</option>
                                                    <option value="sakit" <?= ($peserta['status_kehadiran'] === 'sakit') ? 'selected' : '' ?>>Sakit</option>
                                                    <option value="alpa" <?= ($peserta['status_kehadiran'] === 'alpa' || !$peserta['status_kehadiran']) ? 'selected' : '' ?>>Alpa</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="hidden" name="id_peserta[]" value="<?= intval($peserta['id_peserta']) ?>">
                                                <input type="text" name="keterangan[]" class="form-control form-control-sm" value="<?= htmlspecialchars($peserta['keterangan'] ?? '') ?>" placeholder="Keterangan opsional">
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer bg-light d-flex justify-content-end gap-2">
                            <a href="absensi.php" class="btn btn-secondary">Reset</a>
                            <button type="submit" name="simpan" class="btn btn-success">Simpan Absensi</button>
                        </div>
                    </form>
                </div>
            </div>
        <?php elseif ($kelasFilter): ?>
            <div class="content-card">
                <div class="alert alert-info mb-0">
                    Tidak ada peserta aktif di kelas <strong><?= htmlspecialchars($kelasFilter) ?></strong>.
                </div>
            </div>
        <?php endif; ?>
    </main>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<style>
    .fw-bold { font-weight: 600; }
</style>
</body>
</html>

           