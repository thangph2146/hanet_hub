<?= $this->extend(config('Auth')->views['layout']) ?>

<?= $this->section('title') ?><?= lang('Auth.login') ?> - Trường Đại học Ngân hàng TP.HCM<?= $this->endSection() ?>

<?= $this->section('main') ?>
<!-- Custom CSS for event styling -->
<style>
    .login-container {
        background: linear-gradient(135deg, #f5f7fa 0%, #e9ecef 100%);
        position: relative;
        overflow: hidden;
    }
    
    .login-container::before {
        content: '';
        position: absolute;
        top: -10%;
        left: -10%;
        width: 120%;
        height: 120%;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><circle cx="10" cy="10" r="2" fill="%230d6efd" opacity="0.1"/></svg>');
        z-index: 0;
        animation: floating 60s infinite linear;
    }
    
    .login-left-panel {
        position: relative;
        overflow: hidden;
        border-right: 1px solid rgba(0,0,0,0.05);
        box-shadow: 5px 0px 15px rgba(0,0,0,0.03);
    }
    
    .login-left-panel::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(13, 110, 253, 0.05) 0%, rgba(13, 110, 253, 0) 70%);
        z-index: 0;
    }
    
    .shine {
        position: relative;
        overflow: hidden;
    }
    
    .shine::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
        transform: rotate(30deg);
        animation: shine 6s infinite;
    }
    
    .floating {
        animation: float 6s ease-in-out infinite;
    }
    
    .card {
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(50, 50, 93, 0.1), 0 5px 15px rgba(0, 0, 0, 0.07);
        overflow: hidden;
        transition: all 0.3s;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(50, 50, 93, 0.15), 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #0d6efd 0%, #0a58ca 100%);
        border: none;
        transition: all 0.3s;
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 14px rgba(13, 110, 253, 0.2);
    }
    
    .card-header {
        background: linear-gradient(135deg, #0d6efd 0%, #0a58ca 100%);
        border-bottom: none;
    }
    
    .shape {
        position: absolute;
        opacity: 0.1;
        z-index: 0;
    }
    
    .circle1 {
        width: 300px;
        height: 300px;
        border-radius: 50%;
        background-color: #0d6efd;
        top: -150px;
        right: -150px;
    }
    
    .circle2 {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background-color: #0d6efd;
        bottom: -100px;
        left: -100px;
    }
    
    .social-icon {
        transition: all 0.3s;
    }
    
    .social-icon:hover {
        transform: translateY(-5px);
    }
    
    .university-title {
        background: linear-gradient(45deg, #0d6efd, #0a58ca);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        font-weight: 800;
        letter-spacing: 0.5px;
    }
    
    .form-control {
        border-radius: 10px;
        transition: all 0.3s;
    }
    
    .form-control:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.15);
        transform: translateY(-2px);
    }
    
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    
    @keyframes shine {
        0% { transform: translateX(-100%) rotate(30deg); }
        100% { transform: translateX(100%) rotate(30deg); }
    }
    
    @keyframes floating {
        0% { transform: translateY(0) rotate(0deg); }
        100% { transform: translateY(-100px) rotate(360deg); }
    }

    /* Enhanced social icon styles */
    .social-icons-container {
        margin-top: 2rem;
        margin-bottom: 1rem;
    }
    
    .social-icon {
        display: inline-flex;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        position: relative;
        z-index: 1;
        margin: 0 0.6rem;
    }
    
    .social-icon:hover {
        transform: translateY(-8px) scale(1.1);
    }
    
    .social-icon-inner {
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(145deg, #0d6efd, #084298);
        box-shadow: 0 10px 20px rgba(8, 66, 152, 0.3);
        position: relative;
        overflow: hidden;
    }
    
    .social-icon-inner::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to bottom, rgba(255,255,255,0.3), rgba(255,255,255,0));
        border-radius: 50% 50% 0 0;
    }
    
    .social-icon-inner i {
        font-size: 1.5rem;
        color: white;
        position: relative;
        z-index: 1;
        transition: all 0.3s;
    }
    
    .social-icon:hover .social-icon-inner i {
        transform: scale(1.2);
    }
    
    /* Social icon specific styles */
    .social-facebook {
        color: #1877f2;
    }
    
    .social-website {
        color: #0d6efd;
    }
    
    .social-youtube {
        color: #ff0000;
    }
    
    .social-icon-label {
        position: absolute;
        bottom: -24px;
        left: 0;
        right: 0;
        text-align: center;
        font-size: 0.75rem;
        font-weight: 600;
        color: #555;
        opacity: 0;
        transform: translateY(-5px);
        transition: all 0.3s;
    }
    
    .social-icon:hover .social-icon-label {
        opacity: 1;
        transform: translateY(0);
    }
    
    /* Enhanced event styling */
    .event-badge {
        position: absolute;
        top: 10px;
        right: 10px;
        background: linear-gradient(45deg, #ff6b6b, #ff9e7f);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 50px;
        font-weight: bold;
        font-size: 0.8rem;
        box-shadow: 0 3px 6px rgba(255, 107, 107, 0.3);
        transform: rotate(5deg);
        z-index: 10;
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: rotate(5deg) scale(1); }
        50% { transform: rotate(5deg) scale(1.05); }
        100% { transform: rotate(5deg) scale(1); }
    }
    
    .card-decoration {
        position: absolute;
        bottom: -15px;
        left: -15px;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #aef6ff 0%, #0dcaf0 100%);
        opacity: 0.6;
        z-index: 0;
    }
    
    /* Confetti background for event style */
    .confetti {
        position: absolute;
        width: 10px;
        height: 10px;
        opacity: 0.3;
        z-index: 0;
    }
    
    .confetti-1 {
        top: 10%;
        left: 30%;
        background-color: #ff6b6b;
        clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
        animation: spin 20s infinite linear;
    }
    
    .confetti-2 {
        top: 20%;
        right: 20%;
        background-color: #7843e9;
        clip-path: polygon(50% 0%, 100% 38%, 82% 100%, 18% 100%, 0% 38%);
        animation: spin 15s infinite linear reverse;
    }
    
    .confetti-3 {
        bottom: 15%;
        left: 45%;
        background-color: #0dcaf0;
        clip-path: circle(50% at 50% 50%);
        animation: float 12s infinite;
    }
    
    .confetti-4 {
        bottom: 30%;
        right: 10%;
        background-color: #ffc107;
        clip-path: polygon(25% 0%, 100% 0%, 75% 100%, 0% 100%);
        animation: spin 18s infinite linear;
    }
    
    .confetti-5 {
        top: 50%;
        left: 15%;
        background-color: #20c997;
        width: 15px;
        height: 15px;
        clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
        animation: spin 25s infinite linear reverse;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Make gradient text work in Firefox */
    .university-title {
        background-image: linear-gradient(45deg, #0d6efd, #0a58ca);
        background-size: 100%;
        background-repeat: repeat;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        -moz-background-clip: text;
        -moz-text-fill-color: transparent;
        background-clip: text;
        text-fill-color: transparent;
        font-weight: 800;
        letter-spacing: 0.5px;
    }
</style>

<div class="container-fluid">
    <div class="row min-vh-100 login-container">
        <!-- Enhanced decorative elements for event style -->
        <div class="shape circle1"></div>
        <div class="shape circle2"></div>
        <div class="confetti confetti-1"></div>
        <div class="confetti confetti-2"></div>
        <div class="confetti confetti-3"></div>
        <div class="confetti confetti-4"></div>
        <div class="confetti confetti-5"></div>
        
        <!-- Left column: Banking University branding -->
        <div class="col-lg-5 d-none d-lg-flex bg-white justify-content-center align-items-center login-left-panel">
            <div class="text-center p-5" style="position: relative; z-index: 1;">
                <!-- Event badge -->
                <div class="event-badge">Sự kiện đặc biệt</div>
                
                <div class="mb-5">
                    <!-- University logo with floating animation -->
                    <div class="floating shine mb-4">
                        <img src="<?= base_url('assets/images/logo-hub.png') ?>" alt="Logo Đại học Ngân hàng" class="img-fluid" style="max-width: 250px;">
                    </div>
                    <h1 class="university-title mb-3">TRƯỜNG ĐẠI HỌC NGÂN HÀNG</h1>
                    <h4 class="text-primary fw-bold">TP. HỒ CHÍ MINH</h4>
                    <h5 class="text-primary fst-italic">Banking University of Ho Chi Minh City</h5>
                </div>
                
                <div class="alert alert-primary p-3 mb-5" style="border-radius: 15px; background: rgba(13, 110, 253, 0.1); border: none;">
                    <p class="lead mb-0 fw-bold text-primary">Hệ thống thông tin dành cho sinh viên, giảng viên và cán bộ</p>
                </div>
                
                <!-- Enhanced social icons -->
                <div class="social-icons-container">
                    <a href="https://www.facebook.com/truongdaihocnganhang" class="social-icon" target="_blank">
                        <div class="social-icon-inner">
                            <i class="bi bi-facebook"></i>
                        </div>
                        <div class="social-icon-label">Facebook</div>
                    </a>
                    <a href="https://buh.edu.vn" class="social-icon" target="_blank">
                        <div class="social-icon-inner">
                            <i class="bi bi-globe"></i>
                        </div>
                        <div class="social-icon-label">Website</div>
                    </a>
                    <a href="https://www.youtube.com/c/TruongDaihocNganhangTPHCM" class="social-icon" target="_blank">
                        <div class="social-icon-inner">
                            <i class="bi bi-youtube"></i>
                        </div>
                        <div class="social-icon-label">YouTube</div>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Right column: Login form -->
        <div class="col-lg-7 d-flex align-items-center justify-content-center" style="position: relative; z-index: 1;">
            <div class="container py-5">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-8 col-lg-7 col-xl-6">
                        <!-- University logo for mobile view -->
                        <div class="text-center d-lg-none mb-5">
                            <div class="event-badge">Tuyển sinh 2023</div>
                            <img src="<?= base_url('assets/images/logo-hub.png') ?>" alt="Logo Đại học Ngân hàng" class="img-fluid mb-3 floating" style="max-width: 200px;">
                            <h2 class="university-title">TRƯỜNG ĐẠI HỌC NGÂN HÀNG</h2>
                            <p class="text-primary fw-bold">TP. Hồ Chí Minh</p>
                            
                            <!-- Enhanced social icons for mobile -->
                            <div class="social-icons-container d-flex justify-content-center mt-3 mb-4">
                                <a href="https://www.facebook.com/truongdaihocnganhang" class="social-icon" target="_blank">
                                    <div class="social-icon-inner" style="width: 45px; height: 45px;">
                                        <i class="bi bi-facebook" style="font-size: 1.2rem;"></i>
                                    </div>
                                </a>
                                <a href="https://buh.edu.vn" class="social-icon" target="_blank">
                                    <div class="social-icon-inner" style="width: 45px; height: 45px;">
                                        <i class="bi bi-globe" style="font-size: 1.2rem;"></i>
                                    </div>
                                </a>
                                <a href="https://www.youtube.com/c/TruongDaihocNganhangTPHCM" class="social-icon" target="_blank">
                                    <div class="social-icon-inner" style="width: 45px; height: 45px;">
                                        <i class="bi bi-youtube" style="font-size: 1.2rem;"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                        
                        <div class="card border-0 shadow-lg" style="position: relative; overflow: visible;">
                            <!-- Card decoration -->
                            <div class="card-decoration"></div>
                            
                            <div class="card-header py-4 text-center">
                                <h3 class="card-title fw-bold mb-0 text-white"><?= lang('Auth.login') ?></h3>
                            </div>
                            <div class="card-body p-4 p-md-5">
                                <?php if (session('error') !== null) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px;">
                                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                                        <?= session('error') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php elseif (session('errors') !== null) : ?>
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="border-radius: 12px;">
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
                                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 12px;">
                                        <i class="bi bi-check-circle-fill me-2"></i>
                                        <?= session('message') ?>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                <?php endif ?>

                                <form action="<?= url_to('login') ?>" method="post">
                                    <?= csrf_field() ?>

                                    <!-- Email -->
                                    <div class="form-floating mb-4">
                                        <input type="email" class="form-control form-control-lg border-0 shadow-sm" id="floatingEmailInput" name="email" inputmode="email" autocomplete="email" placeholder="<?= lang('Auth.email') ?>" value="<?= old('email') ?>" required>
                                        <label for="floatingEmailInput"><i class="bi bi-envelope-fill me-1"></i> <?= lang('Auth.email') ?></label>
                                        <div class="form-text">Nhập email trường cấp (@st.buh.edu.vn hoặc @buh.edu.vn)</div>
                                    </div>

                                    <!-- Password -->
                                    <div class="form-floating mb-4">
                                        <input type="password" class="form-control form-control-lg border-0 shadow-sm" id="floatingPasswordInput" name="password" inputmode="text" autocomplete="current-password" placeholder="<?= lang('Auth.password') ?>" required>
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
                                        <button type="submit" class="btn btn-primary btn-lg py-3 fw-bold shine">
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
                                        <span class="position-absolute top-50 start-50 translate-middle px-4 bg-white text-muted small fw-bold">
                                            Hoặc đăng nhập bằng
                                        </span>
                                    </div>

                                    <div class="d-grid">
                                        <a href="<?= url_to('google-login') ?>" class="btn btn-outline-dark btn-lg py-3 shine">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-google me-2" viewBox="0 0 16 16">
                                                <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z"/>
                                            </svg>
                                            <span class="fw-bold">Đăng nhập bằng Google</span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                            <div class="card-footer bg-light py-4 text-center">
                                <p class="mb-0">Gặp khó khăn khi đăng nhập? <a href="mailto:support@buh.edu.vn" class="text-decoration-none fw-bold">Liên hệ hỗ trợ</a></p>
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
