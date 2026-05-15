<?php
session_start();
$page_title = "تسجيل الدخول";
$current_page = "login";
require_once 'includes/db.php';

if (isset($_SESSION['customer_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    if ($email && $password) {
        $stmt = $pdo->prepare("SELECT * FROM customers WHERE email = ?");
        $stmt->execute([$email]);
        $customer = $stmt->fetch();
        
        if ($customer && password_verify($password, $customer['password'])) {
            if ($customer['role'] === 'admin') {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_name'] = $customer['name'];
                $_SESSION['flash_message'] = "مرحباً بك في لوحة الإدارة، " . explode(' ', $customer['name'])[0] . "!";
                $_SESSION['flash_type'] = "success";
                header("Location: admin/index.php");
                exit;
            } else {
                $_SESSION['customer_id'] = $customer['id'];
                $_SESSION['customer_name'] = $customer['name'];
                $_SESSION['flash_message'] = "أهلاً بكِ مجدداً، " . explode(' ', $customer['name'])[0] . "!";
                $_SESSION['flash_type'] = "success";
                
                $redirect = $_GET['redirect'] ?? 'index.php';
                header("Location: " . filter_var($redirect, FILTER_SANITIZE_URL));
                exit;
            }
        } else {
            $error = "البريد الإلكتروني أو كلمة المرور غير صحيحة.";
        }
    } else {
        $error = "يرجى تعبئة جميع الحقول.";
    }
}

require_once 'includes/header.php';
?>

<div class="container section-padding">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm custom-form p-4" style="border-radius: 15px;">
                <div class="text-center mb-4">
                    <i class="fas fa-sign-in-alt fa-3x" style="color: var(--primary-color);"></i>
                    <h3 class="mt-3">تسجيل الدخول</h3>
                    <p class="text-muted">مرحباً بكِ في صالون لؤلؤة</p>
                </div>

                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><i class="fas fa-exclamation-triangle me-2"></i><?= $error ?></div>
                <?php endif; ?>

                <?php if (isset($_GET['msg']) && $_GET['msg'] === 'login_required'): ?>
                    <div class="alert alert-info"><i class="fas fa-info-circle me-2"></i>يرجى تسجيل الدخول لتتمكني من حجز موعد.</div>
                <?php endif; ?>

                <form method="POST" action="">
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control shadow-none" id="floatingEmail" required placeholder="example@email.com" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>" autocomplete="email">
                        <label for="floatingEmail">البريد الإلكتروني</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" name="password" class="form-control shadow-none" id="floatingPassword" required placeholder="Password">
                        <label for="floatingPassword">كلمة المرور</label>
                    </div>

                    <button type="submit" class="btn btn-primary-custom w-100 py-3 rounded-pill mb-3 fs-5">
                        تسجيل الدخول
                    </button>
                    
                    <div class="text-center mt-3 border-top pt-3">
                        <p class="text-muted mb-0">ليس لديكِ حساب؟ <a href="register.php<?= isset($_GET['redirect']) ? '?redirect='.urlencode($_GET['redirect']) : '' ?>" style="color: var(--primary-color); font-weight: bold;">سجلي الآن</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
