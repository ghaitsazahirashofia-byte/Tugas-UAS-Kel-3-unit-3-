<?php
session_start();
include "koneksi.php";

if (isset($_POST['login'])) {

    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM users
        WHERE username='$username'
        AND password_hash='$password'
        AND status='aktif'");

    if (mysqli_num_rows($query) > 0) {

        $user = mysqli_fetch_assoc($query);

        $_SESSION['id_user'] = $user['id_user'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['role'] = $user['role'];

        header("Location: dashboard.php");
        exit;

    } else {
        $error = "Username atau Password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sistem Informasi Absensi</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body class="login-page">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-9">

            <div class="card login-card">
                <div class="row g-0">

                    <div class="col-md-6">
                        <div class="login-brand">
                            <div class="brand-icon">✓</div>
                            <h1>Sistem Informasi Absensi</h1>
                        </div>
                    </div>

                    <div class="col-md-6">

                        <div class="login-form">

                            <h3 class="fw-bold mb-2">Masuk Aplikasi</h3>

                            <p class="text-muted mb-4">
                                Silakan login menggunakan akun yang terdaftar.
                            </p>

                            <?php if(isset($error)){ ?>
                                <div class="alert alert-danger">
                                    <?= $error ?>
                                </div>
                            <?php } ?>

                            <form method="POST">

                                <div class="mb-3">
                                    <label class="form-label">Username</label>

                                    <input
                                        type="text"
                                        name="username"
                                        class="form-control"
                                        placeholder="Masukkan username"
                                        required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Password</label>

                                    <input
                                        type="password"
                                        name="password"
                                        class="form-control"
                                        placeholder="Masukkan password"
                                        required>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-4">

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remember">

                                        <label class="form-check-label" for="remember">
                                            Ingat saya
                                        </label>
                                    </div>

                                    <a href="#">Lupa password?</a>

                                </div>

                                <button
                                    type="submit"
                                    name="login"
                                    class="btn btn-primary w-100">

                                    Login

                                </button>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>