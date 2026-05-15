<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= $page_description ?? 'لؤلؤة - صالون تجميل فاخر يقدم أرقى الخدمات في تصفيف الشعر والأظافر والمكياج والعناية بالبشرة' ?>">
    <title><?= isset($page_title) ? $page_title . ' | لؤلؤة' : 'لؤلؤة - صالون تجميل فاخر' ?></title>

    <!-- Google Fonts - Tajawal for Arabic -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 RTL -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?= $root ?? '' ?>assets/css/style.css">

    <?php if(isset($extra_css)) echo $extra_css; ?>
</head>
<body>

<!-- ===== TOP BAR ===== -->
<div class="topbar">
    <div class="container">
        <div class="topbar-inner">
            <div class="topbar-contact">
                <span><i class="fas fa-phone-alt"></i> 920001234</span>
                <span><i class="fas fa-map-marker-alt"></i> الرياض، حي النزهة</span>
            </div>
            <div class="topbar-social">
                <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="#" aria-label="Snapchat"><i class="fab fa-snapchat"></i></a>
                <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </div>
</div>

<!-- ===== NAVBAR ===== -->
<nav class="navbar navbar-expand-lg main-navbar sticky-top">
    <div class="container">
        <a class="navbar-brand brand-logo" href="<?= $root ?? '' ?>index.php">
            <i class="fas fa-gem brand-icon"></i>
            <span>لؤلؤة</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page ?? '') === 'home' ? 'active' : '' ?>" href="<?= $root ?? '' ?>index.php">
                        <i class="fas fa-home"></i> الرئيسية
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page ?? '') === 'services' ? 'active' : '' ?>" href="<?= $root ?? '' ?>services.php">
                        <i class="fas fa-spa"></i> خدماتنا
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page ?? '') === 'reviews' ? 'active' : '' ?>" href="<?= $root ?? '' ?>reviews.php">
                        <i class="fas fa-star"></i> آراء العملاء
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= ($current_page ?? '') === 'book' ? 'active' : '' ?>" href="<?= $root ?? '' ?>book.php">
                        <i class="fas fa-calendar-alt"></i> احجزي موعدكِ
                    </a>
                </li>
            </ul>
            <div class="navbar-actions d-flex gap-2">
                <?php if(isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true): ?>
                    <div class="dropdown">
                        <button class="btn btn-warning dropdown-toggle fw-bold" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: #333;">
                            <i class="fas fa-crown me-1"></i> مرحباً، مدير
                        </button>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item fw-bold" href="<?= $root ?? '' ?>admin/index.php"><i class="fas fa-chart-pie me-2 text-primary"></i>لوحة الإدارة</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="<?= $root ?? '' ?>logout.php"><i class="fas fa-sign-out-alt me-2"></i>تسجيل الخروج</a></li>
                        </ul>
                    </div>
                <?php elseif(isset($_SESSION['customer_id'])): ?>
                    <div class="dropdown">
                        <button class="btn btn-primary-custom dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user-circle me-1"></i> مرحباً، <?= htmlspecialchars(explode(' ', $_SESSION['customer_name'])[0]) ?>
                        </button>
                        <ul class="dropdown-menu border-0 shadow">
                            <li><a class="dropdown-item text-danger" href="<?= $root ?? '' ?>logout.php"><i class="fas fa-sign-out-alt me-2"></i>تسجيل الخروج</a></li>
                        </ul>
                    </div>
                <?php else: ?>
                    <a href="<?= $root ?? '' ?>login.php" class="btn btn-outline-dark rounded-pill px-4" style="border-width: 2px;">
                        تسجيل الدخول
                    </a>
                    <a href="<?= $root ?? '' ?>register.php" class="btn btn-primary-custom">
                        حساب جديد
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>


