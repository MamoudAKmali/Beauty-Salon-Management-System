<?php
session_start();
$page_title = "احجزي موعدكِ";
$current_page = "book";
require_once 'includes/db.php';

if (!isset($_SESSION['customer_id'])) {
    header("Location: login.php?redirect=book.php&msg=login_required");
    exit;
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $service_id = $_POST['service_id'] ?? '';
    $employee_id = $_POST['employee_id'] ?? '';
    $date = $_POST['appointment_date'] ?? '';
    $time = $_POST['appointment_time'] ?? '';
    $notes = trim($_POST['notes'] ?? '');
    
    $customer_id = $_SESSION['customer_id'];

    if ($service_id && $employee_id && $date && $time) {
        try {
            // Insert Appointment
            $stmt = $pdo->prepare("INSERT INTO appointments (customer_id, service_id, employee_id, appointment_date, appointment_time, notes) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$customer_id, $service_id, $employee_id, $date, $time, $notes]);
            
            $_SESSION['flash_message'] = "تم تسجيل حجزكِ بنجاح! بانتظار زيارتكِ.";
            $_SESSION['flash_type'] = "success";
            header("Location: index.php");
            exit;
        } catch (PDOException $e) {
            $error = "عذراً، حدث خطأ أثناء الحجز. يرجى المحاولة لاحقاً.";
        }
    } else {
        $error = "يرجى تعبئة جميع الحقول المطلوبة.";
    }
}

// Fetch lists for the form
try {
    $services = $pdo->query("SELECT id, name, price FROM services WHERE is_active = 1")->fetchAll();
    $employees = $pdo->query("SELECT id, name, specialization FROM employees WHERE is_active = 1")->fetchAll();
} catch(PDOException $e) {
    die("Database Error");
}

$selected_service = $_GET['service_id'] ?? '';

require_once 'includes/header.php';
?>

<div class="container section-padding">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="section-title-wrapper text-center">
                <span class="section-subtitle">الحجز الإلكتروني</span>
                <h1 class="section-title">احجزي موعدكِ الآن</h1>
            </div>

            <div class="custom-form">
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><i class="fas fa-exclamation-triangle"></i> <?= $error ?></div>
                <?php endif; ?>

                <form method="POST" action="">

                    <h5 class="mb-4" style="color: var(--primary-color); border-bottom: 1px solid #eee; padding-bottom: 10px;"><i class="fas fa-calendar-alt me-2"></i>تفاصيل الموعد</h5>
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select name="service_id" class="form-select shadow-none" id="floatingService" required>
                                    <option value="">-- اختاري الخدمة --</option>
                                    <?php foreach($services as $srv): ?>
                                        <option value="<?= $srv['id'] ?>" <?= ($selected_service == $srv['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($srv['name']) ?> (<?= number_format($srv['price'],0) ?> رس)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="floatingService">الخدمة المطلوبة <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <select name="employee_id" class="form-select shadow-none" id="floatingEmp" required>
                                    <option value="">-- اختاري الموظفة --</option>
                                    <?php foreach($employees as $emp): ?>
                                        <option value="<?= $emp['id'] ?>">
                                            <?= htmlspecialchars($emp['name']) ?> (<?= htmlspecialchars($emp['specialization']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="floatingEmp">الموظفة المختصة <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="date" name="appointment_date" class="form-control shadow-none" id="floatingDate" required min="<?= date('Y-m-d') ?>">
                                <label for="floatingDate">تاريخ الموعد <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="time" name="appointment_time" class="form-control shadow-none" id="floatingTime" required min="09:00" max="22:00">
                                <label for="floatingTime">وقت الموعد <span class="text-danger">*</span></label>
                            </div>
                            <small class="text-muted d-block mt-2"><i class="fas fa-info-circle"></i> أوقات العمل من 9 صباحاً إلى 11 مساءً</small>
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-floating">
                                <textarea name="notes" class="form-control shadow-none" id="floatingNotes" style="height: 100px" placeholder="أي ملاحظات..."></textarea>
                                <label for="floatingNotes">ملاحظات إضافية (اختياري)</label>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary-custom px-5 py-3 w-100 fs-5 rounded-pill shadow-sm">
                            <i class="fas fa-check-circle me-2"></i> تأكيد الحجز الآن
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
