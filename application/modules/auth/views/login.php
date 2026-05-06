<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login - Sistem Kuangan RSPA</title>

<link rel="stylesheet" href="<?= base_url('assets/template/') ?>/dist/css/adminlte.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<style>
body {
    background: linear-gradient(135deg, #4e73df, #1cc88a);
}

.login-box {
    margin-top: 5%;
}

.card {
    border-radius: 15px;
    backdrop-filter: blur(10px);
    background: rgba(255,255,255,0.95);
}

.logo-desa {
    width: 80px;
}

.input-group-text {
    background: #4e73df;
    color: white;
}

.btn-primary {
    background: #4e73df;
    border: none;
}

.btn-primary:hover {
    background: #2e59d9;
}

.footer-login {
    margin-top: 15px;
    color: white;
}
</style>

</head>

<body class="login-page">

<div class="login-box">

    <!-- LOGO -->
    <div class="text-center mb-3">
        <img src="<?= base_url('assets/logo.png') ?>" class="logo-desa">
        <h4 class="mt-2 text-white fw-bold">
            <?= $setting->nama_app ?? 'Desa Pintar' ?>
        </h4>
        <small class="text-light">Sistem Informasi Keuangan</small>
    </div>

    <!-- CARD -->
    <div class="card shadow-lg">
        <div class="card-body login-card-body">

            <p class="login-box-msg fw-bold">Silakan Login</p>

            <!-- ALERT ERROR -->
            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger">
                    <?= $this->session->flashdata('error'); ?>
                </div>
            <?php endif; ?>

            <form action="<?= base_url('auth/login') ?>" method="post">

                <div class="input-group mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                    <div class="input-group-text">
                        <i class="bi bi-person"></i>
                    </div>
                </div>

                <div class="input-group mb-3">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <div class="input-group-text" onclick="togglePassword()" style="cursor:pointer;">
                        <i class="bi bi-eye" id="iconPass"></i>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox">
                            <label class="form-check-label">Remember</label>
                        </div>
                    </div>
                    <div class="col-6 text-end">
                        <a href="#">Lupa Password?</a>
                    </div>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary fw-bold">
                        🔐 Masuk
                    </button>
                </div>

            </form>

        </div>
    </div>

    <!-- FOOTER -->
    <div class="text-center footer-login">
        <small>© <?= date('Y') ?> <?= $setting->nama_app ?? 'Desa Pintar' ?></small>
    </div>

</div>

<script src="<?= base_url('assets/template/') ?>/dist/js/adminlte.js"></script>

<script>
function togglePassword() {
    let pass = document.getElementById("password");
    let icon = document.getElementById("iconPass");

    if (pass.type === "password") {
        pass.type = "text";
        icon.classList.remove("bi-eye");
        icon.classList.add("bi-eye-slash");
    } else {
        pass.type = "password";
        icon.classList.remove("bi-eye-slash");
        icon.classList.add("bi-eye");
    }
}
</script>

<?php if ($this->session->flashdata('auth_error')): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: '<?= $this->session->flashdata('auth_error') ?>'
});
</script>
<?php endif; ?>

</body>
</html>