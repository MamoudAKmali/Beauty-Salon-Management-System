<?php
session_start();
$current_admin_page = "appointments";
require_once '../includes/db.php';

// Handle Status Update (including notification simulation)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $id = $_POST['appointment_id'];
    $new_status = $_POST['status'];
    
    try {
        $stmt = $pdo->prepare("UPDATE appointments SET status = ? WHERE id = ?");
        $stmt->execute([$new_status, $id]);
        
        if ($new_status === 'reminded') {
            $_SESSION['flash_message'] = "تم إرسال تذكير WhatsApp للعميلة بنجاح.";
        } else {
            $_SESSION['flash_message'] = "تم تحديث حالة الموعد.";
        }
        $_SESSION['flash_type'] = "success";
        header("Location: appointments.php");
        exit;
    } catch(PDOException $e) {
        $error = "حدث خطأ أثناء التحديث.";
    }
}

require_once 'header.php';

try {
    $appointments = $pdo->query("
        SELECT a.id, c.name as customer_name, c.phone, s.name as service_name, e.name as employee_name, a.appointment_date, a.appointment_time, a.status, a.notes 
        FROM appointments a
        JOIN customers c ON a.customer_id = c.id
        JOIN services s ON a.service_id = s.id
        JOIN employees e ON a.employee_id = e.id
        ORDER BY a.appointment_date DESC, a.appointment_time DESC
    ")->fetchAll();
} catch(PDOException $e) {
    die("Database Error");
}
?>

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">إدارة المواعيد والتنبيهات</h1>
</div>

<?php if (isset($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<div class="card shadow mb-4 border-0">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>رقم</th>
                        <th>بيانات العميلة</th>
                        <th>الخدمة والموظفة</th>
                        <th>التاريخ والوقت</th>
                        <th>الحالة</th>
                        <th>إجراءات / تنبيهات</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($appointments as $apt): ?>
                    <tr>
                        <td><strong>#<?= $apt['id'] ?></strong></td>
                        <td>
                            <?= htmlspecialchars($apt['customer_name']) ?><br>
                            <small class="text-muted"><i class="fas fa-phone"></i> <?= htmlspecialchars($apt['phone']) ?></small>
                        </td>
                        <td>
                            <span class="text-primary"><?= htmlspecialchars($apt['service_name']) ?></span><br>
                            <small class="text-muted">مع: <?= htmlspecialchars($apt['employee_name']) ?></small>
                        </td>
                        <td>
                            <?= $apt['appointment_date'] ?><br>
                            <small class="text-muted"><i class="far fa-clock"></i> <?= date('h:i A', strtotime($apt['appointment_time'])) ?></small>
                        </td>
                        <td>
                            <?php 
                                $status_classes = [
                                    'pending' => 'bg-warning text-dark',
                                    'confirmed' => 'bg-info text-white',
                                    'completed' => 'bg-success text-white',
                                    'cancelled' => 'bg-danger text-white',
                                    'reminded' => 'bg-primary text-white'
                                ];
                                $badge_class = $status_classes[$apt['status']] ?? 'bg-secondary';
                            ?>
                            <span class="badge <?= $badge_class ?>"><?= $apt['status'] ?></span>
                        </td>
                        <td>
                            <form method="POST" action="appointments.php" class="d-flex gap-2 align-items-center">
                                <input type="hidden" name="appointment_id" value="<?= $apt['id'] ?>">
                                <select name="status" class="form-select form-select-sm" style="width: 130px;">
                                    <option value="pending" <?= $apt['status']=='pending'?'selected':'' ?>>قيد الانتظار</option>
                                    <option value="confirmed" <?= $apt['status']=='confirmed'?'selected':'' ?>>تأكيد</option>
                                    <option value="completed" <?= $apt['status']=='completed'?'selected':'' ?>>مكتمل</option>
                                    <option value="cancelled" <?= $apt['status']=='cancelled'?'selected':'' ?>>إلغاء</option>
                                    <option value="reminded" <?= $apt['status']=='reminded'?'selected':'' ?>>إرسال تذكير</option>
                                </select>
                                <button type="submit" name="update_status" class="btn btn-sm btn-dark">تحديث</button>
                            </form>
                            <?php if($apt['notes']): ?>
                                <button type="button" class="btn btn-sm btn-outline-secondary mt-2 w-100" onclick="alert('ملاحظات الموعد:\n<?= htmlspecialchars($apt['notes']) ?>')">عرض الملاحظات</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($appointments)): ?>
                    <tr><td colspan="6" class="text-center">لا توجد مواعيد محجوزة حالياً.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once 'footer.php'; ?>
