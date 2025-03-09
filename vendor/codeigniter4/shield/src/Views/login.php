<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> - Trường Đại học Ngân hàng TP.HCM<?= $this->endSection() ?>

<?= $this->section('main') ?>

<div class="container-fluid">
    <div class="row min-vh-100 login-container">
        <!-- Left column: Banking University branding -->
        <div class="col-lg-5 d-none d-lg-flex bg-white justify-content-center align-items-center login-left-panel">
            <div class="text-center p-5" style="position: relative; z-index: 1;">
                <div class="mb-5">
                    <!-- University logo -->
                    <img src="<?= base_url('assets/images/logo-hub.png') ?>" alt="Logo Đại học Ngân hàng" class="img-fluid mb-4" style="max-width: 250px;">
                    <h1 class="fw-bold text-primary">TRƯỜNG ĐẠI HỌC NGÂN HÀNG</h1>
                    <h4 class="text-primary opacity-75">TP. HỒ CHÍ MINH</h4>
                    <h5 class="text-primary opacity-75 fst-italic">Banking University of Ho Chi Minh City</h5>
                </div>
                <p class="lead mb-5 text-dark">Hệ thống thông tin dành cho sinh viên, giảng viên và cán bộ</p>
                <div class="d-flex justify-content-center">
                    <a href="https://www.facebook.com/truongdaihocnganhang" class="text-decoration-none" target="_blank">
                        <div class="bg-primary rounded-circle p-2 mx-2"><i class="bi bi-facebook text-white"></i></div>
                    </a>
                    <a href="https://buh.edu.vn" class="text-decoration-none" target="_blank">
                        <div class="bg-primary rounded-circle p-2 mx-2"><i class="bi bi-globe text-white"></i></div>
                    </a>
                    <a href="https://www.youtube.com/c/TruongDaihocNganhangTPHCM" class="text-decoration-none" target="_blank">
                        <div class="bg-primary rounded-circle p-2 mx-2"><i class="bi bi-youtube text-white"></i></div>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Right column: Login form -->
        <div class="col-lg-7 d-flex align-items-center bg-white">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-7 col-xl-6">
                        <!-- University logo for mobile view -->
                        <div class="text-center d-lg-none mb-5">
                            <img src="<?= base_url('assets/images/logo-hub.png') ?>" alt="Logo Đại học Ngân hàng" class="img-fluid mb-3" style="max-width: 200px;">
                            <h2 class="fw-bold text-primary">TRƯỜNG ĐẠI HỌC NGÂN HÀNG</h2>
                            <p class="text-muted">TP. Hồ Chí Minh</p>
                        </div>
                        
                        <div class="card border-0 shadow-lg">
                            <div class="card-header bg-primary text-white py-3 text-center">
                                <h3 class="card-title fw-bold mb-0"><?= lang('Auth.login') ?></h3>
                            </div>
                            <div class="card-body p-4 p-md-5">
                                <?php if (session('error') !== null) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        <?= session('error') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php elseif (session('errors') !== null) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        <?php if (is_array(session('errors'))) : ?>
                                            <?php foreach (session('errors') as $error) : ?>
                                                <?= $error ?>
                                                <br>
                                            <?php endforeach ?>
                                        <?php else : ?>
                                            <?= session('errors') ?>
                                        <?php endif ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif ?>

                                <?php if (session('message') !== null) : ?>
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        <?= session('message') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif ?>

                                <form action="<?= url_to('login') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <!-- Email -->
                                    <div class="form-floating mb-4">
                                        <input type="email" class="form-control form-control-lg" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                                        <label for="floatingEmailInput"><i class="bi bi-envelope-fill me-1"></i> <?= lang('Auth.email') ?></label>
                                        <div class="form-text">Nhập email trường cấp (@st.buh.edu.vn hoặc @buh.edu.vn)</div>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-floating mb-4">
                                        <input type="password" class="form-control form-control-lg" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
                                        <label for="floatingPasswordInput"><i class="bi bi-lock-fill me-1"></i> <?= lang('Auth.password') ?></label>
                                    </div>

                                    <!-- Remember me -->
                                    <?php if (setting('Auth.sessionConfig')['allowRemembering']): ?>
                                        <div class="form-check mb-4">
                                            <input type="checkbox" name="remember" class="form-check-input" id="rememberMe" <?php if (old('remember')): ?> checked<?php endif ?>>
                                            <label class="form-check-label" for="rememberMe">
                                                <i class="bi bi-clock-history me-1"></i> <?= lang('Auth.rememberMe') ?>
                                            </label>
                                        </div>
                                    <?php endif; ?>

                                    <div class="d-grid mb-4">
                                        <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold">
                                            <i class="bi bi-box-arrow-in-right me-2"></i><?= lang('Auth.login') ?>
                                        </button>
                                    </div>

                                    <div class="d-flex justify-content-between small mb-4">
                                        <?php if (setting('Auth.allowMagicLinkLogins')) : ?>
                                            <a href="<?= url_to('magic-link') ?>" class="text-decoration-none">
                                                <i class="bi bi-link-45deg me-1"></i><?= lang('Auth.useMagicLink') ?>
                                            </a>
                                        <?php endif ?>

                                        <?php if (setting('Auth.allowRegistration')) : ?>
                                            <a href="<?= url_to('register') ?>" class="text-decoration-none">
                                                <i class="bi bi-person-plus-fill me-1"></i><?= lang('Auth.register') ?>
                                            </a>
                                        <?php endif ?>
                                    </div>

                                    <!-- Google Login -->
                                    <div class="position-relative text-center mb-4">
                                        <hr class="text-muted">
                                        <span class="position-absolute top-50 start-50 translate-middle px-3 bg-white text-muted small">
                                            Hoặc đăng nhập bằng
                                        </span>
                                    </div>

                                    <div class="d-grid">
                                        <a href="<?= url_to('google-login') ?>" class="btn btn-outline-dark btn-lg py-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google me-2" viewBox="0 0 16 16">
                                                <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                                            </svg>
                                            Đăng nhập bằng Google
                                        </a>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-light py-3 text-center">
                                <p class="mb-0 small">Gặp khó khăn khi đăng nhập? <a href="mailto:support@buh.edu.vn" class="text-decoration-none">Liên hệ hỗ trợ</a></p>
                            </div>
                        </div>
                        
                        <!-- Footer for mobile view -->
                        <div class="text-center text-muted small mt-4 d-lg-none">
                            <p>© <?= date('Y') ?> Trường Đại học Ngân hàng TP.HCM</p>
                            <p>Địa chỉ: 36 Tôn Thất Đạm, Phường Nguyễn Thái Bình, Quận 1, TP.HCM</p>
                            <p>Hotline: (028) 38 212 430</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
