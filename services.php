<?php
session_start();
$page_title = "خدماتنا والأسعار";
$current_page = "services";
require_once 'includes/db.php';
require_once 'includes/header.php';

// Fetch all active services categorized
$categories = [
    'hair' => 'العناية بالشعر',
    'nails' => 'العناية بالأظافر',
    'makeup' => 'مكياج وتجميل',
    'skincare' => 'العناية بالبشرة',
    'eyebrow' => 'الحواجب والرموش'
];

try {
    $stmt = $pdo->query("SELECT * FROM services WHERE is_active = 1 ORDER BY category, name");
    $allServices = $stmt->fetchAll();
    
    // Group services by category
    $groupedServices = [];
    foreach($allServices as $service) {
        $groupedServices[$service['category']][] = $service;
    }
} catch(PDOException $e) {
    $error = "تعذر تحميل البيانات.";
}
?>

<div class="container section-padding">
    <div class="section-title-wrapper">
        <span class="section-subtitle">قائمة الأسعار والخدمات</span>
        <h1 class="section-title">اختاري ما يناسب جمالكِ</h1>
    </div>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
    <?php else: ?>
        
        <div class="row">
            <div class="col-lg-3 mb-4">
                <div class="list-group sticky-top" style="top: 100px;">
                    <?php foreach($groupedServices as $cat_key => $items): ?>
                        <a href="#cat-<?= $cat_key ?>" class="list-group-item list-group-item-action border-0 mb-1 rounded">
                            <?= $categories[$cat_key] ?? 'أخرى' ?>
                        </a>
                    <?php endforeach; ?>
                </div>
            </div>
            
            <div class="col-lg-9">
                <?php foreach($groupedServices as $cat_key => $items): ?>
                    <div id="cat-<?= $cat_key ?>" class="mb-5">
                        <h3 class="mb-4 text-primary" style="color: var(--primary-color) !important;">
                            <i class="fas fa-gem me-2"></i> <?= $categories[$cat_key] ?? 'أخرى' ?>
                        </h3>
                        
                        <div class="row g-4">
                            <?php foreach($items as $service): ?>
                                <div class="col-md-6">
                                    <div class="card h-100 border-0 shadow-sm custom-form p-0 overflow-hidden" style="transition: transform 0.3s; border-radius: 12px;">
                                        <?php if(!empty($service['image'])): ?>
                                            <img src="<?= htmlspecialchars($service['image']) ?>" alt="<?= htmlspecialchars($service['name']) ?>" style="height: 200px; object-fit: cover; width: 100%;">
                                        <?php endif; ?>
                                        <div class="card-body p-4 d-flex flex-column">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                                <h4 class="card-title h5 font-weight-bold mb-0"><?= htmlspecialchars($service['name']) ?></h4>
                                                <span class="badge" style="background-color: var(--accent-color); font-size: 1rem;"><?= number_format($service['price'], 0) ?> رس</span>
                                            </div>
                                            <p class="card-text text-muted small mb-3 flex-grow-1"><?= htmlspecialchars($service['description']) ?></p>
                                            <div class="d-flex justify-content-between align-items-center mt-auto pt-3 border-top">
                                                <span class="text-muted small"><i class="far fa-clock"></i> <?= $service['duration_minutes'] ?> دقيقة</span>
                                                <a href="book.php?service_id=<?= $service['id'] ?>" class="btn btn-sm btn-outline-dark rounded-pill px-3">احجز</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    <?php endif; ?>
</div>

<?php require_once 'includes/footer.php'; ?>
