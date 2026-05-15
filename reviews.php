<?php
session_start();
$page_title = "آراء العملاء";
$current_page = "reviews";
require_once 'includes/db.php';
require_once 'includes/header.php';

try {
    // Fetch approved reviews
    $reviews = $pdo->query("
        SELECT r.*, c.name as customer_name, s.name as service_name 
        FROM reviews r
        JOIN customers c ON r.customer_id = c.id
        LEFT JOIN services s ON r.service_id = s.id
        WHERE r.is_approved = 1
        ORDER BY r.created_at DESC
    ")->fetchAll();
} catch(PDOException $e) {
    $error = "تعذر تحميل التقييمات.";
}
?>

<div class="container section-padding">
    <div class="section-title-wrapper">
        <span class="section-subtitle">قالوا عن لؤلؤة</span>
        <h1 class="section-title">تجارب عميلاتنا</h1>
    </div>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php else: ?>
        <div class="row g-4">
            <?php foreach($reviews as $review): ?>
            <div class="col-md-6 col-lg-4">
                <div class="review-card">
                    <div class="review-stars">
                        <?php 
                            for($i=1; $i<=5; $i++) {
                                echo $i <= $review['rating'] ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                            }
                        ?>
                    </div>
                    <p class="review-text">"<?= htmlspecialchars($review['comment']) ?>"</p>
                    <div class="review-author mt-4">
                        <div class="author-avatar">
                            <?= mb_substr(htmlspecialchars($review['customer_name']), 0, 1, 'UTF-8') ?>
                        </div>
                        <div class="author-info">
                            <h6><?= htmlspecialchars($review['customer_name']) ?></h6>
                            <small class="text-muted"><?= htmlspecialchars($review['service_name'] ?? 'خدمة عامة') ?></small>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
            <?php if(empty($reviews)): ?>
                <div class="col-12 text-center text-muted">لا توجد تقييمات معتمدة بعد.</div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- For a real project, we would add a review submission form here (requires auth/customer ID checking) -->
    <div class="text-center mt-5">
        <div class="p-4 rounded-3" style="background-color: var(--bg-light); border: 1px dashed var(--secondary-color);">
            <h4 class="mb-3">هل زرتِ صالون لؤلؤة مسبقاً؟</h4>
            <p class="text-muted">نحن نهتم برأيك! شاركينا تجربتك لمساعدتنا على تقديم خدمة أفضل لكِ ولعميلاتنا.</p>
            <button class="btn btn-primary-custom" onclick="Swal.fire({icon: 'info', title: 'ميزة قادمة!', text: 'تتطلب هذه الميزة تسجيل الدخول كعميلة. سيتم توفيرها قريباً!', confirmButtonColor: '#d4af37', confirmButtonText: 'حسناً'})">إضافة تقييم</button>
        </div>
    </div>
</div>

<?php require_once 'includes/footer.php'; ?>
