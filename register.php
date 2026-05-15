<?php
session_start();
$page_title = "إنشاء حساب جديد";
$current_page = "register";
require_once 'includes/db.php';

if (isset($_SESSION['customer_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if ($name && $phone && $email && $password && $confirm_password) {
        if ($password !== $confirm_password) {
            $error = "كلمات المرور غير متطابقة.";
        } else {
            // Check if email exists
            $stmt = $pdo->prepare("SELECT id FROM customers WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $error = "البريد الإلكتروني مسجل مسبقاً. يرجى تسجيل الدخول.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO customers (name, phone, email, password, loyalty_points) VALUES (?, ?, ?, ?, 10)");
                
                try {
                    $stmt->execute([$name, $phone, $email, $hashed_password]);
                    $customer_id = $pdo->lastInsertId();
                    
                    $_SESSION['customer_id'] = $customer_id;
                    $_SESSION['customer_name'] = $name;
                    $_SESSION['flash_message'] = "تم إنشاء حسابك بنجاح! لقد حصلتِ على 10 نقاط ترحيبية.";
                    $_SESSION['flash_type'] = "success";
                    
                    $redirect = $_GET['redirect'] ?? 'index.php';
                    header("Location: " . filter_var($redirect, FILTER_SANITIZE_URL));
                    exit;
                } catch(PDOException $e) {
                    $error = "حدث خطأ أثناء التسجيل. يرجى المحاولة لاحقاً.";
                }
            }
        }
    } else {
        $error = "يرجى تعبئة جميع الحقول المطلوبة.";
    }
}

require_once 'includes/header.php';
?>

<div class="container section-padding">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm custom-form p-4" style="border-radius: 15px;">
                <div class="text-center mb-4">
                    <i class="fas fa-user-plus fa-3x" style="color: var(--primary-color);"></i>
                    <h3 class="mt-3">إنشاء حساب جديد</h3>
                    <p class="text-muted">انضمي إلينا واحصلي على 10 نقاط مجانية فوراً!</p>
                </div>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i><?= $error ?></div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="form-floating">
                                <input type="text" name="name" class="form-control shadow-none" id="floatingName" required placeholder="الاسم الكامل" value="<?= htmlspecialchars($_POST['name'] ?? '') ?>">
                                <label for="floatingName">الاسم الكامل <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="tel" name="phone" class="form-control shadow-none" id="floatingPhone" required placeholder="05xxxxxxxx" value="<?= htmlspecialchars($_POST['phone'] ?? '') ?>">
                                <label for="floatingPhone">رقم الجوال <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="email" name="email" class="form-control shadow-none" id="floatingEmail" required placeholder="البريد الإلكتروني" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                                <label for="floatingEmail">البريد الإلكتروني <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-floating">
                                <input type="password" name="password" class="form-control shadow-none" id="floatingPassword" required placeholder="كلمة المرور">
                                <label for="floatingPassword">كلمة المرور <span class="text-danger">*</span></label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="form-floating">
                                <input type="password" name="confirm_password" class="form-control shadow-none" id="floatingConfirm" required placeholder="تأكيد">
                                <label for="floatingConfirm">تأكيد كلمة المرور <span class="text-danger">*</span></label>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary-custom w-100 py-3 rounded-pill mb-3 fs-5">
                        إنشاء حساب
                    </button>
                    
                    <div class="text-center mt-3 border-top pt-3">
                        <p class="text-muted mb-0">لديكِ حساب بالفعل؟ <a href="login.php<?= isset($_GET['redirect']) ? '?redirect='.urlencode($_GET['redirect']) : '' ?>" style="color: var(--primary-color); font-weight: bold;">تسجيل الدخول</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
