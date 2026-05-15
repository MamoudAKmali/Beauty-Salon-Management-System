<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Check authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الإدارة | صالون لؤلؤة</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.rtl.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- SweetAlert2 -->
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body { 
            background-color: #f4f6f9; 
            font-family: 'Tajawal', sans-serif;
        }
        .admin-sidebar {
            background: linear-gradient(180deg, #2b2b2b 0%, #1a1a1a 100%);
            min-height: calc(100vh - 65px);
            padding: 20px 0;
            box-shadow: inset -5px 0 10px rgba(0,0,0,0.1);
        }
        .admin-nav-link {
            color: #cbd5e1;
            padding: 15px 25px;
            display: flex;
            align-items: center;
            border-right: 4px solid transparent;
            transition: all 0.3s ease;
            font-weight: 500;
        }
        .admin-nav-link i { width: 30px; font-size: 1.2rem; }
        .admin-nav-link:hover, .admin-nav-link.active {
            background-color: rgba(212, 175, 55, 0.1);
            color: var(--primary-color);
            border-right-color: var(--primary-color);
        }
        @media (max-width: 767.98px) {
            .admin-content { 
                padding: 20px 10px !important; 
            }
        }
        .admin-content { 
            padding: 40px; 
        }
        .stat-card {
            background: #fff;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
            border: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: transform 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
        }
        .stat-card-icon { 
            font-size: 2.5rem; 
            color: rgba(212, 175, 55, 0.2); 
        }
        .card {
            border-radius: 15px;
            border: none;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #f1f5f9;
            padding: 20px 25px;
            border-radius: 15px 15px 0 0 !important;
        }
        .table th {
            font-weight: 600;
            color: #475569;
            border-bottom-width: 1px;
            padding: 15px;
        }
        .table td {
            padding: 15px;
            vertical-align: middle;
        }
    </style>
</head>
<body>

<nav class="navbar bg-white border-bottom shadow-sm py-2 sticky-top">
    <div class="container-fluid px-3">
        <button class="navbar-toggler border-0 shadow-none d-md-none me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#adminOffcanvas">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand d-flex align-items-center me-auto" href="index.php">
            <i class="fas fa-crown text-warning me-2 fs-4"></i>
            <span class="fw-bold text-dark fs-5 d-none d-sm-inline">لوحة الإدارة</span>
        </a>
        <div class="d-flex align-items-center gap-2">
            <a href="../index.php" class="btn btn-light btn-sm rounded-pill px-3 fw-bold text-muted border">
                <i class="fas fa-external-link-alt"></i> <span class="d-none d-sm-inline">المتجر</span>
            </a>
            <a href="logout.php" class="btn btn-danger btn-sm rounded-pill px-3">
                <i class="fas fa-sign-out-alt"></i> <span class="d-none d-sm-inline">خروج</span>
            </a>
        </div>
    </div>
</nav>

<!-- Offcanvas for Mobile Sidebar -->
<div class="offcanvas offcanvas-start admin-sidebar-offcanvas" tabindex="-1" id="adminOffcanvas" style="background: linear-gradient(180deg, #2b2b2b 0%, #1a1a1a 100%); width: 280px;">
  <div class="offcanvas-header border-bottom" style="border-color: #333 !important;">
    <h5 class="offcanvas-title text-white"><i class="fas fa-crown text-warning me-2"></i> القائمة</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body p-0 pt-3">
        <div class="nav flex-column">
            <a href="index.php" class="admin-nav-link <?= ($current_admin_page ?? '') == 'dashboard' ? 'active' : '' ?>">
                <i class="fas fa-chart-pie"></i> ملخص الإحصائيات
            </a>
            <a href="services.php" class="admin-nav-link <?= ($current_admin_page ?? '') == 'services' ? 'active' : '' ?>">
                <i class="fas fa-list"></i> إدارة الخدمات والصور
            </a>
            <a href="appointments.php" class="admin-nav-link <?= ($current_admin_page ?? '') == 'appointments' ? 'active' : '' ?>">
                <i class="fas fa-calendar-check"></i> المواعيد والتنبيهات
            </a>
        </div>
  </div>
</div>

<div class="container-fluid">
    <div class="row">
        <!-- Desktop Sidebar -->
        <div class="col-md-3 col-lg-2 px-0 admin-sidebar d-none d-md-block">
            <div class="nav flex-column">
                <a href="index.php" class="admin-nav-link <?= ($current_admin_page ?? '') == 'dashboard' ? 'active' : '' ?>">
                    <i class="fas fa-chart-pie"></i> ملخص الإحصائيات
                </a>
                <a href="services.php" class="admin-nav-link <?= ($current_admin_page ?? '') == 'services' ? 'active' : '' ?>">
                    <i class="fas fa-list"></i> إدارة الخدمات والصور
                </a>
                <a href="appointments.php" class="admin-nav-link <?= ($current_admin_page ?? '') == 'appointments' ? 'active' : '' ?>">
                    <i class="fas fa-calendar-check"></i> المواعيد والتنبيهات
                </a>
            </div>
        </div>
        <!-- Main Content -->
        <div class="col-12 col-md-9 col-lg-10 admin-content">
