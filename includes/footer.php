<!-- ===== FOOTER ===== -->
<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="row g-4">
                <!-- Brand -->
                <div class="col-lg-4 col-md-6">
                    <div class="footer-brand">
                        <a href="<?= $root ?? '' ?>index.php" class="footer-logo">
                            <i class="fas fa-gem"></i>
                            <span>لؤلؤة</span>
                        </a>
                        <p>صالون تجميل فاخر يقدم أرقى الخدمات بأيدي متخصصات محترفات لتكوني دائماً في أبهى صورة.</p>
                        <div class="footer-social">
                            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="Snapchat"><i class="fab fa-snapchat"></i></a>
                            <a href="#" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                            <a href="#" aria-label="TikTok"><i class="fab fa-tiktok"></i></a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6">
                    <h5 class="footer-title">روابط سريعة</h5>
                    <ul class="footer-links">
                        <li><a href="<?= $root ?? '' ?>index.php"><i class="fas fa-chevron-left"></i> الرئيسية</a></li>
                        <li><a href="<?= $root ?? '' ?>services.php"><i class="fas fa-chevron-left"></i> خدماتنا</a></li>
                        <li><a href="<?= $root ?? '' ?>book.php"><i class="fas fa-chevron-left"></i> احجزي موعدكِ</a></li>
                        <li><a href="<?= $root ?? '' ?>reviews.php"><i class="fas fa-chevron-left"></i> آراء العملاء</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">خدماتنا</h5>
                    <ul class="footer-links">
                        <li><a href="<?= $root ?? '' ?>services.php"><i class="fas fa-chevron-left"></i> تصفيف وصبغ الشعر</a></li>
                        <li><a href="<?= $root ?? '' ?>services.php"><i class="fas fa-chevron-left"></i> الأظافر والجل</a></li>
                        <li><a href="<?= $root ?? '' ?>services.php"><i class="fas fa-chevron-left"></i> مكياج وتجميل</a></li>
                        <li><a href="<?= $root ?? '' ?>services.php"><i class="fas fa-chevron-left"></i> العناية بالبشرة</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-6">
                    <h5 class="footer-title">تواصلي معنا</h5>
                    <ul class="footer-contact">
                        <li>
                            <i class="fas fa-map-marker-alt"></i>
                            <span>الرياض، حي النزهة، شارع الأمير سلطان</span>
                        </li>
                        <li>
                            <i class="fas fa-phone-alt"></i>
                            <span>920-001-234</span>
                        </li>
                        <li>
                            <i class="fas fa-envelope"></i>
                            <span>info@loloa-salon.com</span>
                        </li>
                        <li>
                            <i class="fas fa-clock"></i>
                            <span>السبت - الخميس: 9 ص - 11 م</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <p>جميع الحقوق محفوظة &copy; <?= date('Y') ?> <strong>صالون لؤلؤة للتجميل</strong></p>
        </div>
    </div>
</footer>

<!-- ===== Back to Top ===== -->
<button class="btn-back-to-top" id="backToTop" aria-label="العودة للأعلى">
    <i class="fas fa-chevron-up"></i>
</button>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>

<!-- Main JS -->
<script src="<?= $root ?? '' ?>assets/js/main.js"></script>

<script>
<?php if (isset($_SESSION['flash_message'])): ?>
    Swal.fire({
        icon: '<?= ($_SESSION['flash_type'] ?? 'success') === 'success' ? 'success' : 'error' ?>',
        title: '<?= ($_SESSION['flash_type'] ?? 'success') === 'success' ? 'نجاح!' : 'تنبيه' ?>',
        text: '<?= addslashes($_SESSION['flash_message']) ?>',
        confirmButtonText: 'حسناً',
        confirmButtonColor: '#d4af37'
    });
<?php
    unset($_SESSION['flash_message']);
    unset($_SESSION['flash_type']);
endif;
?>
</script>

<?php if(isset($extra_js)) echo $extra_js; ?>
</body>
</html>
