<?= $this->extend('layout/default') ?>
<?= $this->section('content') ?>
<style>
    body, #app {
        background: #fff !important;
    }
    .login-brand img {
        width: 100%;
        max-width: 100%;
        height: auto;
        display: block;
        margin: 0 auto;
    }
    .login-brand {
        margin-bottom: 20px;
    }
    @media (max-width: 576px) {
        .login-brand img {
            width: 100%;
        }
    }
</style>
<div id="app">
    <section class="section">
        <div class="container mt-5">
            <div class="row">
                <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                    <div class="login-brand">
                        <img src="assets/img/logo/Pertamina-Logo.wine.png" alt="logo">
                    </div>

                    <div class="card card-primary">
                        <div class="card-body">
                            <form method="POST" action="<?= base_url('login') ?>" class="needs-validation" novalidate="">
                                <?= csrf_field(); ?>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        </div>
                                        <input id="email" type="text" class="form-control" name="u_username" tabindex="1" required autofocus placeholder="Username">
                                        <div class="invalid-feedback">
                                            Mohon Untuk Memasukan Username!
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="fas fa-lock"></i>
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="u_password" tabindex="2" required placeholder="Password">
                                        <div class="invalid-feedback">
                                            Mohon Untuk Memasukan Password!
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-success btn-lg btn-block" tabindex="3">
                                        Login
                                    </button>
                                </div>
                            </form>
                            <div class="text-center mt-3">
                                <a href="auth-forgot-password.html" class="text-small">
                                    Lupa Password?
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="simple-footer text-center" style="position: fixed; bottom: 0; left: 0; width: 100%; background: #fff; z-index: 999;">
                        &copy; 2025 by PT. Pertamina (PERSERO)
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?= $this->endSection() ?>