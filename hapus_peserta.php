<?php
require_once 'koneksi.php';

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM peserta WHERE id_peserta='$id'");

header("Location: peserta.php");
exit;
?>