<?php

include "koneksi.php";

$tglMulai = $_GET['mulai'];
$tglSelesai = $_GET['selesai'];
$kelas = $_GET['kelas'];

$where = "";

if ($kelas != "") {
    $where = "AND p.kelas='$kelas'";
}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Cetak Rekap</title>

    <style>

        body{
            font-family: Arial;
            padding: 20px;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        table, th, td{
            border:1px solid black;
        }

        th, td{
            padding:8px;
            text-align:center;
        }

        h2{
            text-align:center;
        }

        .btn{
            display: inline-block;
            padding: 10px 15px;
            background: #6c757d;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 15px;
        }

    </style>

</head>

<body>

<h2>Rekap Kehadiran</h2>

<p>
    Periode:
    <?= date('d-m-Y', strtotime($tglMulai)) ?>
    s/d
    <?= date('d-m-Y', strtotime($tglSelesai)) ?>
</p>

<a
    href="rekap.php?mulai=<?= $tglMulai ?>&selesai=<?= $tglSelesai ?>&kelas=<?= $kelas ?>"
    class="btn">
    ← Kembali
</a>

<button onclick="window.print()" class="btn">
    🖨 Cetak
</button>

<table>

    <tr>
        <th>No</th>
        <th>NIM</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Hadir</th>
        <th>Izin</th>
        <th>Sakit</th>
        <th>Alpa</th>
        <th>Persentase</th>
    </tr>

    <?php

    $no = 1;

    $query = mysqli_query($conn, "

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
        ON p.id_peserta = a.id_peserta

        AND a.tanggal BETWEEN '$tglMulai'
        AND '$tglSelesai'

        WHERE p.status_peserta='aktif'

        $where

        GROUP BY p.id_peserta

        ORDER BY p.nama_peserta

    ");

    while($d = mysqli_fetch_assoc($query)){

        $total =
            $d['hadir'] +
            $d['izin'] +
            $d['sakit'] +
            $d['alpa'];

        $persen = ($total > 0)
            ? round(($d['hadir'] / $total) * 100)
            : 0;

    ?>

    <tr>

        <td><?= $no++; ?></td>

        <td><?= $d['nim']; ?></td>

        <td><?= $d['nama_peserta']; ?></td>

        <td><?= $d['kelas']; ?></td>

        <td><?= $d['hadir']; ?></td>

        <td><?= $d['izin']; ?></td>

        <td><?= $d['sakit']; ?></td>

        <td><?= $d['alpa']; ?></td>

        <td><?= $persen; ?>%</td>

    </tr>

    <?php } ?>

</table>

</body>
</html>