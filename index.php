<?php
session_start();
$page_title = "الرئيسية";
$current_page = "home";
require_once 'includes/db.php';
require_once 'includes/header.php';
?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="hero-content">
                    <span class="hero-subtitle">دليلكِ للجمال والأناقة</span>
                    <h1 class="hero-title">تألقي بإطلالة ساحرة مع <span>لؤلؤة</span></h1>
                    <p class="hero-text">نقدم لكِ تجربة استثنائية للعناية بجمالكِ، من تصفيف الشعر والمكياج إلى العناية بالبشرة والأظافر، على أيدي أمهر الخبيرات وفي بيئة تعبق بالفخامة والاسترخاء.</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <a href="book.php" class="btn btn-primary-custom">احجزي موعدكِ الآن</a>
                        <a href="services.php" class="btn btn-secondary-custom">تصفح خدماتنا</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="hero-image-wrapper">
                    <!-- Placeholder using a classy salon image from unsplash -->
                    <img src="https://images.unsplash.com/photo-1522337660859-02fbefca4702?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Beauty Salon" class="hero-image img-fluid">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="section-padding">
    <div class="container">
        <div class="section-title-wrapper">
            <span class="section-subtitle">لماذا لؤلؤة؟</span>
            <h2 class="section-title">مميزات تجعلنا خياركِ الأول</h2>
        </div>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h3 class="feature-title">خبراء محترفون</h3>
                    <p class="text-muted">فريق عمل مكون من أفضل الخبيرات في مجال التجميل بخبرة عالمية ومحلية.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-spa"></i>
                    </div>
                    <h3 class="feature-title">منتجات عالمية</h3>
                    <p class="text-muted">نستخدم أرقى وأفضل المنتجات العالمية لضمان جودة استثنائية وآمنة تماماً.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="feature-title">برامج ولاء مكافئة</h3>
                    <p class="text-muted">نقدر عميلاتنا ونمنحهم نقاط ومكافآت قيّمة يمكن استبدالها بخدمات مجانية.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview Section -->
<section class="section-padding bg-white">
    <div class="container">
        <div class="section-title-wrapper">
            <span class="section-subtitle">خدماتنا المتميزة</span>
            <h2 class="section-title">دللي نفسكِ بأرقى الخدمات</h2>
        </div>

        <div class="row g-4">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM services WHERE is_active = 1 LIMIT 3");
                $services = $stmt->fetchAll();
                
                $icons = [
                    'hair' => 'fa-cut',
                    'nails' => 'fa-hand-sparkles',
                    'makeup' => 'fa-magic',
                    'skincare' => 'fa-leaf',
                    'eyebrow' => 'fa-eye',
                    'other' => 'fa-star'
                ];

                foreach($services as $service):
            ?>
            <div class="col-md-4">
                <div class="service-card">
                    <div class="service-img-wrapper">
                        <?php if(!empty($service['image'])): ?>
                            <img src="<?= htmlspecialchars($service['image']) ?>" alt="<?= htmlspecialchars($service['name']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
                        <?php else: ?>
                            <i class="fas <?= $icons[$service['category']] ?? 'fa-spa' ?>"></i>
                        <?php endif; ?>
                    </div>
                    <div class="service-price"><?= number_format($service['price'], 0) ?> رس</div>
                    <div class="service-content text-center">
                        <h3 class="service-title"><?= htmlspecialchars($service['name']) ?></h3>
                        <p class="service-desc"><?= htmlspecialchars(substr($service['description'], 0, 80)) ?>...</p>
                        <a href="book.php?service_id=<?= $service['id'] ?>" class="btn btn-outline-dark rounded-pill px-4">احجزي الآن</a>
                    </div>
                </div>
            </div>
            <?php endforeach; 
            } catch(PDOException $e) {
                echo "<p class='text-danger text-center'>تعذر تحميل الخدمات مؤقتاً.</p>";
            }
            ?>
        </div>
        
        <div class="text-center mt-5">
            <a href="services.php" class="btn btn-primary-custom">عرض جميع الخدمات</a>
        </div>
    </div>
</section>

<?php require_once 'includes/footer.php'; ?>
