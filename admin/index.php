<?php
session_start();
$current_admin_page = "dashboard";
require_once '../includes/db.php';

// Fetch stats
try {
    $stats = [];
    $stats['appointments'] = $pdo->query("SELECT COUNT(*) FROM appointments")->fetchColumn();
    $stats['services'] = $pdo->query("SELECT COUNT(*) FROM services WHERE is_active = 1")->fetchColumn();
    $stats['customers'] = $pdo->query("SELECT COUNT(*) FROM customers")->fetchColumn();
    
    // Recent appointments
    $recent_appointments = $pdo->query("
        SELECT a.id, c.name as customer_name, s.name as service_name, a.appointment_date, a.appointment_time, a.status 
        FROM appointments a
        JOIN customers c ON a.customer_id = c.id
        JOIN services s ON a.service_id = s.id
        ORDER BY a.created_at DESC LIMIT 5
    ")->fetchAll();

} catch(PDOException $e) {
    die("Error fetching stats");
}

require_once 'header.php';
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">لوحة القيادة</h1>
</div>

<div class="row mb-4">
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="stat-card border-left-primary h-100 py-2">
            <div>
                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">إجمالي المواعيد</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['appointments'] ?></div>
            </div>
            <div class="stat-card-icon"><i class="fas fa-calendar"></i></div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="stat-card border-left-success h-100 py-2">
            <div>
                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">الخدمات النشطة</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['services'] ?></div>
            </div>
            <div class="stat-card-icon"><i class="fas fa-spa"></i></div>
        </div>
    </div>
    <div class="col-xl-4 col-md-6 mb-4">
        <div class="stat-card border-left-info h-100 py-2">
            <div>
                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">العملاء</div>
                <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $stats['customers'] ?></div>
            </div>
            <div class="stat-card-icon"><i class="fas fa-users"></i></div>
        </div>
    </div>
</div>

<div class="card shadow mb-4 border-0 rounded-lg">
    <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">أحدث المواعيد</h6>
        <a href="appointments.php" class="btn btn-sm btn-outline-primary">عرض الكل</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th>رقم الموعد</th>
                        <th>اسم العميل</th>
                        <th>الخدمة</th>
                        <th>التاريخ والوقت</th>
                        <th>الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($recent_appointments as $apt): ?>
                    <tr>
                        <td>#<?= $apt['id'] ?></td>
                        <td><?= htmlspecialchars($apt['customer_name']) ?></td>
                        <td><?= htmlspecialchars($apt['service_name']) ?></td>
                        <td><?= $apt['appointment_date'] ?> <span class="text-muted"><?= date('h:i A', strtotime($apt['appointment_time'])) ?></span></td>
                        <td>
                            <?php 
                                $status_classes = [
                                    'pending' => 'bg-warning text-dark',
                                    'confirmed' => 'bg-info text-white',
                                    'completed' => 'bg-success text-white',
                                    'cancelled' => 'bg-danger text-white',
                                    'reminded' => 'bg-primary text-white'
                                ];
                                $status_labels = [
                                    'pending' => 'قيد الانتظار',
                                    'confirmed' => 'مؤكد',
                                    'completed' => 'مكتمل',
                                    'cancelled' => 'ملغي',
                                    'reminded' => 'تم التذكير'
                                ];
                                $badge_class = $status_classes[$apt['status']] ?? 'bg-secondary';
                                $label = $status_labels[$apt['status']] ?? $apt['status'];
                            ?>
                            <span class="badge rounded-pill <?= $badge_class ?>"><?= $label ?></span>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($recent_appointments)): ?>
                    <tr><td colspan="5" class="text-center">لا توجد مواعيد حديثة.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
