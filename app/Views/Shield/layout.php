<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Hệ thống thông tin Trường Đại học Ngân hàng TP.HCM">
    <meta name="author" content="Banking University of Ho Chi Minh City">
    <meta name="theme-color" content="#00529b">
    <link rel="icon" href="<?= base_url('favicon.ico') ?>">

    <title><?= $this->renderSection('title') ?></title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Custom styles -->
    <link href="<?= base_url('assets/css/auth.css') ?>" rel="stylesheet">

    <?= $this->renderSection('pageStyles') ?>
</head>

<body>
    <main role="main">
        <?= $this->renderSection('main') ?>
    </main>

    <footer class="d-none d-lg-block bg-dark text-white py-4 mt-auto">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5 class="border-start border-warning border-4 ps-2">TRƯỜNG ĐẠI HỌC NGÂN HÀNG TP.HCM</h5>
                    <p class="small">Banking University of Ho Chi Minh City</p>
                    <p class="small">© <?= date('Y') ?> Bản quyền thuộc về Trường Đại học Ngân hàng TP.HCM</p>
                </div>
                <div class="col-md-4">
                    <h5 class="border-start border-warning border-4 ps-2">LIÊN HỆ</h5>
                    <p class="small"><i class="bi bi-geo-alt-fill me-2"></i>36 Tôn Thất Đạm, Phường Nguyễn Thái Bình, Quận 1, TP.HCM</p>
                    <p class="small"><i class="bi bi-telephone-fill me-2"></i>(028) 38 212 430</p>
                    <p class="small"><i class="bi bi-envelope-fill me-2"></i>info@buh.edu.vn</p>
                </div>
                <div class="col-md-4">
                    <h5 class="border-start border-warning border-4 ps-2">LIÊN KẾT</h5>
                    <div class="d-flex">
                        <a href="https://www.facebook.com/truongdaihocnganhang" class="footer-link me-3" target="_blank"><i class="bi bi-facebook fs-4"></i></a>
                        <a href="https://buh.edu.vn" class="footer-link me-3" target="_blank"><i class="bi bi-globe fs-4"></i></a>
                        <a href="https://www.youtube.com/c/TruongDaihocNganhangTPHCM" class="footer-link me-3" target="_blank"><i class="bi bi-youtube fs-4"></i></a>
                    </div>
                    <div class="mt-3">
                        <a href="https://buh.edu.vn/gioi-thieu" class="footer-link d-block mb-1" target="_blank">Giới thiệu</a>
                        <a href="https://buh.edu.vn/tuyen-sinh" class="footer-link d-block mb-1" target="_blank">Tuyển sinh</a>
                        <a href="https://buh.edu.vn/dao-tao" class="footer-link d-block mb-1" target="_blank">Đào tạo</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <!-- Custom JavaScript -->
    <script>
        // Hiển thị/ẩn mật khẩu
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInputs = document.querySelectorAll('input[type="password"]');
            
            passwordInputs.forEach(input => {
                // Tạo button hiển thị/ẩn mật khẩu
                const toggleButton = document.createElement('button');
                toggleButton.type = 'button';
                toggleButton.className = 'btn btn-outline-secondary position-absolute end-0 top-50 translate-middle-y me-2';
                toggleButton.innerHTML = '<i class="bi bi-eye"></i>';
                toggleButton.style.zIndex = '5';
                
                // Thêm button vào form-floating
                const parent = input.parentElement;
                parent.style.position = 'relative';
                parent.appendChild(toggleButton);
                
                // Xử lý sự kiện click
                toggleButton.addEventListener('click', function() {
                    if (input.type === 'password') {
                        input.type = 'text';
                        toggleButton.innerHTML = '<i class="bi bi-eye-slash"></i>';
                    } else {
                        input.type = 'password';
                        toggleButton.innerHTML = '<i class="bi bi-eye"></i>';
                    }
                });
            });
            
            // Hiệu ứng cho form
            const formElements = document.querySelectorAll('.form-control');
            formElements.forEach(element => {
                element.addEventListener('focus', function() {
                    this.parentElement.classList.add('shadow-sm');
                });
                
                element.addEventListener('blur', function() {
                    this.parentElement.classList.remove('shadow-sm');
                });
            });
        });
    </script>

    <?= $this->renderSection('pageScripts') ?>
</body>
</html> 